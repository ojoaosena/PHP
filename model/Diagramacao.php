<?php
namespace app\model;

use app\core\Model;

class Diagramacao extends Model
{
    public ?string $usuario_diagramacao = NULL;
    public ?string $marca_diagramacao = NULL;
    public ?string $inicio_diagramacao = NULL;
    public ?string $fim_diagramacao = NULL;
    public ?string $entrega_diagramacao = NULL;

    public static function tableName(): string
    {
        return 'livros'.date('Y');
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function saveEtapa($where, $uri)
    {
        $one = parent::findOne($where);
        $get = 'getMarca_'.$uri;
        $check = $one->$get();
        $marca = 'marca_'.$uri;
        $entrega = 'entrega_'.$uri;

        if ($check === 'checked') {
            $this->$marca = NULL;
            $this->$entrega = NULL;
            return parent::saveEtapa($where, $uri);
        }

        $this->$marca = 'checked';
        $this->$entrega = date('Y-m-d');
        return parent::saveEtapa($where, $uri);
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
        return ['usuario_diagramacao', 'marca_diagramacao', 'inicio_diagramacao', 'fim_diagramacao', 'entrega_diagramacao'];
    }

    public function labels(): array
    {
        return [
            'usuario_diagramacao' => 'Diagramação',
            'inicio_diagramacao' => 'Início',
            'fim_diagramacao' => 'Fim',
        ];
    }

    public function getUsuario_diagramacao(): string
    {
        return $this->usuario_diagramacao;
    }

    public function setUsuario_diagramacao($usuario_diagramacao)
    {
        $this->usuario_diagramacao = $usuario_diagramacao;
    }

    public function getInicio_diagramacao(): ?string
    {
        return $this->inicio_diagramacao;
    }

    public function setInicio_diagramacao($inicio_diagramacao)
    {
        $this->inicio_diagramacao = $inicio_diagramacao;
    }

    public function getFim_diagramacao(): ?string
    {
        return $this->fim_diagramacao;
    }

    public function setFim_diagramacao($fim_diagramacao)
    {
        $this->fim_diagramacao = $fim_diagramacao;
    }

    public function getMarca_diagramacao(): ?string
    {
        return $this->marca_diagramacao;
    }

    public function setMarca_diagramacao($marca_diagramacao)
    {
        $this->marca_diagramacao = $marca_diagramacao;
    }

    public function getEntrega_diagramacao(): ?string
    {
        return $this->entrega_diagramacao;
    }

    public function setEntrega_diagramacao($entrega_diagramacao)
    {
        $this->entrega_diagramacao = $entrega_diagramacao;
    }
}
