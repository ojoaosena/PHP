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
    $image = 'image.png';
    if (file_exists($image))
    {
      unlink($image);
    }
    return Application::$app->view->render('newVisitor', 'main', ['model' => $this->visitor]);
  }

  public function postNewVisitor()
  {
    if (empty($_POST))
    {
      return Application::$app->camera->takePicture();
    }

    if ($this->visitor->loadData(Application::$app->request->body()))
    {
      Application::$app->camera->savePicture($_POST['image']);
      $result = json_decode($this->visitor->json("$this->host/newvisitor"), TRUE);

      if (is_bool($result))
      {
        Application::$app->session->setMessage('success', 'Visitante cadastrado');
        return Application::$app->response->redirect('/listvisitors');
      }
      Application::$app->session->setMessage('danger', $result);
      return Application::$app->response->redirect('/newvisitor');
    }
    if(!in_array('image.png', scandir(dirname(__DIR__).'/public/')))
    {
      Application::$app->session->setMessage('warning', 'Capture a imagem');
      return Application::$app->response->redirect('/newvisitor');
    }
    unlink('image.png');
    return Application::$app->view->render('newVisitor', 'main', ['model' => $this->visitor]);
  }

  public function listVisitors()
  {
    $result = json_decode($this->visitor->jsonG("$this->host/listvisitors"), TRUE);
    return Application::$app->view->render('listVisitors', 'main', ['model' => $this->visitor, 'visitors' => $result]);
  }

  public function getUpdateVisitor()
  {
    $result = json_decode($this->visitor->jsonG("$this->host/updatevisitor?id=" . $_GET['id']), TRUE);
    return Application::$app->view->render('updateVisitor', 'main', ['model' => $this->visitor, 'visitor' => $result]);
  }

  public function postUpdateVisitor()
  {
    if ($this->visitor->loadData(Application::$app->request->body())) {
      $result = json_decode($this->visitor->json("$this->host/updatevisitor?id=" . $_GET['id']), TRUE);

      Application::$app->session->setMessage('success', 'Visitante atualizado');
      return Application::$app->response->redirect('/listvisitors');
    }
  }
}
?>