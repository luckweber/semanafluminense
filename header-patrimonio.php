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
                single_tag_title("Tag Archive for &quot;");
                echo '&quot; - ';
            } elseif (is_archive()) {
                wp_title('');
                echo ' Archive - ';
            } elseif (is_search()) {
                echo 'Search for &quot;' . wp_specialchars($s) . '&quot; - ';
            } elseif (!(is_404()) && (is_single()) || (is_page())) {
                wp_title('');
                echo ' - ';
            } elseif (is_404()) {
                echo 'Not Found - ';
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
        <link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400,200,300,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/jquery.bxslider.css" type="text/css" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <script type='text/javascript' src='http://code.jquery.com/jquery-latest.js?ver=3.5.1'></script>
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




        <!-- Filtros -->

        <?php

        $categoria = get_category_by_slug("patrimonio-cultural");
        $categoriasoque = get_categories("child_of=" . $categoria->term_id);

        $optionsoque = "";
        foreach ($categoriasoque as $categoria) {

            $selected_oque = '';
            if ( isset( $_POST["oque"] ) && $categoria->term_id == $_POST["oque"] ) {
                $selected_oque = 'selected';
            }

            if( $categoria->slug != "destaques" )
                $optionsoque .= "<option value='" . $categoria->term_id . "' " . $selected_oque . ">" . $categoria->name . "</option>";
        }

        $cidades = new WP_Query("post_type=patrimonio-cultural&orderby=title&order=asc&nopaging=true&child_of=" . $categoria->term_id);
        $city = array();
        while ($cidades->have_posts()) {
            $cidades->the_post();
            $str_cidade = ucwords( strtolower( do_shortcode( "[types field='cidade']" ) ) );
            if ( !in_array( $str_cidade , $city ) ) {
                $city[ $str_cidade ] = $str_cidade;
            }
        }
        asort( $city );

        $optionc = "";
        foreach ($city as $cidade) {

            $selected_cidade = '';
            if( isset( $_POST["cidade"] ) && $_POST['cidade'] == $cidade )
                $selected_cidade = 'selected';

            $optionc .= "<option value='" . $cidade . "' ". $selected_cidade .">" . $cidade . "</option>";
        }

        ?>


    </head>

    <body <?php body_class('patrimonio-cultural'); ?>>

        <?php
        /** Plotagem do mapa * */
        $cont = 1;
        $markers = array();
        $address = "Rio de Janeiro, Brazil";
        $zoom = 8;
        $args = array(
            "post_type" => "patrimonio-cultural"
        );
        if (isset($_POST["oque"]) && $_POST["oque"] != "") {
            $args["cat"] = $_POST["oque"];
        }

        if (isset($_POST["cidade"]) && $_POST["cidade"] != "") {
            $args["meta_query"] = array(
                array(
                    'key' => 'wpcf-cidade',
                    'value' => $_POST["cidade"],
                )
            );
        }
        wp_reset_query();
        $my_posts = new WP_Query();
        $my_posts->query($args);
        while ($my_posts->have_posts()) {
            $my_posts->the_post();

            $latitude = do_shortcode("[types field='latitude']");
            $longitude = do_shortcode("[types field='longitude']");

            $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'listagem');
            $url = $thumb['0'];


            $html = "<img class='img-mapa' src='" . $url . "' /><p><span class='map-dia'>" . do_shortcode("[types field='dia']") . " " . do_shortcode("[types field='mes']") . "</span> <span class='maps-horario'>" . do_shortcode("[types field='horario']") . "</span></p><p><a href='" . get_permalink() . "'>" . get_the_title() . "</a></p><p class='desc-map'>" . do_shortcode("[types field='local']") . ", " . do_shortcode("[types field='cidade']") . "</p>";


            $markers[] = array("latitude" => $latitude, "longitude" => $longitude, "html" => $html);
        }

        $mapa = array("address" => $address, "zoom" => $zoom, "markers" => $markers, "scrollwheel" => true);

        $json_encoded = json_encode($mapa);
        
        ?>

        <script type="text/javascript">
            $(function(){
                $('#map_canvas').gMap(<?php echo $json_encoded; ?>);
            });
        </script>


        <div id="site">

            <div id="header">

                <div class="top">
                    <?php include "includes/slider.php";?>
                </div>

                <?php get_template_part('menu'); ?>

            </div>

            <div id="filtrar">

                <form action="" id="form-select-filtro" method="post">

                    <fieldset>

                        <legend>Busque por:</legend>

                        <div class="select">
                            <label><span>O qu&ecirc;</span>
                                <select id="oque" name="oque" class="select-filtro">
                                    <option value="">Bem cultural</option>
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
					<div class="item_sobre">
					<?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'menu' => 'Principal', 'sub_menu' => true ) ); ?>
					<a href="/sobre-o-patrimonio">Sobre o Patrimônio</a>
					</div>
					
					<div class="item_box_patrimonio">
					<?php get_template_part( 'includes/box', 'pin-patrimonio' ); ?>
					</div>
					
                    </fieldset>
					
					
                </form>

            </div>

            <div id="fb-root"></div>
            <script type="text/javascript">(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1&appId=251749364861942";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
