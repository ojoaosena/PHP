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
  public int $status = self::ACTIVE;

  public static function tableName(): string
  {
    return 'users';
  }

  public static function primaryKey(): string
  {
    return 'login';
  }

  public function save()
  {
    $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    return parent::save();
  }

  public function attributes(): array
  {
    return ['login', 'password', 'profile', 'status'];
  }

  public function profile(): array
  {
    return ['Administrator', 'Usuário'];
  }
}
