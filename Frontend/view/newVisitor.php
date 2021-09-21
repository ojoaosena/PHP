<div class="card shadow-lg">
  <div class="row g-0">
    <div class="col-md-4">
      <div class='video'>
        <video id='player' autoplay></video>
      </div>
      <button class='principalbotao' id='capture-btn'>Capturar</button>
      <div class='canvas'>
        <canvas id='canvas'></canvas>
      </div><br>
        <a id='salvar' class='principalancorasalvar' href=''>Salvar</a>
      <script src='takeAPic.js'></script>
      <script src='saveAPic.js'></script>
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <?php use app\core\Application; ?>
        <h3 class="mb-3">Novo visitante</h3>
        <?= Application::$app->form->begin('post'); ?>
        <?= Application::$app->form->input($model, 'fullName', 'text'); ?>
        <?= Application::$app->form->input($model, 'identity', 'text'); ?>
        <?= Application::$app->form->input($model, 'company', 'text'); ?>
        <div class="text-center">
          <button type="submit" class="w-25 btn btn-danger">Salvar</button>
        </div>
        <?= Application::$app->form->end(); ?>
      </div>
    </div>
  </div>
</div>