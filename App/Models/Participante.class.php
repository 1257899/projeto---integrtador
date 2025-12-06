<?php

/**
 * Participante.class { MODELS }
 * Classe responsável por operações na tabela Projeto_Participante
 *
 * @copyright (c) 2022, Julio Ferro
 */

class Participante
{
    /**
     * Identificador único do participante do projeto
     * @var integer
     */
    public $id;

    /**
     * Identificador único do projeto
     * @var integer
     */
    public $projeto_id;

    /**
     * CPF do participante do projeto
     * @var string
     */
    public $cpf_participante;

    /**
     * Nome do participante do projeto
     * @var string
     */
    public $nome_participante;

    /**
     * Data do cadastro do participante do projeto
     * @var string
     */
    public $data_cadastro;

    /**
     * CPF do usuário que cadastrou o participante do projeto
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
     * Data da exclusão do participante do projeto
     * @var string
     */
    public $data_exclusao;

    /**
     * CPF do usuário que excluiu o participante do projeto
     * @var string
     */
    public $cpf_exclusao;

    /**
     * Motivo da exclusão do participante do projeto
     * @var string
     */
    public $motivo_exclusao;


    /**
     * Método responsável por cadastrar um novo participante do projeto no banco
     * @return boolean
     */
    public function cadastrar()
    {
        //INSERIR OS DADOS NO BANCO
        $objConn = new Conn('projeto_participante');
        $api = Functions::ValidaCPF($this->cpf_cadastro);
        if($api){
            $this->id = $objConn->ExeCreate([
                'projeto_id'             => $this->projeto_id,
                'cpf_participante'       => $this->cpf_participante,
                'nome_participante'      => $this->nome_participante,
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
     * Método responsável por atualizar o participante do projeto no banco
     * @return boolean
     */
    public function atualizar()
    {
        return (new Conn('projeto_participante'))->ExeUpdate('id = ' . $this->id, [
            'projeto_id'             => $this->projeto_id,
            'cpf_participante'       => $this->cpf_participante,
            'nome_participante'      => $this->nome_participante,
            'data_cadastro'          => $this->data_cadastro,
            'cpf_cadastro'           => $this->cpf_cadastro
        ]);
    }

    /**
     * Método responsável por deletar o participante do projeto do banco
     * @return boolean
     */
    public function deletar()
    {
        return (new Conn('projeto_participante'))->ExeDelete('id = ' . $this->id, [
            'exclusao'              => $this->exclusao,
            'data_exclusao'         => $this->data_exclusao,
            'cpf_exclusao'          => $this->cpf_exclusao,
            'motivo_exclusao'       => $this->motivo_exclusao
        ]);
    }

    /**
     * Método responsável por deletar todos os participantes do projeto do banco
     * @return boolean
     */
    public function deletarAll($id)
    {
        return (new Conn('projeto_participante'))->ExeDelete('id = ' . $id, [
            'exclusao'              => $this->exclusao,
            'data_exclusao'         => $this->data_exclusao,
            'cpf_exclusao'          => $this->cpf_exclusao,
            'motivo_exclusao'       => $this->motivo_exclusao
        ]);
    }

    /**
     * Método responsável por obter os participantes do projeto do banco de dados
     * @param  string $where
     * @param  string $order
     * @param  string $limit
     * @return array
     */
    public static function getParticipantes($where = null, $order = null, $limit = null)
    {
        return (new Conn('projeto_participante'))->ExeRead($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Método responsável por buscar um participante do projeto com base em seu ID
     * @param  integer $id
     * @return Participante
     */
    public static function getParticipante($id)
    {
        return (new Conn('projeto_participante'))->ExeRead('id = ' . $id)
            ->fetchObject(self::class);
    }

    /**
     * Método responsável por buscar o número do id a ser inserido
     * @param  string $table
     * @param  string $fields
     * @return Participante
     */
    public static function getLastId($table, $fields)
    {
        return (new Conn('projeto_participante'))->ExeLastId($table, $fields)
            ->fetchObject(self::class);
    }
}
