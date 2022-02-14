<?php 

namespace app\models;
use app\core\Model;

class RegisterModel extends Model{
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $password = '';
    public string $passwordConfirm = '';
    
  public function register(){
    echo "creating new user";
  }
  
  public function rules(): array{
    return [
      'firstname' => [self::RULES_REQUIRED],
      'lastname' => [self::RULES_REQUIRED],
      'email' => [self::RULES_REQUIRED, self::RULES_EMAIL],
      'password' => [self::RULES_REQUIRED, [self::RULES_MIN, 'min' => 5], [self::RULES_MAX, 'max' => 24]],
      'passwordConfirm' => [self::RULES_REQUIRED, [self::RULES_MATCH, 'match' => 'password']],
      ];
  }
}