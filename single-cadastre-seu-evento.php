<?php
/*
Template Name: Cadastre Seu Evento Novo
*/

get_header("internas");

the_post();

?>
<div id="content">

	<?php get_template_part('acessibilidade'); ?>

    <div id="post">

        <h2 class="titulo-formulario"><?php the_title(); ?></h2>

        <div class="entry">

            <?php the_content(); ?>

        </div>

    </div>

    <?php get_sidebar(); ?>



</div>


<?php get_footer(); ?>
