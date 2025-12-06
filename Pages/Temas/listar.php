<?php
// Monta os 'alerts', tanto de sucesso, quanto de erro
$mensagem = '';
if (isset($_GET['status'])) {
    switch ($_GET['status']) {
        case 'c-success':
            $mensagem = '<div id="acaoT" class="alert alert-success">Tema cadastrado com sucesso!</div>';
            break;

        case 'e-success':
            $mensagem = '<div id="acaoT" class="alert alert-success">Tema editado com sucesso!</div>';
            break;

        case 'd-success':
            $mensagem = '<div id="acaoT" class="alert alert-success">Tema deletado com sucesso!</div>';
            break;

        case 'd-error':
            $mensagem = '<div id="acaoT" class="alert alert-danger">Não existem temas cadastrados!</div>';
            break;

        case 'dall-success':
            $mensagem = '<div id="acaoT" class="alert alert-success">Temas deletados com sucesso!</div>';
            break;

        case 'error':
            $mensagem = '<div id="acaoT" class="alert alert-danger">Ação não executada! Cpf inválido!</div>';
            break;
    }
}

// Busca
$buscaTema = filter_input(INPUT_GET, 'buscaTema', FILTER_SANITIZE_STRING);

// Condições sql
$condicoes = [
    strlen($buscaTema) ? 'tema LIKE "%' . $buscaTema . '%"' : null,
    'excluido = 0'
];

// Remove posições vazias
$condicoes = array_filter($condicoes);

// Cláusula WHERE
$where = implode(' AND ', $condicoes);

// Cláusula ORDER
$order = 'id DESC';

$qtdeTemas = Tema::getTemas($where, $order);
$qtdeTemas = count($qtdeTemas);

// Paginação
$currentPage = @$_GET['pagina'];
$objPager = new Pager($qtdeTemas, $currentPage ?? 1, 10);

// Consulta os temas cadastrados
$temas = Tema::getTemas($where, $order, $objPager->getLimit());

//GETS
unset($_GET['pagina']);
unset($_GET['p']);
$gets = http_build_query($_GET);

$paginacao = '';
// Retorna as paginas e qual é a atual
$paginas = $objPager->getPages();
foreach ($paginas as $pagina) {
    $class = $pagina['atual'] ? 'active' : '';
    $paginacao .= '<li class="page-item ' . $class . ' "><a class="page-link" href="./index.php?p=temas&pagina=' . $pagina['pagina'] . '&' . $gets . '">' . $pagina['pagina'] . '</a></li>';
}

$resultados = '';
$busca = '';
if (count($temas) == 0) {
    $busca .= '';
    $resultados .= '<tr>
                        <td class="p-3" colspan="11">
                            Nenhum tema encontrado
                        </td>
                    </tr>';
} else {
    foreach ($temas as $tema) {
        // Monta a tabela com o registros
        $tema->data_cadastro = rtrim($tema->data_cadastro, '00');
        $tema->data_cadastro = rtrim($tema->data_cadastro, ':');
        $tema->data_cadastro = implode("/", explode("-", $tema->data_cadastro));

        $resultados .= '<tr class="text-center text-nowrap align-middle">
                            <td>' . $tema->id . '</td>
                            <td>' . $tema->tema . '</td>
                            <td class="cpf">' . $tema->cpf_cadastro . '</td>
                            <td>' . $tema->data_cadastro . '</td>
                            <td><a href="index.php?p=temas&t=visualizar&id=' . $tema->id . '" class="btn btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a></td>
                            <td><a href="index.php?p=temas&t=editar&id=' . $tema->id . '" class="btn btn-warning">
                                    <i class="fas fa-pencil-alt text-white"></i>
                                </a></td>
                            <td><a href="index.php?p=temas&t=deletar&id=' . $tema->id . '" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </a></td>
                        </tr>';
    }
}
?>
<?= $mensagem ?>
<div class="row">
    <div class="col-12 col-md-6 col-lg-4">
        <h2>Temas</h2>
    </div>
</div>
<div class="row pt-4 pt-md-5">
    <div class="col-12 col-md-6 col-xl-4">
        <label for="buscaTema">Buscar tema: </label>
        <form autocomplete="off" method="post" class="d-flex mt-3">
            <input class="form-control me-2" id="buscaTema" name="buscaTema" value="<?= $buscaTema ?>" type="search" placeholder="Tema" aria-label="">
            <button class="btn btn-outline-primary" id="search" type="button">Buscar</button>
        </form>
    </div>
</div>
<div class="row pt-4">
    <div class="table-responsive">
        <table class="table table-hover table-secondary">
            <thead class="text-center text-nowrap table-dark">
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Tema</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Data de cadastro</th>
                    <th scope="col">Visualizar</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Deletar</th>
                </tr>
            </thead>
            <tbody>
                <?= $resultados ?>
            </tbody>
        </table>
    </div>
</div>

<div class="text-end pt-4">
    <a href="index.php?p=temas&t=cadastrar" class="btn btn-success">
        Cadastrar tema
    </a>
    <a href="index.php?p=temas&t=deletarAll" class="mt-3 mt-sm-0 btn btn-danger">
        Deletar temas
    </a>
</div>

<nav class="mt-4" aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <?= $paginacao ?>
    </ul>
</nav>