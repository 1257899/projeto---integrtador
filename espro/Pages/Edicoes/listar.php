<?php
// Monta os 'alerts', tanto de sucesso, quanto de erro
$mensagem = '';
if (isset($_GET['status'])) {
    switch ($_GET['status']) {
        case 'c-success':
            $mensagem = '<div id="acaoE" class="alert alert-success">Edição cadastrada com sucesso!</div>';
            break;

        case 'e-success':
            $mensagem = '<div id="acaoE" class="alert alert-success">Edição editada com sucesso!</div>';
            break;

        case 'd-success':
            $mensagem = '<div id="acaoE" class="alert alert-success">Edição deletada com sucesso!</div>';
            break;

        case 'd-error':
            $mensagem = '<div id="acaoE" class="alert alert-danger">Não existem edições cadastradas!</div>';
            break;

        case 'dall-success':
            $mensagem = '<div id="acaoE" class="alert alert-success">Edições deletadas com sucesso!</div>';
            break;

        case 'error':
            $mensagem = '<div id="acaoE" class="alert alert-danger">Ação não executada! CPF inválido!</div>';
            break;
    }
}

// Busca
$buscaEdicao = filter_input(INPUT_GET, 'buscaEdicao', FILTER_SANITIZE_STRING);

// Condições sql
$condicoes = [
    strlen($buscaEdicao) ? 'ano_edicao LIKE "%' . $buscaEdicao . '%"' : null,
    'exclusao = 0'
];

// Remove posições vazias
$condicoes = array_filter($condicoes);

// Cláusula WHERE
$where = implode(' AND ', $condicoes);

// Cláusula ORDER
$order = 'id DESC';

$qtdeEdicoes = Edicao::getEdicoes($where, $order);
$qtdeEdicoes = count($qtdeEdicoes);

// Paginação
$currentPage = @$_GET['pagina'];
$objPager = new Pager($qtdeEdicoes, $currentPage ?? 1, 10);

// Consulta as edições cadastradas
$edicoes = Edicao::getEdicoes($where, $order, $objPager->getLimit());

//GETS
unset($_GET['pagina']);
unset($_GET['p']);
$gets = http_build_query($_GET);

$paginacao = '';
// Retorna as paginas e qual é a atual
$paginas = $objPager->getPages();
foreach ($paginas as $pagina) {
    $class = $pagina['atual'] ? 'active' : '';
    $paginacao .= '<li class="page-item ' . $class . ' "><a class="page-link" href="./index.php?p=edicoes&pagina=' . $pagina['pagina'] . '&' . $gets . '">' . $pagina['pagina'] . '</a></li>';
}

$resultados = '';
$busca = '';
if (count($edicoes) == 0) {
    $busca .= '';
    $resultados .= '<tr>
                        <td class="p-3" colspan="11">
                            Nenhuma edição encontrada
                        </td>
                    </tr>';
} else {
    foreach ($edicoes as $edicao) {
        // Monta a tabela com o registros
        $edicao->data_cadastro = rtrim($edicao->data_cadastro, '00');
        $edicao->data_cadastro = rtrim($edicao->data_cadastro, ':');
        $edicao->data_cadastro = implode("/", explode("-", $edicao->data_cadastro));

        $resultados .= '<tr class="text-center text-nowrap align-middle">
                            <td>' . $edicao->id . '</td>
                            <td>' . $edicao->ano_edicao . '</td>
                            <td class="cpf">' . $edicao->cpf_cadastro . '</td>
                            <td>' . $edicao->data_cadastro . '</td>
                            <td><a href="index.php?p=edicoes&e=visualizar&id=' . $edicao->id . '" class="btn btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a></td>
                            <td><a href="index.php?p=edicoes&e=editar&id=' . $edicao->id . '" class="btn btn-warning">
                                    <i class="fas fa-pencil-alt text-white"></i>
                                </a></td>
                            <td><a href="index.php?p=edicoes&e=deletar&id=' . $edicao->id . '" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </a></td>
                        </tr>';
    }
}
?>
<?= $mensagem ?>
<div class="row">
    <div class="col-12 col-md-6 col-lg-4">
        <h2>Edições</h2>
    </div>
</div>
<div class="row pt-4 pt-md-5">
    <div class="col-12 col-md-6 col-xl-4">
        <label for="buscaEdicao">Buscar edição: </label>
        <form autocomplete="off" method="post" class="d-flex mt-3">
            <input class="form-control me-2" id="buscaEdicao" name="buscaEdicao" value="<?= $buscaEdicao ?>" type="search" placeholder="Ano da edição" aria-label="">
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
                    <th scope="col">Ano de edição</th>
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
    <a href="index.php?p=edicoes&e=cadastrar" class="btn btn-success">
        Cadastrar edição
    </a>
    <a href="index.php?p=edicoes&e=deletarAll" class="mt-3 mt-sm-0 btn btn-danger">
        Deletar edições
    </a>
</div>

<nav class="mt-4" aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <?= $paginacao ?>
    </ul>
</nav>