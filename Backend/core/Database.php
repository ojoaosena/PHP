<?php
namespace app\core;

use PDO;

class Database
{
	public PDO $pdo;

	public function __construct(array $config)
	{
		$dsn = $config['dsn'] ?? '';
		$user = $config['user'] ?? '';
		$password = $config['password'] ?? '';
		$this->pdo = new PDO($dsn, $user, $password);
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

  public function mountDatabase()
  {
  }

  private function entryTable()
  {
  }

  private function userTable()
  {
    $sql = "CREATE TABLE IF NOT EXISTS users (
			id SERIAL PRIMARY KEY,
			login VARCHAR(64) NOT NULL,
			password VARCHAR(128) NOT NULL,
			profile VARCHAR(16) NOT NULL,
			status BIT(1) NOT NULL,
			created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		);";
		$this->pdo->exec($sql);
  }

  private function visitorTable()
  {
    # code...
  }
}