<main class="form-signin bg-light rounded shadow p-4">
    <form id="login" autocomplete="off" class="needs-validation" method="POST" action="" novalidate>
        <img class="img-fluid pb-3" src="images/logo.png" alt="">
        <?= $alertaLogin ?>
        <div class="form-floating mt-3">
            <input type="password" class="form-control" name="senhaA" id="senhaA" placeholder="Senha atual" required>
            <label for="senhaA">Senha atual</label>
            <div class="invalid-feedback">
                Por favor, preencha este campo!
            </div>
        </div>

        <div class="form-floating mt-2">
            <input type="password" class="form-control" name="senha" id="senha" placeholder="Nova senha" required>
            <label for="senha">Nova Senha</label>
            <div class="invalid-feedback">
                Por favor, preencha este campo!
            </div>
        </div>

        <div class="form-floating mt-2 mb-3">
            <input type="password" class="form-control" name="senhaC" id="senhaC" placeholder="Confirme a senha" required>
            <label for="senhaC">Confirme a senha</label>
            <div class="invalid-feedback">
                Por favor, preencha este campo!
            </div>
        </div>

        <button class="w-100 btn btn-lg btn-primary" name="acao" type="submit">Enviar</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2023 SalveBooks</p>
    </form>
</main>