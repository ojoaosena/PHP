<?php
namespace app\controll;

use PDOException;
use app\core\Application;
use app\model\User;

class UserController
{
  private User $user;

  public function __construct()
  {
    $this->user = new User();
  }

  public function login()
  {
    $data = json_decode(file_get_contents('php://input'), TRUE);
    $user = $this->user->findOne(['login' => $data['login']]);
    if ($user) {
      return json_encode(password_verify($data['password'], $user->{'password'}));
    }
    return json_encode('E-mail não cadastrado');
  }

  public function newUser()
  {
    $data = json_decode(file_get_contents('php://input'), TRUE);
    $user = $this->user->findOne(['login' => $data['login']]);
    if ($user) {
      return json_encode('E-mail já foi cadastrado');
    }
    $this->user->loadData($data);
    return json_encode($this->user->save());
  }

  public function listUsers()
  {
    $users = $this->user->findAll(['status' => 1], 'login');
    foreach ($users as $user) {
      foreach ($user as $key => $value) {
        if (\DateTime::createFromFormat('Y-m-d H:i:s.u', $value)) {
          $user->{$key} = strftime("%d/%m/%y",strtotime($value));
        }
      }
    }
    return json_encode($users);
  }

  public function password()
  {
    $data = json_decode(file_get_contents('php://input'), TRUE);
    $user = $this->user->findOne(['id' => $_GET['id']]);
    $password = password_verify($data['old'], $user->password);
    if ($password) {
      $data = ['password' =>  password_hash($data['password'], PASSWORD_DEFAULT)];
      $this->user->loadData($data);
      return json_encode($this->user->update(['password'], ['id' => $_GET['id']]));
    }
    return json_encode('Senha atual incorreta');
  }

  public function updateUser()
  {
    if ($_SERVER['PATH_INFO'] === '/profile')
    {
      $user = $this->user->findOne(['id' => $_GET['id']]);
      if ($user->profile === 'Administrador')
      {
        $data = ['profile' =>  'Usuário'];
      }
      else
      {
        $data = ['profile' =>  'Administrador'];
      }
      $this->user->loadData($data);
      $this->user->update(['profile'], ['id' => $_GET['id']]);
    }

    if ($_SERVER['PATH_INFO'] === '/password')
    {
      $data = ['password' =>  password_hash('cepe'.date('Y'), PASSWORD_DEFAULT)];
      $this->user->loadData($data);
      $this->user->update(['password'], ['id' => $_GET['id']]);
    }

    if ($_SERVER['PATH_INFO'] === '/inactivate')
    {
      $data = ['status' =>  0];
      $this->user->loadData($data);
      $this->user->update(['status'], ['id' => $_GET['id']]);
    }
  }
}
?>