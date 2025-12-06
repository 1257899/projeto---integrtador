<?php
// Inicia os objetos
$objEdicao = new Edicao;
$objTema = new Tema;
$objProjeto = new Projeto;

// Faz o include do listar pegando o valor de 'pr' passado como parâmetro na url
$valorPr = @$_GET['pr'];
if ($valorPr == '') {
    include_once __DIR__ . '/' . 'listar.php';
}
