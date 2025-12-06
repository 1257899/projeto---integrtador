<?php
// Condições sql
$condicoes = [
    'excluido = 0'
];

// Remove posições vazias
$condicoes = array_filter($condicoes);

// Cláusula WHERE
$where = implode(' AND ', $condicoes);

$temas = Tema::getTemas($where);

// Verifica se há temas cadastrados
if (count($temas) == 0) {
    header('location: index.php?p=temas&status=d-error');
    exit;
} else {
    // VALIDAÇÃO DO POST
    if (isset($_POST['deletar'])) {
        $objTema->excluido = 1;
        foreach ($temas as $tema) {
            // Deleta todas os temas do banco
            $objTema->deletarAll($tema->id);
        }
        header('location: index.php?p=temas&status=dall-success');
        exit;
    }
}
?>
<div class="row">
    <h4>Excluir - Temas</h4>
    <form class="mt-4" method="post">
        <div class="row">
            <div class="col-12">
                <div class="form-floating mb-3">
                    <p class="alert alert-danger">Você deseja realmente excluir todos os temas?</p>
                </div>
            </div>
            <div class="text-end pt-3">
                <a href="index.php?p=temas" class="btn btn-secondary">Cancelar</a>
                <button type="submit" name="deletar" class="btn btn-danger">Deletar</button>
            </div>
        </div>
    </form>
</div>