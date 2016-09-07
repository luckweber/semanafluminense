<?php

    if( in_category("patrimonio-cultural") ) :
        include(TEMPLATEPATH.'/archive-patrimonio.php');
    else:

?>

<?php get_header("internas"); ?>

<div id="content" class="lista">

    <?php get_template_part('acessibilidade'); ?>

        <div class="titulo-categoria">
            <h2><?php single_cat_title(); ?></h2>
        </div>

<?php if (have_posts()) : ?>

        <div id="listagem-posts">

    <?php while (have_posts()) : the_post(); ?>

                <div class="noticia">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('listagem', array('title' => get_the_title())); ?></a>
                    
                    
                    <?php if (!(in_category("patrimonio-cultural"))) : ?>
                        <small><?php the_time("d"); ?> de <?php the_time("F"); ?> de <?php the_time("Y"); ?></small>
                    <?php endif; ?>
                        
                        
                    <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                    <?php if(!(in_category("instituicoes-participantes"))) { ?><?php if(!(in_category("videos"))) { ?><p><a href="<?php the_permalink(); ?>" title="<?php echo excerpt(35); ?>"><?php echo excerpt(35); ?></a></p><?php } } ?>
                </div>

    <?php endwhile; ?>

<?php wp_corenavi(); ?>

<?php else : ?>

            <p><?php echo esc_html( 'Não há ' . strtolower( single_cat_title('', false) ) . ' publicadas no momento.' ); ?></p>

<?php endif; ?>

    </div>

    <?php get_sidebar(); ?>
    

    <?php get_footer(); ?>

<?php endif; ?>