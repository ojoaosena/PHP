<?php
namespace app\core;

class Form
{
  public function begin(string $method): string
  {
    return sprintf('<form method="%s">', $method);
  }
    
  public function input(Model $model, string $attribute, string $type, ?string $value = ''): string
  {
    return sprintf('
      <div class="mb-3">
        <input type="%s" name="%s" placeholder="%s" value="%s" class="form-control %s">
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
      $model->firstError($attribute)
    );
  }
    
  public function select(Model $model, string $attribute, string $options, string $value = ''): string
  {
    return sprintf('
      <div class="form-select">
        <select  name="%s" class="form-control %s">
          %s
        </select>
        <div class="invalid-feedback">
          %s
        </div>
      </div>
    ',
      $attribute,
      $model->hasError($attribute) ? 'is-invalid' : '',
      implode("<br>", $this->option($model, $options, $value)),
      $model->firstError($attribute)
    );
  }
    
  private function option(Model $model, string $options, string $value)
  {
    $elements = [];

    foreach ($model->$options() as $option) {
      $select = '';

      if ($value === $option) {
        $select = 'selected';
      }

      array_push($elements, sprintf('<option value="%s" %s>%s</option>', $option, $select, $option));
    }

    return $elements;
  }
    
  public function textArea(Model $model, string $attribute, string $value = ''): string
  {
    return sprintf('
      <div class="form-group">
        <label>%s</label>
        <textarea name="%s" class="form-control %s">%s</textarea>
        <div class="invalid-feedback">
          %s
        </div>
      </div>
    ',
      $model->label($attribute),
      $attribute,
      $model->hasError($attribute) ? 'is-invalid' : '',
      $value,
      $model->firstError($attribute)
    );
  }

  public function end(): string
  {
    return '</form>';
  }
}