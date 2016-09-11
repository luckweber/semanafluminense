jQuery(document).ready(function ($) {



    $(".datepicker").datepicker({
        dateFormat: "dd/mm/yy",
        timeFormat: "hh:mm tt z",
        dayNames: ["Domingo", "Segunda", "TerÃ§a", "Quarta", "Quinta", "Sexta", "SÃ¡bado"],
        dayNamesMin: ["D", "S", "T", "Q", "Q", "S", "S", "D"],
        dayNamesShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "SÃ¡b", "Dom"],
        monthNames: ["Janeiro", "Fevereiro", "MarÃ§o", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
        monthNamesShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
        nextText: "PrÃ³ximo",
        prevText: "Anterior"
    });
    $("#event_ticket_price").hide();
    $("#label_valor").hide();
    
    
    
    $("#event_contact").hide();
    
    $(".event_owner_option").change(function (){
        
         $(this).each(function () {
            if ($(this).attr("value") == 0) {
                $("#event_contact").show();

            } else if ($(this).attr("value") == 1) {
               $("#event_contact").hide();
            }
        });
        
    });
    
    $("#event_partner_name").prop("disabled", true);
    
    $(".event_partner_option").change(function (){
        
         $(this).each(function () {
            if ($(this).attr("value") == 1) {
                $("#event_partner_name").prop("disabled", false);

            } else if ($(this).attr("value") == 0) {
                $("#event_partner_name").prop("disabled", true);
            }
        });
        
    });
    
    $(".event_ticket_option").change(function () {

        $(this).each(function () {
            if ($(this).attr("value") == "Sim") {
                $("#info_event").show();
                $("#event_ticket_price").hide();
                $("#label_valor").hide();

            } else if ($(this).attr("value") == "nao") {
                $("#info_event").hide();
                $("#event_ticket_price").show();
                $("#label_valor").show();
            }
        });


    });




    var max_fields = 5; //maximum input boxes allowed
    var wrapper = $(".input_fields_wrap"); //Fields wrapper
    var add_button = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function (e) { //on add input button click
        e.preventDefault();



        var length = wrapper.find("input:text").length;

        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input type="text" id="datepicker' + (length + 1) + '" name="data_event' + (length + 1) + '" /><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
        //Fazendo com que cada uma escreva seu name
        wrapper.find("input:text").each(function () {
            //$(this).val($(this).attr('name'))
        });

        $("#datepicker" + (length + 1)).datepicker();

    });

    $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    });

    var incr = $("#incricao");
    incr.attr("readonly", true);
    incr.attr("value", "' . $num . '");

    $("#proponente_cep").on("keyup", function () {
        if ($(this).val().length == 9) {
            text = $(this).val();
            vars = "https://viacep.com.br/ws/" + text + "/json";
            $.getJSON(vars, function (data) {
                $("#proponente_bairro").val(data.bairro);
                $("#proponente_complemento").val(data.complemento);
                $("#proponente_estado").val(data.uf);
                $("#proponente_cidade").val(data.localidade);
            });
        }


    });
    
    $("#responsavel_cep").on("keyup", function () {
        if ($(this).val().length == 9) {
            text = $(this).val();
            vars = "https://viacep.com.br/ws/" + text + "/json";
            $.getJSON(vars, function (data) {
                $("#responsavel_bairro").val(data.bairro);
                $("#responsavel_complemento").val(data.complemento);
                $("#responsavel_estado").val(data.uf);
                $("#responsavel_cidade").val(data.localidade);

            });
        }


    });
    
    
    
    
    
    
    $("#contato_cep").on("keyup", function () {
        if ($(this).val().length == 9) {
            text = $(this).val();
            vars = "https://viacep.com.br/ws/" + text + "/json";
            $.getJSON(vars, function (data) {
                $("#contato_bairro").val(data.bairro);
                $("#contato_complemento").val(data.complemento);
                $("#contato_estado").val(data.uf);
                $("#contato_cidade").val(data.localidade);

            });
        }


    });

    $("#cep").on("keyup", function () {
        if ($(this).val().length == 9) {
            text = $(this).val();
            vars = "https://viacep.com.br/ws/" + text + "/json";
            $.getJSON(vars, function (data) {
                $("#grupo_bairro").val(data.bairro);
                $("#grupo_complemento").val(data.complemento);
                $("#grupo_estado").val(data.uf);
                $("#grupo_cidade").val(data.localidade);

            });
        }
    });


    cpf_cnpf = $("#cpf_cnpj");


    values = $("#select-razao").prop("selectedIndex");


    if (values === 0) {
        cpf_cnpf.removeClass();
        cpf_cnpf.addClass("cpf");

    } else if (values === 1) {
        cpf_cnpf.removeClass();
        cpf_cnpf.addClass("cnpj");
    }

    select1 = $("#regiao");
    selectValues1 = {"1": "Aperibé", "2": "Bom Jesus do Itabapoana", "3": "Campos dos Goytacazes ", "4": "Cardoso Moreira ", "5": "Cambuci", "6": "Italva", "7": "Itaperuna", "8": "Laje do Muriaé", "9": "Natividade", "10": "Miracema", "11": "Macaé ", "11": "Miracema", "12": "São Fidélis ", "13": "São Francisco de Itabapoana ", "14": "São João da Barra ", "15": "Santo Antônio de Pádua ", "16": "São José de Ubá ", "17": "Varre-Sai "};
    selectValues2 = {"1": "Barra Mansa", "2": "Itatiaia", "3": "Pinheiral", "4": "Piraí", "5": "Porto Real", "6": "Quatis", "7": "Resende", "8": "Rio Claro", "9": "Volta Redonda"};
    selectValues3 = {"1": "Petrópolis", "2": "Teresópolis", "3": "São José do Vale do Rio Preto"};
    selectValues4 = {"1": "Belford Roxo", "2": "Cachoeiras de Macacu", "3": "Duque de Caxias", "4": "Guapimirim", "5": "Itaboraí", "6": "Magé", "7": "Maricá", "8": "Mesquita", "9": "Nilópolis", "10": "Niterói", "11": "Nova Iguaçu", "12": "Paracambi", "13": "Queimados", "14": "Rio Bonito", "15": "Rio de Janeiro", "16": "Seropédica", "17": "São Gonçalo", "18": "São João de Meriti", "19": "Tanguá"};
    selectValues5 = {"1": " Araruama", "2": "Armação dos Búzios", "3": "Arraial do Cabo", "4": "Cabo Frio", "5": "Iguaba Grande", "6": "São Pedro da Aldeia", "7": "Saquarema"};
    selectValues6 = {"1": "Angra dos Reis", "2": "Ilha Grande", "3": "Mangaratiba", "4": "Itacuruça", "5": "Paraty"};

    a = $("#regiao").prop("selectedIndex");
    select1.after("<p><label>Cidade<br><select name=cidade id=cidade required></select></label><p>");

    if (a !== 0) {

        if (a === 1) {
            $("#cidade").empty();
            $.each(selectValues1, function (key, value) {
                $("#cidade").append($("<option/>", {
                    value: value,
                    text: value
                }));
            });
            $("#cidade").parent().show();
            $("#cidade").show();

        } else if (a === 2) {
            $("#cidade").empty();
            $.each(selectValues2, function (key, value) {
                $("#cidade").append($("<option/>", {
                    value: value,
                    text: value
                }));
            });
            $("#cidade").parent().show();
            $("#cidade").show();
        } else if (a === 3) {
            $("#cidade").empty();
            $.each(selectValues3, function (key, value) {
                $("#cidade").append($("<option/>", {
                    value: value,
                    text: value
                }));
            });
            $("#cidade").parent().show();
            $("#cidade").show();
        } else if (a === 4) {
            $("#cidade").empty();
            $.each(selectValues4, function (key, value) {
                $("#cidade").append($("<option/>", {
                    value: value,
                    text: value
                }));
            });
            $("#cidade").parent().show();
            $("#cidade").show();
        } else if (a === 5) {
            $("#cidade").empty();
            $.each(selectValues5, function (key, value) {
                $("#cidade").append($("<option/>", {
                    value: value,
                    text: value
                }));
            });
            $("#cidade").parent().show();
            $("#cidade").show();
        } else if (a === 6) {
            $("#cidade").empty();
            $.each(selectValues6, function (key, value) {
                $("#cidade").append($("<option/>", {
                    value: value,
                    text: value
                }));
            });
            $("#cidade").parent().show();
            $("#cidade").show();
        }


    } else {
        $("#cidade").hide();
        $("#cidade").parent().hide();
    }


    $("body").on("change", "#regiao", function () {
        a = $(this).prop("selectedIndex");

        if (a === 0) {
            $("#cidade").parent().hide();
            $("#cidade").show();
            $("#cidade").empty();
            $("#cidade").hide();
        } else if (a === 1) {
            $("#cidade").empty();
            $.each(selectValues1, function (key, value) {
                $("#cidade").append($("<option/>", {
                    value: value,
                    text: value
                }));
            });

            $("#cidade").parent().show();
            $("#cidade").show();

        } else if (a === 2) {
            $("#cidade").empty();
            $.each(selectValues2, function (key, value) {
                $("#cidade").append($("<option/>", {
                    value: value,
                    text: value
                }));
            });

            $("#cidade").parent().show();
            $("#cidade").show();
        } else if (a === 3) {
            $("#cidade").empty();
            $.each(selectValues3, function (key, value) {
                $("#cidade").append($("<option/>", {
                    value: value,
                    text: value
                }));
            });

            $("#cidade").show();
        } else if (a === 4) {
            $("#cidade").empty();
            $.each(selectValues4, function (key, value) {
                $("#cidade").append($("<option/>", {
                    value: value,
                    text: value
                }));
            });

            $("#cidade").parent().show();
            $("#cidade").show();
        } else if (a === 5) {
            $("#cidade").empty();
            $.each(selectValues5, function (key, value) {
                $("#cidade").append($("<option/>", {
                    value: value,
                    text: value
                }));
            });

            $("#cidade").parent().show();
            $("#cidade").show();
        } else if (a === 6) {
            $("#cidade").empty();
            $.each(selectValues6, function (key, value) {
                $("#cidade").append($("<option/>", {
                    value: value,
                    text: value
                }));
            });

            $("#cidade").parent().show();
            $("#cidade").show();
        }

    });



    $("body").on("change", "#select-razao", function () {
        a = $(this).prop("selectedIndex");


        if (a === 0) {
            cpf_cnpf.removeClass();
            cpf_cnpf.addClass("cpf");

        } else if (a === 1) {
            cpf_cnpf.removeClass();
            cpf_cnpf.addClass("cnpj");
        }

        $(".data").mask("99/99/9999");
        $(".cpf").mask("999.999.999-99");
        $(".cnpj").mask("99.999.999/9999-99");
        
        

    });

    $(".data").each(function(){
        $(this).mask("99/99/9999");
    });
    
    
    $(".tel").each(function(){
        $(this).mask("(999) 9999-9999");
    });
    
    $(".cpf").mask("999.999.999-99");
    $(".cnpj").mask("99.999.999/9999-99");
    $(".cep").mask("99999-999");
    $(".hora").mask("99:99");


});