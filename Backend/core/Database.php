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
	$sql = "SELECT * FROM pg_catalog.pg_tables
		WHERE schemaname != 'pg_catalog'
		AND schemaname != 'information_schema'
	;";
	if (!$this->pdo->exec($sql)) {
		$this->userTable;
		$this->visitorTable;
		$this->entryTable;
	}
  }

  private function entryTable()
  {
	$sql = "CREATE TABLE IF NOT EXISTS entries (
		id SERIAL NOT NULL,
		code INT NOT NULL,
		in TIMESTAMP NOT NULL,
		out TIMESTAMP NOT NULL,
		model VARCHAR(16) NOT NULL,
		plate VARCHAR(8) NOT NULL,
		department VARCHAR(32) NOT NULL,
		employee VARCHAR(32) NOT NULL,
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY (id),
		FOREIGN KEY (code) REFERENCES visitors (code)
	);";
	$this->pdo->exec($sql);
  }

  private function userTable()
  {
    $sql = "CREATE TABLE IF NOT EXISTS users (
			id SERIAL,
			login VARCHAR(64) NOT NULL,
			password VARCHAR(128) NOT NULL,
			profile VARCHAR(16) NOT NULL,
			status BIT(1) NOT NULL,
			created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (id),
		);";
		$this->pdo->exec($sql);
  }

  private function visitorTable()
  {
    $sql = "CREATE TABLE IF NOT EXISTS visitors (
		id SERIAL NOT NULL,
		code SERIAL NOT NULL,
		name VARCHAR(128) NOT NULL,
		document VARCHAR(64) NOT NULL,
		company VARCHAR(64) NOT NULL,
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY (id),
	);";
	$this->pdo->exec($sql);
  }
}