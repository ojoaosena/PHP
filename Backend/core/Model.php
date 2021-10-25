<?php
namespace app\core;

use PDO;

abstract class Model
{
	abstract public static function tableName(): string;

  abstract public function attributes(): array;

  public function loadData($data)
  {
    foreach ($data as $key => $value) {
      if (property_exists($this, $key)) {
        $this->{$key} = $value;
      }
    }
  }

	public function save()
	{
		$tableName = static::tableName();
		$attributes = $this->attributes();
		$params = array_map(fn($attr) => ":$attr", $attributes);
		$statement = Application::$app->database->pdo->prepare("INSERT INTO $tableName (".implode(',', $attributes).") VALUES (".implode(',', $params).")");

		foreach ($attributes as $attribute)
    {
			$statement->bindValue(":$attribute", $this->{$attribute});
		}

		return $statement->execute();
	}

	public function update($attributes, $where)
	{
		$tableName = static::tableName();
    $params = implode(", ", array_map(fn($attr) => "$attr = :$attr", $attributes));
    $attrib = array_keys($where);
		$sql = implode("AND ", array_map(fn($attb) => "$attb = :$attb", $attrib));
		$statement = Application::$app->database->pdo->prepare("UPDATE $tableName SET $params WHERE $sql");

		foreach ($attributes as $attribute)
    {
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

	public function findAll($where = [], $orderBy = '')
	{
		$tableName = static::tableName();
    $statement = Application::$app->database->pdo->prepare("SELECT * FROM $tableName");

    if (!empty($where) && !empty($orderBy))
    {
      $attributes = array_keys($where);
		  $sql = implode("AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
      $statement = Application::$app->database->pdo->prepare("SELECT * FROM $tableName WHERE $sql ORDER BY $orderBy");
      foreach ($where as $key => $item) {
        $statement->bindValue(":$key", $item);
      }
      $statement->execute();

		  return $statement->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    if (!empty($where)) {
      $attributes = array_keys($where);
		  $sql = implode("AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
      $statement = Application::$app->database->pdo->prepare("SELECT * FROM $tableName WHERE $sql");
      foreach ($where as $key => $item) {
        $statement->bindValue(":$key", $item);
      }
      $statement->execute();

		  return $statement->fetchAll(PDO::FETCH_CLASS, static::class);
    }

		if (!empty($orderBy)) {
      $statement = Application::$app->database->pdo->prepare("SELECT * FROM $tableName ORDER BY $orderBy");
      $statement->execute();

		  return $statement->fetchAll(PDO::FETCH_CLASS, static::class);
    }
  }

  public function json(string $url, string $token = '')
  {
    $data = [];

    $ch = curl_init($url);

    foreach ($this->attributes() as $attribute) {
      $data[$attribute] = $this->{$attribute};
		}

    $payload = json_encode($data);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

    $header = [
      'Content-Type: application/json',
      $token
    ];

    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

    $result = curl_exec($ch);

    curl_close($ch);

    return $result;
  }

  public function jsonG(string $url, string $token = '')
  {
    $ch = curl_init($url);

    $header = [
      'Content-Type: application/json',
      $token
    ];

    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

    $result = curl_exec($ch);

    curl_close($ch);

    return $result;
  }
}
