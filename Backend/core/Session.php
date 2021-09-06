<?php
namespace app\core;

class Session
{
	public function __construct()
	{		
		session_start();

		$_SESSION['message']['remove'] = TRUE;
	}

	public function setMessage(string $status, string $text)
	{
		$_SESSION['message'] = [
			'remove' => FALSE,
			'text' => $text,
			'status' => $status
		];
	}

	public function status()
	{
		return $_SESSION['message']['status'] ?? FALSE;
	}

	public function text()
	{
		return $_SESSION['message']['text'] ?? FALSE;
	}

	public function __destruct()
	{
		if ($_SESSION['message']['remove']) {
			unset($_SESSION['message']);
		}
	}
}