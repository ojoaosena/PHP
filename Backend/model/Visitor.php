<?php
namespace app\model;

use app\core\Model;

class Visitor extends Model
{
    public string $name = '';
    public string $password = '';
    public string $profile = '';
    public int $status = self::INACTIVE;

    public static function tableName(): string
    {
      return 'users';
    }

    public static function primaryKey(): string
    {
      return 'id';
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
