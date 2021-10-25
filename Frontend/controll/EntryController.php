<?php
namespace app\controll;

use app\core\Application;
use app\model\{Entry, Visitor};

class EntryController
{
  private $host = 'http://localhost:8080';

  private Entry $entry;
  private Visitor $visitor;

  public function __construct()
  {
    $this->entry = new Entry();
    $this->visitor = new Visitor();
  }

  public function getNewEntry()
  {
    $result = json_decode($this->visitor->jsonG("$this->host/newentry?id=" . $_GET['id']), TRUE);
    return Application::$app->view->render('newEntry', 'main', ['model' => $this->entry, 'visitor' => $result]);
  }

  public function postNewEntry()
  {
    if ($this->entry->loadData(Application::$app->request->body()))
    {
      $result = json_decode($this->entry->json("$this->host/newentry?id=" . $_GET['id']), TRUE);

      Application::$app->session->setMessage('success', 'Entrada cadastrada');
      return Application::$app->response->redirect('/listentries');
    }
    return Application::$app->view->render('newEntry', 'main', ['model' => $this->entry]);
  }

  public function listEntries()
  {
    $result = json_decode($this->entry->jsonG("$this->host/listentries"), TRUE);
    return Application::$app->view->render('listEntries', 'main', ['model' => $this->entry, 'entries' => $result]);
  }

  public function getUpdateEntry()
  {
    $result = json_decode($this->entry->jsonG("$this->host/updateentry?id=" . $_GET['id']), TRUE);
    return Application::$app->view->render('updateEntry', 'main', ['model' => $this->entry, 'entry' => $result]);
  }
}
?>