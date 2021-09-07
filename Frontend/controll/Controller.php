<?php
namespace app\controll;

use app\core\Application;
use app\model\User;

class Controller
{
  private $host = 'http://localhost:8080';

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
    if ($this->user->validate()) {
      $result = json_decode($this->user->json("$this->host/newuser"), TRUE);

      if (is_bool($result)) {
        Application::$app->session->setMessage('success', 'Usuário cadastrado');
        return Application::$app->response->redirect('/newuser');
      }
      Application::$app->session->setMessage('danger', $result);
      return Application::$app->response->redirect('/newuser');
    }
    return Application::$app->view->render('newUser', 'main', ['model' => $this->user]);
  }
}
?>