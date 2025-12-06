<?php
//VALIDAÇÃO DO ID
if (!isset($_GET['id']) or !is_numeric($_GET['id'])) {
    header('location: index.php?p=temas&status=error');
    exit;
}

//CONSULTA O TEMA
$objTema = Tema::getTema($_GET['id']);

//VALIDAÇÃO DO TEMA
if (!$objTema instanceof Tema) {
    header('location: index.php?p=temas&status=error');
    exit;
}

//VALIDAÇÃO DO POST
if (isset($_POST['tema'], $_POST['descritivo'], $_POST['cpf_cadastro'], $_POST['data_cadastro'])) {
    $_POST['cpf_cadastro'] = str_replace('.', '', $_POST['cpf_cadastro']);
    $_POST['cpf_cadastro'] = str_replace('-', '', $_POST['cpf_cadastro']);

    $objTema->tema                = ucwords($_POST['tema']);
    $objTema->descritivo          = ucwords($_POST['descritivo']);
    $objTema->cpf_cadastro        = $_POST['cpf_cadastro'];
    $objTema->data_cadastro       = $_POST['data_cadastro'];
    // Atualiza os dados do tema
    if ($objTema->atualizar()) {
        header('location: index.php?p=temas&status=e-success');
        exit;
    } else {
        header('location: index.php?p=temas&status=error');
        exit;
    }
}
?>
<div class="row">
    <h4>Editar tema - #<?php echo $objTema->id ?></h4>
    <form autocomplete="off" class="needs-validation mt-4" method="post" novalidate>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="tema" name="tema" placeholder="Tema" value="<?php echo $objTema->tema ?>" required>
                    <label for="tema">Tema</label>
                    <div class="invalid-feedback">
                        Por favor, preencha este campo!
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-floating mb-3">
                    <input class="form-control" id="descritivo" name="descritivo" placeholder="Descritivo" value="<?php echo $objTema->descritivo ?>" required>
                    <label for="descritivo">Descritivo</label>
                    <div class="invalid-feedback">
                        Por favor, preencha este campo!
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="cpf_cadastro" name="cpf_cadastro" value="<?php echo $objTema->cpf_cadastro ?>" placeholder="CPF" required>
                    <label for="cpf_cadastro">CPF</label>
                    <div class="invalid-feedback">
                        Por favor, preencha este campo!
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-floating mb-3">
                    <div class="form-floating mb-3">
                        <input type="datetime-local" class="form-control" id="data_cadastro" name="data_cadastro" value="<?php echo $objTema->data_cadastro ?>" placeholder="Data" value="<?= date('Y-m-d H:i') ?>" required>
                        <label for="data_cadastro">Data</label>
                        <div class="invalid-feedback">
                            Por favor, preencha este campo!
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-end pt-3">
                <a href="index.php?p=temas" class="btn btn-secondary">Voltar</a>
                <button type="submit" class="btn btn-success">Salvar</button>
            </div>
        </div>
    </form>
</div>