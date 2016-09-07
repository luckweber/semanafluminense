<?php 

/*
 * Template name: Resultado Fotografias Off
 */

get_header("concursofotos-resultado");
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

    // Voto Popular
    $cat_voto_popular = get_category_by_slug( 'voto-popular' );

    // Menção Honrosa
    $cat_mencao = get_category_by_slug( 'mencao-honrosa' );

    $array_place = array(
        '1' => '1º Lugar',
        '2' => '2º Lugar',
        '3' => '3º Lugar'
    );

    $show_voto_juri = false;

    // Voto Juri
    if( $get_tipo_voto == '' || $get_tipo_voto == $cat_juri->term_id ) :

        // Categoria Adulto
        if( $get_cat == '' || $get_cat == $cat_adulto->term_id ) :

            // Tema Memoria
            if( $get_tema == '' || $get_tema == $cat_memoria->term_id ) :

                $args_jam = array(
                    'post_type' => 'fotografias',
                    'category__and' => array( $cat_juri->term_id, $cat_adulto->term_id, $cat_memoria->term_id ),
                    'posts_per_page' => 3,
                    'meta_key' => 'wpcf-posicao',
                    'orderby' => 'meta_value_num',
                    'order' => 'ASC'
                );
                $query_jam = new WP_Query( $args_jam );

                if( $query_jam->have_posts() )
                    $show_voto_juri = true;

            endif; // Tema Memoria

            // Tema Fragmentos
            if( $get_tema == '' || $get_tema == $cat_fragmentos->term_id ) :

                $args_jaf = array(
                    'post_type' => 'fotografias',
                    'category__and' => array( $cat_juri->term_id, $cat_adulto->term_id, $cat_fragmentos->term_id ),
                    'posts_per_page' => 3,
                    'meta_key' => 'wpcf-posicao',
                    'orderby' => 'meta_value_num',
                    'order' => 'ASC'
                );
                $query_jaf = new WP_Query( $args_jaf );

                if( $query_jaf->have_posts() )
                    $show_voto_juri = true;

            endif; // Tema Fragmentos

            // Tema Patrimonio
            if( $get_tema == '' || $get_tema == $cat_patrimonio->term_id ) :

                $args_jap = array(
                    'post_type' => 'fotografias',
                    'category__and' => array( $cat_juri->term_id, $cat_adulto->term_id, $cat_patrimonio->term_id ),
                    'posts_per_page' => 3,
                    'meta_key' => 'wpcf-posicao',
                    'orderby' => 'meta_value_num',
                    'order' => 'ASC'
                );
                $query_jap = new WP_Query( $args_jap );

                if( $query_jap->have_posts() )
                    $show_voto_juri = true;

            endif; // Tema Patrimonio

        endif; // Categoria Adulto

        // Categoria Infanto-Juvenil
        if( $get_cat == '' || $get_cat == $cat_juvenil->term_id ) :

            // Tema Memoria
            if( $get_tema == '' || $get_tema == $cat_memoria->term_id ) :

                $args_juvenil_memoria = array(
                    'post_type' => 'fotografias',
                    'category__and' => array( $cat_juri->term_id, $cat_juvenil->term_id, $cat_memoria->term_id ),
                    'posts_per_page' => 3,
                    'meta_key' => 'wpcf-posicao',
                    'orderby' => 'meta_value_num',
                    'order' => 'ASC'
                );
                $query_juvenil_memoria = new WP_Query( $args_juvenil_memoria );

                if( $query_juvenil_memoria->have_posts() )
                    $show_voto_juri = true;

            endif; // Tema Memoria

            // Tema Fragmentos
            if( $get_tema == '' || $get_tema == $cat_fragmentos->term_id ) :

                $args_juvenil_fragmentos = array(
                    'post_type' => 'fotografias',
                    'category__and' => array( $cat_juri->term_id, $cat_juvenil->term_id, $cat_fragmentos->term_id ),
                    'posts_per_page' => 3,
                    'meta_key' => 'wpcf-posicao',
                    'orderby' => 'meta_value_num',
                    'order' => 'ASC'
                );
                $query_juvenil_fragmentos = new WP_Query( $args_juvenil_fragmentos );

                if( $query_juvenil_fragmentos->have_posts() )
                    $show_voto_juri = true;

            endif; // Tema Fragmentos

            // Tema Patrimonio
            if( $get_tema == '' || $get_tema == $cat_patrimonio->term_id ) :

                $args_juvenil_patrimonio = array(
                    'post_type' => 'fotografias',
                    'category__and' => array( $cat_juri->term_id, $cat_juvenil->term_id, $cat_patrimonio->term_id ),
                    'posts_per_page' => 3,
                    'meta_key' => 'wpcf-posicao',
                    'orderby' => 'meta_value_num',
                    'order' => 'ASC'
                );
                $query_juvenil_patrimonio = new WP_Query( $args_juvenil_patrimonio );

                if( $query_juvenil_patrimonio->have_posts() )
                    $show_voto_juri = true;

            endif; // Tema Fragmentos

        endif; // Categoria Adulto

    endif; // Voto do Juri

    ?>

    <div id="listagem-votacao">

        <?php 
            if( $show_voto_juri == true ) : 
        ?>
        <!-- Seleção do Juri -->

        <h1 class="category-title">Seleção do Juri</h1>

        <!-- Adulto + Fragmentos -->
        <?php 

            $cont = 1;
            if( isset( $query_jaf ) && $query_jaf->have_posts() ) : 
        ?>

        <h1 class="category-title">
            Categoria: <span class="category-title-name"><?php echo $cat_adulto->name; ?></span><br />
            Tema: <span class="category-title-name"><?php echo $cat_fragmentos->name; ?></span>
        </h1>

        <?php
                while( $query_jaf->have_posts() ) :
                    $query_jaf->the_post();
                    $autor = do_shortcode("[types field='concurso-foto-autor']");
                    $local = do_shortcode("[types field='concurso-foto-local']");
        ?>
                <div class="foto<?php echo $cont % 3 ? "" : " second"; ?>">

                    <h1 class="photo-place"><?php echo $array_place[ $cont ]; ?></h1>

                    <div class="voto">
                        <?php
                        $post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
                        $thumb = ( $post_thumbnail_id != '' ) ? wp_get_attachment_image_src( $post_thumbnail_id, 'concurso-fotografia-maior') : '';
                        $url = ( $thumb == true ) ? $thumb['0'] : '';
                        ?>
                        <a href="<?php echo $url; ?>" title="<?php the_title(); ?>" class="group1">
                            <?php the_post_thumbnail('concurso-fotografia-thumb'); ?>
                        </a>
                    </div>

                    <h2 class="photo-title"><?php the_title(); ?></h2>
                    <p class="photo-location"><strong>Local:</strong> <?php echo $local; ?></p>
                    <p class="photo-author"><strong>Autor:</strong> <?php echo $autor; ?></p>

                </div>
                <?php
                    $cont++;
                endwhile;

                // restore original post
                wp_reset_postdata();

            endif;

        ?>

        <!-- /Adulto + Fragmentos -->

        <!-- Adulto + Memoria -->
        <?php 

            $cont = 1;
            if( isset( $query_jam ) && $query_jam->have_posts() ) : 
        ?>

        <h1 class="category-title">
            Categoria: <span class="category-title-name"><?php echo $cat_adulto->name; ?></span><br />
            Tema: <span class="category-title-name"><?php echo $cat_memoria->name; ?></span>
        </h1>

        <?php
                while( $query_jam->have_posts() ) :
                    $query_jam->the_post();
                    $autor = do_shortcode("[types field='concurso-foto-autor']");
                    $local = do_shortcode("[types field='concurso-foto-local']");
        ?>
                <div class="foto<?php echo $cont % 3 ? "" : " second"; ?>">

                    <h1 class="photo-place"><?php echo $array_place[ $cont ]; ?></h1>

                    <div class="voto">
                        <?php
                        $post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
                        $thumb = ( $post_thumbnail_id != '' ) ? wp_get_attachment_image_src( $post_thumbnail_id, 'concurso-fotografia-maior') : '';
                        $url = ( $thumb == true ) ? $thumb['0'] : '';
                        ?>
                        <a href="<?php echo $url; ?>" title="<?php the_title(); ?>" class="group1">
                            <?php the_post_thumbnail('concurso-fotografia-thumb'); ?>
                        </a>
                    </div>

                    <h2 class="photo-title"><?php the_title(); ?></h2>
                    <p class="photo-location"><strong>Local:</strong> <?php echo $local; ?></p>
                    <p class="photo-author"><strong>Autor:</strong> <?php echo $autor; ?></p>

                </div>
                <?php
                    $cont++;
                endwhile;

                // restore original post
                wp_reset_postdata();

            endif;

        ?>

        <!-- /Adulto + Memoria -->

        <!-- /Seleção do Juri -->

        <br style="clear: both;">

        <?php endif; ?>

        <?php 

        $show_voto_popular = false;

        // Voto Popular
        if( $get_tipo_voto == '' || $get_tipo_voto == $cat_voto_popular->term_id ) :

            if( $get_cat == '' || $get_cat == $cat_adulto->term_id ) :

                if( $get_tema == '' || $get_tema == $cat_fragmentos->term_id ) :

                    // Adulto + Fragmentos
                    $args_af = array(
                        'post_type' => 'fotografias',
                        'category__and' => array( $cat_adulto->term_id, $cat_fragmentos->term_id ),
                        'posts_per_page' => 3,
                        'meta_key' => 'votes',
                        'orderby' => 'meta_value_num',
                    );
                    $query_af = new WP_Query( $args_af );

                    if( $query_af->have_posts() )
                        $show_voto_popular = true;

                endif;

                if( $get_tema == '' || $get_tema == $cat_memoria->term_id ) :

                    // Adulto + Memoria
                    $args_am = array(
                        'post_type' => 'fotografias',
                        'category__and' => array( $cat_adulto->term_id, $cat_memoria->term_id ),
                        'posts_per_page' => 3,
                        'meta_key' => 'votes',
                        'orderby' => 'meta_value_num',
                    );
                    $query_am = new WP_Query( $args_am );

                    if( $query_am->have_posts() )
                        $show_voto_popular = true;

                endif;

                if( $get_tema == '' || $get_tema == $cat_patrimonio->term_id ) :

                    // Adulto + Patrimonio
                    $args_ap = array(
                        'post_type' => 'fotografias',
                        'category__and' => array( $cat_adulto->term_id, $cat_patrimonio->term_id ),
                        'posts_per_page' => 3,
                        'meta_key' => 'votes',
                        'orderby' => 'meta_value_num',
                    );
                    $query_ap = new WP_Query( $args_ap );

                    if( $query_ap->have_posts() )
                        $show_voto_popular = true;

                endif;

            endif; // Categoria Adulto

            // Categoria Infanto-Juvenil
            if( $get_cat == '' || $get_cat == $cat_juvenil->term_id ) :

                if( $get_tema == '' || $get_tema == $cat_fragmentos->term_id ) :

                    // Jovem + Fragmentos
                    $args_jf = array(
                        'post_type' => 'fotografias',
                        'category__and' => array( $cat_juvenil->term_id, $cat_fragmentos->term_id ),
                        'posts_per_page' => 3,
                        'meta_key' => 'votes',
                        'orderby' => 'meta_value_num',
                    );
                    $query_jf = new WP_Query( $args_jf );

                    if( $query_jf->have_posts() )
                        $show_voto_popular = true;

                endif;

                if( $get_tema == '' || $get_tema == $cat_memoria->term_id ) :

                    // Jovem + Memorias
                    $args_jm = array(
                        'post_type' => 'fotografias',
                        'category__and' => array( $cat_juvenil->term_id, $cat_memoria->term_id ),
                        'posts_per_page' => 3,
                        'meta_key' => 'votes',
                        'orderby' => 'meta_value_num',
                    );
                    $query_jm = new WP_Query( $args_jm );

                    if( $query_jm->have_posts() )
                        $show_voto_popular = true;

                endif;

                if( $get_tema == '' || $get_tema == $cat_patrimonio->term_id ) :

                    // Juvenil + Patrimonio
                    $args_jp = array(
                        'post_type' => 'fotografias',
                        'category__and' => array( $cat_juvenil->term_id, $cat_patrimonio->term_id ),
                        'posts_per_page' => 3,
                        'meta_key' => 'votes',
                        'orderby' => 'meta_value_num',
                    );
                    $query_jp = new WP_Query( $args_jp );

                    if( $query_jp->have_posts() )
                        $show_voto_popular = true;

                endif;

            endif; // Categoria Jovem

        endif; // Voto Popular

        if( $show_voto_popular == true ) :

        ?>

        <?php if( $get_tipo_voto == '' || $get_tipo_voto == $cat_voto_popular->term_id ) : ?>
        
        <!-- Voto Popular -->
        
        <h1 class="category-title">Voto Popular</h1>
        
        <?php endif; ?>

        <!-- Adulto + Fragmentos -->
        <?php 
            $cont = 1;
            if( isset( $query_af ) && $query_af->have_posts() ) : 
        ?>

        <h1 class="category-title">
            Categoria: <span class="category-title-name"><?php echo $cat_adulto->name; ?></span><br />
            Tema: <span class="category-title-name"><?php echo $cat_fragmentos->name; ?></span>
        </h1>

        <?php
                while( $query_af->have_posts() ) :
                    $query_af->the_post();
                    $autor = do_shortcode("[types field='concurso-foto-autor']");
                    $local = do_shortcode("[types field='concurso-foto-local']");
        ?>
                <div class="foto<?php echo $cont % 3 ? "" : " second"; ?>">

                    <h1 class="photo-place"><?php echo $array_place[ $cont ]; ?></h1>

                    <div class="voto">
                        <?php
                        $post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
                        $thumb = ( $post_thumbnail_id != '' ) ? wp_get_attachment_image_src( $post_thumbnail_id, 'concurso-fotografia-maior') : '';
                        $url = ( $thumb == true ) ? $thumb['0'] : '';
                        ?>
                        <a href="<?php echo $url; ?>" title="<?php the_title(); ?>" class="group1">
                            <?php the_post_thumbnail('concurso-fotografia-thumb'); ?>
                        </a>
                    </div>

                    <h2 class="photo-title"><?php the_title(); ?></h2>
                    <p class="photo-location"><strong>Local:</strong> <?php echo $local; ?></p>
                    <p class="photo-author"><strong>Autor:</strong> <?php echo $autor; ?></p>

                </div>
                <?php
                    $cont++;
                endwhile;

                // restore original post
                wp_reset_postdata();

            endif;

        ?>

        <!-- /Adulto + Fragmentos -->

        <br style="clear: both;">

        <!-- Adulto + Memoria -->
        <?php 

            $cont = 1;
            if( isset( $query_am ) && $query_am->have_posts() ) : 
        ?>

        <h1 class="category-title">
            Categoria: <span class="category-title-name"><?php echo $cat_adulto->name; ?></span><br />
            Tema: <span class="category-title-name"><?php echo $cat_memoria->name; ?></span>
        </h1>

        <?php
                while( $query_am->have_posts() ) :
                    $query_am->the_post();
                    $autor = do_shortcode("[types field='concurso-foto-autor']");
                    $local = do_shortcode("[types field='concurso-foto-local']");
        ?>
                <div class="foto<?php echo $cont % 3 ? "" : " second"; ?>">

                    <h1 class="photo-place"><?php echo $array_place[ $cont ]; ?></h1>

                    <div class="voto">
                        <?php
                        $post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
                        $thumb = ( $post_thumbnail_id != '' ) ? wp_get_attachment_image_src( $post_thumbnail_id, 'concurso-fotografia-maior') : '';
                        $url = ( $thumb == true ) ? $thumb['0'] : '';
                        ?>
                        <a href="<?php echo $url; ?>" title="<?php the_title(); ?>" class="group1">
                            <?php the_post_thumbnail('concurso-fotografia-thumb'); ?>
                        </a>
                    </div>

                    <h2 class="photo-title"><?php the_title(); ?></h2>
                    <p class="photo-location"><strong>Local:</strong> <?php echo $local; ?></p>
                    <p class="photo-author"><strong>Autor:</strong> <?php echo $autor; ?></p>

                </div>
                <?php
                    $cont++;
                endwhile;

                // restore original post
                wp_reset_postdata();

            endif;

        ?>

        <!-- /Adulto + Memoria -->

        <br style="clear: both;">

        <!-- Adulto + Patrimonio -->
        <?php 

            $cont = 1;
            if( isset( $query_ap ) && $query_ap->have_posts() ) : 
        ?>

        <h1 class="category-title">
            Categoria: <span class="category-title-name"><?php echo $cat_adulto->name; ?></span><br />
            Tema: <span class="category-title-name"><?php echo $cat_patrimonio->name; ?></span>
        </h1>

        <?php
                while( $query_ap->have_posts() ) :
                    $query_ap->the_post();
                    $autor = do_shortcode("[types field='concurso-foto-autor']");
                    $local = do_shortcode("[types field='concurso-foto-local']");
        ?>
                <div class="foto<?php echo $cont % 3 ? "" : " second"; ?>">

                    <h1 class="photo-place"><?php echo $array_place[ $cont ]; ?></h1>

                    <div class="voto">
                        <?php
                        $post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
                        $thumb = ( $post_thumbnail_id != '' ) ? wp_get_attachment_image_src( $post_thumbnail_id, 'concurso-fotografia-maior') : '';
                        $url = ( $thumb == true ) ? $thumb['0'] : '';
                        ?>
                        <a href="<?php echo $url; ?>" title="<?php the_title(); ?>" class="group1">
                            <?php the_post_thumbnail('concurso-fotografia-thumb'); ?>
                        </a>
                    </div>

                    <h2 class="photo-title"><?php the_title(); ?></h2>
                    <p class="photo-location"><strong>Local:</strong> <?php echo $local; ?></p>
                    <p class="photo-author"><strong>Autor:</strong> <?php echo $autor; ?></p>

                </div>
                <?php
                    $cont++;
                endwhile;

                // restore original post
                wp_reset_postdata();

            endif;

        ?>

        <!-- /Adulto + Patrimonio -->

        <br style="clear: both;">

        <!-- Juvenil + Fragmentos -->
        <?php 

            $cont = 1;
            if( isset( $query_jf ) && $query_jf->have_posts() ) : 
        ?>

        <h1 class="category-title">
            Categoria: <span class="category-title-name"><?php echo $cat_juvenil->name; ?></span><br />
            Tema: <span class="category-title-name"><?php echo $cat_fragmentos->name; ?></span>
        </h1>

        <?php
                while( $query_jf->have_posts() ) :
                    $query_jf->the_post();
                    $autor = do_shortcode("[types field='concurso-foto-autor']");
                    $local = do_shortcode("[types field='concurso-foto-local']");
        ?>
                <div class="foto<?php echo $cont % 3 ? "" : " second"; ?>">

                    <h1 class="photo-place"><?php echo $array_place[ $cont ]; ?></h1>

                    <div class="voto">
                        <?php
                        $post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
                        $thumb = ( $post_thumbnail_id != '' ) ? wp_get_attachment_image_src( $post_thumbnail_id, 'concurso-fotografia-maior') : '';
                        $url = ( $thumb == true ) ? $thumb['0'] : '';
                        ?>
                        <a href="<?php echo $url; ?>" title="<?php the_title(); ?>" class="group1">
                            <?php the_post_thumbnail('concurso-fotografia-thumb'); ?>
                        </a>
                    </div>

                    <h2 class="photo-title"><?php the_title(); ?></h2>
                    <p class="photo-location"><strong>Local:</strong> <?php echo $local; ?></p>
                    <p class="photo-author"><strong>Autor:</strong> <?php echo $autor; ?></p>

                </div>
                <?php
                    $cont++;
                endwhile;

                // restore original post
                wp_reset_postdata();

            endif;

        ?>

        <!-- /Juvenil + Fragmentos -->

        <br style="clear: both;">

        <!-- Juvenil + Memoria -->
        <?php 

            $cont = 1;
            if( isset( $query_jm ) && $query_jm->have_posts() ) : 
        ?>

        <h1 class="category-title">
            Categoria: <span class="category-title-name"><?php echo $cat_juvenil->name; ?></span><br />
            Tema: <span class="category-title-name"><?php echo $cat_memoria->name; ?></span>
        </h1>

        <?php
                while( $query_jm->have_posts() ) :
                    $query_jm->the_post();
                    $autor = do_shortcode("[types field='concurso-foto-autor']");
                    $local = do_shortcode("[types field='concurso-foto-local']");
        ?>
                <div class="foto<?php echo $cont % 3 ? "" : " second"; ?>">

                    <h1 class="photo-place"><?php echo $array_place[ $cont ]; ?></h1>

                    <div class="voto">
                        <?php
                        $post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
                        $thumb = ( $post_thumbnail_id != '' ) ? wp_get_attachment_image_src( $post_thumbnail_id, 'concurso-fotografia-maior') : '';
                        $url = ( $thumb == true ) ? $thumb['0'] : '';
                        ?>
                        <a href="<?php echo $url; ?>" title="<?php the_title(); ?>" class="group1">
                            <?php the_post_thumbnail('concurso-fotografia-thumb'); ?>
                        </a>
                    </div>

                    <h2 class="photo-title"><?php the_title(); ?></h2>
                    <p class="photo-location"><strong>Local:</strong> <?php echo $local; ?></p>
                    <p class="photo-author"><strong>Autor:</strong> <?php echo $autor; ?></p>

                </div>
                <?php
                    $cont++;
                endwhile;

                // restore original post
                wp_reset_postdata();

            endif;

        ?>

        <!-- /Juvenil + Memoria -->

        <br style="clear: both;">

        <!-- Juvenil + Patrimonio -->
        <?php 

            $cont = 1;
            if( isset( $query_jp ) && $query_jp->have_posts() ) : 
        ?>

        <h1 class="category-title">
            Categoria: <span class="category-title-name"><?php echo $cat_juvenil->name; ?></span><br />
            Tema: <span class="category-title-name"><?php echo $cat_patrimonio->name; ?></span>
        </h1>

        <?php
                while( $query_jp->have_posts() ) :
                    $query_jp->the_post();
                    $autor = do_shortcode("[types field='concurso-foto-autor']");
                    $local = do_shortcode("[types field='concurso-foto-local']");
        ?>
                <div class="foto<?php echo $cont % 3 ? "" : " second"; ?>">

                    <h1 class="photo-place"><?php echo $array_place[ $cont ]; ?></h1>

                    <div class="voto">
                        <?php
                        $post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
                        $thumb = ( $post_thumbnail_id != '' ) ? wp_get_attachment_image_src( $post_thumbnail_id, 'concurso-fotografia-maior') : '';
                        $url = ( $thumb == true ) ? $thumb['0'] : '';
                        ?>
                        <a href="<?php echo $url; ?>" title="<?php the_title(); ?>" class="group1">
                            <?php the_post_thumbnail('concurso-fotografia-thumb'); ?>
                        </a>
                    </div>

                    <h2 class="photo-title"><?php the_title(); ?></h2>
                    <p class="photo-location"><strong>Local:</strong> <?php echo $local; ?></p>
                    <p class="photo-author"><strong>Autor:</strong> <?php echo $autor; ?></p>

                </div>
                <?php
                    $cont++;
                endwhile;

                // restore original post
                wp_reset_postdata();

            endif;

        ?>

        <!-- /Juvenil + Patrimonio -->

        <!-- /Voto Popular -->   

        <?php endif; // Show Voto Popular ?>  

        <?php

        $show_mencao_honrosa = false;
        // Mencao Honrosa

        if( $get_tipo_voto == '' || $get_tipo_voto == $cat_mencao->term_id ) :

            if( $get_cat == '' || $get_cat == $cat_adulto->term_id ) :

                if( $get_tema == '' || $get_tema == $cat_patrimonio->term_id ) :

                    // Adulto + Patrimonio
                    $args_adulto_patrimonio_mencao = array(
                        'post_type' => 'fotografias',
                        'category__and' => array( $cat_adulto->term_id, $cat_patrimonio->term_id, $cat_mencao->term_id ),
                        'posts_per_page' => 1,
                    );
                    $query_adulto_patrimonio_mencao = new WP_Query( $args_adulto_patrimonio_mencao );

                    if( $query_adulto_patrimonio_mencao->have_posts() )
                        $show_mencao_honrosa = true;

                endif;

            endif;

            if( $get_cat == '' || $get_cat == $cat_juvenil->term_id ) :

                if( $get_tema == '' || $get_tema == $cat_patrimonio->term_id ) :

                    // Juvenil + Patrimonio
                    $args_juvenil_patrimonio_mencao = array(
                        'post_type' => 'fotografias',
                        'category__and' => array( $cat_juvenil->term_id, $cat_patrimonio->term_id, $cat_mencao->term_id ),
                        'posts_per_page' => 1,
                    );
                    $query_juvenil_patrimonio_mencao = new WP_Query( $args_juvenil_patrimonio_mencao );

                    if( $query_juvenil_patrimonio_mencao->have_posts() )
                        $show_mencao_honrosa = true;

                endif;

            endif;

        endif;

        ?>

        <?php if( $show_mencao_honrosa == true ) : ?>

        <br style="clear: both;">

        <h1 class="category-title">Menção Honrosa</h1>

        <!-- Adulto + Patrimonio -->
        <?php 
            if( isset( $query_adulto_patrimonio_mencao ) && $query_adulto_patrimonio_mencao->have_posts() ) : 
        ?>

        <h1 class="category-title">
            Categoria: <span class="category-title-name"><?php echo $cat_adulto->name; ?></span><br />
            Tema: <span class="category-title-name"><?php echo $cat_patrimonio->name; ?></span>
        </h1>

        <?php
                while( $query_adulto_patrimonio_mencao->have_posts() ) :
                    $query_adulto_patrimonio_mencao->the_post();
                    $autor = do_shortcode("[types field='concurso-foto-autor']");
                    $local = do_shortcode("[types field='concurso-foto-local']");
        ?>
                <div class="foto">

                    <div class="voto">
                        <?php
                        $post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
                        $thumb = ( $post_thumbnail_id != '' ) ? wp_get_attachment_image_src( $post_thumbnail_id, 'concurso-fotografia-maior') : '';
                        $url = ( $thumb == true ) ? $thumb['0'] : '';
                        ?>
                        <a href="<?php echo $url; ?>" title="<?php the_title(); ?>" class="group1">
                            <?php the_post_thumbnail('concurso-fotografia-thumb'); ?>
                        </a>
                    </div>

                    <h2 class="photo-title"><?php the_title(); ?></h2>
                    <p class="photo-location"><strong>Local:</strong> <?php echo $local; ?></p>
                    <p class="photo-author"><strong>Autor:</strong> <?php echo $autor; ?></p>

                </div>
                <?php
                endwhile;

                // restore original post
                wp_reset_postdata();

            endif;

        ?>

        <!-- /Adulto + Patrimonio -->

        <br style="clear: both;">

        <!-- Juvenil + Patrimonio -->
        <?php 
            if( isset( $query_juvenil_patrimonio_mencao ) && $query_juvenil_patrimonio_mencao->have_posts() ) : 
        ?>

        <h1 class="category-title">
            Categoria: <span class="category-title-name"><?php echo $cat_juvenil->name; ?></span><br />
            Tema: <span class="category-title-name"><?php echo $cat_patrimonio->name; ?></span>
        </h1>

        <?php
                while( $query_juvenil_patrimonio_mencao->have_posts() ) :
                    $query_juvenil_patrimonio_mencao->the_post();
                    $autor = do_shortcode("[types field='concurso-foto-autor']");
                    $local = do_shortcode("[types field='concurso-foto-local']");
        ?>
                <div class="foto">

                    <div class="voto">
                        <?php
                        $post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
                        $thumb = ( $post_thumbnail_id != '' ) ? wp_get_attachment_image_src( $post_thumbnail_id, 'concurso-fotografia-maior') : '';
                        $url = ( $thumb == true ) ? $thumb['0'] : '';
                        ?>
                        <a href="<?php echo $url; ?>" title="<?php the_title(); ?>" class="group1">
                            <?php the_post_thumbnail('concurso-fotografia-thumb'); ?>
                        </a>
                    </div>

                    <h2 class="photo-title"><?php the_title(); ?></h2>
                    <p class="photo-location"><strong>Local:</strong> <?php echo $local; ?></p>
                    <p class="photo-author"><strong>Autor:</strong> <?php echo $autor; ?></p>

                </div>
                <?php
                endwhile;

                // restore original post
                wp_reset_postdata();

            endif;

        ?>

        <!-- /Juvenil + Patrimonio -->

        <br style="clear: both;">

        <?php endif; ?>

    </div>

</div>


<?php get_footer(); ?>