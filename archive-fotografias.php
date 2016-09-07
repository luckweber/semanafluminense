<?php get_header("concursofotos"); ?>

<div id="content">

    <?php get_template_part('acessibilidade'); ?>

    <?php

    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

    $categorias = array();
    if ( isset( $_GET["cat"] ) && $_GET["cat"] != "")
        $categorias[] = $_GET["cat"];

    if ( isset( $_GET["tema"] ) && $_GET["tema"] != "" )
        $categorias[] = $_GET["tema"];

    $args = array(
        'post_type' => 'fotografias',
        'posts_per_page' => 12,
        'paged' => $paged,
    );

    if( count( $categorias ) > 0 ) {
        $args['category__and'] = $categorias;
        wp_reset_query();
    }

    query_posts( $args );

    $photo_total_votes = get_total_votes('fotografias');

    ?>

    <div id="listagem-votacao">



        <?php if ( have_posts() ) : ?>
            <?php
            $cont = 1;
            $foto_votes = 0;
            while ( have_posts() ) : the_post();
                $autor = do_shortcode("[types field='concurso-foto-autor']");
				$local = do_shortcode("[types field='concurso-foto-local']");
                $photo_votes = (int)get_post_meta( get_the_ID(), 'votes', true );
                //$photo_votes_percent = round( $photo_votes / $photo_total_votes * 100 ) . '% dos votos';
        ?>




                <div class="foto<?php echo $cont % 3 ? "" : " second"; ?>">

                    <div class="voto">
                        <?php
                        $post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
                        $thumb = ( $post_thumbnail_id != '' ) ? wp_get_attachment_image_src( $post_thumbnail_id, 'concurso-fotografia-maior') : '';
                        $url = ( $thumb == true ) ? $thumb['0'] : '';
                        ?>
                        <a href="<?php echo $url; ?>" title="<?php the_title(); ?>" class="group1 photo-overlay">
                            <?php the_post_thumbnail('concurso-fotografia-thumb'); ?>
                            <p class="photo-votes">
								<span><?php echo $photo_votes; ?></span>
							</p>
                        </a>
                    </div>

                    <div class="desc-autor autor-f">
			
			<!-- Botão de Votar -->
			<?php //echo do_shortcode('[rate]'); ?>

                        <small>T&iacute;tulo</small>
                        <p><?php the_title(); ?></p>

                        <small>Autor</small>
                        <p><?php ///echo $autor; ?></p>

                        <small>Local</small>
                        <p><?php echo $local; ?></p>						
                    </div>

                </div>

                <?php
                $cont++;
            endwhile;

            wp_corenavi();

            ?>

        <?php else : ?>

            <h2>N&atilde;o foram enviadas fotografias para esta categoria</h2>

        <?php endif; ?>

            

    </div>

</div>


<?php get_footer(); ?>