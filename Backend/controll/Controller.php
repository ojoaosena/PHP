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