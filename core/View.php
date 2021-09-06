<?php
namespace app\core;

class View
{
	private function layoutContent($layout)
	{
		ob_start();
		include_once Application::$ROOT_DIR."/view/layouts/$layout.php";

		return ob_get_clean();
	}

	private function viewContent($view, $params)
	{
		foreach ($params as $key => $value) {
			$$key = $value;
		}

		ob_start();
		include_once Application::$ROOT_DIR."/view/$view.php";

		return ob_get_clean();
	}

	public function render($view, $layout, $params = [])
	{
		$layoutContent = $this->layoutContent($layout);
		$viewContent = $this->viewContent($view, $params);

		return str_replace('{{content}}', $viewContent, $layoutContent);
	}
}