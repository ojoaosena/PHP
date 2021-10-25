<?php
namespace app\controll;

use PDOException;
use app\core\Application;
use app\model\{Entry, Visitor};

class EntryController
{
  private Entry $entry;
  private Visitor $visitor;

  public function __construct()
  {
    $this->entry = new Entry();
    $this->visitor = new Visitor();
  }

  public function getNewEntry()
  {
    $visitor = $this->visitor->findOne(['id' => $_GET['id']]);
    return json_encode($visitor);
  }

  public function postNewEntry()
  {
    $visitor = $this->visitor->findOne(['id' => $_GET['id']]);
    $data = json_decode(file_get_contents('php://input'), TRUE);
    if (empty($data['departure']))
    {
      $data['departure'] = NULL;
    }
    else
    {
      $data['departure'] = str_replace('T', ' ', $data['departure']);
    }
    $data['visitor_name'] = $visitor->{'name'};
    $data['arrive'] = str_replace('T', ' ', $data['arrive']);
    $this->entry->loadData($data);
    return json_encode($this->entry->save());
  }

  public function listEntries()
  {
    $entries = $this->entry->findAll([], 'arrive desc');
    return json_encode($entries);
  }
  
  public function getUpdateEntry()
  {
    $entry = $this->entry->findOne(['id' => $_GET['id']]);
    return json_encode($entry);
  }

  public function postUpdateEntry()
  {
    $data = json_decode(file_get_contents('php://input'), TRUE);
    unset($data['visitor_name']);
    $data['arrive'] = str_replace('T', ' ', $data['arrive']);
    $data['departure'] = str_replace('T', ' ', $data['departure']);
    $this->entry->loadData($data);
    return json_encode($this->entry->update(array_keys($data), ['id' => $_GET['id']]));
  }
  
  public function viewEntry()
  {
    $entry = $this->entry->findOne(['id' => $_GET['id']]);
    return json_encode($entry);
  }
}
?>