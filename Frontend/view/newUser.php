<div class="card shadow-lg">
  <div class="card-body">
    <?php use app\core\Application; ?>
    <h3 class="mb-3">Novo usuário</h3>
    <?= Application::$app->form->begin('post'); ?>
    <?= Application::$app->form->input($model, 'login', 'text'); ?>
    <?= Application::$app->form->input($model, 'password', 'password'); ?>
    <?= Application::$app->form->select($model, 'profile'); ?>
    <div class="text-center">
      <button type="submit" class="w-25 btn btn-danger">Salvar</button>
    </div>
    <?= Application::$app->form->end(); ?>
  </div>
</div>