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

	public function mountDb()
	{
		$year = date('Y');
		$sql = "SHOW TABLES;";
		$prepare = $this->pdo->prepare($sql);
		$prepare->execute();
		$array = $prepare->fetchAll(PDO::FETCH_COLUMN);
		$arraySearch = array_search("livros$year", $array);

		if ($prepare->rowCount() === 0) {
			$this->createUsersTable();
			$this->createLogsTable();
		}

		if (!$arraySearch) {
			$this->createLivro($year);
		}

		$sql = "SELECT * FROM livros$year";
		$prepare = $this->pdo->prepare($sql);
		$prepare->execute();

		if ($prepare->rowCount() === 0) {
			return TRUE;
		}
	}

	private function createUsersTable()
	{
		$sql = "CREATE TABLE IF NOT EXISTS usuarios (
			id INT AUTO_INCREMENT PRIMARY KEY,
			nome VARCHAR(16) NOT NULL,
			sobrenome VARCHAR(16) NOT NULL,
			email VARCHAR(64) NOT NULL,
			senha VARCHAR(128) NOT NULL,
			status TINYINT NOT NULL,
			criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		);";
		$this->pdo->exec($sql);
	}

	private function createLivro($year)
	{
		$sql = "CREATE TABLE IF NOT EXISTS livros$year (
			id INT AUTO_INCREMENT PRIMARY KEY,
			livro VARCHAR(256) NOT NULL,
			autor VARCHAR(128),
			editor VARCHAR(128),
			lancamento DATE NOT NULL,
			observacao VARCHAR(512),
			andamento VARCHAR(16) NOT NULL,
			prazo VARCHAR(8) NOT NULL,
			tiragem VARCHAR(8),
			os VARCHAR(16),
			entrada VARCHAR(16),
			local VARCHAR(32),
			sinopse VARCHAR(512),
			genero VARCHAR(32),
			palavra_chave VARCHAR(64),
			usuario_preparacao VARCHAR(64),
			inicio_preparacao DATE,
			fim_preparacao DATE,
			marca_preparacao VARCHAR(8),
			entrega_preparacao DATE,
			usuario_diagramacao VARCHAR(64),
			inicio_diagramacao DATE,
			fim_diagramacao DATE,
			marca_diagramacao VARCHAR(8),
			entrega_diagramacao DATE,
			usuario_cotejo VARCHAR(64),
			inicio_cotejo DATE,
			fim_cotejo DATE,
			marca_cotejo VARCHAR(8),
			entrega_cotejo DATE,
			usuario_tratamento VARCHAR(64),
			usuario_ilustracao VARCHAR(64),
			inicio_tratamento DATE,
			fim_tratamento DATE,
			marca_tratamento VARCHAR(8),
			entrega_tratamento DATE,
			usuario_fechamento VARCHAR(64),
			inicio_fechamento DATE,
			fim_fechamento DATE,
			marca_fechamento VARCHAR(8),
			entrega_fechamento DATE,
			inicio_isbn DATE,
			fim_isbn DATE,
			marca_isbn VARCHAR(8),
			entrega_isbn DATE,
			inicio_ficha DATE,
			fim_ficha DATE,
			marca_ficha VARCHAR(8),
			entrega_ficha DATE,
			inicio_marketing DATE,
			fim_marketing DATE,
			marca_marketing VARCHAR(8),
			entrega_marketing DATE,
			inicio_capa DATE,
			fim_capa DATE,
			marca_capa VARCHAR(8),
			entrega_capa DATE,
			inicio_boneca DATE,
			fim_boneca DATE,
			marca_boneca VARCHAR(8),
			entrega_boneca DATE,
			inicio_grafica DATE,
			fim_grafica DATE,
			marca_grafica VARCHAR(8),
			entrega_grafica DATE,
			fim_ebook DATE,
			marca_ebook VARCHAR(8),
			entrega_ebook DATE,
			inicio_imprensa DATE,
			fim_imprensa DATE,
			marca_imprensa VARCHAR(8),
			entrega_imprensa DATE,
			marca_contrato VARCHAR(8),
			assinado_contrato VARCHAR(8),
			created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		);";
		$this->pdo->exec($sql);
	}

	private function createLogsTable()
	{
		$sql = "CREATE TABLE registros (
			id INT AUTO_INCREMENT PRIMARY KEY,
			usuario VARCHAR(32) NOT NULL,
			livro VARCHAR(256) NOT NULL,
			atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		);";
		$this->pdo->exec($sql);
	}
}