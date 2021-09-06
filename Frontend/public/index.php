<?php
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Recife');

require_once '../autoload.php';

use app\controll\Controller;
use app\core\Application;

$app = new Application(dirname(__DIR__));

$app->router->get('/', [Controller::class, 'loginG']);
$app->router->post('/', [Controller::class, 'loginP']);

$app->router->get('/newuser', [Controller::class, 'newUserG']);
$app->router->post('/newuser', [Controller::class, 'newUserP']);

$app->run();
?>