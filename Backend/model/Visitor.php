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

  public static function primaryKey(): string
  {
    return 'code';
  }

  public function attributes(): array
  {
    return ['image', 'name', 'document', 'company'];
  }
}
