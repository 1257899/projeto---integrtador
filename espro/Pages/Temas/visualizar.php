<?php
// VALIDAÇÃO DO ID
if (!isset($_GET['id']) or !is_numeric($_GET['id'])) {
    header('location: index.php?p=temas&status=error');
    exit;
}

// CONSULTA O TEMA
$objTema = Tema::getTema($_GET['id']);

// VALIDAÇÃO DO TEMA
if (!$objTema instanceof Tema) {
    header('location: index.php?p=temas&status=error');
    exit;
}

?>
<div class="row">
    <h4>Visualizar Tema #<?php echo $objTema->id ?></h4>
    <form class="mt-4" method="post">
        <div class="row">
            <div class="col-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="tema" name="tema" placeholder="Tema" value="<?php echo $objTema->tema ?>" readonly>
                    <label for="tema">Tema</label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-floating mb-3">
                    <input class="form-control mt-2" id="descritivo" name="descritivo" placeholder="Descritivo" value="<?php echo $objTema->descritivo ?>" readonly>
                    <label for="descritivo">Descritivo</label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="cpf_cadastro" name="cpf_cadastro" value="<?php echo $objTema->cpf_cadastro ?>" placeholder="CPF" readonly>
                    <label for="cpf_cadastro">CPF</label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-floating mb-3">
                    <div class="form-floating mb-3">
                        <input type="datetime-local" class="form-control" id="data_cadastro" name="data_cadastro" value="<?php echo $objTema->data_cadastro ?>" placeholder="Data" value="<?= date('Y-m-d H:i') ?>" readonly>
                        <label for="data_cadastro">Data</label>
                    </div>
                </div>
            </div>

            <div class="col-12 text-end pt-3">
                <a href="index.php?p=temas" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
    </form>
</div>