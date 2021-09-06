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
			/* $$key transforma as chaves de array em variável de mesmo nome */
			$$key = $value;
		}

		ob_start();
		include_once Application::$ROOT_DIR."/view/$view.php";
		return ob_get_clean();
	}

	public function renderView($view, $layout, $params = [])
	{
		/* pega o conteúdo de layout como string*/
		$layoutContent = $this->layoutContent($layout);
		/* pega o conteúdo de view como string*/
		$viewContent = $this->viewContent($view, $params);
		/* busca {{content}} em $layoutContent e substitui por $viewContent */
		return str_replace('{{content}}', $viewContent, $layoutContent);
	}
}