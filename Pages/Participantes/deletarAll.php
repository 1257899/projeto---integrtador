<?php
// Condições sql
$condicoes = [
    'exclusao = 0'
];

// Remove posições vazias
$condicoes = array_filter($condicoes);

// Cláusula WHERE
$where = implode(' AND ', $condicoes);

$participantes = Participante::getParticipantes($where);

// Verifica se há participantes cadastrados
if (count($participantes) == 0) {
    header('location: index.php?p=participantes&status=d-error');
    exit;
} else {
    // VALIDAÇÃO DO POST
    if (isset($_POST['deletar'], $_POST['cpf_exclusao'], $_POST['data_exclusao'], $_POST['motivo_exclusao'])) {
        $objParticipante->exclusao = 1;
        $_POST['cpf_exclusao'] = str_replace('.', '', $_POST['cpf_exclusao']);
        $_POST['cpf_exclusao'] = str_replace('-', '', $_POST['cpf_exclusao']);

        $objParticipante->cpf_exclusao        = $_POST['cpf_exclusao'];
        $objParticipante->data_exclusao       = $_POST['data_exclusao'];
        $objParticipante->motivo_exclusao     = ucwords($_POST['motivo_exclusao']);

        foreach ($participantes as $participante) {
            // Deleta todos os participantes do banco
            $objParticipante->deletarAll($participante->id);
        }
        header('location: index.php?p=participantes&status=dall-success');
        exit;
    }
}
?>
<div class="row">
    <h4>Excluir - Participantes</h4>
    <form autocomplete="off" class="needs-validation mt-4" method="post" novalidate>
        <div class="row">
            <div class="col-12">
                <div class="form-floating mb-3">
                    <p class="alert alert-danger">Você deseja realmente excluir todas os participantes?</p>
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