<?php use app\core\Application; ?>
<h1>Carregar arquivo CSV</h1>

<?= Application::$app->form->begin('', 'post', 'multipart/form-data') ?>
<?= Application::$app->form->field($model, 'csvFile', 'file') ?>
<button type="submit" class="btn btn-primary">Submit</button>
<?= Application::$app->form->end() ?>