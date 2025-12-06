// Função para fazer esconder o alert e redirecionar para url da pagina inicial
$(document).ready(function ($) {
    $("#acaoE").fadeTo(2000, 500).slideUp(500, function () {
        $(location).prop('href', 'index.php?p=edicoes');
        $("#acaoE").slideUp(500);
    });
});

// Função para redirecionar a página conforme a busca
$(document).on('click', '#search', function () {
    let buscaEdicao = $('#buscaEdicao').val();
    if (buscaEdicao == ''){
        $(location).prop('href', 'index.php?p=edicoes');
    } else {
        var link = 'index.php?p=edicoes&buscaEdicao=' + buscaEdicao;
        $(location).prop('href', link);
    } 
});

