<?php use app\core\Application; ?>
<div class="container">
    <div class="py-5 text-center">
        <h1><?= $livro->getLivro() ?></h1>
    </div>

    <?= Application::$app->form->begin('', 'post') ?>
    <div class="row mb-4">
        <div class="col-md-4">
            <h4 class="mb-3">Principal</h4>

            <div class="mb-3">
            <?= Application::$app->form->field($model, 'livro', 'text', $livro->getLivro()) ?>
            </div>

            <div class="mb-3">
            <?= Application::$app->form->field($model, 'autor', 'text', $livro->getAutor()) ?>
            </div>

            <div class="mb-3">
            <?= Application::$app->form->field($model, 'editor', 'text', $livro->getEditor()) ?>
            </div>

            <div class="mb-3">
            <?= Application::$app->form->field($model, 'lancamento', 'date', $livro->getLancamento()) ?>
            </div>

            <div class="mb-3">
            <?= Application::$app->form->textArea($model, 'observacao', $livro->getObservacao()) ?>
            </div>

            <div class="mb-3">
            <?= Application::$app->form->select($model, 'andamento', 'andamento', $livro->getAndamento()) ?>
            </div>

            <div class="mb-3">
            <?= Application::$app->form->select($model, 'prazo', 'prazo', $livro->getPrazo()) ?>
            </div>
        </div>

        <div class="col-md-4">
            <h4 class="mb-3">Informações</h4>

            <div class="mb-3">
            <?= Application::$app->form->field($model, 'tiragem', 'number', $livro->getTiragem()) ?>
            </div>

            <div class="mb-3">
            <?= Application::$app->form->textArea($model, 'os', $livro->getOs()) ?>
            </div>

            <div class="mb-3">
            <?= Application::$app->form->field($model, 'entrada', 'date', $livro->getEntrada()) ?>
            </div>

            <div class="mb-3">
            <?= Application::$app->form->field($model, 'local', 'text', $livro->getLocal()) ?>
            </div>

            <div class="mb-3">
            <?= Application::$app->form->textArea($model, 'sinopse', $livro->getSinopse()) ?>
            </div>

            <div class="mb-3">
            <?= Application::$app->form->textArea($model, 'genero', $livro->getGenero()) ?>
            </div>

            <div class="mb-3">
            <?= Application::$app->form->textArea($model, 'palavra_chave', $livro->getPalavra_chave()) ?>
            </div>
        </div>

        <div class="col-md-4">
            <h4 class="mb-3">Responsáveis</h4>

            <div class="mb-3">
            <?= Application::$app->form->field($model, 'usuario_preparacao', 'text', $livro->getUsuario_preparacao()) ?>
            </div>

            <div class="mb-3">
            <?= Application::$app->form->field($model, 'usuario_cotejo', 'text', $livro->getUsuario_cotejo()) ?>
            </div>

            <hr class="my-5">

            <div class="mb-3">
            <?= Application::$app->form->field($model, 'usuario_diagramacao', 'text', $livro->getUsuario_diagramacao()) ?>
            </div>

            <div class="mb-3">
            <?= Application::$app->form->field($model, 'usuario_fechamento', 'text', $livro->getUsuario_fechamento()) ?>
            </div>

            <hr class="my-5">

            <div class="mb-3">
            <?= Application::$app->form->field($model, 'usuario_tratamento', 'text', $livro->getUsuario_tratamento()) ?>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-around">
        <button type="button" class="btn btn-outline-danger btn-lg my-3" data-toggle="modal" data-target="#staticBackdrop">Apagar</button>

        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-truncate" id="staticBackdropLabel"><?= $livro->getLivro() ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja apagar este livro?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-outline-danger" name="delete" value="Apagar">
            </div>
            </div>
        </div>
        </div>
        <input type="submit" class="btn btn-outline-secondary btn-lg my-3" name="save" value="Salvar">
    </div>
    <?= Application::$app->form->end(); ?>
</div>