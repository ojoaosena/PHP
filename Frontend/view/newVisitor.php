<?php use app\core\Application; ?>
<h3 class="mb-3">Novo visitante</h3>
<?= Application::$app->form->begin('post'); ?>
<div class="row">
  <div class="col">
    <h1>Câmera</h1>
  </div>
  <div class="col">
    <?= Application::$app->form->input($model, 'fullName', 'text'); ?>
    <?= Application::$app->form->input($model, 'identity', 'text'); ?>
    <?= Application::$app->form->input($model, 'company', 'text'); ?>
  </div>
</div>
<div class="text-center">
  <button type="submit" class="w-25 btn btn-danger">Salvar</button>
</div>
<?= Application::$app->form->end(); ?>