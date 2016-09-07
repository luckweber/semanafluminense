<?php

/**
 * Template name: Single Event
 */

get_header('internas');

?>
	<div id="content">

	<?php get_template_part('acessibilidade'); ?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<div id="post" <?php post_class('single-event'); ?>>

			<h2 class="page-title"><?php the_title(); ?></h2>

			<div class="entry">
				<?php 
					the_content();
					$event_id = get_post_meta($post->ID, 'event_id', true);
				?>
             	<?php echo do_shortcode('[ESPRESSO_REG_FORM event_id="'.$event_id.'"]');?>
			</div><!-- .entry -->

		</div>

	<?php endwhile; // end of the loop. ?>
	
	<?php //get_sidebar(); ?>

	</div><!-- #content -->

<?php get_footer('internas'); ?>
