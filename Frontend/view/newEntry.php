<?php use app\core\Application; ?>
<h3 class="mb-3">Registro</h3>
<?= Application::$app->form->begin('post'); ?>
<h5 class="mb-3">Horário</h5>
<?= Application::$app->form->input($model, 'input', 'datetime-local'); ?>
<?= Application::$app->form->input($model, 'output', 'datetime-local'); ?>
<h5 class="mb-3">Veículo</h5>
<?= Application::$app->form->input($model, 'brand', 'text'); ?>
<?= Application::$app->form->input($model, 'model', 'text'); ?>
<?= Application::$app->form->input($model, 'plate', 'text'); ?>
<h5 class="mb-3">Destino</h5>
<?= Application::$app->form->input($model, 'section', 'text'); ?>
<?= Application::$app->form->input($model, 'responsible', 'text'); ?>
<?= Application::$app->form->textArea($model, 'observation'); ?>
<button type="submit" class="w-100 btn btn-danger">Salvar</button>
<?= Application::$app->form->end(); ?>