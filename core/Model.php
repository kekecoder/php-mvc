<?php
namespace app\core;

abstract class Model
{
    public const RULES_REQUIRED = 'required';
    public const RULES_EMAIL = 'email';
    public const RULES_MIN = 'min';
    public const RULES_MAX = 'max';
    public const RULES_MATCH = 'match';
    public const RULES_UNIQUE = 'unique';

    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }
    abstract public function rules(): array;

    public array $errors = [];
    
    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::RULES_REQUIRED && !$value) {
                    $this->addError($attribute, self::RULES_REQUIRED);
                }
                if ($ruleName === self::RULES_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, self::RULES_EMAIL);
                }
                if ($ruleName === self::RULES_MIN && strlen($value) < $rule['min']) {
                    $this->addError($attribute, self::RULES_MIN, $rule);
                }
                if ($ruleName === self::RULES_MAX && strlen($value) > $rule['max']) {
                    $this->addError($attribute, self::RULES_MAX, $rule);
                }
                if ($ruleName === self::RULES_MATCH && $value !== $this->{$rule['match']}) {
                    $this->addError($attribute, self::RULES_MATCH, $rule);
                }
                if($ruleName === self::RULES_UNIQUE){
                    $className = $rule['class'];
                    $uniqueAttr = $rule['attribute'] ?? $attribute;
                    $tableName = $className::tableName();

                    $statment = Application::$app->db->prepare("SELECT  * FROM $tableName WHERE $uniqueAttr = :attr");
                    $statment->bindValue(":attr", $value);

                    $statment->execute();
                    $record = $statment->fetchObject();

                    if($record){
                        $this->addError($attribute, self::RULES_UNIQUE, ['field' => $attribute]);
                    }
                }
            }
        }
        return empty($this->errors);
    }

    public function addError(string $attribute, string $rule, $params = [])
    {
        $messages = $this->errorMessages()[$rule] ?? "";
        foreach ($params as $key => $value) {
            $messages = str_replace("{{$key}}", $value, $messages);
        }
        $this->errors[$attribute][] = $messages;
    }

    public function errorMessages()
    {
        return [
            self::RULES_REQUIRED => "This field is required",
            self::RULES_EMAIL => "This email must be a valid format",
            self::RULES_MIN => "The length of this field must not be less than {min}",
            self::RULES_MAX => "The length of this field must not be greater than {max}",
            self::RULES_MATCH => "This field must match {match}",
            self::RULES_UNIQUE => "Record with this {field} already exists",
        ];
    }

    public function hasError($attribute){
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute){
        return $this->errors[$attribute][0] ?? false;
    }
}