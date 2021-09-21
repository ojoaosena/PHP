<?php
namespace app\model;

use app\core\Model;

class Entry extends Model
{
  public int $code;
  public string $entry = '';
  public string $out = '';
  public string $model = '';
  public string $plate = '';
  public string $department = '';
  public string $employee = '';

  public static function tableName(): string
  {
    return 'entries';
  }

  public static function primaryKey(): string
  {
    return 'id';
  }

  public function attributes(): array
  {
    return ['entry', 'out', 'model', 'plate', 'department', 'employee'];
  }
}
