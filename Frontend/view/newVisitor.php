<div class="card shadow-lg">
  <div class="row">
    <div id="capture-btn" class="col-7">
      <div id="video" class='video m-3'>
        <video width="320" height="240" id='player' autoplay></video>
      </div>
      <canvas id='canvas' style="width: 0px; height: 0px;"></canvas>
      <script src='takeAPic.js'></script>
      <script src='saveAPic.js'></script>
    </div>
    <div class="col-5">
      <div class="card-body">
        <?php use app\core\Application; ?>
        <h3 class="mb-3">Novo visitante</h3>
        <?= Application::$app->form->begin('post'); ?>
        <?= Application::$app->form->input($model, 'fullName', 'text'); ?>
        <?= Application::$app->form->input($model, 'identity', 'text'); ?>
        <?= Application::$app->form->input($model, 'company', 'text'); ?>
        <div class="text-center">
          <button type="submit" class="btn btn-danger">Salvar</button>
        </div>
        <?= Application::$app->form->end(); ?>
      </div>
    </div>
  </div>
</div>