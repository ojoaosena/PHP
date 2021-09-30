<div class="card shadow-lg">
  <div class="card-body">
    <?php if (empty($users)) : ?>
      <div class="row text-center">
        <h1>Não há usuários cadastrados ou ativos</h1>
      </div>
    <?php else : ?>
    <h3 class="mb-3">Usuários</h3>
    <div class="bg-dark text-light row text-center">
      <?php foreach ($model->attributes() as $value) : ?>
        <?php if ($value !== 'confirm') : ?>
          <div class="col-2 text-truncate"><?= $model->label($value); ?></div>
        <?php endif; ?>
      <?php endforeach; ?>
        <div class="col-2 text-truncate">Ações</div>
    </div>
    <?php foreach ($users as $user) : ?>
      <div class="mb-3 row text-center">
        <?php foreach ($model->attributes() as $value) : ?>
          <?php if ($value !== 'confirm') : ?>
            <div class="col-2 text-truncate"><?= $user[$value]; ?></div>
          <?php endif; ?>
        <?php endforeach; ?>
        <div class="col-2 text-truncate">
          <div class="d-flex justify-content-evenly">
            <a href="/updateuser?login=<?=$user['login']?>" class="link-dark"><i data-feather="edit" class="align-top"></i></a>
            <a href="/inactivateuser?login=<?=$user['login']?>" class="link-danger"><i data-feather="delete" class="align-top"></i></a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>