<div class="card shadow-lg">
  <div class="card-body">
    <?php use app\core\Application; ?>
    <h3 class="mb-3"><?= $entry['visitor_name']; ?></h3>
    <div class="row">
      <div class="col">
        <h5 class="mb-3">Horário</h5>
        <?= Application::$app->form->input($model, 'arrive', 'datetime-local', \DateTime::createFromFormat('Y-m-d H:i:s', $entry['arrive'])->format('Y-m-d\TH:i:s'), 'disabled'); ?>
        <?= Application::$app->form->input($model, 'departure', 'datetime-local', \DateTime::createFromFormat('Y-m-d H:i:s', $entry['departure'])->format('Y-m-d\TH:i:s'), 'disabled'); ?>
      </div>
      <div class="col">
        <h5 class="mb-3">Veículo</h5>
        <?= Application::$app->form->input($model, 'model', 'text', $entry['model'], 'disabled'); ?>
        <?= Application::$app->form->input($model, 'plate', 'text', $entry['plate'], 'disabled'); ?>
      </div>
      <div class="col">
        <h5 class="mb-3">Destino</h5>
        <?= Application::$app->form->input($model, 'department', 'text', $entry['department'], 'disabled'); ?>
        <?= Application::$app->form->input($model, 'employee', 'text', $entry['employee'], 'disabled'); ?>
      </div>
    </div>
    <div class="w-100">
      <?= Application::$app->form->textArea($model, 'observation', $entry['observation'], 'disabled'); ?>
    </div>
    <div class="d-flex justify-content-around text-center">
      <a class="w-25 btn btn-danger" href="/listentries">Voltar</a>
    </div>
  </div>
</div>