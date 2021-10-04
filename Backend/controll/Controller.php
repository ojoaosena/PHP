<?php
namespace app\controll;

use PDOException;
use app\core\Application;
use app\model\User;

class Controller
{
  private User $user;

  public function __construct()
  {
    $this->user = new User();
  }

  public function loginG()
  {
    
  }

  public function loginP()
  {
    $data = json_decode(file_get_contents('php://input'), TRUE);
    $user = $this->user->findOne(['login' => $data['login']]);
    if ($user) {
      return json_encode(password_verify($data['password'], $user->{'password'}));
    }
    return json_encode('E-mail não cadastrado');
  }

  public function getUsers()
  {
    $users = $this->user->findAll(['status' => 1]);
    foreach ($users as $user) {
      foreach ($user as $key => $value) {
        if (\DateTime::createFromFormat('Y-m-d H:i:s.u', $value)) {
          $user->{$key} = strftime("%d-%m-%y %T",strtotime($value));
        }
      }
    }
    return json_encode($users);
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

  public function visitorG()
  {
    # code...
  }

  public function newUserG()
  {
    
  }

  public function newUserP()
  {
    $data = json_decode(file_get_contents('php://input'), TRUE);
    $user = $this->user->findOne(['login' => $data['login']]);
    if ($user) {
      return json_encode('E-mail já foi cadastrado');
    }
    $this->user->loadData($data);
    return json_encode($this->user->save());
  }
}
?>