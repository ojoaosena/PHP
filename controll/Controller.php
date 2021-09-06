<?php
namespace app\controll;

use app\core\Application;
use app\model\User;

class Controller
{
  private User $user;

  public function __construct()
  {
    $this->user = new User();
  }

  public function loginG()
  {
    return Application::$app->view->render('login', 'main');
  }

  public function loginP()
  {
    # code...
  }

  public function newUserG()
  {
    return Application::$app->view->render('newUser', 'main');
  }

  public function newUserP()
  {
    # code...
  }
}
?>