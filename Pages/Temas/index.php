<?php
// Inicia o objeto
$objTema = new Tema;

// Faz o include do listar pegando o valor de 't' passado como parâmetro na url
$valorT = @$_GET['t'];
if ($valorT == '') {
    include_once __DIR__ . '/' . 'listar.php';
}
