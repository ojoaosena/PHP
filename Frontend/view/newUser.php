<div class="card shadow-lg">
  <div class="card-body">
    <?php use app\core\Application; ?>
    <?php if (empty($user)) : ?>
      <h3 class="mb-3">Novo usuário</h3>
      <?= Application::$app->form->begin('post'); ?>
      <?= Application::$app->form->input($model, 'login', 'text'); ?>
      <?= Application::$app->form->input($model, 'password', 'password'); ?>
      <?= Application::$app->form->select($model, 'profile'); ?>
    <?php else : ?>
      <h3 class="mb-3">Atualizar usuário</h3>
      <?= Application::$app->form->begin('post'); ?>
      <?= Application::$app->form->input($model, 'login', 'text', $user['login']); ?>
      <?= Application::$app->form->input($model, 'password', 'password', $user['password']); ?>
      <?= Application::$app->form->select($model, 'profile', $user['profile']); ?>
    <?php endif; ?>
      <div class="text-center">
        <button type="submit" class="btn btn-danger">Salvar</button>
      </div>
      <?= Application::$app->form->end(); ?>
  </div>
</div>