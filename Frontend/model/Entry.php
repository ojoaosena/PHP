<?php
namespace app\model;

use app\core\Model;

class Entry extends Model
{
  public string $visitor_name = '';
  public string $arrive = '';
  public string $departure = '';
  public string $model = '';
  public string $plate = '';
  public string $department = '';
  public string $employee = '';
  public string $observation = '';

  public static function tableName(): string
  {
    return 'entries';
  }

  public function rules(): array
  {
    return [
      'arrive' => [self::RULE_REQUIRED],
      'model' => [self::RULE_REQUIRED],
      'plate' => [self::RULE_REQUIRED],
      'department' => [self::RULE_REQUIRED],
      'employee' => [self::RULE_REQUIRED]
    ];
  }

  public function attributes(): array
  {
    return ['visitor_name', 'arrive', 'departure', 'model', 'plate', 'department', 'employee', 'observation'];
  }

  public function labels(): array
  {
    return [
      'visitor_name' => 'Nome',
      'arrive' => 'Entrada',
      'departure' => 'Saída',
      'model' => 'Modelo',
      'plate' => 'Placa',
      'department' => 'Setor',
      'employee' => 'Responsável',
      'observation' => 'Observação'
    ];
  }
}
