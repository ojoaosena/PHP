<div class="card shadow-lg">
  <div class="card-body">
    <?php use app\core\Application ?>
    <h3 class="mb-3">Atualizar senha</h3>
    <?= Application::$app->form->begin('post'); ?>
    <?= Application::$app->form->input($model, 'old', 'password') ?>
    <?= Application::$app->form->input($model, 'password', 'password') ?>
    <?= Application::$app->form->input($model, 'confirm', 'password') ?>
    <div class="text-center">
      <button type="submit" class="btn btn-danger">Salvar</button>
    </div>
    <?= Application::$app->form->end() ?>
  </div>
</div>