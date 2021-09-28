<?php
namespace app\controll;

use app\core\Application;
use app\model\{Entry, User, Visitor};

class ControllerA
{
  private $host = 'http://localhost:8080';

  private Entry $entry;
  private User $user;
  private Visitor $visitor;

  public function __construct()
  {
    $this->entry = new Entry();
    $this->user = new User();
    $this->visitor = new Visitor();
  }

  public function loginG()
  {
    return Application::$app->view->render('login', 'off', ['model' => $this->user]);
  }

  public function loginP()
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

  public function newVisitorG()
  {
    unlink('image.png');
    return Application::$app->view->render('newVisitor', 'main', ['model' => $this->visitor]);
  }

  public function newVisitorP()
  {
    if (empty($_POST)) {
      return Application::$app->camera->takePicture();
    }

    if ($this->visitor->loadData(Application::$app->request->body())) {
      Application::$app->camera->savePicture($_POST['image']);
      $result = json_decode($this->visitor->json("$this->host/newvisitor"), TRUE);

      if (is_bool($result)) {
        Application::$app->session->setMessage('success', 'Visitante cadastrado');
        return Application::$app->response->redirect('/newvisitor');
      }
      Application::$app->session->setMessage('danger', $result);
      return Application::$app->response->redirect('/newvisitor');
    }
    if(!in_array('image.png', scandir(dirname(__DIR__).'/public/'))) {
      Application::$app->session->setMessage('warning', 'Capture a imagem');
      return Application::$app->response->redirect('/newvisitor');
    }
    unlink('image.png');
    return Application::$app->view->render('newVisitor', 'main', ['model' => $this->visitor]);
  }

  public function newEntryG()
  {
    return Application::$app->view->render('newEntry', 'main', ['model' => $this->entry]);
  }
}
?>