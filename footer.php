</div>

<div id="footer">

    <div class="content-footer-menu">

        <div class="content-f">
            <div class="cols col1">
                <?php wp_nav_menu(array('before' => '', 'after' => '', 'container' => 'false','menu' => 'menu-rodape-col1', 'items_wrap' => '<ul id="footer-menu">%3$s</ul>')); ?>
            </div>

            <div class="cols col2">
                <?php wp_nav_menu(array('before' => '', 'after' => '', 'container' => 'false','menu' => 'menu-rodape-col2', 'items_wrap' => '<ul id="footer-menu">%3$s</ul>')); ?>           
            </div>

            <div class="cols col3">
                <?php wp_nav_menu(array('before' => '', 'after' => '', 'container' => 'false','menu' => 'menu-rodape-col3', 'items_wrap' => '<ul id="footer-menu">%3$s</ul>')); ?>                  
            </div>   


        </div>

    </div>

    <div class="content-footer-copyright">

        <div class="content-f">

            <img src="<?php bloginfo("template_url"); ?>/imagens/site/logos-parceiros.png" alt="Parceiros">           

            <p class="semana">Semana Fluminense do Patrim&ocirc;nio &copy; <?php echo Date('Y'); ?> - Todos os direitos reservados  |  <a href="#" title="Pol&iacute;tica de Privacidade">Pol&iacute;tica de Privacidade</a></p>


        </div>

    </div>

</div>


