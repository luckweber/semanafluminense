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
        <?php if (is_singular()) wp_enqueue_script('comment-reply'); ?>


        <!-- Filtros -->

        <?php
        $categoria = get_category_by_slug("programacao");
        $categoriasoque = get_categories("child_of=" . $categoria->term_id . '&hide_empty=0');

        $get_o_que = isset( $_POST['oque'] ) ? $_POST['oque'] : '';
        $get_onde = isset( $_POST['cidade'] ) ? $_POST['cidade'] : '';
        $get_quando = isset( $_POST['quando'] ) ? $_POST['quando'] : '';
        

        $optionsoque = '<option value="0">Todos os eventos</option>';
        foreach ($categoriasoque as $categoria) {

            $selected_oque = "";
            if ( $categoria->term_id == $get_o_que ) {
                $selected_oque = "selected";
            }

            if( $categoria->slug != "destaques" )
                $optionsoque .= "<option value='" . $categoria->term_id . "' " . $selected_oque . ">" . $categoria->name . "</option>";

        }
		
		
		
		

        $args = array(
            'post_type' => 'programacao',
            'category_name' => 'programacao',
            'orderby' => 'title',
            'order' => 'asc',
            'posts_per_page' => -1
        );

        $cidades = new WP_Query( $args );

        $city = array();
		
		
        while ($cidades->have_posts()) {
            $cidades->the_post();
            if (do_shortcode("[types field='cidade']") != '' && !in_array(do_shortcode("[types field='cidade']"), $city)) {
                $city[do_shortcode("[types field='cidade']")] = do_shortcode("[types field='cidade']");
            }
        }
		
		
		


        // Ordena as cidades alfabeticamente
        asort($city);
		array_unique($city);

        $optionc = "";
        foreach ($city as $cidade) {

            $selected_oque = "";
            if ($categoria->term_id == $get_o_que) {
                $selected_oque = "selected";
            }

            $selected_cidade = "";
            if ($cidade == $get_onde) {
                $selected_cidade = "selected";
            }
            $optionc .= "<option value='" . $cidade . "' " . $selected_cidade . ">" . $cidade . "</option>";

        }
		
		
		$year = date('Y');
		
		
		 $args2 = array(
            'post_type' => 'programacao',
            'category_name' => 'programacao',
            'orderby' => 'wpcf-event-start-date',
            'order' => 'desc',
			"meta_key" => "wpcf-event-start-date",
            'posts_per_page' => -1,
			'meta_query'=> array(
			  array(
				  'key' => 'wpcf-event-start-date',
				  'compare' => '<=', 
				  'value' => strtotime(($year-1).'-12-31'),
				  'type' => 'numeric'
			   )
			)
			
			
        );

        $cidades = new WP_Query( $args2 );

        $city = array();
		
		
        while ($cidades->have_posts()) {
            $cidades->the_post();
            if (do_shortcode("[types field='event-start-date' format='y-m-d']") != '' && !in_array(do_shortcode("[types field='event-start-date' format='y-m-d']"), $city)) {
                $city[do_shortcode("[types field='event-start-date' format='y-m-d']")] = do_shortcode("[types field='event-start-date' format='y-m-d']");
            }
        }
		
		
		


        // Ordena as cidades alfabeticamente
        asort($city);
		array_unique($city);

        $optionc2 = "";
        foreach ($city as $cidade) {

            $selected_oque = "";
            if ($categoria->term_id == $get_o_que) {
                $selected_oque = "selected";
            }

            $selected_cidade = "";
            if ($cidade == $get_onde) {
                $selected_cidade = "selected";
            }
            $optionc2 .= "<option value='" . $cidade . "' " . $selected_cidade . ">".date('d/m/Y', strtotime($cidade))."</option>";

        }
		
		
		
        ?>

		<style>
		
			h2 {
				font-size:14px;
				font-weight:bold;
				color:blue;
			}
		
		</style>
		
    </head>

    <body>


        <div id="site">

            <div id="header">

                <div class="top">
                    <?php include "includes/slider.php";?>
                </div>

                <?php get_template_part('menu'); 
				?>
				

            </div>

            <div id="filtrar">

                <form action="" id="form-select-filtro" method="post">

                    <fieldset>

                        <legend>Busque por:</legend>

                        <div class="select">
                            <label><span>O qu&ecirc;</span>
                                <select id="oque" name="oque" class="select-filtro">
                                    <option value="">Evento</option>
                                    <?php echo $optionsoque; ?>
                                </select>
                            </label>
                        </div>

                        <div class="select">
                            <label><span>Quando?</span>
                                <select id="quando" name="quando" class="select-filtro">
                                    <option value="">Quando</option>
									<?php echo $optionc2; ?>
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
						
					
					<div class="item_box_patrimonio">
					<?php get_template_part( 'includes/box', 'pin-evento' ); ?>
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
