(function () {
    'use strict'

    var forms = document.querySelectorAll('.needs-validation')

    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
})()

$(document).ready(function ($) {
    // *** Masks ***

    // CPF
    $('.cpf').mask('000.000.000-00');

    $('#cpf_cadastro').mask('000.000.000-00');
    $('#cpf_exclusao').mask('000.000.000-00');
    $('#cpf_participante').mask('000.000.000-00');
});




