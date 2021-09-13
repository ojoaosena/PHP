<h3 class="mb-3">Usuários</h3>
<div class="row text-center">
  <?php foreach ($model->attributes() as $value) : ?>
    <div class="col-2 text-truncate"><?= $model->label($value); ?></div>
  <?php endforeach; ?>
</div>
<?php foreach ($users as $user) : ?>
  <div class="mb-3 row text-center">
    <?php foreach ($model->attributes() as $value) : ?>
      <div class="col-2 text-truncate"><?= $user[$value]; ?></div>
    <?php endforeach; ?>
  </div>
<?php endforeach; ?>