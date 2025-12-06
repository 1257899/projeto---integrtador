<?php
// Consulta o número do id da próxima edição a ser cadastrada
$lastId = Edicao::getLastId('information_schema.tables', 'auto_increment');
$id = $lastId->auto_increment;

//VALIDAÇÃO DO POST
$cadastrar = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($cadastrar['cadastrar'])) {
    unset($cadastrar['cadastrar']);
    $_POST['cpf_cadastro'] = str_replace('.', '', $_POST['cpf_cadastro']);
    $_POST['cpf_cadastro'] = str_replace('-', '', $_POST['cpf_cadastro']);

    $objEdicao->ano_edicao          = $_POST['ano_edicao'];
    $objEdicao->cpf_cadastro        = $_POST['cpf_cadastro'];
    $objEdicao->data_cadastro       = $_POST['data_cadastro'];


    // Cadastra a edição no banco
    if ($objEdicao->cadastrar()) {
        header('location: index.php?p=edicoes&status=c-success');
        exit;
    } else {
        header('location: index.php?p=edicoes&status=error');
        exit;
    }
}
?>
<div class="row">
    <h4>Cadastrar edição</h4>
    <form class="needs-validation mt-4" autocomplete="off" name="cadastrar" method="POST" novalidate>
        <div class="row">
            <input hidden type="text" id="id" name="id" value="<?= $id ?>">
            <div class="col-12 col-md-4">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="ano_edicao" name="ano_edicao" placeholder="Ano da edição" maxlength="4" required>
                    <label for="ano_edicao">Ano da edição</label>
                    <div class="invalid-feedback">
                        Por favor, preencha este campo!
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="cpf_cadastro" name="cpf_cadastro" placeholder="CPF" required>
                    <label for="cpf_cadastro">CPF</label>
                    <div class="invalid-feedback">
                        Por favor, preencha este campo!
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-floating mb-3">
                    <div class="form-floating mb-3">
                        <input type="datetime-local" class="form-control" id="data_cadastro" name="data_cadastro" placeholder="Data" value="<?= date('Y-m-d H:i') ?>" required>
                        <label for="data_cadastro">Data</label>
                        <div class="invalid-feedback">
                            Por favor, preencha este campo!
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-end pt-3">
                <a href="index.php?p=edicoes" class="btn btn-secondary">Voltar</a>
                <button type="submit" id="cadastrar" class="btn btn-success" value="Cadastrar Edição" name="cadastrar">Cadastrar</button>
            </div>
        </div>
    </form>
</div>