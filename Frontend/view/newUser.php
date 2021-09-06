<?php use app\core\Application; ?>
<h3 class="mb-3">New User</h3>
<?= Application::$app->form->begin('post'); ?>
<?= Application::$app->form->input($model, 'login', 'text'); ?>
<?= Application::$app->form->input($model, 'password', 'password'); ?>
<?= Application::$app->form->select($model, 'profile'); ?>
<button type="submit" class="w-100 btn btn-danger">Salvar</button>
<?= Application::$app->form->end(); ?>