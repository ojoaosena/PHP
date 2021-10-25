<?php use app\core\Application; ?>
<div class="card shadow-lg">
  <div class="row">
    <div class="col-7">
      <div class="m-3">
        <img width="320" height="240" src="./images/<?= $visitor['image'] ?>">
      </div>
    </div>
    <div class="col-5">
      <div id="card" class="card-body">
      <h3 class="mb-3">Visitante</h3>
        <?= Application::$app->form->begin('post'); ?>
        <?= Application::$app->form->input($model, 'name', 'text', $visitor['name']); ?>
        <?= Application::$app->form->input($model, 'document', 'text', $visitor['document']); ?>
        <?= Application::$app->form->input($model, 'company', 'text', $visitor['company']); ?>
        <div class="d-flex justify-content-around text-center">
          <a class="btn btn-danger" href="/listvisitors">Voltar</a>
          <button type="submit" id="post" class="btn btn-danger">Salvar</button>
        </div>
        <?= Application::$app->form->end(); ?>
      </div>
    </div>
  </div>
</div>