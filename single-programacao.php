<?php get_header("internas"); ?>

<div id="content">

    <?php
        global $post;
        if (have_posts()) : while (have_posts()) : 

            the_post();

            $start_date = do_shortcode( "[types field='event-start-date']" );
            $start_time = do_shortcode( "[types field='event-start-date' format='H:i']" );

            $end_date = do_shortcode( "[types field='event-start-date']" );
            $end_time = do_shortcode( "[types field='event-end-date' format='H:i']" );

            $event_time = ( isset( $end_time ) && ( $start_time === $end_time ) ) ? $start_time : $start_time . ' às ' . $end_time;

            if( empty( $start_date ) ) continue;
            
            list( $day, $month, $year ) = explode( '/', $start_date );
            list( $hour, $minute ) = explode( ':', $start_time );

            $months = array(
                'Jan', 'Fev', 'Mar', 'Abr',
                'Mai', 'Jun', 'Jul', 'Ago',
                'Set', 'Out', 'Nov', 'Dez'
            );

            $event_city = do_shortcode("[types field='cidade']");
            $event_venue = do_shortcode("[types field='event-venue']");
            $event_address = do_shortcode("[types field='event-address']");
            $event_ticket = do_shortcode("[types field='event-ticket-price']");

            // Dados do Proponente
            $event_proponent = array();
            $event_proponent['name'] = do_shortcode("[types field='event-proponent-name']");
            $event_proponent['email'] = do_shortcode("[types field='event-proponent-email']");
            $event_proponent['site'] = do_shortcode("[types field='event-proponent-site']");
            $event_proponent['phone'] = do_shortcode("[types field='event-proponent-phone']");

            // Dados do Responsavel
            $event_owner = array();
            $event_owner['name'] = do_shortcode("[types field='event-owner-name']");
            $event_owner['email'] = do_shortcode("[types field='event-owner-email']");
            $event_owner['phone'] = do_shortcode("[types field='event-owner-phone']");

            // Dados do Contato
            $event_contact = array();
            $event_contact['name'] = do_shortcode("[types field='event-contact-name']");
            $event_contact['email'] = do_shortcode("[types field='event-contact-email']");
            $event_contact['phone'] = do_shortcode("[types field='event-contact-phone']");
        ?>

            <div id="post" class="post-programacao">


                    <div class="data">
                        <span class="dia"><?php echo $day; ?></span> 
                        <span class="mes"><?php echo $months[ (int)$month - 1 ]; ?></span>
                    </div>


                    <div class="local-titulo">    
                        <div class="cidade"><?php echo $event_city; ?></div>
                        <div class="horario"><?php echo $event_time; ?></div>
                        <h2><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h2>
                        <div class="local"><?php echo $event_venue . ' - ' . $event_address; ?></div>
                    </div>

                <div class="entry">

                    <?php if( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail( array( 580, 400 ), array( 'alt' => get_the_title(), 'title' => get_the_title(), 'style' => 'margin-bottom: 20px;' ) ); ?>
                    <?php endif; ?>

                    <?php the_content(); ?>

                    <h3>Dados do Contato</h3>

                    <?php

                        // Se tiver os dados do contato
                        if( isset( $event_contact['name'] ) && $event_contact['name'] != '' ) :
                            echo '<p class="nome"><strong>Nome:</strong> ' . $event_contact['name'] . '</p>' . "\n";
                            echo '<p class="email"><strong>E-mail:</strong> ' . $event_contact['email'] . '</p>' . "\n";
                            echo '<p class="telefone"><strong>Telefone:</strong> ' . $event_contact['phone'] . '</p>' . "\n";
                        else :
                            // Se tiver os dados do responsável
                            if( isset( $event_owner['name'] ) && $event_owner['name'] != '' ) :
                                echo '<p class="nome"><strong>Nome:</strong> ' . $event_owner['name'] . '</p>' . "\n";
                                echo '<p class="email"><strong>E-mail:</strong> ' . $event_owner['email'] . '</p>' . "\n";
                                echo '<p class="telefone"><strong>Telefone:</strong> ' . $event_owner['phone'] . '</p>' . "\n";
                            else:
                                // Se tiver os dados do proponente
                                if( isset( $event_proponent['name'] ) && $event_proponent['name'] != '' ) :
                                    echo '<p class="nome"><strong>Nome:</strong> ' . $event_proponent['name'] . '</p>' . "\n";
                                    echo '<p class="email"><strong>E-mail:</strong> ' . $event_proponent['email'] . '</p>' . "\n";
                                    echo '<p class="telefone"><strong>Telefone:</strong> ' . $event_proponent['phone'] . '</p>' . "\n";
                                    if( isset( $event_proponent['site'] ) && $event_proponent['site'] != '' ) :
                                        echo '<p class="site"><strong>Site:</strong> <a href="//' . $event_proponent['site'] . '" title="' . $event_owner['name'] . '" target="_blank">' . $event_proponent['site'] . '</a></p>' . "\n";
                                    endif;
                                endif;
                            endif;
                        endif;

                    ?>
                    
                    <?php if( isset( $event_ticket ) && !empty( $event_ticket ) ) : ?>
                    <div class="preco"><strong>Inscrição:</strong> R$ <?php echo $event_ticket; ?></div>
                    <?php else: ?>
                    <div class="preco"><strong>Inscrição:</strong> Evento Gratuito</div>
                    <?php endif; ?>

                </div>

                <?php if ( isset( $event_address ) && !empty( $event_address ) ) : ?>

                    <div class="como-chegar">
                        <strong>Como chegar</strong>

                        <div class="localizacao">

                            <div class="map">
                                <iframe 
                                    frameborder="0" 
                                    scrolling="no" 
                                    marginheight="0" 
                                    marginwidth="0" 
                                    src="https://maps.google.com.br/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?php echo $event_address . ', ' . $event_city . ', Rio de Janeiro'; ?>&amp;aq=0&amp;oq=<?php echo $event_address . ', ' . $event_city . ', Rio de Janeiro'; ?>&amp;ie=UTF8&amp;t=m&amp;z=14&amp;output=embed"></iframe>
                            </div>
                        </div>

                    </div>

                <?php endif; ?>

                <div class="veja-mais">
                    <!--<h4>Outros eventos</h4>-->

                    <div id="listagem-posts">

                        <?php $temp_query = $wp_query; ?>
                        <?php $cont = 0; ?>
                        <?php

                            $args_related = array(
                                'post_type' => 'programacao',
                                'posts_per_page' => 4,
                                'meta_key' => 'wpcf-event-start-date',
                                'orderby' => 'rand',
                                'order' => 'ASC',
                                'meta_query' => array(
                                    array(
                                        'key' => 'wpcf-event-start-date'
                                    ),
                                    array(
                                        'key' => 'wpcf-cidade',
                                        'value' => $event_city
                                    )
                                )
                            );

                        ?>
                        <?php $secondary_post = new WP_Query( $args_related ); ?>
                        <?php 
                            if( $secondary_post->have_posts() ) : while ( $secondary_post->have_posts() ) : 

                                $secondary_post->the_post();

                                // Exclui o evento principal da lista de eventos relacionados
                                if( $post->ID !== get_the_ID() ) :

                                    $start_date = do_shortcode( "[types field='event-start-date']" );
                                    $start_time = do_shortcode( "[types field='event-start-date' format='H:i']" );

                                    $end_date = do_shortcode( "[types field='event-start-date']" );
                                    $end_time = do_shortcode( "[types field='event-end-date' format='H:i']" );

                                    $event_time = ( isset( $end_time ) && ( $start_time === $end_time ) ) ? $start_time : $start_time . ' às ' . $end_time;

                                    list( $day, $month, $year ) = explode( '/', $start_date );
                                    list( $hour, $minute ) = explode( ':', $start_time );

                                    $months = array(
                                        'Jan', 'Fev', 'Mar', 'Abr',
                                        'Mai', 'Jun', 'Jul', 'Ago',
                                        'Set', 'Out', 'Nov', 'Dez'
                                    );

                                    $event_city = do_shortcode("[types field='cidade']");
                                    $event_venue = do_shortcode("[types field='event-venue']");
                                    $event_address = do_shortcode("[types field='event-address']");


                        ?>                         

                            <div class="post<?php echo $cont == 0 ? " first" : ""; ?>">

                                <div class="data">
                                    <span class="dia"><?php echo $day; ?></span> 
                                    <span class="mes"><?php echo $months[ (int)$month - 1 ]; ?></span>
                                </div>

                                <div class="local-titulo">    
                                    <div class="cidade"><?php echo $event_city; ?></div>
                                    <div class="horario"><?php echo $event_time; ?></div>
                                    <h2><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h2>
                                    <div class="local"><?php echo $event_venue . ' - ' . $event_address; ?></div>                        
                                    <p><a href="<?php the_permalink(); ?>" title="<?php echo excerpt(20); ?>"><?php echo excerpt(20); ?></a></p>
                                </div>


                            </div>

                            <?php 
                                $cont++;
                                endif; endwhile; endif;
                                wp_reset_query();
                            ?>

                    </div>

                </div>


            </div>


        <?php endwhile; ?>
    <?php else : ?>
        <h2>Não há eventos cadastrados no momento.</h2>
    <?php endif; ?>    


<?php get_sidebar(); ?>



</div>


<?php get_footer(); ?>
