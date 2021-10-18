<?php
namespace app\core;

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

  abstract public function rules(): array;

  abstract public function labels(): array;

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
      self::RULE_UNIQUE => 'Selecione uma opção válida'
    ];
  }

  private function ruleError(string $attribute, string $rule, $params = [])
  {
    $message = $this->errorMessages()[$rule] ?? '';

    if (!is_string($params))
    {
      foreach ($params as $key => $value)
      {
        $message = str_replace("{{$key}}", $value, $message);
      }
    }

    $this->errors[$attribute][] = $message;
  }

  public function label($attribute)
  {
    return $this->labels()[$attribute] ?? $attribute;
  }

  public function loadData($data)
  {
    $attributes = [];

    foreach ($data as $key => $value) {
      if (property_exists($this, $key)) {
        $this->{$key} = $value;
        $attributes[$key] = $value;
      }
    }

    $rls = array_intersect_key($this->rules(), $attributes);

    foreach ($rls as $attribute => $rules) {
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

        if ($ruleName === self::RULE_UNIQUE && !in_array($value, $this->$attribute(), TRUE)) {
          $this->ruleError($attribute, self::RULE_UNIQUE, $rule);
        }
      }
    }

    return empty($this->errors);
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
