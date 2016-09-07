<?php get_header("patrimonio"); ?>

<div id="content" class="lista">

    <?php
    if ((isset($_GET["oque"]) || isset($_GET["cidade"])) && ($_GET["oque"] != "" || $_GET["cidade"] != "")) {
        wp_reset_query();
        /* $limit = 12; //number of posts to display
          $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; */

        $args = array(
            "post_type" => "patrimonio-cultural",
            "showposts" => 5000
        );


        if (isset($_GET["oque"]) && $_GET["oque"] != "") {
            $args["cat"] = $_GET["oque"];
        }

        if (isset($_GET["cidade"]) && $_GET["cidade"] != "") {
            $args["meta_query"] = array(
                array(
                    'key' => 'wpcf-cidade',
                    'value' => $_GET["cidade"],
                )
            );
        }
        
        //var_dump($args); exit;


        query_posts($args);
    }
    ?>

    <div class="titulo-categoria">
        <!-- <h2><?php //$category = get_the_category();  echo $category[0]->cat_name; ?></h2> -->
    </div>      



    <?php if (have_posts()) : ?>



        <div id="listagem-posts">

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
                    <?php if (!(in_category("instituicoes-participantes"))) { ?><?php if (!(in_category("videos"))) { ?><p><a href="<?php the_permalink(); ?>" title="<?php echo excerpt(35); ?>"><?php echo excerpt(35); ?></a></p><?php
            }
        }
        ?>
                </div>

            <?php endwhile; ?>

            <?php wp_corenavi(); ?>

<?php else : ?>

            <h2>Nada encontrado</h2>

<?php endif; ?>

    </div>



<?php get_sidebar(); ?>

</div>
<?php get_footer(); ?>
