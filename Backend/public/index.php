<?php
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Recife');

require_once '../autoload.php';

use app\controll\{UserController, VisitorController};
use app\core\Application;

$config = [
  'dsn' => 'pgsql:host=localhost;port=5432;dbname=postgres',
  'user' => 'postgres',
  'password' => 'asbesto'
];

$app = new Application(dirname(__DIR__), $config);

$tableLookup = $app->database->tableLookup();

if ($tableLookup === 0) {
	$app->database->mount();
}

$app->router->post('/', [UserController::class, 'login']);

$app->router->post('/newuser', [UserController::class, 'newUser']);

$app->router->get('/listusers', [UserController::class, 'listUsers']);

$app->router->post('/updatepassword', [UserController::class, 'password']);

$app->router->get('/profile', [UserController::class, 'updateUser']);
$app->router->get('/password', [UserController::class, 'updateUser']);
$app->router->get('/inactivate', [UserController::class, 'updateUser']);

$app->router->post('/newvisitor', [VisitorController::class, 'newVisitor']);

$app->router->get('/listvisitors', [VisitorController::class, 'listVisitors']);

$app->run();
?>