// Função para fazer esconder o alert e redirecionar para url da pagina inicial
$(document).ready(function ($) {
    $("#acaoT").fadeTo(2000, 500).slideUp(500, function () {
        $(location).prop('href', 'index.php?p=temas');
        $("#acaoT").slideUp(500);
    });
});

// Função para redirecionar a página conforme a busca
$(document).on('click', '#search', function () {
    let buscaTema = $('#buscaTema').val();
    if (buscaTema == ''){
        $(location).prop('href', 'index.php?p=temas');
    } else {
        var link = 'index.php?p=edicoes&buscaTema=' + buscaTema;
        $(location).prop('href', link);
    } 
});