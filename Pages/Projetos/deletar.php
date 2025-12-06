<?php
//VALIDAÇÃO DO ID
if (!isset($_GET['id']) or !is_numeric($_GET['id'])) {
    header('location: index.php?p=projetos&status=error');
    exit;
}

//CONSULTA O PROJETO
$objProjeto = Projeto::getProjeto($_GET['id']);

//VALIDAÇÃO DO PROJETO
if (!$objProjeto instanceof Projeto) {
    header('location: index.php?p=projetos&status=error');
    exit;
}

//VALIDAÇÃO DO POST
if (isset($_POST['deletar'], $_POST['cpf_exclusao'], $_POST['data_exclusao'])) {
    $objProjeto->exclusao = 1;
    $_POST['cpf_exclusao'] = str_replace('.', '', $_POST['cpf_exclusao']);
    $_POST['cpf_exclusao'] = str_replace('-', '', $_POST['cpf_exclusao']);

    $objProjeto->cpf_exclusao        = $_POST['cpf_exclusao'];
    $objProjeto->data_exclusao       = $_POST['data_exclusao'];

    // Deleta o projeto no banco
    if ($objProjeto->deletar()) {
        header('location: index.php?p=projetos&status=d-success');
        exit;
    } else {
        header('location: index.php?p=projetos&status=error');
        exit;
    }
}
?>
<div class="row">
    <h4>Excluir - Projeto #<?php echo $objProjeto->id ?></h4>
    <form autocomplete="off" class="needs-validation mt-4" method="post" novalidate>
        <div class="row">
            <div class="col-12">
                <div class="form-floating mb-3">
                    <p class="alert alert-danger">Você deseja realmente excluir o projeto <strong>#<?= $objProjeto->id ?></strong>, com o nome de <strong><?= $objProjeto->nome_equipe ?></strong>?</p>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="cpf_exclusao" name="cpf_exclusao" placeholder="CPF" required>
                    <label for="cpf_exclusao">CPF</label>
                    <div class="invalid-feedback">
                        Por favor, preencha este campo!
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-floating mb-3">
                    <div class="form-floating mb-3">
                        <input type="datetime-local" class="form-control" id="data_exclusao" name="data_exclusao" placeholder="Data" value="<?= date('Y-m-d H:i') ?>" required>
                        <label for="data_exclusao">Data</label>
                        <div class="invalid-feedback">
                            Por favor, preencha este campo!
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-end pt-3">
                <a href="index.php?p=projetos" class="btn btn-secondary">Cancelar</a>
                <button type="submit" name="deletar" class="btn btn-danger">Deletar</button>
            </div>
        </div>
    </form>
</div>