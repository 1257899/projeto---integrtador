<?php
// Consulta o número do id do próximo tema a ser cadastrado
$lastId = Tema::getLastId('information_schema.tables', 'auto_increment');
$id = $lastId->auto_increment;

//VALIDAÇÃO DO POST
$cadastrar = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($cadastrar['cadastrar'])) {
    unset($cadastrar['cadastrar']);
    $_POST['cpf_cadastro'] = str_replace('.', '', $_POST['cpf_cadastro']);
    $_POST['cpf_cadastro'] = str_replace('-', '', $_POST['cpf_cadastro']);
    $objTema->tema                = ucwords($_POST['tema']);
    $objTema->descritivo          = ucwords($_POST['descritivo']);
    $objTema->cpf_cadastro        = $_POST['cpf_cadastro'];
    $objTema->data_cadastro       = $_POST['data_cadastro'];

    // Cadastra o tema no banco
    if ($objTema->cadastrar()) {
        header('location: index.php?p=temas&status=c-success');
        exit;
    } else {
        header('location: index.php?p=temas&status=error');
        exit;
    }
}
?>
<div class="row">
    <h4>Cadastrar tema</h4>
    <form class="needs-validation mt-4" autocomplete="off" name="cadastrar" method="POST" novalidate>
        <div class="row">
            <input hidden type="text" id="id" name="id" value="<?= $id ?>">
            <div class="col-12 col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="tema" name="tema" placeholder="Tema" required>
                    <label for="tema">Tema</label>
                    <div class="invalid-feedback">
                        Por favor, preencha este campo!
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-floating mb-3">
                    <textarea class="form-control" rows="5" id="descritivo" name="descritivo" placeholder="Descritivo" required></textarea>
                    <label for="descritivo">Descritivo</label>
                    <div class="invalid-feedback">s
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
            <div class="col-12 text-end pt-3">
                <a href="index.php?p=temas" class="btn btn-secondary">Voltar</a>
                <button type="submit" id="cadastrar" class="btn btn-success" value="Cadastrar Tema" name="cadastrar">Cadastrar</button>
            </div>
        </div>
    </form>
</div>