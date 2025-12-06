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
if (isset($_POST['ano_edicao'], $_POST['cpf_cadastro'], $_POST['data_cadastro'])) {
    $_POST['cpf_cadastro'] = str_replace('.', '', $_POST['cpf_cadastro']);
    $_POST['cpf_cadastro'] = str_replace('-', '', $_POST['cpf_cadastro']);

    $objEdicao->ano_edicao          = $_POST['ano_edicao'];
    $objEdicao->cpf_cadastro        = $_POST['cpf_cadastro'];
    $objEdicao->data_cadastro       = $_POST['data_cadastro'];
    // Atualiza os dados da edição
    if ($objEdicao->atualizar()) {
        header('location: index.php?p=edicoes&status=e-success');
        exit;
    } else {
        header('location: index.php?p=edicoes&status=error');
        exit;
    }
}
?>
<div class="row">
    <h4>Editar edição - #<?php echo $objEdicao->id ?></h4>
    <form autocomplete="off" class="needs-validation mt-4" method="post" novalidate>
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="ano_edicao" name="ano_edicao" placeholder="Ano da edição" value="<?php echo $objEdicao->ano_edicao ?>" maxlength="4" required>
                    <label for="ano_edicao">Ano da edição</label>
                    <div class="invalid-feedback">
                        Por favor, preencha este campo!
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="cpf_cadastro" name="cpf_cadastro" value="<?php echo $objEdicao->cpf_cadastro ?>" placeholder="CPF" required>
                    <label for="cpf_cadastro">CPF</label>
                    <div class="invalid-feedback">
                        Por favor, preencha este campo!
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-floating mb-3">
                    <div class="form-floating mb-3">
                        <input type="datetime-local" class="form-control" id="data_cadastro" name="data_cadastro" value="<?php echo $objEdicao->data_cadastro ?>" placeholder="Data" value="<?= date('Y-m-d H:i') ?>" required>
                        <label for="data_cadastro">Data</label>
                        <div class="invalid-feedback">
                            Por favor, preencha este campo!
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-end pt-3">
                <a href="index.php?p=edicoes" class="btn btn-secondary">Voltar</a>
                <button type="submit" class="btn btn-success">Salvar</button>
            </div>
        </div>
    </form>
</div>