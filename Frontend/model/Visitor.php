<?php
namespace app\model;

use app\core\Model;

class Visitor extends Model
{
  public string $image = '';
  public string $name = '';
  public string $document = '';
  public string $company = '';

  public static function tableName(): string
  {
    return 'visitors';
  }

  public function rules(): array
  {
    return [
      'name' => [self::RULE_REQUIRED],
      'document' => [self::RULE_REQUIRED],
      'company' => [self::RULE_REQUIRED]
    ];
  }

  public function attributes(): array
  {
    return ['image', 'name', 'document', 'company'];
  }

  public function labels(): array
  {
    return [
      'name' => 'Nome',
      'document' => 'Identificação',
      'company' => 'Empresa',
    ];
  }
}
