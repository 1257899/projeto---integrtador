<?php

/**
 * Login.class { HELPERS }
 * Classe responsável pelo acesso do usuário ao sistema (login)
 *
 * @copyright (c) 2022, Julio Ferro
 */

class Login
{
    /**
     * Método responsável por iniciar a sessão
     */
    private static function init()
    {
        // Verificar status da sessão
        if (session_status() !== PHP_SESSION_ACTIVE) {
            // Inicia a sessão
            session_start();
        }
    }

    /**
     * Método responsável por retornar os dados do usuário logado
     * @param Usuario $objUsuario
     * @return boolean 
     */
    public static function getUsuarioLogado()
    {
        // Inicia a sessão
        self::init();

        // Retorna dados do usuário
        return self::isLogged() ? $_SESSION['usuario'] : null;
    }

    /**
     * Método responsável por logar o usuário
     * @param Usuario $objUsuario
     * @return boolean 
     */
    public static function LoginUser($objUsuario)
    {
        // Inicia a sessão
        self::init();

        // Sessão de usuário
        $_SESSION['usuario'] = [
            'id'    => $objUsuario->id,
            'nome'  => $objUsuario->nome,
            'usuario'  => $objUsuario->usuario
        ];

        // Redireciona usuário para index
        header('Location: index.php');
        exit;
    }

    /**
     * Método responsável por deslogar o usuário
     */
    public static function Logout()
    {
        // Inicia a sessão
        self::init();

        // Remove a sessão de usuário
        unset($_SESSION['usuario']);

        // Redireciona usuário para index
        header('Location: acesso.php?p=login');
        exit;
    }

    /**
     * Método responsável por verificar se o usuário está logado
     * @return boolean 
     */
    public static function isLogged()
    {
        // Inicia a sessão
        self::init();

        return isset($_SESSION['usuario']['id']);
    }

    /**
     * Método responsável por obrigar o usuário estar logado para acessar
     */
    public static function requireLogin()
    {
        if (!self::isLogged()) {
            header('Location: acesso.php?p=login');
            exit;
        }
    }

    /**
     * Método responsável por obrigar o usuário estar deslogado para acessar
     */
    public static function requireLogout()
    {
        if (self::isLogged()) {
            header('Location: index.php');
            exit;
        }
    }
}
