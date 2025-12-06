<?php

/**
 * Configurações do site
 * Definindo constantes do banco
 * Definindo data/hora baseada em São Paulo/America
 * Gerando autoload de classes
 *
 * @copyright (c) 2021, Julio Ferro, Rubens Bampa
 */

// ****** DATA/HORA ******
date_default_timezone_set('America/Sao_Paulo');

// ****** AUTOLOAD DE CLASSES ******
spl_autoload_register(function ($Class) {
    $cDir = ['Conn', 'Helpers', 'Models'];
    $iDir = null;

    foreach ($cDir as $dirName) {
        if (!$iDir && file_exists(__DIR__ . "/{$dirName}/{$Class}.class.php") && !is_dir($dirName)) {
            include_once(__DIR__ . "/{$dirName}/{$Class}.class.php");
            $iDir = true;
        }
    }

    if (!$iDir) {
        trigger_error("Não foi possivel incluir {$Class}.class.php", E_USER_ERROR);
        die;
    }
});
