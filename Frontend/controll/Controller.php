<?php
namespace app\controll;

use app\core\Application;
use app\model\{Entry, User, Visitor};

class Controller
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

  public function userG()
  {
    $result = json_decode($this->user->jsonG("$this->host/user"), TRUE);
    return Application::$app->view->render('showUsers', 'main', ['model' => $this->user, 'users' => $result]);
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

  public function newVisitorG()
  {
    return Application::$app->view->render('newVisitor', 'main', ['model' => $this->visitor]);
  }

  public function newVisitorP()
  {
    var_dump(dirname(__DIR__));
  }

  public function newEntryG()
  {
    return Application::$app->view->render('newEntry', 'main', ['model' => $this->entry]);
  }
}
?>