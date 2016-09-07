<?php

/* Template name: Listagem de Poesias */

get_header("concursopoesia");

?>

<div id="content">

    <?php get_template_part('acessibilidade'); ?>

    <?php

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    if ((isset($_GET["cat"]) || isset($_GET["tema"])) && ($_GET["cat"] != "" || $_GET["tema"] != "")) {
        wp_reset_query();

        $categorias = array();
        if ( $_GET["cat"] != "")
            $categorias[] = $_GET["cat"];
        
        if ( $_GET["tema"] != "" )
            $categorias[] = $_GET["tema"];

        $args = array(
            "post_type" => "poesias",
            "category__and" => $categorias,
            "posts_per_page" => 12,
            "paged" => $paged,
        );

    } else {

        $args = array(
            "post_type" => "poesias",
            "posts_per_page" => 12,
            "paged" => $paged,
        );

    }

    query_posts( $args );

    $poetry_total_votes = get_total_votes('poesias');

    ?>

    <div id="listagem-votacao">



        <?php if (have_posts()) : ?>
            <?php
            $cont = 1;
            while (have_posts()) : the_post();
                $autor = do_shortcode("[types field='nome']");
                $poetry_votes = (int)get_post_meta( get_the_ID(), 'votes', true );
                $poetry_votes_percent = round( $poetry_votes / $poetry_total_votes * 100 ) . '% dos votos';
                ?>




                <div class="poesias<?php //echo $cont % 3 ? "" : " bordas"; ?>">

                    <div class="desc-autor">
                        <p class="poetry-title"><strong>Título:</strong> <?php the_title(); ?></p>
                        <p class="poetry-author"><strong>Autor:</strong><?php echo $autor; ?></p>
                        <p class="poetry-votes"><strong>Votos:</strong> <?php echo $poetry_votes_percent; ?></p>
                    </div>

                    <div class="poesia">

                        <?php the_content(); ?>
                        
						<!-- Botão de Votar -->
                        <div class="votar">
                            <?php //echo do_shortcode("[rate]"); ?>
                        </div>
                        
                    </div>

                </div>

                <?php
                $cont++;
            endwhile;
            ?>

            <?php wp_corenavi(); ?>

<?php else : ?>

            <h2>N&atilde;o foram enviadas poesias para esta categoria</h2>

<?php endif; ?>







    </div>


</div>


<?php get_footer(); ?>