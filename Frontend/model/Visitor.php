<?php
namespace app\model;

use app\core\Model;

class Visitor extends Model
{
  public string $fullName = '';
  public string $identity = '';
  public string $company = '';

  public static function tableName(): string
  {
    return 'visitors';
  }

  public function rules(): array
  {
    return [
      'fullName' => [self::RULE_REQUIRED],
      'identity' => [self::RULE_REQUIRED],
      'company' => [self::RULE_REQUIRED]
    ];
  }

  public function attributes(): array
  {
    return ['fullName', 'identity', 'company'];
  }

  public function labels(): array
  {
    return [
      'fullName' => 'Nome Completo',
      'identity' => 'Identificação',
      'company' => 'Empresa',
    ];
  }
}
