<?php
// VALIDAÇÃO DO ID
if (!isset($_GET['id']) or !is_numeric($_GET['id'])) {
    header('location: index.php?p=projetos&status=error');
    exit;
}

// CONSULTA O PROJETO
$objProjeto = Projeto::getProjeto($_GET['id']);

// VALIDAÇÃO DO PROJETO
if (!$objProjeto instanceof Projeto) {
    header('location: index.php?p=projetos&status=error');
    exit;
}

// Retorna os dados da edição do projeto
$projetoEdicao = Edicao::getEdicao($objProjeto->edicao_id);
$resultadoEdicao = $projetoEdicao->ano_edicao;

// Retorna os dados do tema do projeto
$projetoTema = Tema::getTema($objProjeto->tema_id);
$resultadoTema = $projetoTema->tema;


?>
<div class="row">
    <h4>Visualizar Projeto #<?php echo $objProjeto->id ?></h4>
    <form class="mt-4" method="post">
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="form-floating mb-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="edicao_id" name="edicao_id" value="<?php echo $resultadoEdicao ?>" placeholder="Edição" readonly>
                        <label for="edicao_id">Edição</label>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="tema_id" name="tema_id" value="<?php echo $resultadoTema ?>" placeholder="Tema" readonly>
                    <label for="tema_id">Tema</label>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nome_equipe" name="nome_equipe" value="<?php echo $objProjeto->nome_equipe ?>" placeholder="Nome da equipe" readonly>
                    <label for="nome_equipe">Nome da equipe</label>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="cpf_cadastro" name="cpf_cadastro" value="<?php echo $objProjeto->cpf_cadastro ?>" placeholder="CPF" readonly>
                    <label for="cpf_cadastro">CPF</label>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-floating mb-3">
                    <div class="form-floating mb-3">
                        <input type="datetime-local" class="form-control" id="data_cadastro" name="data_cadastro" value="<?php echo $objProjeto->data_cadastro ?>" placeholder="Data" value="<?= date('Y-m-d H:i') ?>" readonly>
                        <label for="data_cadastro">Data</label>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 mt-2">
                <div class="form-group mb-3">
                    <h5>Documento</h5>
                    <a target="_blank" href="./<?php echo $objProjeto->documento ?>">Clique aqui para visualizar</a>
                </div>
            </div>
            <div class="col-12 col-md-6 mt-2">
                <div class="form-group mb-3">
                    <h5>Apresentação</h5>
                    <a target="_blank" href="./<?php echo $objProjeto->apresentacao ?>">Clique aqui para visualizar</a>
                </div>
            </div>

            <div class="col-12 text-end pt-3">
                <a href="index.php?p=projetos" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
    </form>
</div>