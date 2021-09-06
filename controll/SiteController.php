<?php
namespace app\controll;

use app\core\Application;
use app\model\{Book, User};

class SiteController
{
    private Book $book;
    private User $user;

    public function __construct()
    {
        $this->book = new Book();
        $this->user = new User();

    }

	public function upload()
    {
        if (Application::$app->request->isPost()) {
            $key = array_key_first($_FILES);
            $file = $_FILES[$key]['tmp_name'];
            $fileName = $_FILES[$key]['name'];

            if (empty($fileName)) {
                Application::$app->session->setMessage('danger', 'Selecione um arquivo');
                return Application::$app->response->redirect('/');
            }

			$csv = explode(".", $fileName);

            if ($csv[1] === 'csv') {
                $row = 1;
                if (($handle = fopen($file, "r")) !== FALSE) {
                    while (($data = fgetcsv($handle, 1000)) !== FALSE) {
                        ${'array'.$row} = [];
                        $num = count($data);
                        for ($i = 0; $i < $num; $i++) {
                            ${'array'.$row}['livro'] = $data[0];
                            ${'array'.$row}['autor'] = $data[1];
                            ${'array'.$row}['editor'] = $data[2];
                            ${'array'.$row}['lancamento'] = $data[3];
                            ${'array'.$row}['observacao'] = $data[4];
                            ${'array'.$row}['andamento'] = $data[5];
                            ${'array'.$row}['prazo'] = $data[6];
                        }
                        $this->book->loadData(${'array'.$row});
                        $this->book->save();
                        $row++;
                    }
                    fclose($handle);
                }
                Application::$app->session->setMessage('success', 'Livros '.date('Y').' cadastrados');
                return Application::$app->response->redirect('/');
            } else {
                Application::$app->session->setMessage('danger', 'A extensão do arquivo deve ser .csv');
                return Application::$app->response->redirect('/');
            }
        }

		return Application::$app->view->renderView('upload', 'off', ['model' => $this->book]);
    }

	public function homeBook()
	{
        if (Application::$app->request->isPost()) {
            if (empty($this->book->findBook($_POST['livro']))) {
                Application::$app->session->setMessage('danger', 'Nenhum resultado encontrado');
                return Application::$app->response->redirect('/');
            }

			$params = [
                'livros' => $this->book->findBook($_POST['livro']),
                'number' => 1
            ];
		} else {
            $params = [
                'livros' => $this->book->findAll(),
                'number' => 1
            ];
        }        

		return Application::$app->view->renderView('livro', 'main', $params);
	}

	public function newUser()
	{
		if (Application::$app->request->isPost()) {
			$this->user->loadData(Application::$app->request->body());

            if ($this->user->validate() && $this->user->save()) {
				Application::$app->session->setMessage('success', 'Usuário cadastrado');
                return Application::$app->response->redirect('/');
            }
		}

		return Application::$app->view->renderView('novousuario', 'main', ['model' => $this->user]);
	}
    
    public function newBook()
    {
        if (Application::$app->request->isPost()) {
            $this->book->loadData(Application::$app->request->body());

            if ($this->book->validate() && $this->book->save()) {
                Application::$app->session->setMessage('success', 'Livro cadastrado');
                return Application::$app->response->redirect('/');
            }
        }

        return Application::$app->view->renderView('novolivro', 'main', ['model' => $this->book]);
    }
    
    public function updateBook()
    {
        if (Application::$app->request->isPost()) {
            if (isset($_POST['save'])) {
                $this->book->loadData(Application::$app->request->body());

                if ($this->book->validate() && $this->book->update(['id' => $_GET['id']])) {
                    Application::$app->session->setMessage('success', 'Livro atualizado');
                    return Application::$app->response->redirect('/');
                }
            }

            if (isset($_POST['delete'])) {
                if ($this->book->delete(['id' => $_GET['id']])) {
                    Application::$app->session->setMessage('success', 'Livro apagado');
                    return Application::$app->response->redirect('/');
                }
            }
        }

        $params = [
            'livro' => $this->book->findOne(['id' => $_GET['id']]),
            'model' => $this->book
		];

        return Application::$app->view->renderView('atualizarlivro', 'main', $params);
    }

    public function etapa()
    {
        $uri = explode('/', $_SERVER['REQUEST_URI']);

        if ($uri[1] === 'diagramacao' || $uri[1] === 'fechamento') {
            $worker = 'Diagramador';
        }

        if ($uri[1] === 'cotejo' || $uri[1] === 'preparacao') {
            $worker = 'Revisor';
        }

        if ($uri[1] === 'tratamento') {
            $worker = 'Tratamento';
        }

        if (Application::$app->request->isPost()) {
            // echo '<pre>';
            // var_dump($_POST);
            // echo '</pre>';
            // exit;
            foreach ($_POST as $key => $value) {
                if(is_int($key)) {
                    $id = $key;
                }
            }

            if (isset($_POST['checkbox'])) {
                $checkbox = 'on';
            } else {
                $checkbox = '';
            }

            $this->book->loadData(Application::$app->request->body());

            if ($this->book->check(['id' => $id], $uri[1], $checkbox)) {
                Application::$app->session->setMessage('success', 'Livro atualizado');
                return Application::$app->response->redirect($_SERVER['REQUEST_URI']);
            }
        } else {
            $params = [
                'worker' => $worker,
                'uri' => $uri[1],
                'livros' => $this->book->findAll(),
                'number' => 1,
                'marca' =>  'getMarca_'.$uri[1],
                'inicio' =>  'getInicio_'.$uri[1],
                'fim' =>  'getFim_'.$uri[1],
                'entrega' =>  'getEntrega_'.$uri[1],
                'usuario' => 'getUsuario_'.$uri[1]
            ];
        }        

		return Application::$app->view->renderView('etapa', 'main', $params);
    }
    
    public function updateEtapa()
    {
        if (Application::$app->request->isPost()) {
            if (isset($_POST['save'])) {
                $this->book->loadData(Application::$app->request->body());

                if ($this->book->validate() && $this->book->update(['id' => $_GET['id']])) {
                    Application::$app->session->setMessage('success', 'Livro atualizado');
                    return Application::$app->response->redirect('/');
                }
            }

            if (isset($_POST['delete'])) {
                if ($this->book->delete(['id' => $_GET['id']])) {
                    Application::$app->session->setMessage('success', 'Livro apagado');
                    return Application::$app->response->redirect('/');
                }
            }
        }

        $params = [
            'livro' => $this->book->findOne(['id' => $_GET['id']]),
            'model' => $this->book
		];

        return Application::$app->view->renderView('atualizaretapa', 'main', $params);
    }
}