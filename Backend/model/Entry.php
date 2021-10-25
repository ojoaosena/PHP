<?php
namespace app\model;

use app\core\Model;

class Entry extends Model
{
  public string $visitor_name = '';
  public string $arrive = '';
  public $departure = NULL;
  public string $model = '';
  public string $plate = '';
  public string $department = '';
  public string $employee = '';
  public $observation = NULL;

  public static function tableName(): string
  {
    return 'entries';
  }

  public function attributes(): array
  {
    return ['visitor_name', 'arrive', 'departure', 'model', 'plate', 'department', 'employee', 'observation'];
  }
}
