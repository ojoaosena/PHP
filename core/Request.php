<?php
namespace app\core;

class Request
{
	public function path()
	{
		$path = $_SERVER['PATH_INFO'] ?? '/';
		$position = strpos($path, '?');

		if ($position === FALSE) {
			return $path;
		}

		return substr($path, 0, $position);
	}

	public function method()
	{
		return strtoupper($_SERVER['REQUEST_METHOD']);
	}

	public function isGet()
	{
		return $this->method() === 'GET';
	}

	public function isPost()
	{
		return $this->method() === 'POST';
	}

	public function body()
	{
		$body = [];

		if ($this->isGet()) {
			foreach ($_GET as $key => $value) {
	            $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
	        }
		}

		if ($this->isPost()) {
			foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
		}

		return $body;
	}
}