<?php

/**
 * Projeto.class { MODELS }
 * Classe responsável por operações na tabela Projeto
 *
 * @copyright (c) 2022, Julio Ferro
 */

class Projeto
{
    /**
     * Identificador único do projeto
     * @var integer
     */
    public $id;

    /**
     * Identificador único da edição
     * @var integer
     */
    public $edicao_id;

    /**
     * Identificador único do tema
     * @var integer
     */
    public $tema_id;

    /**
     * Nome da equipe do projeto
     * @var string
     */
    public $nome_equipe;

    /**
     * Data do cadastro do projeto
     * @var string
     */
    public $data_cadastro;

    /**
     * CPF do usuário que cadastrou o projeto
     * @var string
     */
    public $cpf_cadastro;

    /**
     * Status de exclusão
     * 1 - Excluído
     * 0 - Não excluído
     * @var integer
     */
    public $exclusao;

    /**
     * Data da exclusão do projeto
     * @var string
     */
    public $data_exclusao;

    /**
     * CPF do usuário que excluiu o projeto
     * @var string
     */
    public $cpf_exclusao;

    /**
     * Documento do projeto
     * @var string
     */
    public $documento;

    /**
     * Apresentação do projeto
     * @var string
     */
    public $apresentacao;


    /**
     * Método responsável por cadastrar um novo projeto no banco
     * @return boolean
     */
    public function cadastrar()
    {
        //INSERIR OS DADOS NO BANCO
        $objConn = new Conn('projeto');
        $api = Functions::ValidaCPF($this->cpf_cadastro);
        if($api){
            $this->id = $objConn->ExeCreate([
                'edicao_id'             => $this->edicao_id,
                'tema_id'               => $this->tema_id,
                'nome_equipe'           => $this->nome_equipe,
                'data_cadastro'         => $this->data_cadastro,
                'cpf_cadastro'          => $this->cpf_cadastro,
                'documento'             => $this->documento,
                'apresentacao'          => $this->apresentacao
            ]);    
        } else {
            return false;
        }
       
        //RETORNAR SUCESSO
        return true;
    }

    /**
     * Método responsável por atualizar o projeto no banco
     * @return boolean
     */
    public function atualizar()
    {
        return (new Conn('projeto'))->ExeUpdate('id = ' . $this->id, [
            'edicao_id'             => $this->edicao_id,
            'tema_id'               => $this->tema_id,
            'nome_equipe'           => $this->nome_equipe,
            'data_cadastro'         => $this->data_cadastro,
            'cpf_cadastro'          => $this->cpf_cadastro,
            'documento'             => $this->documento,
            'apresentacao'          => $this->apresentacao
        ]);
    }

    /**
     * Método responsável por deletar o projeto do banco
     * @return boolean
     */
    public function deletar()
    {
        return (new Conn('projeto'))->ExeDelete('id = ' . $this->id, [
            'exclusao'              => $this->exclusao,
            'data_exclusao'         => $this->data_exclusao,
            'cpf_exclusao'          => $this->cpf_exclusao
        ]);
    }

    /**
     * Método responsável por deletar todos os projetos do banco
     * @return boolean
     */
    public function deletarAll($id)
    {
        return (new Conn('projeto'))->ExeDelete('id = ' . $id, [
            'exclusao'              => $this->exclusao,
            'data_exclusao'         => $this->data_exclusao,
            'cpf_exclusao'          => $this->cpf_exclusao
        ]);
    }

    /**
     * Método responsável por obter os projetos do banco de dados
     * @param  string $where
     * @param  string $order
     * @param  string $limit
     * @return array
     */
    public static function getProjetos($where = null, $order = null, $limit = null)
    {
        return (new Conn('projeto'))->ExeRead($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Método responsável por buscar um projeto com base em seu ID
     * @param  integer $id
     * @return Projeto
     */
    public static function getProjeto($id)
    {
        return (new Conn('projeto'))->ExeRead('id = ' . $id)
            ->fetchObject(self::class);
    }

    /**
     * Método responsável por buscar um projeto com base no nome da sua equipe
     * @param  integer $nome_equipe
     * @return Projeto
     */
    public static function getProjetoByName($nome_equipe)
    {
        return (new Conn('projeto'))->ExeRead('nome_equipe = ' . $nome_equipe)
            ->fetchObject(self::class);
    }

    /**
     * Método responsável por buscar o número do id a ser inserido
     * @param  string $table
     * @param  string $fields
     * @return Projeto
     */
    public static function getLastId($table, $fields)
    {
        return (new Conn('projeto'))->ExeLastId($table, $fields)
            ->fetchObject(self::class);
    }
}
