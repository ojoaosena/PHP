<?php
namespace app\core;

class Application
{
	public static string $ROOT_DIR;

	public static Application $app;
	public Form $form;
  public Request $request;
	public Response $response;
	public Router $router;
	public Session $session;
  public View $view;

	function __construct($rootPath)
	{
		self::$ROOT_DIR = $rootPath;
		self::$app = $this;

		$this->form = new Form();
		$this->request = new Request();
		$this->response = new Response();
		$this->router = new Router();
		$this->session = new Session();
		$this->view = new View();
	}

	public function run()
	{
		echo $this->router->resolve();
	}
}