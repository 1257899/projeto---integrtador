<?php
//VALIDAÇÃO DO ID
if (!isset($_GET['id']) or !is_numeric($_GET['id'])) {
    header('location: index.php?p=participantes&status=error');
    exit;
}

//CONSULTA O PARTICIPANTE
$objParticipante = Participante::getParticipante($_GET['id']);

//VALIDAÇÃO DO PARTICIPANTE
if (!$objParticipante instanceof Participante) {
    header('location: index.php?p=participantes&status=error');
    exit;
}

//VALIDAÇÃO DO POST
if (isset($_POST['deletar'], $_POST['cpf_exclusao'], $_POST['data_exclusao'], $_POST['motivo_exclusao'])) {
    $objParticipante->exclusao = 1;
    $_POST['cpf_exclusao'] = str_replace('.', '', $_POST['cpf_exclusao']);
    $_POST['cpf_exclusao'] = str_replace('-', '', $_POST['cpf_exclusao']);

    $objParticipante->cpf_exclusao        = $_POST['cpf_exclusao'];
    $objParticipante->data_exclusao       = $_POST['data_exclusao'];
    $objParticipante->motivo_exclusao     = ucwords($_POST['motivo_exclusao']);

    // Deleta o participante no banco
    if ($objParticipante->deletar()) {
        header('location: index.php?p=participantes&status=d-success');
        exit;
    } else {
        header('location: index.php?p=participantes&status=error');
        exit;
    }
}
?>
<div class="row">
    <h4>Excluir - Participante #<?php echo $objParticipante->id ?></h4>
    <form autocomplete="off" class="needs-validation mt-4" method="post" novalidate>
        <div class="row">
            <div class="col-12">
                <div class="form-floating mb-3">
                    <p class="alert alert-danger">Você deseja realmente excluir o participante <strong>#<?= $objParticipante->id ?></strong>, com o nome de <strong><?= $objParticipante->nome_participante ?></strong>?</p>
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
            <div class="col-12 col-md-4">
                <div class="form-floating mb-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="motivo_exclusao" name="motivo_exclusao" placeholder="Motivo da exclusão" value="<?= date('Y-m-d H:i') ?>" required>
                        <label for="motivo_exclusao">Motivo da exclusão</label>
                        <div class="invalid-feedback">
                            Por favor, preencha este campo!
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-end pt-3">
                <a href="index.php?p=participantes" class="btn btn-secondary">Cancelar</a>
                <button type="submit" name="deletar" class="btn btn-danger">Deletar</button>
            </div>
        </div>
    </form>
</div>