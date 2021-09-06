<div class="container-fluid">
    <div class="row text-center text-light bg-secondary">
        <div class="col-1 my-2 text-truncate">#</div>
        <div class="d-none d-print-flex col-1 my-2 text-truncate">Mês</div>
        <div class="col-5 my-2 text-truncate">Nome</div>
        <div class="col-2 my-2 text-truncate">Lançamento</div>
        <div class="col-2 my-2 text-truncate">Andamento</div>
        <div class="col-1 my-2 text-truncate">Prazo</div>
        <div class="d-print-none col-1 my-2 text-truncate">@</div>
    </div>
    <?php foreach ($livros as $livro): ?>
        <div class="row text-center <?= $livro->colorMonth() ?>">
            <div class="col-1 my-2 text-truncate"><?= $number++ ?></div>
            <div class="d-none d-print-flex col-1 my-2"><?= strtoupper(strftime("%b", strtotime($livro->getLancamento()))) ?></div>
            <div class="col-5 my-2 text-left text-truncate"><?= $livro->getLivro() ?></div>
            <div class="col-2 my-2 text-truncate"><?= strftime("%d/%m/%y", strtotime($livro->getLancamento())) ?></div>
            <div class="col-2 my-2 text-truncate <?= $livro->colorAndamento() ?>"><?= $livro->getAndamento() ?></div>
            <div class="col-1 my-2 text-truncate <?= $livro->colorPrazo() ?>"><?= $livro->getPrazo() ?></div>
            <div class="d-print-none col-1 text-truncate">
                <a href="/atualizarlivro?id=<?= $livro->getId() ?>" class="btn btn-outline-dark">Alterar</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>