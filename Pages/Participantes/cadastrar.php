<?php
// Consulta o número do id do próximo participante a ser cadastrado
$lastId = Participante::getLastId('information_schema.tables', 'auto_increment');
$id = $lastId->auto_increment;

// Retorna os projetos cadastrados e monta o select com seus dados
$projetos = Projeto::getProjetos('exclusao = 0', 'nome_equipe');
$qtdeProjetos = count($projetos);
$resultado = '';
foreach ($projetos as $projeto) {
    $resultado .= '<option value="' . $projeto->id . '">' . $projeto->nome_equipe . '</option>';
}

$cadastrar = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if ($qtdeProjetos == 0) {
    header('location: index.php?p=participantes&status=c-error');
    exit;
} else if (!empty($cadastrar['cadastrar'])) {
    //VALIDAÇÃO DO POST
    unset($cadastrar['cadastrar']);
    $_POST['cpf_cadastro'] = str_replace('.', '', $_POST['cpf_cadastro']);
    $_POST['cpf_cadastro'] = str_replace('-', '', $_POST['cpf_cadastro']);

    $_POST['cpf_participante'] = str_replace('.', '', $_POST['cpf_participante']);
    $_POST['cpf_participante'] = str_replace('-', '', $_POST['cpf_participante']);

    $objParticipante->projeto_id          = $_POST['projeto_id'];
    $objParticipante->cpf_participante    = $_POST['cpf_participante'];
    $objParticipante->nome_participante   = $_POST['nome_participante'];
    $objParticipante->cpf_cadastro        = $_POST['cpf_cadastro'];
    $objParticipante->data_cadastro       = $_POST['data_cadastro'];

    // Cadastra o participante no banco
    if ($objParticipante->cadastrar()) {
        header('location: index.php?p=participantes&status=c-success');
        exit;
    } else {
        header('location: index.php?p=participantes&status=error');
        exit;
    }
}

?>
<div class="row">
    <h4>Cadastrar participante</h4>
    <form class="needs-validation mt-4" autocomplete="off" name="cadastrar" method="POST" novalidate>
        <div class="row">
            <input hidden type="text" id="id" name="id" value="<?= $id ?>">
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
                    <input type="text" class="form-control" id="nome_participante" name="nome_participante" placeholder="Nome do participante" required>
                    <label for="nome_participante">Nome do participante</label>
                    <div class="invalid-feedback">
                        Por favor, preencha este campo!
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="cpf_participante" name="cpf_participante" placeholder="CPF do participante" required>
                    <label for="cpf_participante">CPF do participante</label>
                    <div class="invalid-feedback">
                        Por favor, preencha este campo!
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="cpf_cadastro" name="cpf_cadastro" placeholder="CPF do cadastrador" required>
                    <label for="cpf_cadastro">CPF do cadastrador</label>
                    <div class="invalid-feedback">
                        Por favor, preencha este campo!
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
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
                <a href="index.php?p=participantes" class="btn btn-secondary">Voltar</a>
                <button type="submit" id="cadastrar" class="btn btn-success" value="Cadastrar Participante" name="cadastrar">Cadastrar</button>
            </div>
        </div>
    </form>
</div>