<?php wp_footer(); ?>

        <link media="screen" rel="stylesheet" href="<?php bloginfo("template_url"); ?>/css/colorbox.css" />
        <script src="<?php bloginfo("template_url"); ?>/js/jquery.colorbox-min.js"></script>

        <?php if( is_archive('fotografias') || is_page('resultado-fotografias') ) : ?>
        <script>
            $(document).ready(function(){
                $(".group1").colorbox({rel:'group1'});
                $("#click").click(function(){
                    $('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
                    return false;
                });
            });
        </script>
        <?php endif; ?>

        <?php //if( !is_page('patrimonio-cultural') ) : ?>
        <script src="<?php bloginfo("template_url"); ?>/js/jquery.bxslider.min.js" type="text/javascript"></script>
        <?php //endif; ?>

        <?php 
            global $post;
            $post_type_url = get_post_type_archive_link( $post->post_type );
            
            // if( is_front_page() || is_home() || is_page('programacao') || is_archive('patrimonio-cultural') || is_page('resultado-fotografias') || is_page('resultado-poesias') || ( $post->post_type == 'fotografias' ) || ( $post->post_type == 'poesias' ) || ( $post->post_type == 'programacao' ) ||  is_page('cadastre-seu-evento') ) : 
        ?>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <script type="text/javascript" src="<?php bloginfo("template_url"); ?>/js/gmap.js"></script>

        <script type="text/javascript">
            $(document).ready(function(){
                
                $(".flickr_badge_image a").attr("target","_blank");

                $(".select-filtro").change(function(){
                    this.form.submit();
                });

            });

        </script>

		<?php get_template_part( 'includes/mapa', 'eventos' ); ?>
		<?php get_template_part( 'includes/mapa', 'patrimonio' ); ?>

        <?php // endif; ?>

        <?php if( is_page('ficha-de-inscricao') ) : ?>
        <script type="text/javascript" src="<?php bloginfo("template_url"); ?>/js/jquery.maskedinput.min.js"></script>
        <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
        <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.min.js"></script>
        <script type="text/javascript" src="<?php bloginfo("template_url"); ?>/js/form_inscricao_seminario.js"></script>
        <?php endif; ?>

        <?php if( is_page( 'cadastre-seu-evento' ) || is_page('inscricao-de-seminario') ) : ?>
        <script type="text/javascript" src="<?php bloginfo("template_url"); ?>/js/jquery-ui-1.10.3.custom.min.js"></script>
        <script type="text/javascript" src="<?php bloginfo("template_url"); ?>/js/custom.js"></script>
        <script type="text/javascript" src="<?php bloginfo("template_url"); ?>/js/jquery.maskedinput.min.js"></script>
        
        <?php if( !is_page('inscricao-de-seminario') ) : ?>
        <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
        <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.min.js"></script>
        <script type="text/javascript">
            (function() {

                <?php

                    $cat_programacao = get_category_by_slug("programacao");
                    $categorias = get_categories("child_of=" . $cat_programacao->term_id . '&hide_empty=0');
                    $html = '';
                    foreach( $categorias as $categoria ) {
                        $html .= '<option value="' . $categoria->term_id . '">' . $categoria->name . '</option>';
                    }

                ?>

                $('#event_category').append( '<?php echo $html; ?>' );

                var months = [
                    'Janeiro', 'Fevereiro', 'Março', 'Abril',
                    'Março', 'Junho', 'Julho', 'Agosto',
                    'Setembro', 'Outubro', 'Novembro', 'Dezembro'
                ];

                var dayNames = [
                    'Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'
                ];

                $.datepicker.setDefaults({
                    dateFormat: 'dd/mm/yy', // Data que será exibida para o usuário (dd/mm/yyyy)
                    dayNamesMin: dayNames,
                    hideIfNoPrevNext: true,
                    minDate: new Date( <?php echo date('Y'); ?>, 7, 1 ), // Month index starts with zero so '7' means August.
                    maxDate: new Date( <?php echo date('Y'); ?>, 8, 30 ), // Month index starts with zero so '8' means September.
                    monthNames: months
                });

                var startDate = $('#event_start_date');
                var endDate = $('#event_end_date');

                // Ativa o Datepicker
                startDate.datepicker({
                    onClose: function( d, o ) {

                        //var startDateValue = startDate.datepicker('getDate');
                        //var endDateValue = endDate.datepicker('getDate');

                    }
                });

                // Ativa o Datepicker
                endDate.datepicker({
                    onClose: function( d, o ) {

                        //var startDateValue = startDate.datepicker('getDate');
                        //var endDateValue = endDate.datepicker('getDate');

                    }
                });

            })();

            // Validação do Formulário
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
                        bairro: "required",
                        event_ticket_price: {
                            required: '#event_ticket_option_no:checked',
                            numberAlt: true
                        },
                        event_photo: {
                            accept: 'image/*'
                        },
                        event_category: {
                            isNotDefault: '0'
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
                        bairro: "Informe o bairro.",
                        event_ticket_price: "Informe o valor da inscrição.",
                        event_photo: "O arquivo deve ser no formato JPG, GIF ou PNG, com no máximo 2 megabytes.",
                        event_category: { isNotDefault: "Por favor, selecione uma categoria." },
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

                // Verifica se o valor do item do select é diferente do padrão
                jQuery.validator.addMethod('isNotDefault', function( value, element, param ) {
                    return param != value;
                }, 'Por favor, selecione um item.');


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
        </script>
        <?php
                endif; // if( !is_page('inscricao-de-seminario') )
            endif; // if( is_page( 'cadastre-seu-evento' ) )
        ?>
        
        <!-- BX SLider Home -->
        <script type="text/javascript">
        $(document).ready(function(){
            $('.js-top-menu-slider').bxSlider({
                auto: true,
                captions: true,
                controls: false,
                mode: 'horizontal',
                pager: true

            });

            $('.js-noticia-slider').bxSlider({
                auto: true,
                captions: false,
                controls: true,
                mode: 'horizontal',
                pager: false
            });

            $('.js-video-slider').bxSlider({
                auto: true,
                captions: false,
                controls: true,
                mode: 'horizontal',
                pager: false
            });

            // Noticias Slider
            if( $('#slider-noticias') ) {
                $('#slider-noticias').bxSlider({
                    auto: true,
                    autoStart: true,
                    control: true,
                    pager: false,
                    pause: 4000
                });
            }

            // Mapa single patrimonio
            if($('.js-single-mapa-patrimonio').length == 1) {
            	
            	// $('.js-single-mapa-patrimonio').gMap(mapJson);

            	$('.js-single-mapa-patrimonio').gMap({ 
            		zoom: 14,
            		markers : [
	            		{ 
	            			latitude: $('.js-single-mapa-patrimonio').attr('lat'),
	            			longitude: $('.js-single-mapa-patrimonio').attr('lng')
	            		}
            		]
            	});
            }

        });
        </script>

        <script type="text/javascript">

             var _gaq = _gaq || [];
             _gaq.push(['_setAccount', 'UA-33720300-1']);
             _gaq.push(['_trackPageview']);

             (function() {
                   var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                   ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
             })();

        </script>

        <script src="<?php bloginfo("template_url"); ?>/js/textresizer.js"></script>
		
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-63460768-1', 'auto');
		  ga('send', 'pageview');

		</script>		

</body>

</html>