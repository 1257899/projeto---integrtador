<?php

/**
 * Functions.class { HELPERS }
 * Classe responsável por funções auxiliares do sistema
 *
 * @copyright (c) 2022, Julio Ferro
 */

class Functions
{
    /**
     * Método responsável por verificar se a senha é forte
     * @param string $senha
     * @return boolean 
     */
    public static function ValidaSenha($senha)
    {
        return preg_match('/[a-z]/', $senha) // Letra minúscula
            && preg_match('/[A-Z]/', $senha) // Letra maiúscula
            && preg_match('/[0-9]/', $senha) // Número
            && preg_match('/^[\w$@]{6,}$/', $senha); // Mínimo de 6 caracteres
    }

    /**
     * Método responsável por criptografar a senha
     * @param string $senha
     * @return string 
     */
    public static function CriptografaSenha($senha)
    {
        return password_hash($senha, PASSWORD_DEFAULT);
    }

    /**
     * Método responsável por converter o número para o padrão da moeda real
     * @param string $valor
     * @return string 
     */
    public static function Real($valor)
    {
        $valor = number_format($valor, 2, ',', '.');
        return "R$" . ' ' . $valor;
    }
        
    /**
     * Método responsável por chamar API de verificação de CPF
     * @param string $cpf
     * @return boolean 
     */
    public static function ValidaCPF($cpf)
    {
        $token = '5372|vF6NI0kuykuy1JlndS9H2nLDU30nrTLb';
        $value = $cpf; //tratar pontuacao
        $type = 'cpf';

        $url = 'https://api.invertexto.com/v1/validator';
        $url .= '?token=' . urlencode($token);
        $url .= '&value=' . urlencode($value);
        $url .= '&type=' . urlencode($type);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'CPF Inválido' . curl_error($ch);
        }

        curl_close($ch);
        
        $value = json_decode($response);

        $valid = $value->valid;

        // Processar a resposta (por exemplo, imprimir na tela)
        return $valid;

    }

    
}
