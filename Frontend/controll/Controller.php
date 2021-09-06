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
    return Application::$app->view->render('login', 'main', ['model' => $this->user]);
  }

  public function loginP()
  {
    
  }

  public function newUserG()
  {
    return Application::$app->view->render('newUser', 'main', ['model' => $this->user]);
  }

  public function newUserP()
  {
    $this->user->loadData(Application::$app->request->body());
    $this->user->validate();
    return Application::$app->view->render('newUser', 'main', ['model' => $this->user]);
  }
}
?>