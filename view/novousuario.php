<?php use app\core\Application; ?>
<div class="container">
    <div class="py-5 text-center">
        <h1>Novo usuário</h1>
    </div>

    <?= Application::$app->form->begin('', 'post') ?>
    <?= Application::$app->form->field($model, 'login', 'text') ?>
    <?= Application::$app->form->field($model, 'email', 'email') ?>
    <div class="row mb-4">
        <div class="col-6">
            <?= Application::$app->form->field($model, 'senha', 'password') ?>
        </div>

        <div class="col-6">
            <?= Application::$app->form->field($model, 'confirmaSenha', 'password') ?>
        </div>
    </div>

    <button type="submit" class="btn btn-outline-secondary btn-lg btn-block my-5">Salvar</button>
    <?= Application::$app->form->end() ?>
</div>