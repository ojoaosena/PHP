<?php
namespace app\model;

use app\core\Model;

class Entry extends Model
{
  public string $input = '';
  public string $output = '';
  public string $brand = '';
  public string $model = '';
  public string $plate = '';
  public string $section = '';
  public string $responsible = '';
  public string $observation = '';

  public static function tableName(): string
  {
    return 'entries';
  }

  public function rules(): array
  {
    return [
      'input' => [self::RULE_REQUIRED],
      'output' => [self::RULE_REQUIRED],
      'brand' => [self::RULE_REQUIRED],
      'model' => [self::RULE_REQUIRED],
      'plate' => [self::RULE_REQUIRED],
      'section' => [self::RULE_REQUIRED],
      'responsible' => [self::RULE_REQUIRED],
      'observation' => [self::RULE_REQUIRED]
    ];
  }

  public function attributes(): array
  {
    return ['input', 'output', 'brand', 'model', 'plate', 'section', 'responsible', 'observation'];
  }

  public function labels(): array
  {
    return [
      'input' => 'Entrada',
      'output' => 'Saída',
      'brand' => 'Marca',
      'model' => 'Modelo',
      'plate' => 'Placa',
      'section' => 'Setor',
      'responsible' => 'Responsável',
      'observation' => 'Observação'
    ];
  }
}
