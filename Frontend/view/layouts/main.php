<?php use app\core\Application; ?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="bootstrap.min.css">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portaria</title>
  <script src="feather.min.js"></script>
</head>
<body class="h-100 d-flex flex-column">
  <header class="h-25 d-block">
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
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Portaria</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Visitante
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="/newvisitor">Cadastrar</a></li>
                <li><a class="dropdown-item" href="/listvisitors">Listar</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Entrada
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="/listentries">Listar</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Usuário
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="/updatepassword">Senha</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="/newuser">Cadastrar</a></li>
                <li><a class="dropdown-item" href="/listusers">Listar</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/">Sair</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <?php if (Application::$app->session->status() && Application::$app->session->text()): ?>
      <div class="w-25 m-auto d-flex justify-content-center alert alert-<?= Application::$app->session->status() ?>">
        <?= Application::$app->session->text() ?>
      </div>
    <?php endif; ?>
  </header>
  <main class="h-50 d-flex justify-content-center align-items-center">
    {{content}}
  </main>
  <footer class="h-25 d-flex justify-content-center align-items-end">
    <p class="text-center text-muted">© <?=date('Y')?> Companhia Editora de Pernambuco</p>
  </footer>
  <script src="bootstrap.min.js"></script>
  <script>feather.replace()</script>
</body>
</html>