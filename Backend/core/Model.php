<?php
namespace app\core;

use PDO;

abstract class Model
{
  public const RULE_REQUIRED = 'required';
  public const RULE_EMAIL = 'email';
  public const RULE_MIN = 'min';
  public const RULE_MAX = 'max';
  public const RULE_MATCH = 'match';
  public const RULE_UNIQUE = 'unique';

  public $errors = [];

	abstract public static function tableName(): string;

  abstract public function attributes(): array;
  
  abstract public static function primaryKey(): string;

  abstract public function rules(): array;

  abstract public function labels(): array;

  public function loadData($data)
  {
    foreach ($data as $key => $value) {
      if (property_exists($this, $key)) {
        $this->{$key} = $value;
      }
    }
  }

  public function hasError($attribute)
  {
    return $this->errors[$attribute] ?? FALSE;
  }

  public function firstError($attribute)
  {
    return $this->errors[$attribute][0] ?? FALSE;
  }

  public function addError(string $attribute, string $message)
  {
    $this->errors[$attribute][] = $message;
  }

  private function errorMessages()
  {
    return [
      self::RULE_REQUIRED => 'Este campo é obrigatório',
      self::RULE_EMAIL => 'Preencha com email válido',
      self::RULE_MIN => 'Este campo deve conter ao menos {min} caracteres',
      self::RULE_MAX => 'Este campo deve conter o máximo de {max} caracteres',
      self::RULE_MATCH => 'Este campo deve ser igual a {match}',
      self::RULE_UNIQUE => 'Este {field} já existe'
    ];
  }

  private function ruleError(string $attribute, string $rule, $params = [])
  {
    $message = $this->errorMessages()[$rule] ?? '';

    foreach ($params as $key => $value) {
      $message = str_replace("{{$key}}", $value, $message);
    }

    $this->errors[$attribute][] = $message;
  }

  public function label($attribute)
  {
    return $this->labels()[$attribute] ?? $attribute;
  }

  public function validate()
  {
    foreach ($this->rules() as $attribute => $rules) {
      $value = $this->{$attribute};

      foreach ($rules as $rule) {
        $ruleName = $rule;

        if (!is_string($ruleName)) {
          $ruleName = $rule[0];
        }

        if ($ruleName === self::RULE_REQUIRED && !$value) {
          $this->ruleError($attribute, self::RULE_REQUIRED);
        }

        if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
          $this->ruleError($attribute, self::RULE_EMAIL);
        }

        if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
          $this->ruleError($attribute, self::RULE_MIN, $rule);
        }

        if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
          $this->ruleError($attribute, self::RULE_MAX, $rule);
        }

        if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
          $rule['match'] = $this->label($rule['match']);
          $this->ruleError($attribute, self::RULE_MATCH, $rule);
        }

        if ($ruleName === self::RULE_UNIQUE) {
          $className = $rule['class'];
          $uniqueAttr = $rule['attribute'] ?? $attribute;
          $tableName = $className::tableName();
          $statement = Application::$app->database->pdo->prepare("SELECT * FROM $tableName WHERE $uniqueAttr = :attr;");
          $statement->bindValue(":attr", $value);
          $statement->execute();
          $record = $statement->fetchObject();

          if ($record) {
            $this->ruleError($attribute, self::RULE_UNIQUE, ['field' => $this->label($attribute)]);
          }
        }
      }
    }

    return empty($this->errors);
  }

	public function save()
	{
		$tableName = static::tableName();
		$attributes = $this->attributes();
		$params = array_map(fn($attr) => ":$attr", $attributes);
		$statement = Application::$app->database->pdo->prepare("INSERT INTO $tableName (".implode(',', $attributes).") VALUES (".implode(',', $params).")");

		foreach ($attributes as $attribute) {
			$statement->bindValue(":$attribute", $this->{$attribute});
		}

		return $statement->execute();
	}

	public function update($where)
	{
		$tableName = static::tableName();
		$attributes = $this->attributes();
    $params = implode(", ", array_map(fn($attr) => "$attr = :$attr", $attributes));
    $attrib = array_keys($where);
		$sql = implode("AND ", array_map(fn($attb) => "$attb = :$attb", $attrib));
		$statement = Application::$app->database->pdo->prepare("UPDATE $tableName SET $params WHERE $sql");

		foreach ($attributes as $attribute) {

      foreach ($where as $key => $item) {
        $statement->bindValue(":$attribute", $this->{$attribute});
        $statement->bindValue(":$key", $item);
      }
    }

		return $statement->execute();
	}

	public function delete($where)
	{
		$tableName = static::tableName();
		$attributes = array_keys($where);
		$sql = implode("AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
		$statement = Application::$app->database->pdo->prepare("DELETE FROM $tableName WHERE $sql");

		foreach ($where as $key => $item) {
			$statement->bindValue(":$key", $item);
		}

		return $statement->execute();
	}

	public function findOne($where)
	{
		$tableName = static::tableName();
		$attributes = array_keys($where);
		$sql = implode("AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
		$statement = Application::$app->database->pdo->prepare("SELECT * FROM $tableName WHERE $sql");

		foreach ($where as $key => $item) {
			$statement->bindValue(":$key", $item);
		}

		$statement->execute();

		return $statement->fetchObject(static::class);
	}

	public function findAll($orderBy = '')
	{
		$tableName = static::tableName();
      $statement = Application::$app->database->pdo->prepare("SELECT * FROM $tableName");

		if ($orderBy !== '') {
      $statement = Application::$app->database->pdo->prepare("SELECT * FROM $tableName ORDER BY $orderBy");
    }

		$statement->execute();

		return $statement->fetchAll(PDO::FETCH_CLASS, static::class);
  }
}
