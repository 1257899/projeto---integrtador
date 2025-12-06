<?php
// VALIDAÇÃO DO ID
if (!isset($_GET['id']) or !is_numeric($_GET['id'])) {
    header('location: index.php?p=participantes&status=error');
    exit;
}

// CONSULTA O PARTICIPANTEs
$objParticipante = Participante::getParticipante($_GET['id']);

// VALIDAÇÃO DO PARTICIPANTE
if (!$objParticipante instanceof Participante) {
    header('location: index.php?p=participantes&status=error');
    exit;
}

// Retorna os dados do projeto do participante
$projetoParticipante = Projeto::getProjeto($objParticipante->projeto_id);
$resultado = $projetoParticipante->nome_equipe;

?>
<div class="row">
    <h4>Visualizar Participante #<?php echo $objParticipante->id ?></h4>
    <form class="mt-4" method="post">
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nome_equipe" name="nome_equipe" value="<?php echo $resultado ?>" placeholder="Nome da equipe" readonly>
                    <label for="nome_equipe">Nome da equipe</label>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nome_participante" name="nome_participante" value="<?php echo $objParticipante->nome_participante ?>" placeholder="Nome do participante" readonly>
                    <label for="nome_participante">Nome do participante</label>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="cpf_participante" name="cpf_participante" value="<?php echo $objParticipante->cpf_participante ?>" placeholder="CPF do participante" readonly>
                    <label for="cpf_participante">CPF do participante</label>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="cpf_cadastro" name="cpf_cadastro" value="<?php echo $objParticipante->cpf_cadastro ?>" placeholder="CPF do cadastrador" readonly>
                    <label for="cpf_cadastro">CPF do cadastrador</label>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-floating mb-3">
                    <div class="form-floating mb-3">
                        <input type="datetime-local" class="form-control" id="data_cadastro" name="data_cadastro" value="<?php echo $objParticipante->data_cadastro ?>" placeholder="Data" value="<?= date('Y-m-d H:i') ?>" readonly>
                        <label for="data_cadastro">Data</label>
                    </div>
                </div>
            </div>

            <div class="col-12 text-end pt-3">
                <a href="index.php?p=participantes" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
    </form>
</div>