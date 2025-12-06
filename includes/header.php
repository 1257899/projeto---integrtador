<?php
$usuarioLog = Login::getUsuarioLogado();

$nomeUser = $usuarioLog ? $usuarioLog['nome'] : '';
$user = $usuarioLog ? "user=" . $usuarioLog['usuario'] : '';
?>
<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="images/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/bootstrap-select.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Editora</title>
</head>

<body class="bg-light d-flex flex-column h-100">
    <header>
        <div class="col-lg-2 sidebar flex-column flex-shrink-0 p-3 text-white bg-dark">
            <a href="./index.php" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto">
                <img class="img-fluid"  src="images/salvebooks.png" alt="">
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item pt-2 pb-2">
                    <a href="./index.php" class="nav-link" aria-current="page">
                        Home
                    </a>
                </li>
                <li class="nav-item pb-2">
                    <a href="./index.php?p=edicoes" class="nav-link" aria-current="page">
                        Edições
                    </a>
                </li>
                <li class="nav-item pb-2">
                    <a href="./index.php?p=temas" class="nav-link" aria-current="page">
                        Temas
                    </a>
                </li>
                <li class="nav-item pb-2">
                    <a href="./index.php?p=projetos" class="nav-link" aria-current="page">
                        Projetos
                    </a>
                </li>
                <li class="nav-item pb-2">
                    <a href="./index.php?p=participantes" class="nav-link" aria-current="page">
                        Participantes
                    </a>
                </li>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="images/admin.png" alt="" class="rounded-circle me-2">
                    <span class="font-weight-bold"><?= $nomeUser ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-light text-small shadow" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="./acesso.php?p=aSenha&<?= $user ?>">Alterar senha</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="./logout.php">Sair</a></li>
                </ul>
            </div>
        </div>


        <div class="container-fluid">
            <div class="row">
                <nav class="navbar d-lg-none navbar-dark bg-dark">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="./index.php">
                            <img class="img-fluid" width="180" height="65" src="images/logo.png" alt="">
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                            <ul class="nav navbar-nav">
                                <li class="nav-item pt-2 pb-2">
                                    <a href="./index.php" class="nav-link" aria-current="page">
                                        Home
                                    </a>
                                </li>
                                <li class="nav-item pb-2">
                                    <a href="./index.php?p=edicoes" class="nav-link" aria-current="page">
                                        Edições
                                    </a>
                                </li>
                                <li class="nav-item pb-2">
                                    <a href="./index.php?p=temas" class="nav-link" aria-current="page">
                                        Temas
                                    </a>
                                </li>
                                <li class="nav-item pb-2">
                                    <a href="./index.php?p=projetos" class="nav-link" aria-current="page">
                                        Projetos
                                    </a>
                                </li>
                                <li class="nav-item pb-2">
                                    <a href="./index.php?p=participantes" class="nav-link" aria-current="page">
                                        Participantes
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider text-white">
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="images/admin.png" alt="" class="rounded-circle me-2"><?= $nomeUser ?>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="./acesso.php?p=aSenha&<?= $user ?>">Alterar senha</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="./logout.php">Sair</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="topbar d-none d-lg-block bg-dark text-white">
                    <div class="text-end pb-5 pt-4"></div>
                </div>
            </div>
        </div>
    </header>