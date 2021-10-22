<?php
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Recife');

require_once '../autoload.php';

use app\controll\{EntryController, UserController, VisitorController};
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

$app->router->get('/newvisitor', [VisitorController::class, 'getNewVisitor']);
$app->router->post('/newvisitor', [VisitorController::class, 'postNewVisitor']);

$app->router->post('/takeapicture', [VisitorController::class, 'takeAPicture']);

$app->router->get('/listvisitors', [VisitorController::class, 'listVisitors']);

$app->router->get('/newentry', [EntryController::class, 'newEntryG']);

$app->run();
?>