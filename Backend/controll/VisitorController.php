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
    $visitors = $this->visitor->findAll('', 'name');
    return json_encode($visitors);
  }

  public function password()
  {
    $data = json_decode(file_get_contents('php://input'), TRUE);
    $user = $this->user->findOne(['login' => $_GET['login']]);
    $password = password_verify($data['old'], $user->password);
    if ($password) {
      $data = ['password' =>  password_hash($data['password'], PASSWORD_DEFAULT)];
      $this->user->loadData($data);
      return json_encode($this->user->update(['password'], ['login' => $_GET['login']]));
    }
    return json_encode('Senha atual incorreta');
  }

  public function updateUser()
  {
    if ($_SERVER['PATH_INFO'] === '/profile')
    {
      $user = $this->user->findOne(['login' => $_GET['login']]);
      if ($user->profile === 'Administrador')
      {
        $data = ['profile' =>  'Usuário'];
      }
      else
      {
        $data = ['profile' =>  'Administrador'];
      }
      $this->user->loadData($data);
      $this->user->update(['profile'], ['login' => $_GET['login']]);
    }

    if ($_SERVER['PATH_INFO'] === '/password')
    {
      $data = ['password' =>  password_hash('cepe'.date('Y'), PASSWORD_DEFAULT)];
      $this->user->loadData($data);
      $this->user->update(['password'], ['login' => $_GET['login']]);
    }

    if ($_SERVER['PATH_INFO'] === '/inactivate')
    {
      $data = ['status' =>  0];
      $this->user->loadData($data);
      $this->user->update(['status'], ['login' => $_GET['login']]);
    }
  }
}
?>