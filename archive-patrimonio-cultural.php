<?php
/* Template name: Arquive Patrimonio Cultural - home */
get_header("patrimonio");
?>

<div id="content" class="lista">

	<?php get_template_part('acessibilidade'); ?>
	
    <?php
    if ((isset($_POST["oque"]) || isset($_POST["cidade"])) && ($_POST["oque"] != "" || $_POST["cidade"] != "")) {
        wp_reset_query();

        $args = array(
            "post_type" => "patrimonio-cultural",
            "nopaging" => true
        );


        if (isset($_POST["oque"]) && $_POST["oque"] != "") {
            $args["cat"] = $_POST["oque"];
        }

        if (isset($_POST["cidade"]) && $_POST["cidade"] != "") {
            $args["meta_query"] = array(
                array(
                    'key' => 'wpcf-cidade',
                    'value' => $_POST["cidade"],
                )
            );
        }

        query_posts($args);
    }
    ?>

    <div id="listagem-posts">

    <?php if (have_posts()) : ?>

            <?php while (have_posts()) : the_post(); ?>

                <div class="noticia">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('listagem', array('title' => get_the_title())); ?></a>
                    <?php echo do_shortcode("[types field='endereco']"); ?>

                    <?php if (!(in_category("instituicoes-participantes"))) { ?>
                    <?php } elseif (!(in_category("patrimonio-cultural"))) { ?>
                    <?php } else { ?>
                        <small><?php the_time("d"); ?> de <?php the_time("F"); ?> de <?php the_time("Y"); ?></small>
                    <?php } ?>


                    <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                    <?php if (!(in_category("instituicoes-participantes"))) : ?>
                        <?php if (!(in_category("videos"))) : ?>
                        <p><a href="<?php the_permalink(); ?>" title="<?php echo excerpt(35); ?>"><?php echo excerpt(35); ?></a></p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

            <?php endwhile; ?>

            <?php wp_corenavi(); ?>

    <?php else : ?>
            <div class="noticia">
                <h2>Nada encontrado</h2>
            </div>
    <?php endif; ?>

    </div>

    <?php get_sidebar('patrimonio-cultural'); ?>

</div>
<?php get_footer(); ?>
