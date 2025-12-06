<?php
// Monta os 'alerts', tanto de sucesso, quanto de erro
$mensagem = '';
if (isset($_GET['status'])) {
    switch ($_GET['status']) {
        case 'c-success':
            $mensagem = '<div id="acaoPa" class="alert alert-success">Participante cadastrado com sucesso!</div>';
            break;

        case 'c-error':
            $mensagem = '<div id="acaoPa" class="alert alert-danger">Não existem projetos cadastrados. Não é possível cadastrar um participante!</div>';
            break;

        case 'e-success':
            $mensagem = '<div id="acaoPa" class="alert alert-success">Participante editado com sucesso!</div>';
            break;

        case 'd-success':
            $mensagem = '<div id="acaoPa" class="alert alert-success">Participante deletado com sucesso!</div>';
            break;

        case 'd-error':
            $mensagem = '<div id="acaoPa" class="alert alert-danger">Não existem participantes cadastrados!</div>';
            break;

        case 'dall-success':
            $mensagem = '<div id="acaoPa" class="alert alert-success">Participantes deletados com sucesso!</div>';
            break;

        case 'error':
            $mensagem = '<div id="acaoPa" class="alert alert-danger">Ação não executada! Cpf inválido!</div>';
            break;
    }
}

// Busca
$buscaParticipante = filter_input(INPUT_GET, 'buscaParticipante', FILTER_SANITIZE_STRING);

// Condições sql
$condicoes = [
    strlen($buscaParticipante) ? 'nome_participante LIKE "%' . $buscaParticipante . '%"' : null,
    'exclusao = 0'
];

// Remove posições vazias
$condicoes = array_filter($condicoes);

// Cláusula WHERE
$where = implode(' AND ', $condicoes);

// Cláusula ORDER
$order = 'id DESC';

$qtdeParticipantes = Participante::getParticipantes($where, $order);
$qtdeParticipantes = count($qtdeParticipantes);

// Paginação
$currentPage = @$_GET['pagina'];
$objPager = new Pager($qtdeParticipantes, $currentPage ?? 1, 10);

// Consulta os participantes cadastrados
$participantes = Participante::getParticipantes($where, $order, $objPager->getLimit());

//GETS
unset($_GET['pagina']);
unset($_GET['p']);
$gets = http_build_query($_GET);

$paginacao = '';
// Retorna as paginas e qual é a atual
$paginas = $objPager->getPages();
foreach ($paginas as $pagina) {
    $class = $pagina['atual'] ? 'active' : '';
    $paginacao .= '<li class="page-item ' . $class . ' "><a class="page-link" href="./index.php?p=participantes&pagina=' . $pagina['pagina'] . '&' . $gets . '">' . $pagina['pagina'] . '</a></li>';
}

$resultados = '';
$busca = '';

if (count($participantes) == 0) {
    $busca .= '';
    $resultados .= '<tr>
                        <td class="p-3" colspan="11">
                            Nenhum participante encontrado
                        </td>
                    </tr>';
} else {
    foreach ($participantes as $participante) {
        $projetoParticipante = Projeto::getProjeto($participante->projeto_id);
        // Monta a tabela com o registros
        $participante->data_cadastro = rtrim($participante->data_cadastro, '00');
        $participante->data_cadastro = rtrim($participante->data_cadastro, ':');
        $participante->data_cadastro = implode("/", explode("-", $participante->data_cadastro));

        $resultados .= '<tr class="text-center text-nowrap align-middle">
                            <td>' . $participante->id . '</td>
                            <td>
                                <a href="index.php?p=projetos&pr=visualizar&id=' . $projetoParticipante->id . '" class="">
                                    ' . $projetoParticipante->nome_equipe . '
                                </a>
                            </td>
                            <td>' . $participante->nome_participante . '</td>
                            <td class="cpf">' . $participante->cpf_participante . '</td>
                            <td class="cpf">' . $participante->cpf_cadastro . '</td>
                            <td>' . $participante->data_cadastro . '</td>
                            <td><a href="index.php?p=participantes&pa=visualizar&id=' . $participante->id . '" class="btn btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a></td>
                            <td><a href="index.php?p=participantes&pa=editar&id=' . $participante->id . '" class="btn btn-warning">
                                    <i class="fas fa-pencil-alt text-white"></i>
                                </a></td>
                            <td><a href="index.php?p=participantes&pa=deletar&id=' . $participante->id . '" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </a></td>
                        </tr>';
    }
}
?>
<?= $mensagem ?>
<div class="row">
    <div class="col-12 col-md-6 col-lg-4">
        <h2>Participantes</h2>
    </div>
</div>
<div class="row pt-4 pt-md-5">
    <div class="col-12 col-md-6 col-xl-4">
        <label for="buscaParticipante">Buscar participante: </label>
        <form autocomplete="off" method="post" class="d-flex mt-3">
            <input class="form-control me-2" id="buscaParticipante" name="buscaParticipante" value="<?= $buscaParticipante ?>" type="search" placeholder="Nome do participante" aria-label="">
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
                    <th scope="col">Projeto</th>
                    <th scope="col">Nome do participante</th>
                    <th scope="col">CPF do participante</th>
                    <th scope="col">CPF do cadastrador</th>
                    <th scope="col">Data de cadastro</th>
                    <th scope="col">Visualizar</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?= $resultados ?>
            </tbody>
        </table>
    </div>
</div>

<div class="text-end pt-4">
    <a href="index.php?p=participantes&pa=cadastrar" class="btn btn-success">
        Cadastrar participante
    </a>
    <a href="index.php?p=participantes&pa=deletarAll" class="mt-3 mt-sm-0 btn btn-danger">
        Deletar participantes
    </a>
</div>

<nav class="mt-4" aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <?= $paginacao ?>
    </ul>
</nav>