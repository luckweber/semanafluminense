<?php 
	// $cat_programacao 	= get_category_by_slug( 'programacao' );
	// $cat_destaque 		= get_category_by_slug( 'destaques' );
	
	$query_conditions = array( 
		'post_type'=>  'banner_slider',
		// 'category__and' => array($cat_destaque->term_id, $cat_destaque->term_id),
		'meta_query' => array(
			array( 'key' => '_thumbnail_id')
		),
		'nopaging' => true
	);
	$the_query_slider = new WP_Query($query_conditions);

?>

<div class="top-content">
	<div class="slider">
		<?php 	if ( $the_query_slider->have_posts() ): ?>
					<ul class="js-top-menu-slider bxslider">
		<?php 		while ( $the_query_slider->have_posts() ):?>
		<?php 			$the_query_slider->the_post(); ?>
						<li>
							<!--<a href="<?php //echo get_permalink();?>" title="<?php //the_title();?>">-->
							<?php the_post_thumbnail( 'header-destaques', array('title' => get_the_title() ) ); ?>	
							<!--</a>-->
						</li>
		<?php 		endwhile; ?>
					</ul>

		<?php 	else : ?>
					<img src="<?php bloginfo('template_url'); ?>/images/imagem-topo-slider.jpg" >
		<?php 	endif; 
				/* Restore original Post Data */
				wp_reset_postdata();
		?>
	</div>
	<div class="logo">
		<a href="<?php echo get_site_url();?>">IV Semana Fluminense do Patrimônio </a>
	</div>
</div>