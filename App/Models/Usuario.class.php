<?php

/**
 * Usuario.class { MODELS }
 * Classe responsável por operações na tabela Usuários
 *
 * @copyright (c) 2022, Julio Ferro
 */
class Usuario
{
    /**
     * Identificador único do usuário
     * @var integer
     */
    public $id;

    /**
     * Nome
     * @var string
     */
    public $nome;

    /**
     * Usuário
     * @var string
     */
    public $usuario;

    /**
     * Hash da Senha
     * @var string
     */
    public $senha;

    /**
     * Método responsável por atualizar a vaga no banco
     * @return boolean
     */
    public function atualizar($usuario)
    {
        return (new Conn('usuarios'))->ExeUpdate('usuario = "' . $usuario . '"', [
            'senha' => $this->senha
        ]);
    }

    /**
     * Método responsável por buscar um usuário com base no seu usuario
     * @param string $usuario
     * @return Usuario
     */
    public static function getUsuarioByUser($usuario)
    {
        return (new Conn('usuarios'))->ExeRead('usuario = "' . $usuario . '"')
            ->fetchObject(self::class);
    }

    /**
     * Método responsável por buscar um usuário com base na sua senha
     * @param string $senha
     * @return Usuario
     */
    public static function getUsuarioByPass($senha)
    {
        return (new Conn('usuarios'))->ExeRead('senha = "' . $senha . '"')
            ->fetchObject(self::class);
    }
}
