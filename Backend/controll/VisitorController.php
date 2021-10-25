<?php
namespace app\controll;

use PDOException;
use app\core\Application;
use app\model\Visitor;

class VisitorController
{
  private Visitor $visitor;

  public function __construct()
  {
    $this->visitor = new Visitor();
  }

  public function newVisitor()
  {
    $data = json_decode(file_get_contents('php://input'), TRUE);
    $visitor = $this->visitor->findOne(['name' => $data['name']]);
    if ($visitor) {
      return json_encode('Visitante já foi cadastrado');
    }
    $this->visitor->loadData($data);
    return json_encode($this->visitor->save());
  }

  public function listVisitors()
  {
    $visitors = $this->visitor->findAll([], 'name');
    return json_encode($visitors);
  }

  public function getUpdateVisitor()
  {
    $visitor = $this->visitor->findOne(['id' => $_GET['id']]);
    return json_encode($visitor);
  }

  public function postUpdateVisitor()
  {
    $data = json_decode(file_get_contents('php://input'), TRUE);
    unset($data['image']);
    $this->visitor->loadData($data);
    return json_encode($this->visitor->update(array_keys($data), ['id' => $_GET['id']]));
  }
}
?>