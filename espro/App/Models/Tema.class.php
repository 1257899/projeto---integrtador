<?php

/**
 * Tema.class { MODELS }
 * Classe responsável por operações na tabela Tema
 *
 * @copyright (c) 2022, Julio Ferro
 */

class Tema
{
    /**
     * Identificador único do tema
     * @var integer
     */
    public $id;

    /**
     * Título do tema
     * @var string
     */
    public $tema;

    /**
     * Descritivo do tema
     * @var string
     */
    public $descritivo;

    /**
     * Data de cadastro do tema
     * @var string
     */
    public $data_cadastro;

    /**
     * CPF do usuário que cadastrou o tema
     * @var string
     */
    public $cpf_cadastro;

    /**
     * Status de exclusão
     * 1 - Excluído
     * 0 - Não excluído
     * @var integer
     */
    public $excluido;


    /**
     * Método responsável por cadastrar um novo tema no banco
     * @return boolean
     */
    public function cadastrar()
    {
        //INSERIR OS DADOS NO BANCO
        $objConn = new Conn('tema');
        $api = Functions::ValidaCPF($this->cpf_cadastro);
        if($api){
            $this->id = $objConn->ExeCreate([
                'tema'                   => $this->tema,
            'descritivo'             => $this->descritivo,
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
     * Método responsável por atualizar o tema no banco
     * @return boolean
     */
    public function atualizar()
    {
        return (new Conn('tema'))->ExeUpdate('id = ' . $this->id, [
            'tema'                   => $this->tema,
            'descritivo'             => $this->descritivo,
            'data_cadastro'          => $this->data_cadastro,
            'cpf_cadastro'           => $this->cpf_cadastro
        ]);
    }

    /**
     * Método responsável por deletar o tema do banco
     * @return boolean
     */
    public function deletar()
    {
        return (new Conn('tema'))->ExeDelete('id = ' . $this->id, [
            'excluido'               => $this->excluido
        ]);
    }

    /**
     * Método responsável por deletar todos os temas do banco
     * @return boolean
     */
    public function deletarAll($id)
    {
        return (new Conn('tema'))->ExeDelete('id = ' . $id, [
            'excluido'               => $this->excluido
        ]);
    }

    /**
     * Método responsável por obter os temas do banco de dados
     * @param  string $where
     * @param  string $order
     * @param  string $limit
     * @return array
     */
    public static function getTemas($where = null, $order = null, $limit = null)
    {
        return (new Conn('tema'))->ExeRead($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Método responsável por buscar um tema com base em seu ID
     * @param  integer $id
     * @return Tema
     */
    public static function getTema($id)
    {
        return (new Conn('tema'))->ExeRead('id = ' . $id)
            ->fetchObject(self::class);
    }

    /**
     * Método responsável por buscar o número do id a ser inserido
     * @param  string $table
     * @param  string $fields
     * @return Tema
     */
    public static function getLastId($table, $fields)
    {
        return (new Conn('tema'))->ExeLastId($table, $fields)
            ->fetchObject(self::class);
    }
}
