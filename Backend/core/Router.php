<?php
namespace app\core;

class Router
{
	private $routes = [];

	public function get($path, $callback)
	{
		$this->routes['GET'][$path] = $callback;
	}

	public function post($path, $callback)
	{
		$this->routes['POST'][$path] = $callback;
	}

	public function resolve()
	{
		$path = Application::$app->request->path();
		$method = Application::$app->request->method();

		$callback = $this->routes[$method][$path] ?? FALSE;

		if ($callback === FALSE) {
			Application::$app->response->codeHTTP(404);
			return Application::$app->view->render('notFound', 'main');
		}

		if (is_array($callback)) {
			$callback[0] = new $callback[0]();
		}

		return call_user_func($callback);
	}
}