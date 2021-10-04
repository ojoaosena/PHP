<div class="h-75 w-50 card shadow-lg overflow-auto">
  <div class="card-body">
    <?php if (empty($users)) : ?>
      <div class="row text-center">
        <h1>Não há usuários cadastrados ou ativos</h1>
      </div>
    <?php else : ?>
    <h3 class="mb-3">Usuários</h3>
    <div class="row text-center fw-bold">
      <?php foreach ($model->attributes() as $value) : ?>
        <?php if ($value === 'login' || $value === 'profile' || $value === 'created_at') : ?>
          <div class="col-3 text-truncate"><?= $model->label($value); ?></div>
        <?php endif ?>
      <?php endforeach ?>
        <div class="col-3 text-truncate">Ações</div>
    </div>
    <hr>
    <?php foreach ($users as $user) : ?>
      <div class="row text-center">
        <?php foreach ($model->attributes() as $value) : ?>
          <?php if ($value === 'login' || $value === 'profile' || $value === 'created_at') : ?>
            <div class="col-3 text-truncate"><?= $user[$value]; ?></div>
          <?php endif ?>
        <?php endforeach ?>
        <div class="col-3 text-truncate">
          <div class="d-flex justify-content-evenly">
            <a href="/profile?login=<?=$user['login']?>" class="link-dark"><i data-feather="<?= $user['profile'] === 'Usuário' ? 'user-check' : 'user' ?>" class="align-top"></i></a>
            <a href="/password?login=<?=$user['login']?>" class="link-dark"><i data-feather="key" class="align-top"></i></a>
            <a href="/inactivate?login=<?=$user['login']?>" class="link-danger"><i data-feather="delete" class="align-top"></i></a>
          </div>
        </div>
      </div>
      <hr>
    <?php endforeach ?>
    <?php endif ?>
  </div>
</div>