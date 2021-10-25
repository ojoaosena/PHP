<?php
namespace app\core;

class Form
{
  public function begin(string $method): string
  {
    return sprintf('<form method="%s">', $method);
  }
    
  public function input(Model $model, string $attribute, string $type, ?string $value = '', ?string $disabled = ''): string
  {
    return sprintf('
      <div class="mb-3">
        <input type="%s" name="%s" placeholder="%s" value="%s" class="form-control %s" %s>
        <div class="invalid-feedback">
          %s
        </div>
      </div>
    ',
      $type,
      $attribute,
      $model->label($attribute),
      $value,
      $model->hasError($attribute) ? 'is-invalid' : '',
      $disabled,
      $model->firstError($attribute)
    );
  }
    
  public function select(Model $model, string $attribute, string $value = ''): string
  {
    return sprintf('
      <div class="mb-3">
        <select name="%s" class="form-select %s">
          %s
        </select>
        <div class="invalid-feedback">
          %s
        </div>
      </div>
    ',
      $attribute,
      $model->hasError($attribute) ? 'is-invalid' : '',
      implode("<br>", $this->option($model, $attribute, $value)),
      $model->firstError($attribute)
    );
  }
    
  private function option(Model $model, string $options, string $value)
  {
    $elements = ['<option>- Selecione uma opção -</option>'];

    foreach ($model->$options() as $option) {
      $select = '';

      if ($value === $option) {
        array_shift($elements);
        $select = 'selected';
      }

      array_push($elements, sprintf('<option value="%s" %s>%s</option>', $option, $select, $option));
    }

    return $elements;
  }
    
  public function textArea(Model $model, string $attribute, string $value = '', ?string $disabled = ''): string
  {
    return sprintf('
      <div class="mb-3">
        <textarea name="%s" placeholder="%s" class="form-control %s" %s>%s</textarea>
        <div class="invalid-feedback">
          %s
        </div>
      </div>
    ',
      $attribute,
      $model->label($attribute),
      $model->hasError($attribute) ? 'is-invalid' : '',
      $disabled,
      $value,
      $model->firstError($attribute)
    );
  }

  public function end(): string
  {
    return '</form>';
  }
}