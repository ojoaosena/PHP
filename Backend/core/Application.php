<?php
namespace app\core;

class Application
{
	public static string $ROOT_DIR;

	public static Application $app;
	public Database $database;
  public Request $request;
	public Response $response;
	public Router $router;
	public Session $session;

	function __construct($rootPath, array $config)
	{
		self::$ROOT_DIR = $rootPath;
		self::$app = $this;

		$this->database = new Database($config);
		$this->request = new Request();
		$this->response = new Response();
		$this->router = new Router();
		$this->session = new Session();
	}

	public function run()
	{
		echo $this->router->resolve();
	}
}