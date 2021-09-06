<?php use app\core\Application; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php if (Application::$app->session->status() && Application::$app->session->text()): ?>
    <div class="alert alert-<?= Application::$app->session->status() ?> text-center my-0 py-1 m-auto">
      <?= Application::$app->session->text() ?>
    </div>
  <?php endif; ?>
  {{content}}
</body>
</html>