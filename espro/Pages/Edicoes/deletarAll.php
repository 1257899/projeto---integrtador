<?php
// Condições sql
$condicoes = [
    'exclusao = 0'
];

// Remove posições vazias
$condicoes = array_filter($condicoes);

// Cláusula WHERE
$where = implode(' AND ', $condicoes);

$edicoes = Edicao::getEdicoes($where);

// Verifica se há edições cadastradas
if (count($edicoes) == 0) {
    header('location: index.php?p=edicoes&status=d-error');
    exit;
} else {
    // VALIDAÇÃO DO POST
    if (isset($_POST['deletar'], $_POST['cpf_exclusao'], $_POST['data_exclusao'])) {
        $objEdicao->exclusao = 1;
        $_POST['cpf_exclusao'] = str_replace('.', '', $_POST['cpf_exclusao']);
        $_POST['cpf_exclusao'] = str_replace('-', '', $_POST['cpf_exclusao']);

        $objEdicao->cpf_exclusao        = $_POST['cpf_exclusao'];
        $objEdicao->data_exclusao       = $_POST['data_exclusao'];
        foreach ($edicoes as $edicao) {
            // Deleta todas as edições do banco
            $objEdicao->deletarAll($edicao->id);
        }
        header('location: index.php?p=edicoes&status=dall-success');
        exit;
    }
}
?>
<div class="row">
    <h4>Excluir - Edições</h4>
    <form autocomplete="off" class="needs-validation mt-4" method="post" novalidate>
        <div class="row">
            <div class="col-12">
                <div class="form-floating mb-3">
                    <p class="alert alert-danger">Você deseja realmente excluir todas as edições?</p>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="cpf_exclusao" name="cpf_exclusao" placeholder="CPF" required>
                    <label for="cpf_exclusao">CPF</label>
                    <div class="invalid-feedback">
                        Por favor, preencha este campo!
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-floating mb-3">
                    <div class="form-floating mb-3">
                        <input type="datetime-local" class="form-control" id="data_exclusao" name="data_exclusao" placeholder="Data" value="<?= date('Y-m-d H:i') ?>" required>
                        <label for="data_exclusao">Data</label>
                        <div class="invalid-feedback">
                            Por favor, preencha este campo!
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-end pt-3">
                <a href="index.php?p=edicoes" class="btn btn-secondary">Cancelar</a>
                <button type="submit" name="deletar" class="btn btn-danger">Deletar</button>
            </div>
        </div>
    </form>
</div>