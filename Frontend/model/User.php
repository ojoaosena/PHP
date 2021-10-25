<?php
namespace app\model;

use app\core\Model;

class User extends Model
{
  private const INACTIVE = 0;
  private const ACTIVE = 1;

  public string $login = '';
  public string $old = '';
  public string $password = '';
  public string $confirm = '';
  public string $profile = '';
  public int $status = self::ACTIVE;
  public string $created_at = '';

  public static function tableName(): string
  {
    return 'users';
  }

  public function rules(): array
  {
    return [
      'login' => [self::RULE_REQUIRED, self::RULE_EMAIL],
      'old' => [self::RULE_REQUIRED],
      'password' => [self::RULE_REQUIRED],
      'confirm' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
      'profile' => [self::RULE_UNIQUE]
    ];
  }

  public function attributes(): array
  {
    return ['login', 'old', 'password', 'confirm', 'profile', 'status', 'created_at'];
  }

  public function profile(): array
  {
    return ['Administrador', 'Usuário'];
  }

  public function labels(): array
  {
    return [
      'login' => 'Login',
      'old' => 'Senha atual',
      'password' => 'Senha',
      'confirm' => 'Confirme a senha',
      'profile' => 'Perfil',
      'status' => 'Status',
      'created_at' => 'Inserido em'
    ];
  }
}
