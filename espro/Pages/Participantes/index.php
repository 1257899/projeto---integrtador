<?php
// Inicia os objetos
$objProjeto = new Projeto;
$objParticipante = new Participante;

// Faz o include do listar pegando o valor de 'pa' passado como parâmetro na url
$valorPa = @$_GET['pa'];
if ($valorPa == '') {
    include_once __DIR__ . '/' . 'listar.php';
}
