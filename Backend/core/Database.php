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

	public function tableLookup()
	{
		$sql = "SELECT * FROM pg_catalog.pg_tables WHERE schemaname != 'pg_catalog' AND schemaname != 'information_schema';";
		return $this->pdo->exec($sql);
	}

  public function mount()
  {
		$this->user();
		$this->visitor();
		$this->entry();
  }

  private function user()
  {
    $sql = "CREATE TABLE IF NOT EXISTS users (
			login VARCHAR(64) PRIMARY KEY,
			password VARCHAR(128) NOT NULL,
			profile VARCHAR(16) NOT NULL,
			status SMALLINT NOT NULL,
			created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		);";
		$this->pdo->exec($sql);
  }

  private function visitor()
  {
    $sql = "CREATE TABLE IF NOT EXISTS visitors (
			code SERIAL PRIMARY KEY,
      image VARCHAR(128) NOT NULL,
			name VARCHAR(128) NOT NULL,
			document VARCHAR(64) NOT NULL,
			company VARCHAR(64) NOT NULL,
			created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		);";
		$this->pdo->exec($sql);
  }

  private function entry()
  {
		$sql = "CREATE TABLE IF NOT EXISTS entries (
			id SERIAL PRIMARY KEY,
			code INT REFERENCES visitors (code) NOT NULL,
			arrive TIMESTAMP NOT NULL,
			departure TIMESTAMP NOT NULL,
			model VARCHAR(16) NOT NULL,
			plate VARCHAR(8) NOT NULL,
			department VARCHAR(32) NOT NULL,
			employee VARCHAR(32) NOT NULL,
			created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		);";
		$this->pdo->exec($sql);
  }
}