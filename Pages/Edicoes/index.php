<?php
// Inicia o objeto
$objEdicao = new Edicao;

// Faz o include do listar pegando o valor de 'e' passado como parâmetro na url
$valorE = @$_GET['e'];
if ($valorE == '') {
    include_once __DIR__ . '/' . 'listar.php';
}
