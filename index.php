<?php 

/* Template name: Home */

get_header();

?>

<div id="content">

    <div id="listagem-posts">

        <?php

        $months = array(
            'Jan', 'Fev', 'Mar', 'Abr',
            'Mai', 'Jun', 'Jul', 'Ago',
            'Set', 'Out', 'Nov', 'Dez'
        );

        $page = ( get_query_var('page') ) ? get_query_var('page') : 1;

        if ((isset($_POST["oque"]) || isset($_POST["quando"]) || isset($_POST["cidade"])) && ($_POST["oque"] != "" || isset($_POST["quando"]) || $_POST["cidade"] != "")) {

            $args = array(
                "post_type" => "programacao",
                "showposts" => 5000,
                "posts_per_page" => 5000,
                "category_name" => "programacao",
                "meta_key" => "wpcf-event-start-date",
                "order" => "asc",
                "orderby" => "meta_value meta_value_num"
            );

            $args['meta_query'] = array( 
                'relation' => 'AND'
            );

            if (isset($_POST["oque"]) && $_POST["oque"] != "") {
                unset($args["category_name"]);
                if ( (int)$_POST["oque"] > 0)
                    $args["cat"] = $_POST["oque"];
                else
                    $args["category_name"] = "programacao";
            }

            if (isset($_POST["quando"]) && $_POST["quando"] != "") {

                $arr_quando = array(
                    'key' => 'wpcf-event-start-date',
                    'value' => array(
                        strtotime( $_POST["quando"] . '-08-' . date('Y') . ' 00:00' ),
                        strtotime( $_POST["quando"] . '-08-' . date('Y') . ' 23:59' )
                    ),
                    'compare' => 'BETWEEN',
                );

                array_push( $args['meta_query'], $arr_quando);

            }

            if (isset($_POST["cidade"]) && $_POST["cidade"] != "") {

                $arr_cidade = array(
                    'key' => 'wpcf-cidade',
                    'value' => $_POST["cidade"],
                );

                array_push( $args['meta_query'], $arr_cidade);

            }

        } else {

            $args = array(
                "post_type" => "programacao",
                "category_name" => "programacao",
                "year" => date('Y'), // get posts from current year,
                "meta_key" => "wpcf-event-start-date",
                "order" => "asc",
                "orderby" => "meta_value meta_value_num",
                // "posts_per_page" => 10,
                "paged" => $page
            );

        }

        $temp = $wp_query;
        $wp_query = null;
        $wp_query = new WP_Query( $args );

        $cont = 0;
        if( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();

            $start_date = do_shortcode( "[types field='event-start-date']" );
            $start_time = do_shortcode( "[types field='event-start-date' format='H:i']" );

            $end_date = do_shortcode( "[types field='event-start-date']" );
            $end_time = do_shortcode( "[types field='event-end-date' format='H:i']" );
            
            $event_time = ( isset( $end_time ) && ( $start_time === $end_time ) ) ? $start_time : $start_time . ' às ' . $end_time;

            if( isset( $start_date ) && !empty( $start_date ) )
                list( $day, $month, $year ) = explode( '/', $start_date );

            if( isset( $start_time ) && !empty( $start_time ) )
                list( $hour, $minute ) = explode( ':', $start_time );

            $event_city = do_shortcode( "[types field='cidade']" );
            $event_venue = do_shortcode( "[types field='event-venue']" );
            $event_address = do_shortcode("[types field='event-address']");
        
        ?>
                <div class="post<?php if( $cont === 0 ) echo " first"; ?>">

                    <div class="data">
                        <span class="dia"><?php echo $day; ?></span>
                        <span class="mes"><?php echo $months[ (int)$month - 1 ]; ?></span>
                    </div>


                    <div class="local-titulo">
                        <div class="cidade"><?php echo $event_city; ?></div>
                        <div class="horario"><?php echo $event_time; ?></div>
                        <h2><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h2>
                        <div class="local"><?php echo $event_venue . ' - ' . $event_address; ?></div>
                        <p><a href="<?php the_permalink(); ?>" title="<?php echo excerpt(20); ?>"><?php echo excerpt(20); ?></a></p>
                    </div>

                </div>

                <?php
                $cont++;
            endwhile;

            wp_corenavi();
            $wp_query = null;
            $wp_query = $temp; // reset

            ?>
        <?php else : ?>
            <div class="post">
                <h2>A programação da Semana Fluminense 2015 será divulgada em breve.</h2>
            </div>
        <?php endif; ?>

    </div>

    <?php get_sidebar(); ?>

</div>


<?php get_footer(); ?>
