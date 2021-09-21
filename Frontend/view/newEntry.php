<div class="card shadow-lg">
  <div class="card-body">
    <?php use app\core\Application; ?>
    <h3 class="mb-3">Registro</h3>
    <?= Application::$app->form->begin('post'); ?>
    <div class="row">
      <div class="col">
        <h5 class="mb-3">Horário</h5>
        <?= Application::$app->form->input($model, 'input', 'datetime-local', date('Y-m-d\TH:i:s')); ?>
        <?= Application::$app->form->input($model, 'output', 'datetime-local'); ?>
      </div>
      <div class="col">
        <h5 class="mb-3">Veículo</h5>
        <?= Application::$app->form->input($model, 'model', 'text'); ?>
        <?= Application::$app->form->input($model, 'plate', 'text'); ?>
      </div>
      <div class="col">
        <h5 class="mb-3">Destino</h5>
        <?= Application::$app->form->input($model, 'section', 'text'); ?>
        <?= Application::$app->form->input($model, 'responsible', 'text'); ?>
      </div>
    </div>
    <div class="w-100">
      <?= Application::$app->form->textArea($model, 'observation'); ?>
    </div>
    <div class="text-center">
      <button type="submit" class="w-25 btn btn-danger">Salvar</button>
    </div>
    <?= Application::$app->form->end(); ?>
  </div>
</div>