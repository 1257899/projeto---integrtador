<?php
// Condições sql
$condicoes = [
    'exclusao = 0'
];

// Remove posições vazias
$condicoes = array_filter($condicoes);

// Cláusula WHERE
$where = implode(' AND ', $condicoes);

$projetos = Projeto::getProjetos($where);

// Verifica se há projetos cadastrados
if (count($projetos) == 0) {
    header('location: index.php?p=projetos&status=d-error');
    exit;
} else {
    // VALIDAÇÃO DO POST
    if (isset($_POST['deletar'], $_POST['cpf_exclusao'], $_POST['data_exclusao'])) {
        $objParticipante->exclusao = 1;
        $_POST['cpf_exclusao'] = str_replace('.', '', $_POST['cpf_exclusao']);
        $_POST['cpf_exclusao'] = str_replace('-', '', $_POST['cpf_exclusao']);

        $objParticipante->cpf_exclusao        = $_POST['cpf_exclusao'];
        $objParticipante->data_exclusao       = $_POST['data_exclusao'];

        foreach ($projetos as $projeto) {
            // Deleta todas os projetos do banco
            $objParticipante->deletarAll($projeto->id);
        }
        header('location: index.php?p=projetos&status=dall-success');
        exit;
    }
}
?>
<div class="row">
    <h4>Excluir - Projetos</h4>
    <form autocomplete="off" class="needs-validation mt-4" method="post" novalidate>
        <div class="row">
            <div class="col-12">
                <div class="form-floating mb-3">
                    <p class="alert alert-danger">Você deseja realmente excluir todas os projetos?</p>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="cpf_exclusao" name="cpf_exclusao" placeholder="CPF" required>
                    <label for="cpf_exclusao">CPF</label>
                    <div class="invalid-feedback">
                        Por favor, preencha este campo!
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
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
                <a href="index.php?p=projetos" class="btn btn-secondary">Cancelar</a>
                <button type="submit" name="deletar" class="btn btn-danger">Deletar</button>
            </div>
        </div>
    </form>
</div>