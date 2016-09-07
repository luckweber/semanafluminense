<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

    <head profile="http://gmpg.org/xfn/11">

        <?php
            $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'concurso-fotografia-thumb');
            $url = $thumb['0'];
        ?>
        <link rel="image_src" href="<?php echo $url; ?>" />

        <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

        <?php if (is_search()) { ?>
            <meta name="robots" content="noindex, nofollow" />
        <?php } ?>

        <title>
            <?php
            if (function_exists('is_tag') && is_tag()) {
                single_tag_title("Arquivos de tags &quot;");
                echo '&quot; - ';
            } elseif (is_archive()) {
                echo ' Arquivos - ';
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



    </head>

    <body class="votacao">


        <div id="site">

            <div id="header">

                <div class="top">
                    <?php include "includes/slider.php";?>
                </div>

                <?php get_template_part('menu'); ?>

            </div>

            <div class="concurso-votacao">
                
                <div class="desc1">
                    <h2>Concurso Cultural</h2>
                    <p class="first"><em>O Estado do Rio de Janeiro reúne importantes manifestações, cenários e objetos reconhecidos como patrimônio cultural. Promover a valorização desses acervos e despertar a população para a necessidade de preservá-los são os objetivos do concurso cultural “Olhares sobre o Patrimônio Fluminense”, uma das ações promovidas pela Semana Fluminense de Patrimônio.</em></p>
                    <p class="first"><em>O concurso tem, ainda, a proposta de revelar o patrimônio cultural eleito pela população fluminense e que não é necessariamente protegido por meio do ato de tombamento, ou de qualquer outra forma de registro ou proteção oficial, e para tanto, os trabalhos são julgados de duas formas distintas, revelando a diversidade da visão sobre o patrimônio cultural fluminense.</em></p>
                </div>

                <div class="desc2">     
                    <strong>Concurso Olhares sobre o Patrimônio Fluminense 2014</strong>
                    <p>Os temas da quarta edição do concurso cultural Olhares sobre o Patrimônio Fluminense, que contempla as modalidades fotografia e poesia e as categorias infanto-juvenil e adulto, dialogam com o tema geral da semana Fluminense – Patrimônio Cultural e Grandes Intervenções.</p>
                    <p>São eles: O Patrimônio da Costa Verde Fluminense; Fatos e feitos; e Memória Transformada.</p>
                    <!--<p>Para conhecer os vencedores deste ano, <a href="<?php bloginfo("url"); ?>/resultado-fotografias/">clique aqui</a>.</p>-->
                </div>

            </div>




            <div id="filtrar">
                

                <form action="" id="form-select-filtro">

                    <fieldset>
                        
                        <strong class="filtros">Filtros &raquo;</strong>

                        <legend>Busque por:</legend>

                        <div class="select select-fix-position">
                            <?php

                                $categorias     = get_term_by( 'slug', 'categorias', 'category' );
                                $categorias     = get_terms( 'category', 'hide_empty=0&child_of=' . $categorias->term_id );

                                $get_categoria = ( isset( $_GET['cat'] ) && $_GET['cat'] != '' ) ? $_GET['cat'] : '';
                            ?>
                            <label><span>Categorias</span>
                                <select name="cat" id="categoria" class="select-filtro">
                                    <option value="">Categorias</option>
                                        <?php 
                                            $selected = '';
                                            foreach ($categorias as $categoria) :
                                                $selected = ( $categoria->term_id == $get_categoria ) ? ' selected="selected"' : '';
                                        ?>
                                        <option value="<?php echo $categoria->term_id; ?>"<?php echo $selected; ?>><?php echo esc_html( $categoria->name ); ?></option>
                                        <?php
                                            endforeach;
                                        ?>
                                </select>
                            </label>
                        </div>

                        <div class="select select-fix-position">
                            <?php

                                $temas          = get_term_by( 'slug', 'temas', 'category' );
                                $temas          = get_terms( 'category', 'hide_empty=0&child_of=' . $temas->term_id );

                                $get_tema = ( isset( $_GET['tema'] ) && $_GET['tema'] != '' ) ? $_GET['tema'] : '';
                            ?>
                            <label><span>Tema</span>
                                <select id="tema" name="tema" class="select-filtro">
                                    <option value="">Temas</option>
                                        <?php 
                                            $selected = '';
                                            foreach ($temas as $tema) :
                                                $selected = ( $tema->term_id == $get_tema ) ? ' selected="selected"' : '';
                                        ?>
                                        <option value="<?php echo $tema->term_id; ?>"<?php echo $selected; ?>><?php echo esc_html( $tema->name ); ?></option>
                                        <?php
                                            endforeach;
                                        ?>
                                </select>
                            </label>
                        </div>


                    </fieldset>

                </form>



            </div>




            <div id="fb-root"></div>
            <script>
                (function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=251749364861942";
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
            </script>
