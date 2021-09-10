<?php use app\core\Application; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="bootstrap.min.css">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <header class="position-absolute top-0 start-50 translate-middle-x">
    <?php if (Application::$app->session->status() && Application::$app->session->text()): ?>
      <div class="alert alert-<?= Application::$app->session->status() ?>">
        <?= Application::$app->session->text() ?>
      </div>
    <?php endif; ?>
  </header>
  <main class="position-absolute top-50 start-50 translate-middle">
    {{content}}
  </main>
  <script src="bootstrap.min.js"></script>
</body>
</html>