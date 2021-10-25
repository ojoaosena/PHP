<div class="h-75 w-50 card shadow-lg overflow-auto">
  <div class="card-body">
    <?php if (empty($entries)) : ?>
      <div class="row text-center">
        <h1>Não há entradas cadastradas</h1>
      </div>
    <?php else : ?>
    <h3 class="mb-3">Entradas</h3>
    <div class="row text-center fw-bold">
      <?php foreach ($model->attributes() as $value) : ?>
        <?php if ($value === 'visitor_name' || $value === 'arrive' || $value === 'departure') : ?>
          <div class="col-3 text-truncate"><?= $model->label($value); ?></div>
        <?php endif ?>
      <?php endforeach ?>
        <div class="col-3 text-truncate">Ações</div>
    </div>
    <hr>
    <?php foreach ($entries as $entry) : ?>
      <div class="row text-center">
        <?php foreach ($model->attributes() as $value) : ?>
          <?php if ($value === 'visitor_name' || $value === 'arrive' || $value === 'departure') : ?>
            <div class="col-3 text-truncate"><?= $entry[$value]; ?></div>
          <?php endif ?>
        <?php endforeach ?>
        <div class="col-3 text-truncate">
          <div class="d-flex justify-content-evenly">
            <a href="/updateentry?id=<?=$entry['id']?>" class="link-dark"><i data-feather="clipboard" class="align-top"></i></a>
          </div>
        </div>
      </div>
      <hr>
    <?php endforeach ?>
    <?php endif ?>
  </div>
</div>