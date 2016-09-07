<?php get_header("internas"); ?>





</script>

<div id="content">

	<?php get_template_part('acessibilidade'); ?>
	
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>    


            <div id="post" class="single-patrimonio">

                    <h2><?php the_title(); ?></h2>
                    <?php if( do_shortcode("[types field='subtitulo']") != '' ) : ?>
                    <h3><?php echo do_shortcode("[types field='subtitulo']"); ?></h3>
                    <?php endif; ?>

                    <div class="entry">

                        <?php the_content(); ?>      
						
						
						<?php 
							$latitude = do_shortcode("[types field='latitude']");
            				$longitude = do_shortcode("[types field='longitude']");

            				if($latitude && $longitude):
            			?>

								<div id="single-mapa-patrimonio" class="single-mapa-patrimonio js-single-mapa-patrimonio" lat="<?php echo $latitude;?>" lng="<?php echo $longitude;?>">
									

								</div>
						<?php endif; ?>

						<?php if( do_shortcode("[types field='subtitulo']") != '' )?>
                    </div>

                    <div class="compartilhar">

                        <a href="https://twitter.com/share" class="twitter-share-button" data-lang="pt">Tweetar</a>
                        <script type="text/javascript">!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
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
                        <div class="fb-like" data-href="<?php the_permalink(); ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>            

                    </div>


                <?php endwhile; ?>
            <?php else : ?>
                <h2>Nada encontrado</h2>
            <?php endif; ?>            





    </div>

    <?php get_sidebar('patrimonio-cultural'); ?>



</div>




<?php get_footer(); ?>
