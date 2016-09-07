<?php

    get_header("internas");

    global $post;

?>

<div id="content">


    <?php include "acessibilidade.php"; ?>


    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>    


            <div id="post">

                    <h2 class="titulo-formulario"><?php the_title(); ?></h2>

                    <div class="entry" id="<?php echo $post->post_name ?>">

                        <?php the_content(); ?>      

                    </div>
                    


                <?php endwhile; ?>
            <?php else : ?>
                <h2>Nada encontrado</h2>
            <?php endif; ?>            





    </div>

    <?php get_sidebar(); ?>



</div>


<?php get_footer(); ?>
