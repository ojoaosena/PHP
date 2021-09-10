<?php
namespace app\model;

use app\core\Model;

class User extends Model
{
  private const INACTIVE = 0;
  private const ACTIVE = 1;

  public string $login = '';
  public string $password = '';
  public string $profile = '';
  public int $status = self::INACTIVE;        

  public static function tableName(): string
  {
    return 'users';
  }

  public function rules(): array
  {
    return [
      'login' => [self::RULE_REQUIRED, self::RULE_EMAIL],
      'password' => [self::RULE_REQUIRED],
      'profile' => [self::RULE_UNIQUE]
    ];
  }

  public function attributes(): array
  {
    return ['login', 'password', 'profile', 'status'];
  }

  public function profile(): array
  {
    return ['Administrador', 'Usuário'];
  }

  public function labels(): array
  {
    return [
      'login' => 'Login',
      'password' => 'Senha',
      'profile' => 'Perfil',
    ];
  }
}
