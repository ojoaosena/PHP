<?php use app\core\Application; ?>
<div class="container">
    <div class="py-5 text-center">
        <h1>Novo livro</h1>
    </div>

    <?= Application::$app->form->begin('', 'post') ?>
    <div class="row mb-4">
        <div class="col-md-4">
            <h4 class="mb-3">Principal</h4>

            <div class="mb-3">
            <?= Application::$app->form->field($model, 'livro', 'text') ?>
            </div>

            <div class="mb-3">
            <?= Application::$app->form->field($model, 'autor', 'text') ?>
            </div>

            <div class="mb-3">
            <?= Application::$app->form->field($model, 'editor', 'text') ?>
            </div>

            <div class="mb-3">
            <?= Application::$app->form->field($model, 'lancamento', 'date') ?>
            </div>

            <div class="mb-3">
            <?= Application::$app->form->textArea($model, 'observacao') ?>
            </div>

            <div class="mb-3">
            <?= Application::$app->form->select($model, 'andamento', 'andamento') ?>
            </div>

            <div class="mb-3">
            <?= Application::$app->form->select($model, 'prazo', 'prazo') ?>
            </div>
        </div>

        <div class="col-md-4">
            <h4 class="mb-3">Informações</h4>

            <div class="mb-3">
            <?= Application::$app->form->field($model, 'tiragem', 'number', 'text') ?>
            </div>

            <div class="mb-3">
            <?= Application::$app->form->textArea($model, 'os') ?>
            </div>

            <div class="mb-3">
            <?= Application::$app->form->field($model, 'entrada', 'date') ?>
            </div>

            <div class="mb-3">
            <?= Application::$app->form->field($model, 'local', 'text') ?>
            </div>

            <div class="mb-3">
            <?= Application::$app->form->textArea($model, 'sinopse') ?>
            </div>

            <div class="mb-3">
            <?= Application::$app->form->textArea($model, 'genero') ?>
            </div>

            <div class="mb-3">
            <?= Application::$app->form->textArea($model, 'palavra_chave') ?>
            </div>
        </div>

        <div class="col-md-4">
            <h4 class="mb-3">Responsáveis</h4>

            <div class="mb-3">
            <?= Application::$app->form->field($model, 'usuario_preparacao', 'text') ?>
            </div>

            <div class="mb-3">
            <?= Application::$app->form->field($model, 'usuario_cotejo', 'text') ?>
            </div>

            <hr class="my-5">

            <div class="mb-3">
            <?= Application::$app->form->field($model, 'usuario_diagramacao', 'text') ?>
            </div>

            <div class="mb-3">
            <?= Application::$app->form->field($model, 'usuario_fechamento', 'text') ?>
            </div>

            <hr class="my-5">

            <div class="mb-3">
            <?= Application::$app->form->field($model, 'usuario_tratamento', 'text') ?>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-outline-secondary btn-lg btn-block my-5">Salvar</button>
    <?= Application::$app->form->end() ?>
</div>