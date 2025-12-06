<?php
$condicoes = [
    'exclusao = 0'
];

// Remove posições vazias
$condicoes = array_filter($condicoes);

// Cláusula WHERE
$where = implode(' AND ', $condicoes);

$projetos = Projeto::getProjetos($where);
$resultados = "";

if (count($projetos) == 0) {
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
                </tr>';
    }
}
?>
<div class="row">
    <div class="col-12 pt-5 pt-md-0">
        <h2 class="pb-3 pb-md-5 mb-md-3 mb-xl-2 pb-xl-5">Projetos</h2>
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
                    </tr>
                </thead>
                <tbody>
                    <?= $resultados ?>
                </tbody>
            </table>
        </div>
    </div>
</div>