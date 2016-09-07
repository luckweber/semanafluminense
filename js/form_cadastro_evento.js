jQuery('.wpcf7-form').each(function(){

    // Enable Phone Mask
    phoneMask( $('#event_proponent_phone, #event_contact_phone, #event_owner_phone') );

	$('#event_owner, #event_contact, .error').hide();
	$('#event_owner, #event_contact, #event_partner_field').prop('disabled', true);

	var ticketOption = $(".event_ticket_option");

	if( ticketOption.val() == "Sim" ) {
		$('#event_ticket_price_field')
			.prop('disabled', true)
			.hide();
	}

	ticketOption.click( function() {

		var eventOption = $(this).val();
		if( eventOption == "Não" ) {
			$('#event_ticket_price_field')
				.prop('disabled', false)
				.show();
		} else {
			$('#event_ticket_price_field')
				.prop('disabled', true)
				.hide();
		}

	} );

	var proponentOption = $('.event_proponent_option');
	proponentOption.click( function() {

		var thisOption = $(this).val();
		if( thisOption > 0 ) {
			$('#event_proponent_fields').prop('disabled', false);
			$('#event_owner').show().prop('disabled', false);
		} else {
			$('#event_proponent_fields').prop('disabled', false);
			$('#event_owner').hide().prop('disabled', true);
			$('#event_proponent_fields').children('input').removeClass('error');
			$('#event_proponent_fields').find('label.error').hide();
		}

	} );

	var ownerOption = $('.event_owner_option');
	ownerOption.click( function() {

		var thisOption = $(this).val();
		if( thisOption == 0 ) {
			$('#event_contact').show().prop('disabled', false);
		} else {
			$('#event_contact').hide().prop('disabled', true);
			$('#event_contact').children('input').removeClass('error');
			$('#event_contact').find('label.error').hide();
		}

	} );

	var partnerOption = $('.event_partner_option');
	partnerOption.click( function() {

		var thisOption = $(this).val();
		if( thisOption == 1 ) {
			$('#event_partner_field').prop('disabled', false);
		} else {
			$('#event_partner_field').prop('disabled', true);
			$('#event_partner_field').children('input').removeClass('error');
			$('#event_partner_field').find('label.error').hide();
		}

	} );

	jQuery(this).validate({
		//debug: true,
		rules: {
			event_end_date: {
				compareDate: '#event_start_date'
			},
			event_ticket_price: {
				required: '#event_ticket_option_no:checked',
				numberAlt: true
			},
			event_proponent_name: {
				required: {
					depends: function( element ) {
						return ( !$('#event_proponent_fields').is(':disabled') );
					}
				}
			},
			event_proponent_email: {
				required: {
					depends: function( element ) {
						return ( !$('#event_proponent_fields').is(':disabled') );
					}
				},
				email: true
			},
			event_proponent_phone: {
				required: {
					depends: function( element ) {
						return ( !$('#event_proponent_fields').is(':disabled') );
					}
				}
			},
			event_owner_name: {
				required: {
					depends: function( element ) {
						return ( !$('#event_owner').is(':disabled') );
					}
				}
			},
			event_owner_email: {
				required: {
					depends: function( element ) {
						return ( !$('#event_owner').is(':disabled') );
					}
				},
				email: true
			},
			event_owner_phone: {
				required: {
					depends: function( element ) {
						return ( !$('#event_owner').is(':disabled') );
					}
				}
			},
			event_contact_name: {
				required: {
					depends: function( element ) {
						return ( !$('#event_contact').is(':disabled') );
					}
				}
			},
			event_contact_email: {
				required: {
					depends: function( element ) {
						return ( !$('#event_contact').is(':disabled') );
					}
				},
				email: true
			},
			event_contact_phone: {
				required: {
					depends: function( element ) {
						return ( !$('#event_contact').is(':disabled') );
					}
				}
			},
			event_partner_name: {
				required: '#event_partner_option_yes:checked'
			}

		},
		messages: {
			event_title: "Informe o título de seu evento.",
			event_description: "Informe a descrição de seu evento.",
			event_start_date: "Informe a data inicial de seu evento.",
			event_venue: "Informe o local do evento.",
			event_address: "Informe o endereço do local do evento.",
			event_ticket_price: "Informe o valor da inscrição.",
			event_proponent_option: "Você deve selecionar um tipo de proponente.",
			event_proponent_name: "Informe o nome do proponente.",
			event_proponent_email: "Informe um endereço de e-mail válido.",
			event_proponent_phone: "Informe o telefone do proponente.",
			event_owner_name: "Informe o nome do responsável.",
			event_owner_email: "Informe um endereço de e-mail válido.",
			event_owner_phone: "Informe o telefone do responsável.",
			event_contact_name: "Informe o nome do contato.",
			event_contact_email: "Informe um endereço de e-mail válido.",
			event_contact_phone: "Informe o telefone do contato.",
			event_partner_name: "Informe o(s) nome(s) do(s) parceiro(s)."
		},
		invalidHandler: function(event, validator) {
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

	// Adiciona um verificador de moeda no formato brasileiro. Ex.: 10,00
	jQuery.validator.addMethod("numberAlt", function(value, element) {
		return this.optional(element) || /^(\R\$)?( )?-?(?:\d+|\d{1,3}(?:\.\d{3})+)?(?:,\d+)?$/.test(value);
	}, "Por favor, digite um valor numérico válido.");

	// Compara duas datas
	jQuery.validator.addMethod("compareDate", function(value, element, param) {

		var sd = $(param).val();
		var ed = value;

		return sfpCompareDate( sd, ed );

		// Montar script para comparar start_date e end_date
		// Referencia: http://stackoverflow.com/questions/492994/compare-dates-with-javascript
	}, "A data final deve ser maior ou igual que a data inicial.");


});

function sfpCompareDate( start, end ) {

	var sd = start.split('/');
	var ed = end.split('/');

	var s_date = new Date( sd[2], sd[1], sd[0] );
	var e_date = new Date( ed[2], ed[1], ed[0] );

	if( s_date.getTime() > e_date.getTime() )
		return false;
	if( s_date.getTime() <= e_date.getTime() )
		return true;

}

// Get Current Element Selected Index
function getElementIndex ( el ) {
    return el.index( el.filter(':checked') );
}

// Formatos: (99) 9999-9999 / (99) 99999-9999
function phoneMask( field ) {

    field.mask('(99) 9999-9999?9').ready( function(event) {
        var target, phone, element;
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
        if( target ) {
            phone = target.value.replace(/\D/g, '');
            element = $(target);
            element.unmask();
            if(phone.length > 10) {
                element.mask("(99) 99999-999?9");
            } else {
                element.mask("(99) 9999-9999?9");
            }
        }
    } );

    field.focusout(function(){
        var phone, element;
        element = $(this);
        element.unmask();
        phone = element.val().replace(/\D/g, '');
        if(phone.length > 10) {
            element.mask("(99) 99999-999?9");
        } else {
            element.mask("(99) 9999-9999?9");
        }
    }).trigger('focusout');

}