<?php
namespace app\model;

use app\core\Model;

class Book extends Model
{
    public int $id;
    public string $csvFile = '';
    public string $livro = '';
    public string $autor = '';
    public string $editor = '';
    public string $lancamento = '';
    public string $observacao = '';
    public string $andamento = '';
    public string $prazo = '';
    public string $tiragem = '';
    public string $os = '';
    public string $entrada = '';
    public string $local = '';
    public string $sinopse = '';
    public string $genero = '';
    public string $palavra_chave = '';
    public string $usuario_preparacao = '';
    public  $marca_preparacao = '';
    public  $inicio_preparacao = '';
    public  $fim_preparacao = '';
    public  $entrega_preparacao = '';
    public  $usuario_cotejo = '';
    public  $marca_cotejo = '';
    public  $inicio_cotejo = '';
    public  $fim_cotejo = '';
    public  $entrega_cotejo = '';
    public  $usuario_diagramacao = '';
    public  $marca_diagramacao = '';
    public  $inicio_diagramacao = '';
    public  $fim_diagramacao = '';
    public  $entrega_diagramacao = '';
    public  $usuario_fechamento = '';
    public  $marca_fechamento = '';
    public  $inicio_fechamento = '';
    public  $fim_fechamento = '';
    public  $entrega_fechamento = '';
    public  $usuario_tratamento = '';
    public  $usuario_ilustracao = '';
    public  $marca_tratamento = '';
    public  $inicio_tratamento = '';
    public  $fim_tratamento = '';
    public  $entrega_tratamento = '';

