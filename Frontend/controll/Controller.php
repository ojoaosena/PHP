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
    if ($this->user->loadData(Application::$app->request->body())) {
      $result = json_decode($this->user->json($this->host), TRUE);

      if (!is_bool($result)) {
        Application::$app->session->setMessage('danger', $result);
        return Application::$app->response->redirect('/');
      }

      if ($result) {
        Application::$app->session->setMessage('success', 'Usuário logado');
        return Application::$app->response->redirect('/');
      }

      Application::$app->session->setMessage('danger', 'Senha incorreta');
      return Application::$app->response->redirect('/');
    }
    return Application::$app->view->render('login', 'main', ['model' => $this->user]);
  }

  public function newUserG()
  {
    return Application::$app->view->render('newUser', 'main', ['model' => $this->user]);
  }

  public function newUserP()
  {
    if ($this->user->loadData(Application::$app->request->body())) {
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

  public function newGuestG()
  {
    return Application::$app->view->render('newGuest', 'main', ['model' => $this->user]);
  }
}
?>