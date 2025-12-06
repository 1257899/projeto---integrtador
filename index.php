<?php
// Pega todos os dados de saída e guardar em buffer
ob_start();
require(__DIR__ . '/' . 'App' . '/' . 'config.php');

// Obriga o usuário a estar logado
Login::requireLogin();

include __DIR__ . '/' . 'includes' . '/' . 'header.php';
?>
<div class="container-fluid">
	<div class="row">
		<div class="col p-index">
			<div class="box p-4 p-lg-5 shadow rounded">
				<?php
				// Faz o include dos módulos e suas páginas pegando o valor de 'p' passado como parâmetro na url
				$valor = @$_GET['p'];
				if ($valor == '') {
					include __DIR__ . '/' . 'inicio.php';
				} else if ($valor == 'edicoes') {
					include __DIR__ . '/' . 'Pages' . '/' . 'Edicoes' . '/' . 'index.php';
					if ($valorE == 'cadastrar') {
						include_once __DIR__ . '/' . 'Pages' . '/' . 'Edicoes' . '/' . 'cadastrar.php';
					} else if ($valorE == 'editar') {
						include_once __DIR__ . '/' . 'Pages' . '/' . 'Edicoes' . '/' . 'editar.php';
					} else if ($valorE == 'deletar') {
						include_once __DIR__ . '/' . 'Pages' . '/' . 'Edicoes' . '/' . 'deletar.php';
					} else if ($valorE == 'visualizar') {
						include_once __DIR__ . '/' . 'Pages' . '/' . 'Edicoes' . '/' . 'visualizar.php';
					} else if ($valorE == 'deletarAll') {
						include_once __DIR__ . '/' . 'Pages' . '/' . 'Edicoes' . '/' . 'deletarAll.php';
					}
				} else if ($valor == 'participantes') {
					include __DIR__ . '/' . 'Pages' . '/' . 'Participantes' . '/' . 'index.php';
					if ($valorPa == 'cadastrar') {
						include_once __DIR__ . '/' . 'Pages' . '/' . 'Participantes' . '/' . 'cadastrar.php';
					} else if ($valorPa == 'editar') {
						include_once __DIR__ . '/' . 'Pages' . '/' . 'Participantes' . '/' . 'editar.php';
					} else if ($valorPa == 'deletar') {
						include_once __DIR__ . '/' . 'Pages' . '/' . 'Participantes' . '/' . 'deletar.php';
					} else if ($valorPa == 'visualizar') {
						include_once __DIR__ . '/' . 'Pages' . '/' . 'Participantes' . '/' . 'visualizar.php';
					} else if ($valorPa == 'deletarAll') {
						include_once __DIR__ . '/' . 'Pages' . '/' . 'Participantes' . '/' . 'deletarAll.php';
					}
				} else if ($valor == 'projetos') {
					include __DIR__ . '/' . 'Pages' . '/' . 'Projetos' . '/' . 'index.php';
					if ($valorPr == 'cadastrar') {
						include_once __DIR__ . '/' . 'Pages' . '/' . 'Projetos' . '/' . 'cadastrar.php';
					} else if ($valorPr == 'editar') {
						include_once __DIR__ . '/' . 'Pages' . '/' . 'Projetos' . '/' . 'editar.php';
					} else if ($valorPr == 'deletar') {
						include_once __DIR__ . '/' . 'Pages' . '/' . 'Projetos' . '/' . 'deletar.php';
					} else if ($valorPr == 'visualizar') {
						include_once __DIR__ . '/' . 'Pages' . '/' . 'Projetos' . '/' . 'visualizar.php';
					} else if ($valorPr == 'deletarAll') {
						include_once __DIR__ . '/' . 'Pages' . '/' . 'Projetos' . '/' . 'deletarAll.php';
					}
				} else if ($valor == 'temas') {
					include __DIR__ . '/' . 'Pages' . '/' . 'Temas' . '/' . 'index.php';
					if ($valorT == 'cadastrar') {
						include_once __DIR__ . '/' . 'Pages' . '/' . 'Temas' . '/' . 'cadastrar.php';
					} else if ($valorT == 'editar') {
						include_once __DIR__ . '/' . 'Pages' . '/' . 'Temas' . '/' . 'editar.php';
					} else if ($valorT == 'deletar') {
						include_once __DIR__ . '/' . 'Pages' . '/' . 'Temas' . '/' . 'deletar.php';
					} else if ($valorT == 'visualizar') {
						include_once __DIR__ . '/' . 'Pages' . '/' . 'Temas' . '/' . 'visualizar.php';
					} else if ($valorT == 'deletarAll') {
						include_once __DIR__ . '/' . 'Pages' . '/' . 'Temas' . '/' . 'deletarAll.php';
					}
				}
				?>
			</div>
		</div>
	</div>
</div>
<footer class="footer mt-auto py-3">
	<p class="text-center text-muted">&copy; 2023 SalveBooks</p>
</footer>
<?php
include __DIR__ . '/' . 'includes' . '/' . 'footer.php';

// Envia o conteúdo do buffer para a saída, esvazia-o e encerra o buffering;
ob_end_flush();
?>