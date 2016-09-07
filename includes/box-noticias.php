<?php


	
	$query_conditions = array( 
		'post_type'=>  'noticias',
		// 'category__and' => array($cat_destaque->term_id, $cat_destaque->term_id),
		'meta_query' => array(
			array( 'key' => '_thumbnail_id')
		),
		'posts_per_page' => 4
	);

	$the_query_slider = new WP_Query($query_conditions);
?>

<?php 	if ( $the_query_slider->have_posts() ): ?>
<div class="box slider-noticias slider">
    <h3>Notícias</h3>
    <div class="box-content">
        <ul class="js-noticia-slider">
            
            <?php while ( $the_query_slider->have_posts() ) : $the_query_slider->the_post(); ?>
            <li>

                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                    <?php the_post_thumbnail('slider-patrimonio', array('title' => get_the_title())); ?>
                </a>
                <div class="slider-label">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <?php the_title(); ?>
                    </a>
                </div>
            </li>
            <?php
            endwhile;
            wp_reset_query();
            ?>
        </ul>
    </div>
    <div class="mais-link">
        <a href="<?php bloginfo( 'url' );?>/noticias/">Ver todas as notícias</a>
    </div>
</div>

<?php 	endif; ?>