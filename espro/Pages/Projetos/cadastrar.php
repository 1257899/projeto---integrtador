<?php
// Consulta o número do id do próximo projeto a ser cadastrado
$lastId = Projeto::getLastId('information_schema.tables', 'auto_increment');
$id = $lastId->auto_increment;

// Retorna as edições cadastradas e monta o select com seus dados
$edicoes = Edicao::getEdicoes('exclusao = 0', 'ano_edicao DESC');
$qtdeEdicoes = count($edicoes);
$resultadoEdicoes = '';
foreach ($edicoes as $edicao) {
    $resultadoEdicoes .= '<option value="' . $edicao->id . '">' . $edicao->ano_edicao . '</option>';
}

// Retorna os temas cadastrados e monta o select com seus dados
$temas = Tema::getTemas('excluido = 0', 'Tema ASC');
$qtdeTemas = count($temas);
$resultadoTemas = '';
foreach ($temas as $tema) {
    $resultadoTemas .= '<option value="' . $tema->id . '">' . $tema->tema . '</option>';
}

$cadastrar = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if ($qtdeEdicoes == 0) {
    header('location: index.php?p=projetos&status=ce-error');
    exit;
} else if ($qtdeTemas == 0) {
    header('location: index.php?p=projetos&status=ct-error');
    exit;
} else if (!empty($cadastrar['cadastrar'])) {

    //VALIDAÇÃO DO POST
    $documento = $_FILES["documento"];
    $apresentacao = $_FILES["apresentacao"];

    move_uploaded_file($documento["tmp_name"], 'uploads/documentos/' . $documento["name"]);
    move_uploaded_file($apresentacao["tmp_name"], 'uploads/apresentacoes/' . $apresentacao["name"]);

    unset($cadastrar['cadastrar']);

    $_POST['cpf_cadastro'] = str_replace('.', '', $_POST['cpf_cadastro']);
    $_POST['cpf_cadastro'] = str_replace('-', '', $_POST['cpf_cadastro']);

    $objProjeto->edicao_id          = $_POST['edicao_id'];
    $objProjeto->tema_id            = $_POST['tema_id'];
    $objProjeto->nome_equipe        = $_POST['nome_equipe'];
    $objProjeto->cpf_cadastro       = $_POST['cpf_cadastro'];
    $objProjeto->data_cadastro      = $_POST['data_cadastro'];
    $objProjeto->documento          = 'uploads/documentos/' . $documento["name"];
    $objProjeto->apresentacao       = 'uploads/apresentacao/' . $apresentacao["name"];

    // Cadastra o projeto no banco
    if ($objProjeto->cadastrar()) {
        header('location: index.php?p=projetos&status=c-success');
        exit;
    } else {
        header('location: index.php?p=projetos&status=error');
        exit;
    }
}

?>
<div class="row">
    <h4>Cadastrar projeto</h4>
    <form class="needs-validation mt-4" autocomplete="off" name="cadastrar" method="POST" enctype="multipart/form-data" novalidate>
        <div class="row">
            <input hidden type="text" id="id" name="id" value="<?= $id ?>">
            <div class="col-12 col-md-4">
                <div class="form-floating mb-3">
                    <select class="form-select" data-live-search="true" id="edicao_id" name="edicao_id" aria-label="Edição" required>
                        <?= $resultadoEdicoes ?>
                    </select>
                    <label for="edicao_id">Edição</label>
                    <div class="invalid-feedback">
                        Por favor, preencha este campo!
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-floating mb-3">
                    <select class="form-select" data-live-search="true" id="tema_id" name="tema_id" aria-label="Tema" required>
                        <?= $resultadoTemas ?>
                    </select>
                    <label for="tema_id">Tema</label>
                    <div class="invalid-feedback">
                        Por favor, preencha este campo!
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nome_equipe" name="nome_equipe" placeholder="Nome da equipe" required>
                    <label for="nome_equipe">Nome da equipe</label>
                    <div class="invalid-feedback">
                        Por favor, preencha este campo!
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="cpf_cadastro" name="cpf_cadastro" placeholder="CPF" required>
                    <label for="cpf_cadastro">CPF</label>
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
            <div class="col-12 col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label" for="documento">Documento</label>
                    <input type="file" class="form-control" id="documento" name="documento" placeholder="Documento" required>
                    <div class="invalid-feedback">
                        Por favor, preencha este campo!
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label" for="apresentacao">Apresentação</label>
                    <input type="file" class="form-control" id="apresentacao" name="apresentacao" placeholder="Apresentação" required>
                    <div class="invalid-feedback">
                        Por favor, preencha este campo!
                    </div>
                </div>
            </div>
            <div class="col-12 text-end pt-3">
                <a href="index.php?p=projetos" class="btn btn-secondary">Voltar</a>
                <button type="submit" id="cadastrar" class="btn btn-success" value="Cadastrar Projeto" name="cadastrar">Cadastrar</button>
            </div>
        </div>
    </form>
</div>