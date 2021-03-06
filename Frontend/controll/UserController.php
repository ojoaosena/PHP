<?php
namespace app\controll;

use app\core\Application;
use app\model\User;

class UserController
{
  private $host = 'http://localhost:8080/';

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

      if (is_string($result))
      {
        Application::$app->session->setMessage('danger', $result);
        return Application::$app->response->redirect('/');
      }

      // if ($result)
      // {
        echo "<pre>";
        var_dump($result);
        echo "</pre>";
        exit;
      // }

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
        return Application::$app->response->redirect('/listusers');
      }
      Application::$app->session->setMessage('danger', $result);
      return Application::$app->response->redirect('/newuser');
    }
    return Application::$app->view->render('newUser', 'main', ['model' => $this->user]);
  }

  public function getPassword()
  {
    return Application::$app->view->render('updatePassword', 'main', ['model' => $this->user]);
  }

  public function postPassword()
  {
    if ($this->user->loadData(Application::$app->request->body()))
    {
      $result = json_decode($this->user->json($this->host . '/updatepassword?id=' . $_SESSION['id']), TRUE);

      if (is_bool($result))
      {
        Application::$app->session->setMessage('success', 'Senha atualizada');
        return Application::$app->response->redirect('/updatepassword');
      }
      Application::$app->session->setMessage('danger', $result);
      return Application::$app->response->redirect('/updatepassword');
    }
    return Application::$app->view->render('updatePassword', 'main', ['model' => $this->user]);
  }

  public function listUsers()
  {
    $result = json_decode($this->user->jsonG("$this->host/listusers"), TRUE);
    return Application::$app->view->render('listUsers', 'main', ['model' => $this->user, 'users' => $result]);
  }

  public function updateUser()
  {
    if ($_SERVER['PATH_INFO'] === '/profile')
    {
      $result = json_decode($this->user->jsonG($this->host. '/profile?id=' . $_GET['id']), TRUE);
      Application::$app->session->setMessage('success', 'Perfil de '. $_GET['id'] . ' alterado');
    }

    if ($_SERVER['PATH_INFO'] === '/password')
    {
      $result = json_decode($this->user->jsonG($this->host. '/password?id=' . $_GET['id']), TRUE);
      Application::$app->session->setMessage('success', 'Senha de '. $_GET['id'] . ' resetada');
    }

    if ($_SERVER['PATH_INFO'] === '/inactivate')
    {
      $result = json_decode($this->user->jsonG($this->host. '/inactivate?id=' . $_GET['id']), TRUE);
      Application::$app->session->setMessage('danger', 'id ' . $_GET['id'] . ' desativado');
    }
    
    return Application::$app->response->redirect('/listusers');
  }
}
?>