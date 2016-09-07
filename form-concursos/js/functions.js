$(document).ready(function(){

	$("a[href$='.pdf']").prop('target', '_blank');
    $(".data").mask("99/99/9999");
    $(".cep").mask("99999-999");
    $(".telefone").mask("(99) 9999-9999");
    $(".cpf").mask("999.999.999-99");

    $("#form-index").validate({
        submitHandler: function( form ) {
            if( !$('#regulamento').is(':checked') ) {
                $('#label-regulamento').addClass('erro');
                return false;
            } else {
                $('#label-regulamento').removeClass('erro');
                form.submit();
            }
        }
    });

    $("#form-infantil").validate({
        rules: {
            juvenil_nome: "required",
            juvenil_nascimento: "required",
            juvenil_email: {
                required: true,
                email: true
            },
            juvenil_telefone: "required",
            juvenil_responsavel: "required",
            juvenil_email_responsavel: {
                email: true,
                required: true
            },
            juvenil_cpf: "required",
        }
    });

    $("#form-adulto").validate({
        rules: {
            adulto_nome: "required",
            adulto_nascimento: "required",
            adulto_email: {
                required: true,
                email: true
            },
            adulto_telefone: "required",
            adulto_cpf: "required",
        }
    });

    $("#form-upload-foto").validate({
        rules: {
            foto_titulo: "required",
            foto_local: "required",
            foto_data: "required",
            foto_anexo: {
                required: true,
                accept: "jpg|jpeg|png"
            },
            "referencia[]": {
                required: true
            }
        },
        messages: {
            foto_anexo: {
                accept: "Somente s&atilde;o aceitas fotos com extens&otilde;es jpg e jpeg"
            }
        }
    });

    $("#form-upload-poesia").validate({
        rules: {
            poesia_titulo: "required",
            poesia_tipo: "required",
            poesia_conteudo: "required",
            "referencia[]": {
                required: true
            }
        }
    });
});