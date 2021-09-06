<?php
namespace app\model;

use app\core\Model;

class User extends Model
{
    private const STATUS_INACTIVE = 0;
    private const STATUS_ACTIVE = 1;
    private const STATUS_DELETED = 2;

    public string $login = '';
    public string $email = '';
    public int $status = self::STATUS_INACTIVE;
    public string $senha = '';
    public string $confirmaSenha = '';

    public static function tableName(): string
    {
        return 'usuarios';
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function save()
    {
        $this->status = self::STATUS_INACTIVE;
        $this->senha = password_hash($this->senha, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function rules(): array
    {
        return [
            'login' => [self::RULE_REQUIRED, [self::RULE_UNIQUE, 'class' => self::class]],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'senha' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 4], [self::RULE_MAX, 'max' => 16]],
            'confirmaSenha' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'senha']],
        ];
    }

    public function attributes(): array
    {
        return ['login', 'email', 'senha', 'status'];
    }

    public function attributesCheck(): array
    {
        return ['login', 'email', 'senha', 'status'];
    }

    public function labels(): array
    {
        return [
            'login' => 'Login',
            'email' => 'Email',
            'senha' => 'Senha',
            'confirmaSenha' => 'Confirma senha'
        ];
    }
}
