<!-- <h2 class='principalc2'>Capturar Imagem</h2>
<div class='video'>
    <video id='player' autoplay></video>
</div>
<button class='principalbotao' id='capture-btn'>Capturar</button>
<div class='canvas'>
    <canvas id='canvas'></canvas>
</div><br>
    <a id='salvar' class='principalancorasalvar' href=''>Salvar</a>
<script src='/javascript/capturaimagem.js'></script>
<script src='/javascript/salvacaptura.js'></script> -->
<?php use app\core\Application; ?>
<h3 class="mb-3">Novo visitante</h3>
<?= Application::$app->form->begin('post'); ?>
<div class="row">
  <div class="col">
    <div class='video'>
      <video id='player' width="320" height="240" autoplay></video>
    </div>
    <button class='principalbotao' id='capture-btn'>Capturar</button>
    <div class='canvas'>
      <canvas id='canvas'></canvas>
    </div>
    <script src='capturaimagem.js'></script>
    <script src='salvacaptura.js'></script>
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