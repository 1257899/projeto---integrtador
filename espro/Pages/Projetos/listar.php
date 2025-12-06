<?php
// Monta os 'alerts', tanto de sucesso, quanto de erro
$mensagem = '';
if (isset($_GET['status'])) {
    switch ($_GET['status']) {
        case 'c-success':
            $mensagem = '<div id="acaoPr" class="alert alert-success">Projeto cadastrado com sucesso!</div>';
            break;

        case 'ce-error':
            $mensagem = '<div id="acaoPr" class="alert alert-danger">Não existem edições cadastradas. Não é possível cadastrar um projeto!</div>';
            break;

        case 'ct-error':
            $mensagem = '<div id="acaoPr" class="alert alert-danger">Não existem temas cadastrados. Não é possível cadastrar um projeto!</div>';
            break;

        case 'e-success':
            $mensagem = '<div id="acaoPr" class="alert alert-success">Projeto editado com sucesso!</div>';
            break;

        case 'd-success':
            $mensagem = '<div id="acaoPr" class="alert alert-success">Projeto deletado com sucesso!</div>';
            break;

        case 'd-error':
            $mensagem = '<div id="acaoPr" class="alert alert-danger">Não existem projetos cadastrados!</div>';
            break;

        case 'dall-success':
            $mensagem = '<div id="acaoPr" class="alert alert-success">Projetos deletados com sucesso!</div>';
            break;

        case 'error':
            $mensagem = '<div id="acaoPr" class="alert alert-danger">Ação não executada! Cpf inválido!</div>';
            break;
    }
}

// Busca
$buscaProjeto = filter_input(INPUT_GET, 'buscaProjeto', FILTER_SANITIZE_STRING);

// Condições sql
$condicoes = [
    strlen($buscaProjeto) ? 'nome_equipe LIKE "%' . $buscaProjeto . '%"' : null,
    'exclusao = 0'
];

// Remove posições vazias
$condicoes = array_filter($condicoes);

// Cláusula WHERE
$where = implode(' AND ', $condicoes);

// Cláusula ORDER
$order = 'id DESC';

$qtdeProjetos = Projeto::getProjetos($where, $order);
$qtdeProjetos = count($qtdeProjetos);

// Paginação
$currentPage = @$_GET['pagina'];
$objPager = new Pager($qtdeProjetos, $currentPage ?? 1, 10);

// Consulta os projetos cadastrados
$projetos = Projeto::getProjetos($where, $order, $objPager->getLimit());

//GETS
unset($_GET['pagina']);
unset($_GET['p']);
$gets = http_build_query($_GET);

$paginacao = '';
// Retorna as paginas e qual é a atual
$paginas = $objPager->getPages();
foreach ($paginas as $pagina) {
    $class = $pagina['atual'] ? 'active' : '';
    $paginacao .= '<li class="page-item ' . $class . ' "><a class="page-link" href="./index.php?p=projetos&pagina=' . $pagina['pagina'] . '&' . $gets . '">' . $pagina['pagina'] . '</a></li>';
}

$resultados = '';
$busca = '';

if (count($projetos) == 0) {
    $busca .= '';
    $resultados .= '<tr>
                        <td class="p-3" colspan="11">
                            Nenhum projeto encontrado
                        </td>
                    </tr>';
} else {
    foreach ($projetos as $projeto) {
        $projetoEdicao = Edicao::getEdicao($projeto->edicao_id);
        $projetoTema = Tema::getTema($projeto->tema_id);
        // Monta a tabela com o registros
        $projeto->data_cadastro = rtrim($projeto->data_cadastro, '00');
        $projeto->data_cadastro = rtrim($projeto->data_cadastro, ':');
        $projeto->data_cadastro = implode("/", explode("-", $projeto->data_cadastro));

        $resultados .= '<tr class="text-center text-nowrap align-middle">
                            <td>' . $projeto->id . '</td>
                            <td>
                                <a href="index.php?p=edicoes&e=visualizar&id=' . $projetoEdicao->id . '" class="">
                                    ' . $projetoEdicao->ano_edicao . '
                                </a>
                            </td>
                            <td>
                                <a href="index.php?p=temas&t=visualizar&id=' . $projetoTema->id . '" class="">
                                    ' . $projetoTema->tema . '
                                </a>
                            </td>
                            <td>' . $projeto->nome_equipe . '</td>
                            <td class="cpf">' . $projeto->cpf_cadastro . '</td>
                            <td>' . $projeto->data_cadastro . '</td>
                            <td><a href="index.php?p=projetos&pr=visualizar&id=' . $projeto->id . '" class="btn btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a></td>
                            <td><a href="index.php?p=projetos&pr=editar&id=' . $projeto->id . '" class="btn btn-warning">
                                    <i class="fas fa-pencil-alt text-white"></i>
                                </a></td>
                            <td><a href="index.php?p=projetos&pr=deletar&id=' . $projeto->id . '" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </a></td>
                        </tr>';
    }
}
?>
<?= $mensagem ?>
<div class="row">
    <div class="col-12 col-md-6 col-lg-4">
        <h2>Projetos</h2>
    </div>
</div>
<div class="row pt-4 pt-md-5">
    <div class="col-12 col-md-6 col-xl-4">
        <label for="buscaProjeto">Buscar projeto: </label>
        <form autocomplete="off" method="post" class="d-flex mt-3">
            <input class="form-control me-2" id="buscaProjeto" name="buscaProjeto" value="<?= $buscaProjeto ?>" type="search" placeholder="Nome da equipe" aria-label="">
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
                    <th scope="col">Edição</th>
                    <th scope="col">Tema</th>
                    <th scope="col">Nome da equipe</th>
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
    <a href="index.php?p=projetos&pr=cadastrar" class="btn btn-success">
        Cadastrar projeto
    </a>
    <a href="index.php?p=projetos&pr=deletarAll" class="mt-3 mt-sm-0 btn btn-danger">
        Deletar projetos
    </a>
</div>

<nav class="mt-4" aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <?= $paginacao ?>
    </ul>
</nav>