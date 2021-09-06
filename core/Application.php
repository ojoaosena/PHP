<?php
namespace app\core;

class Application
{
	public static string $ROOT_DIR;

	public static Application $app;

	public Database $database;
	public Form $form;
    public Request $request;
	public Response $response;
	public Router $router;
	public Session $session;
    public View $view;

	function __construct($rootPath, array $config)
	{
		self::$ROOT_DIR = $rootPath;
		/* $app serve para usar as classes através de Application fora desta classe */
		self::$app = $this;

		$this->database = new Database($config);
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