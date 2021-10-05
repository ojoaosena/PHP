<?php
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Recife');

require_once '../autoload.php';

use app\controll\UserController;
use app\core\Application;

$app = new Application(dirname(__DIR__));

$app->router->get('/', [UserController::class, 'getLogin']);
$app->router->post('/', [UserController::class, 'postLogin']);

$app->router->get('/listusers', [UserController::class, 'listUsers']);

$app->router->get('/updatepassword', [UserController::class, 'getPassword']);
$app->router->post('/updatepassword', [UserController::class, 'postPassword']);

$app->router->get('/profile', [UserController::class, 'updateUser']);
$app->router->get('/password', [UserController::class, 'updateUser']);
$app->router->get('/inactivate', [UserController::class, 'updateUser']);

$app->router->get('/newuser', [UserController::class, 'getNewUser']);
$app->router->post('/newuser', [UserController::class, 'postNewUser']);

$app->router->get('/newvisitor', [Controller::class, 'newVisitorG']);
$app->router->post('/newvisitor', [Controller::class, 'newVisitorP']);

$app->router->post('/takeapicture', [Controller::class, 'takeAPicture']);

$app->router->get('/newentry', [Controller::class, 'newEntryG']);

$app->run();
?>