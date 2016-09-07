<?php get_header("internas"); ?>

<div id="content" class="programacao">

    <div class="titulo-categoria">
        <h2><?php post_type_archive_title(); ?></h2>
    </div>

    <div id="listagem-posts">

        <?php
            
            $args = array(
                "post_type" => "programacao",
                "year" => date('Y'), // get posts from current year
                "orderby" => "meta_value",
                "meta_key" => "wpcf-event-start-date",
                "order" => "asc",
                'meta_query' => array(
                    array(
                        'key' => 'wpcf-event-start-date'
                    )
                )
            );

            $months = array(
                'Jan', 'Fev', 'Mar', 'Abr',
                'Mai', 'Jun', 'Jul', 'Ago',
                'Set', 'Out', 'Nov', 'Dez'
            );

        ?>

        <?php wp_reset_query(); $posts = query_posts( $args ); ?>
        <?php if ( have_posts() ) : $cont = 0; ?>

            <?php 
                while ( have_posts() ) : 

                    the_post();

                    $start_date = do_shortcode( "[types field='event-start-date']" );
                    $start_time = do_shortcode( "[types field='event-start-date' format='H:i']" );

                    $end_date = do_shortcode( "[types field='event-start-date']" );
                    $end_time = do_shortcode( "[types field='event-end-date' format='H:i']" );
                    
                    $event_time = ( isset( $end_time ) && ( $start_time === $end_time ) ) ? $start_time : $start_time . ' às ' . $end_time;

                    list( $day, $month, $year ) = explode( '/', $start_date );
                    list( $hour, $minute ) = explode( ':', $start_time );

                    $event_city = do_shortcode( "[types field='cidade']" );
                    $event_venue = do_shortcode( "[types field='event-venue']" );

            ?>

                <div class="post<?php echo $cont === 0 ? " first" : ""; ?>">

                    <div class="data">
                        <span class="dia"><?php echo $day; ?></span> 
                        <span class="mes"><?php echo $months[ (int)$month - 1 ]; ?></span>
                    </div>

                    <!-- <div class="desc-img">
                        <?php if( has_post_thumbnail( $posts[ $cont ]->ID ) ) : ?>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'listagem', array( 'title' => get_the_title() ) ); ?></a>
                        <?php else : ?>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                            <img src="<?php bloginfo("template_url"); ?>/imagens/iii_semana_do_patrimonio.jpg" class="attachment-listagem wp-post-image" alt="Logotipo da III Semana do Patrimônio" title="<?php the_title(); ?>" height="120" width="160" />
                        </a>
                        <?php endif; ?>
                    </div> -->

                    <div class="local-titulo">    
                        <div class="cidade"><?php echo $event_city; ?></div>
                        <div class="horario"><?php echo $event_time; ?></div>
                        <h2><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h2>
                        <div class="local"><?php echo $event_venue; ?></div>                        
                        <p><a href="<?php the_permalink(); ?>" title="<?php echo excerpt(20); ?>"><?php echo excerpt(20); ?></a></p>
                    </div>

                </div>

                <?php
                $cont++;
            endwhile;
            ?>

            <?php wp_corenavi(); ?>

        <?php else : ?>

            <h2>Não há eventos cadastrados no momento.</h2>

        <?php endif; ?>

    </div>

<?php get_sidebar(); ?>

</div>


<?php get_footer(); ?>
