<?php
require(__DIR__ . '/' . 'App' . '/' . 'config.php');
// Faz o include dos módulos e suas páginas pegando o valor de 'p' passado como parâmetro na url
$valor = @$_GET['p'];
if ($valor == '' || $valor == 'login') {
    // Obriga o usuário a não estar logado
    Login::requireLogout();

    $alertaLogin = '';

    if (isset($_POST['acao'])) {
        $objUsuario = Usuario::getUsuarioByUser($_POST['user']);

        if (!$objUsuario instanceof Usuario || !password_verify($_POST['senha'], $objUsuario->senha)) {
            $alertaLogin = '<div class="alert alert-danger">Usuário ou senha inválidos</div>';
        } else {
            // Efetua o login do usuário
            Login::LoginUser($objUsuario);
        }
    }
} else if ($valor == 'aSenha') {
    // Obriga o usuário a estar logado
    Login::requireLogin();

    // Verifica se existe o parâmetro 'user' na URL
    if (strpos($_SERVER['REQUEST_URI'], '/acesso.php?p=aSenha&user=') === false) {
        header('Location: acesso.php?p=login');
        exit;
    }

    $alertaLogin = '';

    if (isset($_POST['senha'], $_POST['senhaC'], $_POST['senhaA'])) {

        $objUsuario = Usuario::getUsuarioByUser($_GET['user']);

        if ($_POST['senha'] !== $_POST['senhaC'] || !password_verify($_POST['senhaA'], $objUsuario->senha)) {
            $alertaLogin = '<div class="alert alert-danger">Dados inválidos</div>';
        } else if (Functions::ValidaSenha($_POST['senha']) === false) {
            $alertaLogin = '<div class="alert alert-danger">Senha fraca. Requer 1 letra minúscula, 1 letra maiúscula, 1 número e no mínimo 6 caracteres</div>';
        } else {
            $objUsuario->senha = Functions::CriptografaSenha($_POST['senha']); // Criptografando a senha
            $objUsuario->atualizar($_GET['user']);
            header('location: logout.php');
            exit;
        }
    }
}
?>

<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="images/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/bootstrap-select.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>SalveBooks</title>
</head>
<style>
    .body{
		background-image: url("images/backgroud.jpg");
		background-color:yellow;
	}
</style>
<body class="text-center b-login bg-dark">

    <?php
    // Faz o include dos módulos e suas páginas pegando o valor de 'p' passado como parâmetro na url
    $valor = @$_GET['p'];
    if ($valor == '' || $valor == 'login') {
        include __DIR__ . '/' . 'login.php';
    } else if ($valor == 'aSenha') {
        include __DIR__ . '/' . 'aSenha.php';
    }
    ?>

    <script src="dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>