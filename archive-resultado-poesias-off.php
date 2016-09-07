<?php

/* 
 * Template name: Resultado Poesias Off 
 */

get_header("concursopoesia-resultado");
//get_header("internas");

?>

<div id="content">

    <?php get_template_part('acessibilidade'); ?>

    <?php

    global $post;

    $get_ano = '';
    if( isset( $_GET['ano'] ) && $_GET['ano'] != '' )
        $get_ano = $_GET['ano'];

    $get_tipo_voto = '';
    if( isset( $_GET['tipo_voto'] ) && $_GET['tipo_voto'] != '' )
        $get_tipo_voto = $_GET['tipo_voto'];

    $get_cat = '';
    if( isset( $_GET['cat'] ) && $_GET['cat'] != '' )
        $get_cat = $_GET['cat'];

    $get_tema = '';
    if( isset( $_GET['tema'] ) && $_GET['tema'] != '' )
        $get_tema = $_GET['tema'];

    // Categorias
    $cat_adulto = get_category_by_slug( 'adulto' );
    $cat_juvenil = get_category_by_slug( 'infanto-juvenil' );

    // Modalidades
    $cat_fragmentos = get_category_by_slug( 'fragmentos-de-memoria' );
    $cat_memoria = get_category_by_slug( 'memoria-preservada' );
    $cat_patrimonio = get_category_by_slug( 'o-patrimonio-da-regiao-serrana-do-rio-de-janeiro' );

    // Juri
    $cat_juri = get_category_by_slug( 'juri' );
    $cat_voto_popular = get_category_by_slug( 'voto-popular' );

    $array_place = array(
        '1' => '1º Lugar',
        '2' => '2º Lugar',
        '3' => '3º Lugar'
    );

    // Voto Juri

    $show_voto_juri = false;

    // Voto Juri
    if( $get_tipo_voto == '' || $get_tipo_voto == $cat_juri->term_id ) {

        // Categoria Adulto
        if( $get_cat == '' || $get_cat == $cat_adulto->term_id ) {

            // Tema Memoria
            if( $get_tema == '' || $get_tema == $cat_memoria->term_id ) {

                $args_juri_adulto_memoria = array(
                    'post_type' => 'poesias',
                    'category__and' => array( $cat_juri->term_id, $cat_adulto->term_id, $cat_memoria->term_id ),
                    'posts_per_page' => 3,
                    'meta_key' => 'wpcf-posicao',
                    'orderby' => 'meta_value_num',
                    'order' => 'ASC'
                );
                $query_juri_adulto_memoria = new WP_Query( $args_juri_adulto_memoria );

                if( $query_juri_adulto_memoria->have_posts() )
                    $show_voto_juri = true;

            } // Tema Memoria

            // Tema Fragmentos
            if( $get_tema == '' || $get_tema == $cat_fragmentos->term_id ) {

                $args_juri_adulto_fragmentos = array(
                    'post_type' => 'poesias',
                    'category__and' => array( $cat_juri->term_id, $cat_adulto->term_id, $cat_fragmentos->term_id ),
                    'posts_per_page' => 3,
                    'meta_key' => 'wpcf-posicao',
                    'orderby' => 'meta_value_num',
                    'order' => 'ASC'
                );
                $query_juri_adulto_fragmentos = new WP_Query( $args_juri_adulto_fragmentos );

                if( $query_juri_adulto_fragmentos->have_posts() )
                    $show_voto_juri = true;

            } // Tema Fragmentos

            // Tema Patrimonio
            if( $get_tema == '' || $get_tema == $cat_patrimonio->term_id ) {

                $args_juri_adulto_patrimonio = array(
                    'post_type' => 'poesias',
                    'category__and' => array( $cat_juri->term_id, $cat_adulto->term_id, $cat_patrimonio->term_id ),
                    'posts_per_page' => 3,
                    'meta_key' => 'wpcf-posicao',
                    'orderby' => 'meta_value_num',
                    'order' => 'ASC'
                );
                $query_juri_adulto_patrimonio = new WP_Query( $args_juri_adulto_patrimonio );

                if( $query_juri_adulto_patrimonio->have_posts() )
                    $show_voto_juri = true;

            } // Tema Patrimonio

        } // Categoria Adulto

    } // Voto Juri

    ?>

    <div id="listagem-votacao">

        <?php 
            if( $show_voto_juri == true ) {
        ?>

        <!-- Selecao do Juri -->

        <h1 class="category-title">Seleção do Juri</h1>

        <!-- Adulto + Fragmentos -->
        <?php
            if( isset( $query_juri_adulto_fragmentos ) && $query_juri_adulto_fragmentos->have_posts() ) {
        ?>

        <h1 class="category-title">
            Categoria: <span class="category-title-name"><?php echo $cat_adulto->name; ?></span><br />
            Tema: <span class="category-title-name"><?php echo $cat_fragmentos->name; ?></span>
        </h1>
        
        <?php
                $cont = 1;
                while( $query_juri_adulto_fragmentos->have_posts() ) {
                    $query_juri_adulto_fragmentos->the_post();
                    $autor = do_shortcode("[types field='nome']");

        ?>
                <div class="poesias">

                    <h1 class="poetry-place"><?php echo $array_place[ $cont ]; ?></h1>

                    <div class="desc-autor">
                        <p class="poetry-title"><strong>Título:</strong> <?php the_title(); ?></p>
                        <p class="poetry-author"><strong>Autor:</strong> <?php echo $autor; ?></p>
                    </div>

                    <div class="poesia poetry-content">
                        <?php the_content(); ?>
                    </div>

                </div>
                <?php
                    $cont++;
                }

                // restore original post
                wp_reset_postdata();
            }
        ?>
        <!-- /Adulto + Fragmentos -->

        <br style="clear: both;">

        <!-- Adulto + Memoria -->
        <?php
            if( isset( $query_juri_adulto_memoria ) && $query_juri_adulto_memoria->have_posts() ) {
        ?>

        <h1 class="category-title">
            Categoria: <span class="category-title-name"><?php echo $cat_adulto->name; ?></span><br />
            Tema: <span class="category-title-name"><?php echo $cat_memoria->name; ?></span>
        </h1>

        <?php
                $cont = 1;
                while( $query_juri_adulto_memoria->have_posts() ) {
                    $query_juri_adulto_memoria->the_post();
                    $autor = do_shortcode("[types field='nome']");

        ?>
                <div class="poesias">

                    <h1 class="poetry-place"><?php echo $array_place[ $cont ]; ?></h1>

                    <div class="desc-autor">
                        <p class="poetry-title"><strong>Título:</strong> <?php the_title(); ?></p>
                        <p class="poetry-author"><strong>Autor:</strong> <?php echo $autor; ?></p>
                    </div>

                    <div class="poesia poetry-content">
                        <?php the_content(); ?>
                    </div>

                </div>
                <?php
                    $cont++;
                }

                // restore original post
                wp_reset_postdata();
            }
        ?>
        <!-- /Adulto + Memoria -->

        <br style="clear: both;">

        <!-- Adulto + Patrimonio -->
        <?php
            if( isset( $query_juri_adulto_patrimonio ) && $query_juri_adulto_patrimonio->have_posts() ) {
        ?>

        <h1 class="category-title">
            Categoria: <span class="category-title-name"><?php echo $cat_adulto->name; ?></span><br />
            Tema: <span class="category-title-name"><?php echo $cat_patrimonio->name; ?></span>
        </h1>
        
        <?php
                $cont = 1;
                while( $query_juri_adulto_patrimonio->have_posts() ) {
                    $query_juri_adulto_patrimonio->the_post();
                    $autor = do_shortcode("[types field='nome']");

        ?>
                <div class="poesias">

                    <h1 class="poetry-place"><?php echo $array_place[ $cont ]; ?></h1>

                    <div class="desc-autor">
                        <p class="poetry-title"><strong>Título:</strong> <?php the_title(); ?></p>
                        <p class="poetry-author"><strong>Autor:</strong> <?php echo $autor; ?></p>
                    </div>

                    <div class="poesia poetry-content">
                        <?php the_content(); ?>
                    </div>

                </div>
                <?php
                    $cont++;
                }

                // restore original post
                wp_reset_postdata();
            }
        ?>
        <!-- /Adulto + Patrimonio -->

        <!-- /Selecao do Juri -->

        <br style="clear: both;">
        
        <?php } // if( $show_voto_juri == true ) ?>

        <?php

            $show_voto_popular = false;

            // Voto Popular
            if( $get_tipo_voto == '' || $get_tipo_voto == $cat_voto_popular->term_id ) {

                // Categoria Adulto
                if( $get_cat == '' || $get_cat == $cat_adulto->term_id ) {

                    // Tema Fragmentos
                    if( $get_tema == '' || $get_tema == $cat_fragmentos->term_id ) {

                        $args_af = array(
                            'post_type' => 'poesias',
                            'category__and' => array( $cat_adulto->term_id, $cat_fragmentos->term_id ),
                            'posts_per_page' => 3,
                            'meta_key' => 'votes',
                            'orderby' => 'meta_value_num',
                        );
                        $query_af = new WP_Query( $args_af );

                        if( $query_af->have_posts() )
                            $show_voto_popular = true;

                    } // Tema Fragmentos

                    // Tema Memoria
                    if( $get_tema == '' || $get_tema == $cat_memoria->term_id ) {

                        $args_am = array(
                            'post_type' => 'poesias',
                            'category__and' => array( $cat_adulto->term_id, $cat_memoria->term_id ),
                            'posts_per_page' => 3,
                            'meta_key' => 'votes',
                            'orderby' => 'meta_value_num',
                        );
                        $query_am = new WP_Query( $args_am );

                        if( $query_am->have_posts() )
                            $show_voto_popular = true;

                    } // Tema Memoria

                    // Tema Patrimonio
                    if( $get_tema == '' || $get_tema == $cat_patrimonio->term_id ) {

                        $args_ap = array(
                            'post_type' => 'poesias',
                            'category__and' => array( $cat_adulto->term_id, $cat_patrimonio->term_id ),
                            'posts_per_page' => 3,
                            'meta_key' => 'votes',
                            'orderby' => 'meta_value_num',
                        );
                        $query_ap = new WP_Query( $args_ap );

                        if( $query_ap->have_posts() )
                            $show_voto_popular = true;

                    } // Tema Patrimonio

                } // Categoria Adulto

                // Categoria Juvenil
                if( $get_cat == '' || $get_cat == $cat_juvenil->term_id ) {

                    // Tema Fragmentos
                    if( $get_tema == '' || $get_tema == $cat_fragmentos->term_id ) {

                        $args_jf = array(
                            'post_type' => 'poesias',
                            'category__and' => array( $cat_juvenil->term_id, $cat_fragmentos->term_id ),
                            'posts_per_page' => 3,
                            'meta_key' => 'votes',
                            'orderby' => 'meta_value_num',
                        );
                        $query_jf = new WP_Query( $args_jf );

                        if( $query_jf->have_posts() )
                            $show_voto_popular = true;

                    } // Tema Fragmentos

                    // Tema Memoria
                    if( $get_tema == '' || $get_tema == $cat_memoria->term_id ) {

                        $args_jm = array(
                            'post_type' => 'poesias',
                            'category__and' => array( $cat_juvenil->term_id, $cat_memoria->term_id ),
                            'posts_per_page' => 3,
                            'meta_key' => 'votes',
                            'orderby' => 'meta_value_num',
                        );
                        $query_jm = new WP_Query( $args_jm );

                        if( $query_jm->have_posts() )
                            $show_voto_popular = true;

                    } // Tema Memoria

                    // Tema Patrimonio
                    if( $get_tema == '' || $get_tema == $cat_patrimonio->term_id ) {

                        $args_jp = array(
                            'post_type' => 'poesias',
                            'category__and' => array( $cat_juvenil->term_id, $cat_patrimonio->term_id ),
                            'posts_per_page' => 3,
                            'meta_key' => 'votes',
                            'orderby' => 'meta_value_num',
                        );
                        $query_jp = new WP_Query( $args_jp );

                        if( $query_jp->have_posts() )
                            $show_voto_popular = true;

                    } // Tema Patrimonio

                } // Categoria Juvenil

            } // Voto Popular

        ?>

        <!-- Voto Popular -->

        <?php if( $show_voto_popular == true ) { ?>

        <h1 class="category-title">Voto Popular</h1>

        <?php 
            if( isset( $query_af ) && $query_af->have_posts() ) {
                $cont = 1;
        ?>

        <!-- Adulto + Fragmentos -->

        <h1 class="category-title">
            Categoria: <span class="category-title-name"><?php echo $cat_adulto->name; ?></span><br />
            Tema: <span class="category-title-name"><?php echo $cat_fragmentos->name; ?></span>
        </h1>

        <?php
                while( $query_af->have_posts() ) {
                    $query_af->the_post();
                    $autor = do_shortcode("[types field='nome']");
                    $votos = get_post_meta( get_the_ID(), 'votes', true );

        ?>
                <div class="poesias<?php echo $cont % 3 ? "" : " bordas"; ?>">

                    <h1 class="poetry-place"><?php echo $array_place[ $cont ]; ?></h1>

                    <div class="desc-autor">
                        <p class="poetry-title"><strong>Título:</strong> <?php the_title(); ?></p>
                        <p class="poetry-author"><strong>Autor:</strong> <?php echo $autor; ?></p>
                    </div>

                    <div class="poesia poetry-content">
                        <?php the_content(); ?>
                    </div>

                </div>
                <?php
                    $cont++;
                }

                // restore original post
                wp_reset_postdata();
        ?>

        <!-- /Adulto + Fragmentos -->

        <br style="clear: both;">
        
        <?php } ?>

        <?php 
            if( isset( $query_am ) && $query_am->have_posts() ) {
                $cont = 1;
        ?>

        <!-- Adulto + Memoria -->

        <h1 class="category-title">
            Categoria: <span class="category-title-name"><?php echo $cat_adulto->name; ?></span><br />
            Tema: <span class="category-title-name"><?php echo $cat_memoria->name; ?></span>
        </h1>

        <?php
                while( $query_am->have_posts() ) {
                    $query_am->the_post();
                    $autor = do_shortcode("[types field='nome']");
                    $votos = get_post_meta( get_the_ID(), 'votes', true );

        ?>
                <div class="poesias<?php echo $cont % 3 ? "" : " bordas"; ?>">

                    <h1 class="poetry-place"><?php echo $array_place[ $cont ]; ?></h1>

                    <div class="desc-autor">
                        <p class="poetry-title"><strong>Título:</strong> <?php the_title(); ?></p>
                        <p class="poetry-author"><strong>Autor:</strong> <?php echo $autor; ?></p>
                    </div>

                    <div class="poesia poetry-content">
                        <?php the_content(); ?>
                    </div>

                </div>
                <?php
                    $cont++;
                }

                // restore original post
                wp_reset_postdata();
        ?>

        <!-- /Adulto + Memoria -->

        <br style="clear: both;">
        
        <?php } ?>

        <?php 
            if( isset( $query_ap ) && $query_ap->have_posts() ) { 
                $cont = 1;
        ?>

        <!-- Adulto + Patrimonio -->

        <h1 class="category-title">
            Categoria: <span class="category-title-name"><?php echo $cat_adulto->name; ?></span><br />
            Tema: <span class="category-title-name"><?php echo $cat_patrimonio->name; ?></span>
        </h1>

        <?php
                while( $query_ap->have_posts() ) {
                    $query_ap->the_post();
                    $autor = do_shortcode("[types field='nome']");
                    $votos = get_post_meta( get_the_ID(), 'votes', true );

        ?>
                <div class="poesias<?php echo $cont % 3 ? "" : " bordas"; ?>">

                    <h1 class="poetry-place"><?php echo $array_place[ $cont ]; ?></h1>

                    <div class="desc-autor">
                        <p class="poetry-title"><strong>Título:</strong> <?php the_title(); ?></p>
                        <p class="poetry-author"><strong>Autor:</strong> <?php echo $autor; ?></p>
                    </div>

                    <div class="poesia poetry-content">
                        <?php the_content(); ?>
                    </div>

                </div>
                <?php
                    $cont++;
                }

                // restore original post
                wp_reset_postdata();
        ?>

        <!-- /Adulto + Patrimonio -->

        <br style="clear: both;">
        
        <?php } ?>

        <?php 
            if( isset( $query_jf ) && $query_jf->have_posts() ) {
                $cont = 1;
        ?>

        <!-- Juvenil + Fragmentos -->

        <h1 class="category-title">
            Categoria: <span class="category-title-name"><?php echo $cat_juvenil->name; ?></span><br />
            Tema: <span class="category-title-name"><?php echo $cat_fragmentos->name; ?></span>
        </h1>

        <?php
                while( $query_jf->have_posts() ) {
                    $query_jf->the_post();
                    $autor = do_shortcode("[types field='nome']");
                    $votos = get_post_meta( get_the_ID(), 'votes', true );

        ?>
                <div class="poesias<?php echo $cont % 3 ? "" : " bordas"; ?>">

                    <h1 class="poetry-place"><?php echo $array_place[ $cont ]; ?></h1>

                    <div class="desc-autor">
                        <p class="poetry-title"><strong>Título:</strong> <?php the_title(); ?></p>
                        <p class="poetry-author"><strong>Autor:</strong> <?php echo $autor; ?></p>
                    </div>

                    <div class="poesia poetry-content">
                        <?php the_content(); ?>
                    </div>

                </div>
                <?php
                    $cont++;
                }

                // restore original post
                wp_reset_postdata();
        ?>

        <!-- /Juvenil + Fragmentos -->

        <br style="clear: both;">
        
        <?php } ?>

        <?php 
            if( isset( $query_jm ) && $query_jm->have_posts() ) {
                $cont = 1;
        ?>

        <!-- Juvenil + Memoria -->

        <h1 class="category-title">
            Categoria: <span class="category-title-name"><?php echo $cat_juvenil->name; ?></span><br />
            Tema: <span class="category-title-name"><?php echo $cat_memoria->name; ?></span>
        </h1>

        <?php
                while( $query_jm->have_posts() ) {
                    $query_jm->the_post();
                    $autor = do_shortcode("[types field='nome']");
                    $votos = get_post_meta( get_the_ID(), 'votes', true );

        ?>
                <div class="poesias<?php echo $cont % 3 ? "" : " bordas"; ?>">

                    <h1 class="poetry-place"><?php echo $array_place[ $cont ]; ?></h1>

                    <div class="desc-autor">
                        <p class="poetry-title"><strong>Título:</strong> <?php the_title(); ?></p>
                        <p class="poetry-author"><strong>Autor:</strong> <?php echo $autor; ?></p>
                    </div>

                    <div class="poesia poetry-content">
                        <?php the_content(); ?>
                    </div>

                </div>
                <?php
                    $cont++;
                }

                // restore original post
                wp_reset_postdata();

        ?>

        <!-- /Juvenil + Memoria -->

        <br style="clear: both;">

        <?php } ?>

        <?php 
            if( isset( $query_jp ) && $query_jp->have_posts() ) {
                $cont = 1;
        ?>

        <!-- Juvenil + Patrimonio -->

        <h1 class="category-title">
            Categoria: <span class="category-title-name"><?php echo $cat_juvenil->name; ?></span><br />
            Tema: <span class="category-title-name"><?php echo $cat_patrimonio->name; ?></span>
        </h1>

        <?php
                while( $query_jp->have_posts() ) {
                    $query_jp->the_post();
                    $autor = do_shortcode("[types field='nome']");
                    $votos = get_post_meta( get_the_ID(), 'votes', true );

        ?>
                <div class="poesias<?php echo $cont % 3 ? "" : " bordas"; ?>">

                    <h1 class="poetry-place"><?php echo $array_place[ $cont ]; ?></h1>

                    <div class="desc-autor">
                        <p class="poetry-title"><?php the_title(); ?></p>
                        <p class="poetry-author"><?php echo $autor; ?></p>
                    </div>

                    <div class="poesia poetry-content">
                        <?php the_content(); ?>
                    </div>

                </div>
                <?php
                    $cont++;
                }

                // restore original post
                wp_reset_postdata();

        ?>
        <!-- /Juvenil + Patrimonio -->
        
            <?php } ?>

        <?php } // if( $show_voto_popular == true ) ?>

    </div>


</div>


<?php get_footer(); ?>
