$(document).ready(function() {

    $('#opcao_curso, #opcao_pergunta_dois, #opcao_outros').hide();
    $('#opcao_curso, #opcao_pergunta_dois, #opcao_outros').find('input').prop('disabled', true);

    $(".data").mask("99/99/9999");
    $(".telefone").mask("(99) 9999-9999");

    $('.escolaridade').click(function() {
        if( $(this).val() > 1 ) {
            $('#opcao_curso').show();
            $('#opcao_curso').find('input').prop('disabled', false);
        } else {
            $('#opcao_curso').hide();
            $('#opcao_curso').find('input').prop('disabled', true);
        }
    });

    $('.pergunta-dois').click(function() {
        if( $(this).val() == 0 ) {
            $('#opcao_pergunta_dois').show();
            $('#opcao_pergunta_dois').find('input').prop('disabled', false);
        } else {
            $('#opcao_pergunta_dois').hide();
            $('#opcao_pergunta_dois').find('input').prop('disabled', true);
        }
    });

    $('.pergunta-tres').click(function() {
        if( $(this).val() > 2 ) {
            $('#opcao_outros').show();
            $('#opcao_outros').find('input').prop('disabled', false);
        } else {
            $('#opcao_outros').hide();
            $('#opcao_outros').find('input').prop('disabled', true);
        }
    });

    $(".wpcf7-form").validate({
        rules: {
            nome: "required",
            email: {
                required: true,
                email: true
            },
            nascimento: "required",
            bairro: "required",
            cidade: "required",
            telefone: "required"
        },
        messages: {
            nome: "Digite seu nome.",
            email: "Digite um e-mail válido.",
            nascimento: "Informe a sua data de nascimento.",
            bairro: "Informe o bairro.",
            cidade: "Informe o sua cidade.",
            telefone: "Informe seu telefone."
        },
        invalidHandler: function(form, validator) {

            $('html, body').animate({
                scrollTop: $('.wpcf7').offset().top - 100
            });

        },
        submitHandler: function(form, validator) {
            
            $('html, body').animate({
                scrollTop: $('.wpcf7').offset().top - 100
            });

            form.submit();

        }
    });

});