<style type="text/css">
 .main{
	background-color:yellow;
 }
	</style>
<main class="form-signin bg-light rounded shadow p-4">
	<form id="login" autocomplete="off" class="needs-validation" method="post" novalidate>
	<img class="img-fluid pb-3" src="images/salvebooks.png" alt="">
		<?= $alertaLogin ?>
		<div class="form-floating mt-2">
			<input type="text" class="form-control" name="user" id="user" placeholder="Usuário" required>
			<label for="user">Usuário</label>
			<div class="invalid-feedback">
				Por favor, preencha este campo!
			</div>
		</div>

		<div class="form-floating mt-2">
			<input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" required>
			<label for="senha">Senha</label>
			<div class="invalid-feedback">
				Por favor, preencha este campo!
			</div>
		</div>

		<button class="w-100 btn btn-lg btn-primary mt-3" name="acao" value="logar" type="submit">Entrar</button>
		<p class="mt-5 mb-3 text-muted">&copy; 2023 SalveBooks</p>
	</form>
</main>