    public static function tableName(): string
    {
        return 'livros'.date('Y');
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function check($where, $uri, $mark)
    {
        $one = parent::findOne($where);
        $get = 'getMarca_'.$uri;
        $check = $one->$get();
        $marca = 'marca_'.$uri;
        $entrega = 'entrega_'.$uri;

        if ($check === 'checked') {
            $this->$marca = NULL;
            $this->$entrega = NULL;
            return parent::check($where, $uri, $mark);
        }

        if ($mark === 'on') {
            $this->$marca = 'checked';
            $this->$entrega = date('Y-m-d');
            return parent::check($where, $uri, $mark);
        }

        return parent::check($where, $uri, $mark);
    }

    public function rules(): array
    {
        return [
            'livro' => [self::RULE_REQUIRED],
            'lancamento' => [self::RULE_REQUIRED],
            'andamento' => [self::RULE_REQUIRED],
            'prazo' => [self::RULE_REQUIRED],
        ];
    }

    public function attributes(): array
    {
        return ['livro', 'autor', 'editor', 'lancamento', 'observacao', 'andamento', 'prazo', 'tiragem', 'os', 'entrada', 'local', 'sinopse', 'genero', 'palavra_chave', 'usuario_preparacao', 'usuario_cotejo', 'usuario_diagramacao', 'usuario_fechamento', 'usuario_ilustracao', 'usuario_tratamento'];
    }

    public function attributesPreparacao(): array
    {
        return ['usuario_preparacao', 'inicio_preparacao', 'fim_preparacao', 'marca_preparacao', 'entrega_preparacao'];
    }

    public function attributesCotejo(): array
    {
        return ['usuario_cotejo', 'inicio_cotejo', 'fim_cotejo', 'marca_cotejo', 'entrega_cotejo'];
    }

    public function attributesDiagramacao(): array
    {
        return ['usuario_diagramacao', 'inicio_diagramacao', 'fim_diagramacao', 'marca_diagramacao', 'entrega_diagramacao'];
    }

    public function attributesFechamento(): array
    {
        return ['usuario_fechamento', 'inicio_fechamento', 'fim_fechamento', 'marca_fechamento', 'entrega_fechamento'];
    }

    public function attributesTratamento(): array
    {
        return ['usuario_tratamento', 'usuario_ilustração', 'inicio_tratamento', 'fim_tratamento', 'marca_tratamento', 'entrega_tratamento'];
    }

    public function andamento(): array
    {
        return ['A INICIAR', 'ATRASADO', 'EM ANDAMENTO', 'FINALIZADO'];
    }

    public function colorAndamento()
    {
        switch ($this->getAndamento()) {
            case 'A INICIAR':
                echo 'text-primary';
                break;

            case 'ATRASADO':
                echo 'text-danger';
                break;

            case 'EM ANDAMENTO':
                echo 'text-warning';
                break;

            case 'FINALIZADO':
                echo 'text-success';
                break;
        }
    }

    public function days(): array
    {
        return [
            'diagramacao' => [
                'IDEAL' => '-24 days',
                'JUSTO' => '-14 days',
                'CRÍTICO' => '-9 days'
            ],
            'preparacao' => [
                'IDEAL' => '-89 days',
                'JUSTO' => '-69 days',
                'CRÍTICO' => '-49 days'
            ],
            'tratamento' => [
                'IDEAL' => '-89 days',
                'JUSTO' => '-69 days',
                'CRÍTICO' => '-49 days'
            ],
            'capa' => [
                'IDEAL' => '-89 days',
                'JUSTO' => '-69 days',
                'CRÍTICO' => '-49 days'
            ],
        ];
    }

    public function prazo(): array
    {
        return ['CRÍTICO', 'IDEAL', 'JUSTO'];
    }

    public function colorPrazo()
    {
        switch ($this->getPrazo()) {
            case 'JUSTO':
                echo 'text-warning';
                break;

            case 'IDEAL':
                echo 'text-success';
                break;
        }
    }

    public function colorMonth()
    {
        if (strftime("%m", strtotime($this->getLancamento())) % 2 === 0) {
            echo 'bg-white';
        }
    }

    public function labels(): array
    {
        return [
            'csvFile' => 'Selecione o arquivo CSV',
            'livro' => 'Livro',
            'autor' => 'Autor',
            'editor' => 'Editor',
            'lancamento' => 'Lançamento',
            'observacao' => 'Observação',
            'andamento' => 'Andamento',
            'prazo' => 'Prazo',
            'tiragem' => 'Tiragem',
            'os' => 'OS',
            'entrada' => 'Entrada',
            'local' => 'Local do lançamento',
            'sinopse' => 'Sinopse',
            'genero' => 'Gênero',
            'palavra_chave' => 'Palavra-chave',
            'usuario_preparacao' => 'Preparação',
            'inicio_preparacao' => 'Início',
            'fim_preparacao' => 'Fim',
            'usuario_cotejo' => 'Cotejo',
            'inicio_cotejo' => 'Início',
            'fim_cotejo' => 'Fim',
            'usuario_diagramacao' => 'Diagramação',
            'usuario_ilustracao' => 'Ilustração',
            'inicio_diagramacao' => 'Início',
            'fim_diagramacao' => 'Fim',
            'usuario_fechamento' => 'Fechamento',
            'inicio_fechamento' => 'Início',
            'fim_fechamento' => 'Fim',
            'usuario_tratamento' => 'Tratamento',
            'inicio_tratamento' => 'Início',
            'fim_tratamento' => 'Fim',
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLivro(): string
    {
        return $this->livro;
    }

    public function getLancamento(): string
    {
        return $this->lancamento;
    }

    public function getAndamento(): string
    {
        return $this->andamento;
    }

    public function getPrazo(): string
    {
        return $this->prazo;
    }

    public function getAutor(): string
    {
        return $this->autor;
    }

    public function getEditor(): string
    {
        return $this->editor;
    }

    public function getObservacao(): string
    {
        return $this->observacao;
    }

    public function getTiragem(): string
    {
        return $this->tiragem;
    }

    public function getOs(): string
    {
        return $this->os;
    }

    public function getEntrada(): string
    {
        return $this->entrada;
    }

    public function getLocal(): string
    {
        return $this->local;
    }

    public function getSinopse(): string
    {
        return $this->sinopse;
    }

    public function getGenero(): string
    {
        return $this->genero;
    }

    public function getPalavra_chave(): string
    {
        return $this->palavra_chave;
    }

    public function getUsuario_preparacao(): string
    {
        return $this->usuario_preparacao;
    }

    public function getMarca_preparacao(): ?string
    {
        return $this->marca_preparacao;
    }

    public function getInicio_preparacao(): ?string
    {
        return $this->inicio_preparacao;
    }

    public function getFim_preparacao(): ?string
    {
        return $this->fim_preparacao;
    }

    public function getEntrega_preparacao(): ?string
    {
        return $this->entrega_preparacao;
    }

    public function getUsuario_cotejo(): string
    {
        return $this->usuario_cotejo;
    }

    public function getMarca_cotejo(): ?string
    {
        return $this->marca_cotejo;
    }

    public function getInicio_cotejo(): ?string
    {
        return $this->inicio_cotejo;
    }

    public function getFim_cotejo(): ?string
    {
        return $this->fim_cotejo;
    }

    public function getEntrega_cotejo(): ?string
    {
        return $this->entrega_cotejo;
    }

    public function getUsuario_diagramacao(): string
    {
        return $this->usuario_diagramacao;
    }

    public function getMarca_diagramacao(): ?string
    {
        return $this->marca_diagramacao;
    }

    public function getInicio_diagramacao(): ?string
    {
        return $this->inicio_diagramacao;
    }

    public function getFim_diagramacao(): ?string
    {
        return $this->fim_diagramacao;
    }

    public function getEntrega_diagramacao(): ?string
    {
        return $this->entrega_diagramacao;
    }

    public function getUsuario_fechamento(): string
    {
        return $this->usuario_fechamento;
    }

    public function getMarca_fechamento(): ?string
    {
        return $this->marca_fechamento;
    }

    public function getInicio_fechamento(): ?string
    {
        return $this->inicio_fechamento;
    }

    public function getFim_fechamento(): ?string
    {
        return $this->fim_fechamento;
    }

    public function getEntrega_fechamento(): ?string
    {
        return $this->entrega_fechamento;
    }

    public function getUsuario_tratamento(): string
    {
        return $this->usuario_tratamento;
    }

    public function getUsuario_ilustracao(): string
    {
        return $this->usuario_ilustracao;
    }

    public function getMarca_tratamento(): ?string
    {
        return $this->marca_tratamento;
    }

    public function getInicio_tratamento(): ?string
    {
        return $this->inicio_tratamento;
    }

    public function getFim_tratamento(): ?string
    {
        return $this->fim_tratamento;
    }

    public function getEntrega_tratamento(): ?string
    {
        return $this->entrega_tratamento;
    }
}
