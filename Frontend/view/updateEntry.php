<div class="card shadow-lg">
  <div class="card-body">
    <?php use app\core\Application; ?>
    <h3 class="mb-3"><?= $entry['visitor_name']; ?></h3>
    <?= Application::$app->form->begin('post'); ?>
    <div class="row">
      <div class="col">
        <h5 class="mb-3">Horário</h5>
        <?= Application::$app->form->input($model, 'arrive', 'datetime-local', \DateTime::createFromFormat('Y-m-d H:i:s', $entry['arrive'])->format('Y-m-d\TH:i:s')); ?>
        <?= Application::$app->form->input($model, 'departure', 'datetime-local', date('Y-m-d\TH:i:s')); ?>
      </div>
      <div class="col">
        <h5 class="mb-3">Veículo</h5>
        <?= Application::$app->form->input($model, 'model', 'text', $entry['model']); ?>
        <?= Application::$app->form->input($model, 'plate', 'text', $entry['plate']); ?>
      </div>
      <div class="col">
        <h5 class="mb-3">Destino</h5>
        <?= Application::$app->form->input($model, 'department', 'text', $entry['department']); ?>
        <?= Application::$app->form->input($model, 'employee', 'text', $entry['employee']); ?>
      </div>
    </div>
    <div class="w-100">
      <?= Application::$app->form->textArea($model, 'observation', $entry['observation']); ?>
    </div>
    <div class="d-flex justify-content-around text-center">
      <a class="w-25 btn btn-danger" href="/listentries">Voltar</a>
      <button type="submit" id="post" class="w-25 btn btn-danger">Salvar</button>
    </div>
    <?= Application::$app->form->end(); ?>
  </div>
</div>