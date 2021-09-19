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
  <header class="w-100 position-absolute top-0 start-50 translate-middle-x">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="logo.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Visitante
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="/visitor">Editar</a></li>
                <li><a class="dropdown-item" href="/newentry">Entrada</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="/newvisitor">Cadastrar</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Usuário
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="/user">Editar</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="/newuser">Cadastrar</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="/" tabindex="-1" aria-disabled="true">Sair</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
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