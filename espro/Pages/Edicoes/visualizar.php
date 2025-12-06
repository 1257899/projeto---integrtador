<?php
// VALIDAÇÃO DO ID
if (!isset($_GET['id']) or !is_numeric($_GET['id'])) {
    header('location: index.php?p=edicoes&status=error');
    exit;
}

// CONSULTA A EDIÇÃO
$objEdicao = Edicao::getEdicao($_GET['id']);

// VALIDAÇÃO DA EDIÇÃO
if (!$objEdicao instanceof Edicao) {
    header('location: index.php?p=edicoes&status=error');
    exit;
}

?>
<div class="row">
    <h4>Visualizar Edição #<?php echo $objEdicao->id ?></h4>
    <form class="mt-4" method="post">
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="ano_edicao" name="ano_edicao" placeholder="Ano da edição" value="<?php echo $objEdicao->ano_edicao ?>" readonly>
                    <label for="ano_edicao">Ano da edição</label>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="cpf_cadastro" name="cpf_cadastro" value="<?php echo $objEdicao->cpf_cadastro ?>" placeholder="CPF" readonly>
                    <label for="cpf_cadastro">CPF</label>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-floating mb-3">
                    <div class="form-floating mb-3">
                        <input type="datetime-local" class="form-control" id="data_cadastro" name="data_cadastro" value="<?php echo $objEdicao->data_cadastro ?>" placeholder="Data" value="<?= date('Y-m-d H:i') ?>" readonly>
                        <label for="data_cadastro">Data</label>
                    </div>
                </div>
            </div>

            <div class="col-12 text-end pt-3">
                <a href="index.php?p=edicoes" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
    </form>
</div>