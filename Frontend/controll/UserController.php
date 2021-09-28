<?php
namespace app\controll;

use app\core\Application;
use app\model\User;

class UserController
{
  private $host = 'http://localhost:8080';

  private User $user;

  public function __construct()
  {
    $this->user = new User();
  }

  public function getLogin()
  {
    return Application::$app->view->render('login', 'off', ['model' => $this->user]);
  }

  public function postLogin()
  {
    if ($this->user->loadData(Application::$app->request->body()))
    {
      $result = json_decode($this->user->json($this->host), TRUE);

      if (!is_bool($result))
      {
        Application::$app->session->setMessage('danger', $result);
        return Application::$app->response->redirect('/');
      }

      if ($result)
      {
        Application::$app->session->setMessage('success', 'Usuário logado');
        return Application::$app->response->redirect('/');
      }

      Application::$app->session->setMessage('danger', 'Senha incorreta');
      return Application::$app->response->redirect('/');
    }
    return Application::$app->view->render('login', 'main', ['model' => $this->user]);
  }

  public function getNewUser()
  {
    return Application::$app->view->render('newUser', 'main', ['model' => $this->user]);
  }

  public function postNewUser()
  {
    if ($this->user->loadData(Application::$app->request->body()))
    {
      $result = json_decode($this->user->json("$this->host/newuser"), TRUE);

      if (is_bool($result))
      {
        Application::$app->session->setMessage('success', 'Usuário cadastrado');
        return Application::$app->response->redirect('/newuser');
      }
      Application::$app->session->setMessage('danger', $result);
      return Application::$app->response->redirect('/newuser');
    }
    return Application::$app->view->render('newUser', 'main', ['model' => $this->user]);
  }

  public function showUsers()
  {
    $result = json_decode($this->user->jsonG("$this->host/users"), TRUE);
    return Application::$app->view->render('showUsers', 'main', ['model' => $this->user, 'users' => $result]);
  }

  public function getUpdateUser()
  {
    $result = json_decode($this->user->jsonG($this->host. '/updateuser?login=' . $_GET['login']), TRUE);
    return Application::$app->view->render('updateUser', 'main', ['model' => $this->user, 'user' => $result]);
  }

  public function postUpdateUser()
  {
    # code...
  }

  public function inactivateUser()
  {
    $result = json_decode($this->user->jsonG($this->host. '/inactivateuser?login=' . $_GET['login']), TRUE);
    return Application::$app->response->redirect('/showusers');
  }
}
?>