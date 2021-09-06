<?php
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Recife');

require_once '../autoload.php';

use app\controll\SiteController;
use app\core\Application;

$config = [
    'dsn' => 'mysql:host=localhost;port=3306;dbname=editora',
    'user' => 'root',
    'password' => 2357
];

/* dirname(path) = caminho da raiz da unidade de armazenamento até o path */
$app = new Application(dirname(__DIR__), $config);

if ($app->database->mountDb()) {
    $app->router->get('/', [SiteController::class, 'upload']);
	$app->router->post('/', [SiteController::class, 'upload']);
} else {
    $app->router->get('/novousuario', [SiteController::class, 'newUser']);
    $app->router->post('/novousuario', [SiteController::class, 'newUser']);

    $app->router->get('/', [SiteController::class, 'homeBook']);
    $app->router->post('/', [SiteController::class, 'homeBook']);

    $app->router->get('/novolivro', [SiteController::class, 'newBook']);
    $app->router->post('/novolivro', [SiteController::class, 'newBook']);

    $app->router->get('/atualizarlivro', [SiteController::class, 'updateBook']);
    $app->router->post('/atualizarlivro', [SiteController::class, 'updateBook']);

    $app->router->get('/preparacao', [SiteController::class, 'etapa']);
    $app->router->post('/preparacao', [SiteController::class, 'etapa']);

    $app->router->get('/cotejo', [SiteController::class, 'etapa']);
    $app->router->post('/cotejo', [SiteController::class, 'etapa']);

    $app->router->get('/diagramacao', [SiteController::class, 'etapa']);
    $app->router->post('/diagramacao', [SiteController::class, 'etapa']);

    $app->router->get('/fechamento', [SiteController::class, 'etapa']);
    $app->router->post('/fechamento', [SiteController::class, 'etapa']);

    $app->router->get('/tratamento', [SiteController::class, 'etapa']);
    $app->router->post('/tratamento', [SiteController::class, 'etapa']);
}

$app->run();