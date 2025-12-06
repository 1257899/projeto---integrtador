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

// Retorna os projetos cadastrados e monta o select com seus dados
$projetos = Projeto::getProjetos('id <> ' . $objParticipante->projeto_id, 'nome_equipe');
$projetoParticipante = Projeto::getProjeto($objParticipante->projeto_id);
$resultado = '';
$resultado .= '<option selected value="' . $projetoParticipante->id . '">' . $projetoParticipante->nome_equipe . '</option>';
foreach ($projetos as $projeto) {
    $resultado .= '<option value="' . $projeto->id . '">' . $projeto->nome_equipe . '</option>';
}

//VALIDAÇÃO DO POST
if (isset($_POST['projeto_id'], $_POST['nome_participante'], $_POST['cpf_participante'], $_POST['cpf_cadastro'], $_POST['data_cadastro'])) {
    $_POST['cpf_cadastro'] = str_replace('.', '', $_POST['cpf_cadastro']);
    $_POST['cpf_cadastro'] = str_replace('-', '', $_POST['cpf_cadastro']);

    $_POST['cpf_participante'] = str_replace('.', '', $_POST['cpf_participante']);
    $_POST['cpf_participante'] = str_replace('-', '', $_POST['cpf_participante']);

    $objParticipante->projeto_id              = $_POST['projeto_id'];
    $objParticipante->nome_participante       = $_POST['nome_participante'];
    $objParticipante->cpf_participante        = $_POST['cpf_participante'];
    $objParticipante->cpf_cadastro            = $_POST['cpf_cadastro'];
    $objParticipante->data_cadastro           = $_POST['data_cadastro'];

    // Atualiza os dados do participante
    if ($objParticipante->atualizar()) {
        header('location: index.php?p=participantes&status=e-success');
        exit;
    } else {
        header('location: index.php?p=participantes&status=error');
        exit;
    }
}
?>
<div class="row">
    <h4>Editar participante - #<?php echo $objParticipante->id ?></h4>
    <form autocomplete="off" class="needs-validation mt-4" method="post" novalidate>
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="form-floating mb-3">
                    <select class="form-select" data-live-search="true" id="projeto_id" name="projeto_id" aria-label="Projeto" required>
                        <?= $resultado ?>
                    </select>
                    <label for="projeto_id">Projeto</label>
                    <div class="invalid-feedback">
                        Por favor, preencha este campo!
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nome_participante" name="nome_participante" value="<?php echo $objParticipante->nome_participante ?>" placeholder=" Nome do participante" required>
                    <label for="nome_participante">Nome do participante</label>
                    <div class="invalid-feedback">
                        Por favor, preencha este campo!
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="cpf_participante" name="cpf_participante" value="<?php echo $objParticipante->cpf_participante ?>" placeholder=" CPF do participante" required>
                    <label for="cpf_participante">CPF do participante</label>
                    <div class="invalid-feedback">
                        Por favor, preencha este campo!
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="cpf_cadastro" name="cpf_cadastro" value="<?php echo $objParticipante->cpf_cadastro ?>" placeholder="CPF do cadastrador" required>
                    <label for="cpf_cadastro">CPF do cadastrador</label>
                    <div class="invalid-feedback">
                        Por favor, preencha este campo!
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-floating mb-3">
                    <div class="form-floating mb-3">
                        <input type="datetime-local" class="form-control" id="data_cadastro" name="data_cadastro" value="<?php echo $objParticipante->data_cadastro ?>" placeholder="Data" value="<?= date('Y-m-d H:i') ?>" required>
                        <label for="data_cadastro">Data</label>
                        <div class="invalid-feedback">
                            Por favor, preencha este campo!
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-end pt-3">
                <a href="index.php?p=participantes" class="btn btn-secondary">Voltar</a>
                <button type="submit" class="btn btn-success">Salvar</button>
            </div>
        </div>
    </form>
</div>