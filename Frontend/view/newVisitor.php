<?php use app\core\Application; ?>
<div class="card shadow-lg">
  <div class="row">
    <div class="col-7">
      <div id="video" class="m-3">
        <video width="320" height="240" id="player" autoplay></video>
      </div>
      <canvas id="canvas" class="d-none"></canvas>
    </div>
    <div class="col-5">
      <div id="card" class="card-body">
        <h3 class="mb-3">Novo visitante</h3>
        <?= Application::$app->form->begin('post'); ?>
        <?= Application::$app->form->input($model, 'name', 'text'); ?>
        <?= Application::$app->form->input($model, 'document', 'text'); ?>
        <?= Application::$app->form->input($model, 'company', 'text'); ?>
        <div class="d-flex justify-content-around text-center">
          <button type="button" id="capture" class="btn btn-danger">Capturar</button>
          <button type="submit" id="post" class="btn btn-danger">Salvar</button>
        </div>
        <?= Application::$app->form->end(); ?>
      </div>
    </div>
  </div>
</div>
<script src='takeAPic.js'></script>