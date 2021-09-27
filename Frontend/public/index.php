<?php
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Recife');

require_once '../autoload.php';

use app\controll\Controller;
use app\core\Application;

$app = new Application(dirname(__DIR__));

$app->router->get('/', [Controller::class, 'loginG']);
$app->router->post('/', [Controller::class, 'loginP']);

$app->router->get('/user', [Controller::class, 'userG']);
$app->router->post('/user', [Controller::class, 'userP']);

$app->router->get('/newuser', [Controller::class, 'newUserG']);
$app->router->post('/newuser', [Controller::class, 'newUserP']);

$app->router->get('/updateuser', [Controller::class, 'userG']);

$app->router->get('/newvisitor', [Controller::class, 'newVisitorG']);
$app->router->post('/newvisitor', [Controller::class, 'newVisitorP']);

$app->router->post('/takeapicture', [Controller::class, 'takeAPicture']);

$app->router->get('/newentry', [Controller::class, 'newEntryG']);

$app->run();
?>