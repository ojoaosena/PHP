<?php use app\core\Application ?>
<h3 class="mb-3">Login</h3>
<?= Application::$app->form->begin('post') ?>
<?= Application::$app->form->input($model, 'login', 'text') ?>
<?= Application::$app->form->input($model, 'password', 'password') ?>
<button type="submit" class="w-100 btn btn-danger">Entrar</button>
<?= Application::$app->form->end() ?>