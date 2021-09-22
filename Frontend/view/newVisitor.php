<?php use app\core\Application; ?>
<?= Application::$app->form->begin('post'); ?>
<div class="card shadow-lg">
  <div class="row">
    <div id="capture" class="col-7">
      <div id="video" class="m-3">
        <video width="320" height="240" id="player" autoplay></video>
      </div>
      <canvas id="canvas" class="d-none"></canvas>
    </div>
    <div class="col-5">
      <div class="card-body">
        <h3 class="mb-3">Novo visitante</h3>
        <?= Application::$app->form->input($model, 'fullName', 'text'); ?>
        <?= Application::$app->form->input($model, 'identity', 'text'); ?>
        <?= Application::$app->form->input($model, 'company', 'text'); ?>
        <div class="text-center">
          <button type="submit" id="post" class="btn btn-danger">Salvar</button>
        </div>
        <?= Application::$app->form->end(); ?>
      </div>
    </div>
  </div>
</div>
<script src='takeAPic.js'></script>