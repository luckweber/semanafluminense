<?php get_header("internas"); ?>

<div id="content">


    <?php 
        $post_category = '';
        $post_theme = '';
        $post_type = '';

        if (have_posts()) : while (have_posts()) : 
            the_post(); 

            $post_categories = wp_get_post_categories( get_the_ID() );

            $parent_cat = get_category_by_slug( 'categorias' );
            $categorias = get_categories( 'child_of=' . $parent_cat->term_id );

            for( $i = 0; $i < count( $categorias ); $i++ ) {
                if( in_array( $categorias[$i]->term_id, $post_categories) ) {
                    $post_category = $categorias[$i]->name;
                }
            }

            $parent_theme = get_category_by_slug( 'temas' );
            $temas = get_categories( 'child_of=' . $parent_theme->term_id );

            for( $i = 0; $i < count( $temas ); $i++ ) {
                if( in_array( $temas[$i]->term_id, $post_categories) ) {
                    $post_theme = $temas[$i]->name;
                }
            }

            $parent_type = get_category_by_slug( 'modalidades' );
            $modalidades = get_categories( 'child_of=' . $parent_type->term_id );

            for( $i = 0; $i < count( $modalidades ); $i++ ) {
                if( in_array( $modalidades[$i]->term_id, $post_categories) ) {
                    $post_type = $modalidades[$i]->name;
                }
            }

            $nome = do_shortcode("[types field='nome']");
            $email = do_shortcode("[types field='email']");
            $nasc = do_shortcode("[types field='data-nascimento']");
            $sexo = ( do_shortcode("[types field='sexo']") == 'm' ) ? 'Masculino' : 'Feminino';
            $endereco = do_shortcode("[types field='endereco']");
            $bairro = do_shortcode("[types field='bairro']");
            $cidade = do_shortcode("[types field='cidade']");
            $estado = do_shortcode("[types field='estado']");
            $telefone = do_shortcode("[types field='telefone']");
            $celular = do_shortcode("[types field='celular']");
            $cep = do_shortcode("[types field='cep']");
            
            $cpf = do_shortcode("[types field='cpf']");
            $rg = do_shortcode("[types field='rg']");
            $orgao = do_shortcode("[types field='orgao']");

    ?>    


            <div id="post">

                    <p><small class="data"><?php the_time("d"); ?> de <?php the_time("F"); ?> de <?php the_time("Y"); ?>, às <?php the_time('H:i'); ?></small></p>

                    <h2><?php the_title(); ?></h2>
                    <?php if( do_shortcode("[types field='subtitulo']") != '' ) : ?>
                    <h3><?php echo do_shortcode("[types field='subtitulo']"); ?></h3>
                    <?php endif; ?>

                    <div class="entry">

                        <?php the_content(); ?>

                        <p class="link-download">
                            <a href="javascript:window.print()">Imprimir Relatório</a>
                        </p>

                    </div>

                    <div class="dados-foto">

                        <p><strong>Titulo:</strong> <?php the_title(); ?></p>
                        <p><strong>Categoria:</strong> <?php echo $post_category; ?></p>
                        <p><strong>Tema:</strong> <?php echo $post_theme; ?></p>
                        <p><strong>Tipo:</strong> <?php echo $post_type; ?></p>

                    </div>

                    <div class="dados-foto">

                        <p><strong>Nome do Participante:</strong> <?php echo $nome; ?></p>
                        <p><strong>Data de Nascimento:</strong> <?php echo $nasc; ?></p>
                        <p><strong>Sexo:</strong> <?php echo $sexo; ?></p>
                        <p><strong>Endereço:</strong> <?php echo $endereco; ?></p>
                        <p><strong>Bairro:</strong> <?php echo $bairro; ?></p>
                        <p><strong>Cidade:</strong> <?php echo $cidade; ?></p>
                        <p><strong>Estado:</strong> <?php echo $estado; ?></p>
                        <p><strong>CEP:</strong> <?php echo $cep; ?></p>
                        <p><strong>Telefone:</strong> <?php echo $telefone; ?></p>
                        <p><strong>Celular:</strong> <?php echo $celular; ?></p>

                        <p><strong>CPF:</strong> <?php echo $cpf; ?></p>
                        <p><strong>RG:</strong> <?php echo $rg; ?></p>
                        <p><strong>Órgão Expedidor:</strong> <?php echo $orgao; ?></p>
                        <p><strong>E-mail pessoal:</strong> <?php echo $email; ?></p>

                    </div>

                    <div class="page-break"></div>

                    <div class="dados-foto">

                        <p><strong>Titulo:</strong> <?php the_title(); ?></p>
                        <p><strong>Categoria:</strong> <?php echo $post_category; ?></p>
                        <p><strong>Tema:</strong> <?php echo $post_theme; ?></p>
                        <p><strong>Tipo:</strong> <?php echo $post_type; ?></p>
                        <div class="poesia"><?php the_content(); ?></div>

                    </div>


                <?php endwhile; ?>
            <?php else : ?>
                <h2>Nada encontrado</h2>
            <?php endif; ?>            





    </div>



</div>


<?php get_footer(); ?>
