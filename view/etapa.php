<div class="container-fluid">
    <div class="row text-center text-light bg-secondary">
        <div class="col-1 my-2 text-truncate">#</div>
        <div class="col-2 my-2 text-truncate">Nome</div>
        <div class="col-2 my-2 text-truncate"><?= $worker ?></div>
        <div class="col-2 my-2 text-truncate">Início</div>
        <div class="col-2 my-2 text-truncate">Fim</div>
        <div class="col-2 my-2 text-truncate">Entrega</div>
        <div class="col-1 my-2 text-truncate">@</div>
    </div>
    <?php foreach ($livros as $livro): ?>
        <form action="" method="post">
        <div class="row text-center <?= $livro->colorMonth() ?>">
            <div class="col-1 my-2 text-truncate"><?= $number++ ?></div>
            <div class="col-2 my-2 text-left text-truncate" data-toggle="collapse" data-target="#collapseExample<?= $livro->getId() ?>" aria-expanded="false" aria-controls="collapseExample" role="button"><?= $livro->getLivro() ?></div>
            <div class="col-2 mt-2 text-truncate">
                <div class="collapse show" id="collapseExample<?= $livro->getId() ?>">
                    <?= $livro->$usuario() ?>
                </div>
                <div class="collapse" id="collapseExample<?= $livro->getId() ?>">
                    <input type="text" name="usuario_<?= $uri ?>" placeholder="Revisor" value="<?= $livro->$usuario() ?>">
                </div>
            </div>
            <div class="col-2 mt-2 text-truncate">
                <div class="collapse show" id="collapseExample<?= $livro->getId() ?>">
                    <?= ($livro->$entrega()) ? strftime('%d/%m/%y', strtotime($livro->$inicio())) : '' ?>
                </div>
                <div class="collapse" id="collapseExample<?= $livro->getId() ?>">
                    <input type="date" name="inicio_<?= $uri ?>" placeholder="Revisor" value="<?= $livro->$inicio() ?>">
                </div>
            </div>
            <div class="col-2 mt-2 text-truncate">
                <div class="collapse show" id="collapseExample<?= $livro->getId() ?>">
                    <?= ($livro->$entrega()) ? strftime('%d/%m/%y', strtotime($livro->$fim())) : '' ?>
                </div>
                <div class="collapse" id="collapseExample<?= $livro->getId() ?>">
                    <input type="date" name="fim_<?= $uri ?>" placeholder="Revisor" value="<?= $livro->$fim() ?>">
                </div>
            </div>
            <div class="col-1 my-2 text-truncate">
                <input type="checkbox" name="checkbox" <?= $livro->$marca() ?>>
            </div>
            <div class="col-1 my-2 text-truncate"><?= ($livro->$entrega()) ? strftime('%d/%m/%y', strtotime($livro->$entrega())) : '' ?></div>
            <div class="d-print-none col-1 text-truncate">
                <input type="submit" class="btn btn-outline-dark" name="<?= $livro->getId() ?>" value="Alterar">
            </div>
        </div>
        </form>
    <?php endforeach; ?>
</div>