<?php my_force_login(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

    <head profile="http://gmpg.org/xfn/11">

        <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

        <?php if (is_search()) { ?>
            <meta name="robots" content="noindex, nofollow" />
        <?php } ?>

        <title>
            <?php
            if (function_exists('is_tag') && is_tag()) {
                single_tag_title("Tags");
                echo '&quot; - ';
            } elseif (is_archive()) {
                wp_title('');
                echo ' - Arquivos - ';
            } elseif (is_search()) {
                echo 'Busca por &quot;' . wp_specialchars($s) . '&quot; - ';
            } elseif (!(is_404()) && (is_single()) || (is_page())) {
                wp_title('');
                echo ' - ';
            } elseif (is_404()) {
                echo 'Nada encontrado - ';
            }
            if (is_home()) {
                bloginfo('name');
                echo ' - ';
                bloginfo('description');
            } else {
                bloginfo('name');
            }
            if ($paged > 1) {
                echo ' - page ' . $paged;
            }
            ?>
        </title>
        <?php wp_head(); ?>
        <link rel="shortcut icon" href="<?php bloginfo("template_url"); ?>/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/jquery.bxslider.css" type="text/css" />
        <link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400,200,300,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <?php if (is_singular()) wp_enqueue_script('comment-reply'); ?>

        <?php if( is_page( 'cadastre-seu-evento' ) ) : ?>
        <link rel="stylesheet" href="<?php bloginfo("template_url"); ?>/css/humanity/jquery-ui-1.10.3.custom.min.css" type="text/css" />
        <?php endif; ?>
        
        <?php if( is_page('cadastre-seu-evento') ): ?>

            <!-- required plugins -->
            <script type="text/javascript" src="<?php bloginfo("template_url"); ?>/js/date.js"></script>

            <script type="text/javascript">
                //MASCARA PARA O TELEFONA
                var trava = false;
                var iCount1, iCount2, iCount, iTexto, nChar;
                function MaskDown(e) {
                    if(trava == false) {
                        iTexto = e.value;
                        iCount1 = e.value.length;
                        trava = true;
                    }
                }

                function MaskUp(e,evt,msc) {
                    iCount2 = e.value.length;
                    var key_code = evt.keyCode ? evt.keyCode : evt.charCode ? evt.charCode : evt.which ? evt.which : void 0;
                    if (key_code == 9) {
                        iCount1 = iCount2-1;
                        e.select;

                    } else {
                        if (iCount2 > iCount1) {
                            e.value = e.value.substr(0,iCount1+1);
                            if(e.value.length > msc.length) {
                                e.value = e.value.substr(0,msc.length);
                            }
                            if(iCount1 == 0) {
                                if (msc.substring(iCount1,iCount1+1) != "#") {
                                    nChar=1;
                                    while (msc.substring(iCount1+nChar,iCount1+nChar+1) != "#" && nChar <= msc.length) {
                                        nChar++;
                                    }
                                    e.value = msc.substring(0,iCount1+nChar) + e.value.substr(0,iCount1+1);
                                }
                            } else {
                                if (msc.substring(iCount1+1,iCount1+2) != "#") {
                                    var nChar=1;
                                    while (msc.substring(iCount1+nChar,iCount1+nChar+1) != "#" && nChar <= msc.length) {
                                        nChar++;
                                    }
                                    e.value = e.value.substr(0,iCount1+1) + msc.substring(iCount1+1,iCount1+nChar);
                                }
                            }
                        } else if (iCount2 == iCount1) {
                            e.value = e.value;
                        } else {
                            if (msc.substr(iCount2,1) != "#") {

                                nChar = 1;
                                while (msc.substr(iCount1-nChar,1) != "#" && nChar <= iCount1) {
                                    nChar++;
                                }
                                e.value = iTexto.substr(0,iCount2-nChar+1);
                            }

                        }
                        trava = false;
                    }}
            </script>

            <script>
                //MASCARA PARA O CAMPO DE HORAS
                function mascara_hora(hora_evento){
                    var myhora = '';
                    myhora = myhora + hora_evento;
                    if (myhora.length == 2){
                        myhora = myhora + ':';
                        document.forms[0].hora_evento.value = myhora;
                    }
                    if (myhora.length == 5){
                        verifica_hora();
                    }
                }
                //VALIDA A HORA CERTA
                function verifica_hora(){
                    hrs = (document.forms[0].hora.value.substring(0,2));
                    min = (document.forms[0].hora.value.substring(3,5));

                    alert('hrs '+ hrs);
                    alert('min '+ min);

                    situacao = "";
                    // verifica data e hora
                    if ((hrs < 00 ) || (hrs > 23) || ( min < 00) ||( min > 59)){
                        situacao = "falsa";
                    }

                    if (document.forms[0].hora.value == "") {
                        situacao = "falsa";
                    }

                    if (situacao == "falsa") {
                        alert("Hora inválida!");
                        document.forms[0].hora.focus();
                    }
                }

            </script>
			
            <script type="text/javascript">

                function addMsg(text,element_id) {

                    document.getElementById(element_id).value += text + '\n';

                }
            </script>


        <?php endif; ?>

        <!-- Filtros -->

        <?php

        if( $post->post_type == 'patrimonio-cultural' ) {

            $categoria = get_category_by_slug("patrimonio-cultural");
            $categoriasoque = get_categories("child_of=" . $categoria->term_id);

            $optionsoque = "";
            foreach ($categoriasoque as $categoria) {

                $selected_oque = '';
                if ( isset( $_GET["oque"] ) && $categoria->term_id == $_GET["oque"] ) {
                    $selected_oque = 'selected';
                }

                if( $categoria->slug != "destaques" )
                    $optionsoque .= "<option value='" . $categoria->term_id . "' " . $selected_oque . ">" . $categoria->name . "</option>";
            }

            $cidades = new WP_Query("post_type=patrimonio-cultural&orderby=title&order=asc&child_of=" . $categoria->term_id);
            $city = array();
            while ($cidades->have_posts()) {
                $cidades->the_post();
                if (!in_array(do_shortcode("[types field='cidade']"), $city)) {
                    $city[do_shortcode("[types field='cidade']")] = do_shortcode("[types field='cidade']");
                }
            }

            $optionc = "";
            foreach ($city as $cidade) {

                $selected_cidade = '';
                if( isset( $_GET["cidade"] ) && $_GET['cidade'] == $cidade )
                    $selected_cidade = 'selected';

                $optionc .= "<option value='" . $cidade . "' ". $selected_cidade .">" . $cidade . "</option>";
            }

        } // endif

        $body_class = array( 'interna' );
        if( $post->post_type != '' ) {
            $body_class[] = $post->post_type;
        }

        ?>

    

    </head>

    <body <?php body_class( $body_class ); ?>>

        <div id="site" class="fonte">

            <div id="header">

                <div class="top">
                    <?php include "includes/slider.php";?>
                </div>

                <?php get_template_part('menu'); ?>

            </div>

            <?php if( $post->post_type == 'patrimonio-cultural' ) : ?>
            <div id="filtrar">

                <form action="" id="form-select-filtro">

                    <fieldset>

                        <legend>Busque por:</legend>

                        <div class="select">
                            <label><span>O qu&ecirc;</span>
                                <select id="oque" name="oque" class="select-filtro">
                                    <option value="">O qu&ecirc;</option>
                                    <?php echo $optionsoque; ?>
                                </select>
                            </label>
                        </div>

                        <div class="select">
                            <label><span>Onde?</span>
                                <select id="cidade" name="cidade" class="select-filtro">
                                    <option value="">Onde</option>
                                    <?php echo $optionc; ?>
                                </select>
                            </label>
                        </div>

                    </fieldset>

                </form>

            </div>
            <?php endif; ?>

            <div id="fb-root"></div>
            <script type="text/javascript">(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1&appId=251749364861942";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>