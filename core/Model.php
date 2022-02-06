<?php
namespace app\core;

abstract class Model{
  public const RULES_REQUIRED = 'required';
  public const RULES_EMAIL = 'email';
  public const RULES_MIN = 'min';
  public const RULES_MAX = 'max';
  public const RULES_MATCH = 'match';
  
  public function loadData($data){
    foreach ($data as $key => $value){
      if(property_exists($this, $key)){
        $this->{$key} = $value;
      }
    }
  }
  abstract public function rules(): array;
  public array $errors = [];
  public function validate(){
    foreach ($this->rules() as $attribute => $rules){
      $value = $this->{$attribute};
      foreach ($rules as $rule){
        $ruleName = $rule;
        if(!is_string($ruleName)){
          $ruleName = $rule[0];
        }
        if($ruleName === self::RULES_REQUIRED && !$value){
          $this->addError($attribute, self::RULES_REQUIRED);
        }
      if($ruleName === self::RULES_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)){
        $this->addError($attribute, self::RULES_EMAIL);
      }
      }
    }
    return empty($this->errors);
  }
  
  public function addError(string $attribute, string $rule){
    $messages = $this->errorMessages()[$rule] ?? "";
    $this->errors[$attribute][] = $messages; 
  }
  
  public function errorMessages(){
    return [
      self::RULES_REQUIRED => "This field is required",
      self::RULES_EMAIL => "This email must be a valid format",
      self::RULES_MIN => "min length of this field must be {min}",
      self::RULES_MAX => "max length of this field must be {max}",
      self::RULES_MATCH => "This field must match {match}"
      ];
  }
}