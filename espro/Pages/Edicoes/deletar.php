<?php
//VALIDAÇÃO DO ID
if (!isset($_GET['id']) or !is_numeric($_GET['id'])) {
    header('location: index.php?p=edicoes&status=error');
    exit;
}

//CONSULTA A EDIÇÃO
$objEdicao = Edicao::getEdicao($_GET['id']);

//VALIDAÇÃO DA EDIÇÃO
if (!$objEdicao instanceof Edicao) {
    header('location: index.php?p=edicoes&status=error');
    exit;
}

//VALIDAÇÃO DO POST
if (isset($_POST['deletar'], $_POST['cpf_exclusao'], $_POST['data_exclusao'])) {
    $objEdicao->exclusao = 1;
    $_POST['cpf_exclusao'] = str_replace('.', '', $_POST['cpf_exclusao']);
    $_POST['cpf_exclusao'] = str_replace('-', '', $_POST['cpf_exclusao']);

    $objEdicao->cpf_exclusao        = $_POST['cpf_exclusao'];
    $objEdicao->data_exclusao       = $_POST['data_exclusao'];

    // Deleta a edição no banco
    if ($objEdicao->deletar()) {
        header('location: index.php?p=edicoes&status=d-success');
        exit;
    } else {
        header('location: index.php?p=edicoes&status=error');
        exit;
    }
}
?>
<div class="row">
    <h4>Excluir - Edição #<?php echo $objEdicao->id ?></h4>
    <form autocomplete="off" class="needs-validation mt-4" method="post" novalidate>
        <div class="row">
            <div class="col-12">
                <div class="form-floating mb-3">
                    <p class="alert alert-danger">Você deseja realmente excluir a edição <strong>#<?= $objEdicao->id ?></strong>, com o ano de <strong><?= $objEdicao->ano_edicao ?></strong>?</p>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="cpf_exclusao" name="cpf_exclusao" placeholder="CPF" required>
                    <label for="cpf_exclusao">CPF</label>
                    <div class="invalid-feedback">
                        Por favor, preencha este campo!
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
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
                <a href="index.php?p=edicoes" class="btn btn-secondary">Cancelar</a>
                <button type="submit" name="deletar" class="btn btn-danger">Deletar</button>
            </div>
        </div>
    </form>
</div>