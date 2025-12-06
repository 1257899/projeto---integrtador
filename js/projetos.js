// Função para fazer esconder o alert e redirecionar para url da pagina inicial
$(document).ready(function ($) {
    $("#acaoPr").fadeTo(2000, 500).slideUp(500, function () {
        $(location).prop('href', 'index.php?p=projetos');
        $("#acaoPr").slideUp(500);
    });
});

// Função para redirecionar a página conforme a busca
$(document).on('click', '#search', function () {
    let buscaProjeto = $('#buscaProjeto').val();
    if (buscaProjeto == ''){
        $(location).prop('href', 'index.php?p=projetos');
    } else {
        var link = 'index.php?p=projetos&buscaProjeto=' + buscaProjeto;
        $(location).prop('href', link);
    } 
});
