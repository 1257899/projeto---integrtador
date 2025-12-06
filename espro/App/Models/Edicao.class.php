<?php

/**
 * Edicao.class { MODELS }
 * Classe responsável por operações na tabela Edição
 *
 * @copyright (c) 2022, Julio Ferro
 */

class Edicao
{
    /**
     * Identificador único da edição
     * @var integer
     */
    public $id;

    /**
     * Ano da edição
     * @var integer
     */
    public $ano_edicao;

    /**
     * Data do cadastro da edição
     * @var string
     */
    public $data_cadastro;

    /**
     * CPF do usuário que cadastrou a edição
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
     * Data da exclusão da edição
     * @var string
     */
    public $data_exclusao;

    /**
     * CPF do usuário que excluiu a edição
     * @var string
     */
    public $cpf_exclusao;


    /**
     * Método responsável por cadastrar uma nova edição no banco
     * @return boolean
     */
    public function cadastrar()
    {
        //INSERIR OS DADOS NO BANCO
        $objConn = new Conn('edicao');
        $api = Functions::ValidaCPF($this->cpf_cadastro);
        if($api){
            $this->id = $objConn->ExeCreate([
                'ano_edicao'             => $this->ano_edicao,
                'data_cadastro'          => $this->data_cadastro,
                'cpf_cadastro'           => $this->cpf_cadastro
            ]);    
        } else {
            return false;
        }
       
        //RETORNAR SUCESSO
        return true;
    }

    /**
     * Método responsável por atualizar a edição no banco
     * @return boolean
     */
    public function atualizar()
    {
        return (new Conn('edicao'))->ExeUpdate('id = ' . $this->id, [
            'ano_edicao'             => $this->ano_edicao,
            'data_cadastro'          => $this->data_cadastro,
            'cpf_cadastro'           => $this->cpf_cadastro
        ]);
    }

    /**
     * Método responsável por deletar a edição do banco
     * @return boolean
     */
    public function deletar()
    {
        return (new Conn('edicao'))->ExeDelete('id = ' . $this->id, [
            'exclusao'              => $this->exclusao,
            'data_exclusao'         => $this->data_exclusao,
            'cpf_exclusao'          => $this->cpf_exclusao
        ]);
    }

    /**
     * Método responsável por deletar todas as edições do banco
     * @return boolean
     */
    public function deletarAll($id)
    {
        return (new Conn('edicao'))->ExeDelete('id = ' . $id, [
            'exclusao'              => $this->exclusao,
            'data_exclusao'         => $this->data_exclusao,
            'cpf_exclusao'          => $this->cpf_exclusao
        ]);
    }

    /**
     * Método responsável por obter as edições do banco de dados
     * @param  string $where
     * @param  string $order
     * @param  string $limit
     * @return array
     */
    public static function getEdicoes($where = null, $order = null, $limit = null)
    {
        return (new Conn('edicao'))->ExeRead($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Método responsável por buscar uma edicao com base em seu ID
     * @param  integer $id
     * @return Edicao
     */
    public static function getEdicao($id)
    {
        return (new Conn('edicao'))->ExeRead('id = ' . $id)
            ->fetchObject(self::class);
    }

    /**
     * Método responsável por buscar o número do id a ser inserido
     * @param  string $table
     * @param  string $fields
     * @return Edicao
     */
    public static function getLastId($table, $fields)
    {
        return (new Conn('edicao'))->ExeLastId($table, $fields)
            ->fetchObject(self::class);
    }
}
