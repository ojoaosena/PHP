<?php
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Recife');

require_once '../autoload.php';

use app\controll\Controller;
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

$app->router->get('/', [Controller::class, 'loginG']);
$app->router->post('/', [Controller::class, 'loginP']);

$app->router->get('/users', [Controller::class, 'getUsers']);

$app->router->get('/updateuser', [Controller::class, 'getUpdateUser']);

$app->router->get('/inactivateuser', [Controller::class, 'inactivateUser']);

$app->router->get('/newuser', [Controller::class, 'newUserG']);
$app->router->post('/newuser', [Controller::class, 'newUserP']);

$app->router->get('/visitor', [Controller::class, 'visitorG']);
$app->router->post('/visitor', [Controller::class, 'visitorP']);

$app->run();
?>