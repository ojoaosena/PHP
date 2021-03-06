<div class="card shadow-lg">
  <div class="card-body">
    <?php use app\core\Application; ?>
    <h3 class="mb-3"><?= $visitor['name']; ?></h3>
    <?= Application::$app->form->begin('post'); ?>
    <div class="row">
      <div class="col">
        <h5 class="mb-3">Horário</h5>
        <?= Application::$app->form->input($model, 'arrive', 'datetime-local', date('Y-m-d\TH:i:s')); ?>
        <?= Application::$app->form->input($model, 'departure', 'datetime-local'); ?>
      </div>
      <div class="col">
        <h5 class="mb-3">Veículo</h5>
        <?= Application::$app->form->input($model, 'model', 'text'); ?>
        <?= Application::$app->form->input($model, 'plate', 'text'); ?>
      </div>
      <div class="col">
        <h5 class="mb-3">Destino</h5>
        <?= Application::$app->form->input($model, 'department', 'text'); ?>
        <?= Application::$app->form->input($model, 'employee', 'text'); ?>
      </div>
    </div>
    <div class="w-100">
      <?= Application::$app->form->textArea($model, 'observation'); ?>
    </div>
    <div class="d-flex justify-content-around text-center">
      <a class="w-25 btn btn-danger" href="/listvisitors">Voltar</a>
      <button type="submit" id="post" class="w-25 btn btn-danger">Salvar</button>
    </div>
    <?= Application::$app->form->end(); ?>
  </div>
</div>