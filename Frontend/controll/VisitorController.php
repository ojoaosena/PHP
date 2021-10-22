<?php
namespace app\controll;

use app\core\Application;
use app\model\Visitor;

class VisitorController
{
  private $host = 'http://localhost:8080';

  private Visitor $visitor;

  public function __construct()
  {
    $this->visitor = new Visitor();
  }

  public function getNewVisitor()
  {
    return Application::$app->view->render('newVisitor', 'main', ['model' => $this->visitor]);
  }

  public function postNewVisitor()
  {
    if ($this->visitor->loadData(Application::$app->request->body()))
    {
      $result = json_decode($this->visitor->json("$this->host/newvisitor"), TRUE);

      if (is_bool($result))
      {
        Application::$app->session->setMessage('success', 'Visitante cadastrado');
        return Application::$app->response->redirect('/newvisitor');
      }
      Application::$app->session->setMessage('danger', $result);
      return Application::$app->response->redirect('/newvisitor');
    }
    return Application::$app->view->render('newVisitor', 'main', ['model' => $this->visitor]);
  }

  public function listVisitors()
  {
    $result = json_decode($this->visitor->jsonG("$this->host/listvisitors"), TRUE);
    return Application::$app->view->render('listVisitors', 'main', ['model' => $this->visitor, 'visitors' => $result]);
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
    $image = 'image.png';
    if (file_exists($image))
    {
      unlink($image);
    }
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
}
?>