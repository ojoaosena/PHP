<?php
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Recife');

require_once '../autoload.php';

use app\controll\Controller;
use app\core\Application;

$config = [
  'dsn' => 'pgsql:host=localhost;port=5432;dbname=portal',
  'user' => 'administrator',
  'password' => 'asbesto'
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [Controller::class, 'loginG']);
$app->router->post('/', [Controller::class, 'loginP']);

$app->router->get('/user', [Controller::class, 'userG']);

$app->router->get('/newuser', [Controller::class, 'newUserG']);
$app->router->post('/newuser', [Controller::class, 'newUserP']);

$app->run();
?>