<?php get_header("internas"); ?>

<div id="content">


    <?php 
        $post_category = '';
        $post_theme = '';

        if (have_posts()) : 
            while (have_posts()) :

                the_post();

                $parent_cat = get_category_by_slug( 'categorias' );
                $categorias = get_categories( 'child_of=' . $parent_cat->term_id );

                $parent_theme = get_category_by_slug( 'temas' );
                $temas = get_categories( 'child_of=' . $parent_theme->term_id );

                $post_categories = wp_get_post_categories( get_the_ID() );

                for( $i = 0; $i < count( $categorias ); $i++ ) {
                    if( in_array( $categorias[$i]->term_id, $post_categories) ) {
                        $post_category = $categorias[$i]->name;
                    }
                }

                for( $i = 0; $i < count( $temas ); $i++ ) {
                    if( in_array( $temas[$i]->term_id, $post_categories) ) {
                        $post_theme = $temas[$i]->name;
                    }
                }

                $local = do_shortcode("[types field='concurso-foto-local']");
                $autor = do_shortcode("[types field='concurso-foto-autor']");
                $data = do_shortcode("[types field='concurso-foto-data']");

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


            <div id="post" class="post-concurso">

                <small class="data"><?php the_time("d"); ?> de <?php the_time("F"); ?> de <?php the_time("Y"); ?></small>
                <h2><?php the_title(); ?></h2>
                <h3><?php echo do_shortcode("[types field='titulo']"); ?></h3>

                <div class="entry">

                    <?php 
                        the_post_thumbnail('concurso-fotografia-maior');
                        $foto = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full');
                    ?>

                    <p class="link-download">
                        <a href="<?php echo $foto[0]; ?>" target="_blank">Baixar Foto</a>
                        <a href="javascript:window.print()">Imprimir Relatório</a>
                    </p>

                </div>

                <div class="dados-foto">

                    <p><strong>Titulo:</strong> <?php the_title(); ?></p>
                    <p><strong>Categoria:</strong> <?php echo $post_category; ?></p>
                    <p><strong>Tema:</strong> <?php echo $post_theme; ?></p>

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
                    <p><?php the_post_thumbnail( 'concurso-fotografia-thumb' ); ?></p>

                </div>

                <div class="compartilhar">

                    <a href="https://twitter.com/share" class="twitter-share-button" data-lang="pt">Tweetar</a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                    <!-- Place this tag where you want the +1 button to render. -->
                    <div class="g-plusone" data-size="medium" data-annotation="inline" data-width="120"></div>

                    <!-- Place this tag after the last +1 button tag. -->
                    <script type="text/javascript">
                        window.___gcfg = {lang: 'pt-BR'};

                        (function() {
                            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                            po.src = 'https://apis.google.com/js/plusone.js';
                            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                        })();
                    </script>            
                    <!-- <div class="fb-like" data-href="<?php the_permalink(); ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div> -->            

                </div>


                <?php endwhile; ?>
            <?php else : ?>
                <h2>Nada encontrado</h2>
            <?php endif; ?>            





    </div>




</div>


<?php get_footer(); ?>
