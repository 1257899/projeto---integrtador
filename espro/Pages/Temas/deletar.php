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
if (isset($_POST['deletar'])) {
    $objTema->excluido = 1;
    // Deleta o tema no banco
    if ($objTema->deletar()) {
        header('location: index.php?p=temas&status=d-success');
        exit;
    } else {
        header('location: index.php?p=temas&status=error');
        exit;
    }
}
?>
<div class="row">
    <h4>Excluir - Tema #<?php echo $objTema->id ?></h4>
    <form class="mt-4" method="post">
        <div class="row">
            <div class="col-12">
                <div class="form-floating mb-3">
                    <p class="alert alert-danger">Você deseja realmente excluir o tema <strong>#<?= $objTema->id ?></strong>, com o título de <strong><?= $objTema->tema ?></strong>?</p>
                </div>
            </div>
            <div class="text-end pt-3">
                <a href="index.php?p=temas" class="btn btn-secondary">Cancelar</a>
                <button type="submit" name="deletar" class="btn btn-danger">Deletar</button>
            </div>
        </div>
    </form>
</div>