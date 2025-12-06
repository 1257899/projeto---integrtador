// Função para fazer esconder o alert e redirecionar para url da pagina inicial
$(document).ready(function ($) {
    $("#acaoPa").fadeTo(2000, 500).slideUp(500, function () {
        $(location).prop('href', 'index.php?p=participantes');
        $("#acaoPa").slideUp(500);
    });
});

// Função para redirecionar a página conforme a busca
$(document).on('click', '#search', function () {
    let buscaParticipante = $('#buscaParticipante').val();
    if (buscaParticipante == ''){
        $(location).prop('href', 'index.php?p=participantes');
    } else {
        var link = 'index.php?p=participantes&buscaParticipante=' + buscaParticipante;
        $(location).prop('href', link);
    } 
});