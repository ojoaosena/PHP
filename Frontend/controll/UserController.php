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
        // Refazer com as informacoes de usuario em cache
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

  public function getPassword()
  {
    return Application::$app->view->render('updatePassword', 'main', ['model' => $this->user]);
  }

  public function postPassword()
  {
    if ($this->user->loadData(Application::$app->request->body()))
    {
      $result = json_decode($this->user->json($this->host . '/updatepassword?login=' . $_SESSION['login']), TRUE);

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
      $result = json_decode($this->user->jsonG($this->host. '/profile?login=' . $_GET['login']), TRUE);
      Application::$app->session->setMessage('success', 'Perfil de '. $_GET['login'] . ' alterado');
    }

    if ($_SERVER['PATH_INFO'] === '/password')
    {
      $result = json_decode($this->user->jsonG($this->host. '/password?login=' . $_GET['login']), TRUE);
      Application::$app->session->setMessage('success', 'Senha de '. $_GET['login'] . ' resetada');
    }

    if ($_SERVER['PATH_INFO'] === '/inactivate')
    {
      $result = json_decode($this->user->jsonG($this->host. '/inactivate?login=' . $_GET['login']), TRUE);
      Application::$app->session->setMessage('danger', 'Login ' . $_GET['login'] . ' desativado');
    }
    
    return Application::$app->response->redirect('/listusers');
  }
}
?>