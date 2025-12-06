<?php
//VALIDAÇÃO DO ID
if (!isset($_GET['id']) or !is_numeric($_GET['id'])) {
    header('location: index.php?p=projetos&status=error');
    exit;
}

//CONSULTA O PROJETO
$objProjeto = Projeto::getProjeto($_GET['id']);

//VALIDAÇÃO DO PROJETO
if (!$objProjeto instanceof Projeto) {
    header('location: index.php?p=projetos&status=error');
    exit;
}

// Retorna as edições cadastradas e monta o select com seus dados
$edicoes = Edicao::getEdicoes('id <> ' . $objProjeto->edicao_id, 'ano_edicao DESC');
$projetoEdicao = Edicao::getEdicao($objProjeto->edicao_id);
$resultadoEdicao = '';
$resultadoEdicao .= '<option selected value="' . $projetoEdicao->id . '">' . $projetoEdicao->ano_edicao . '</option>';
foreach ($edicoes as $edicao) {
    $resultadoEdicao .= '<option value="' . $edicao->id . '">' . $edicao->ano_edicao . '</option>';
}

// Retorna os temas cadastradas e monta o select com seus dados
$temas = Tema::getTemas('id <> ' . $objProjeto->tema_id, 'tema ASC');
$projetoTema = Tema::getTema($objProjeto->tema_id);
$resultadoTema = '';
$resultadoTema .= '<option selected value="' . $projetoTema->id . '">' . $projetoTema->tema . '</option>';
foreach ($temas as $tema) {
    $resultadoTema .= '<option value="' . $tema->id . '">' . $tema->tema . '</option>';
}

//VALIDAÇÃO DO POST
if (isset($_POST['edicao_id'], $_POST['tema_id'], $_POST['nome_equipe'], $_POST['documento'], $_POST['apresentacao'], $_POST['cpf_cadastro'], $_POST['data_cadastro'])) {
    $_POST['cpf_cadastro'] = str_replace('.', '', $_POST['cpf_cadastro']);
    $_POST['cpf_cadastro'] = str_replace('-', '', $_POST['cpf_cadastro']);

    $documento = $_FILES["documento"];
    $apresentacao = $_FILES["apresentacao"];

    move_uploaded_file($documento["tmp_name"], 'uploads/documentos/' . $documento["name"]);
    move_uploaded_file($apresentacao["tmp_name"], 'uploads/apresentacoes/' . $apresentacao["name"]);

    $objProjeto->edicao_id               = $_POST['edicao_id'];
    $objProjeto->tema_id                 = $_POST['tema_id'];
    $objProjeto->nome_equipe             = $_POST['nome_equipe'];
    $objProjeto->documento               = 'uploads/documentos/' . $documento["name"];
    $objProjeto->apresentacao            = 'uploads/apresentacoes/' . $apresentacao["name"];
    $objProjeto->cpf_cadastro            = $_POST['cpf_cadastro'];
    $objProjeto->data_cadastro           = $_POST['data_cadastro'];
    // Atualiza os dados do preco
    if ($objProjeto->atualizar()) {
        header('location: index.php?p=projetos&status=e-success');
        exit;
    } else {
        header('location: index.php?p=projetos&status=error');
        exit;
    }
}
?>
<div class="row">
    <h4>Editar edição - #<?php echo $objProjeto->id ?></h4>
    <form autocomplete="off" class="needs-validation mt-4" method="post" enctype="multipart/form-data" novalidate>
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="form-floating mb-3">
                    <select class="form-select" data-live-search="true" id="edicao_id" name="edicao_id" aria-label="Edição" required>
                        <?= $resultadoEdicao ?>
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
                        <?= $resultadoTema ?>
                    </select>
                    <label for="tema_id">Tema</label>
                    <div class="invalid-feedback">
                        Por favor, preencha este campo!
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nome_equipe" name="nome_equipe" value="<?php echo $objProjeto->nome_equipe ?>" placeholder=" Nome da equipe" required>
                    <label for="nome_equipe">Nome da equipe</label>
                    <div class="invalid-feedback">
                        Por favor, preencha este campo!
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="cpf_cadastro" name="cpf_cadastro" value="<?php echo $objProjeto->cpf_cadastro ?>" placeholder="CPF" required>
                    <label for="cpf_cadastro">CPF</label>
                    <div class="invalid-feedback">
                        Por favor, preencha este campo!
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-floating mb-3">
                    <div class="form-floating mb-3">
                        <input type="datetime-local" class="form-control" id="data_cadastro" name="data_cadastro" value="<?php echo $objProjeto->data_cadastro ?>" placeholder="Data" value="<?= date('Y-m-d H:i') ?>" required>
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

            <div class="text-end pt-3">
                <a href="index.php?p=projetos" class="btn btn-secondary">Voltar</a>
                <button type="submit" class="btn btn-success">Salvar</button>
            </div>
        </div>
    </form>
</div>