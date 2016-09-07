<?php
/* Template name: Votos */
get_header("internas"); ?>

<div id="content">


    <?php include "acessibilidade.php"; ?>


    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>    


            <div id="post">




                    <div class="entry">

                        <?php the_content(); ?>
                        
                        
                        
                        <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Votos poesias')) : else : ?><?php endif; ?>
                        <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Votos fotografias')) : else : ?><?php endif; ?>
                        
                        
                        <h2>Fotografias</h2>
                        
                        <?php
                        
                            global $post;
                            $results = PostRatings()->getTopRated("post_type=fotografias&number=100");

                            foreach($results as $post){
                            setup_postdata($post); ?>


                            <p>
                                <?php the_title(); ?> - <strong><?php printf(_n('%d voto', '%d votos', $post->votes), $post->votes); ?></strong><br />
                                T&iacute;tulo da obra: <?php echo do_shortcode("[types field='titulo']"); ?><br />
                                <?php the_taxonomies(); ?>
                            <hr>
                            </p>

                            <?php } wp_reset_postdata(); ?>
                        
                        
                            
                            
                        <h2 style="margin-top:150px;">Poesias</h2>
                        
                        <?php
                        
                            global $post;
                            $results = PostRatings()->getTopRated("post_type=poesias&number=100");

                            foreach($results as $post){
                            setup_postdata($post); ?>


                            <p>
                                <?php the_title(); ?> - <strong><?php printf(_n('%d voto', '%d votos', $post->votes), $post->votes); ?></strong><br />
                                T&iacute;tulo da obra: <?php echo do_shortcode("[types field='titulo']"); ?><br />
                                <?php the_taxonomies(array("")); ?>
                            <hr>
                            </p>

                            <?php } wp_reset_postdata(); ?>                            
                            
                             
                            
                            

                    </div>

               
                 
                    


                <?php endwhile; ?>
            <?php else : ?>
                <h2>Nada encontrado</h2>
            <?php endif; ?>            





    </div>




</div>


<?php get_footer(); ?>
