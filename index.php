<?php 

/* Template name: Home */

get_header();

?>

<div id="content" >

    <div id="listagem-posts">
	
	

        <?php
		
		if(isset($_POST["quando"])){
			//echo '<script>alert("'.$_POST["quando"].'")</script>';
		}
		
		$year = date('Y');
		
		$page = ( get_query_var('page') ) ? get_query_var('page') : 1;


            $months = array(
                'Jan', 'Fev', 'Mar', 'Abr',
                'Mai', 'Jun', 'Jul', 'Ago',
                'Set', 'Out', 'Nov', 'Dez'
            );
			
		if ((isset($_POST["oque"]) || isset($_POST["quando"]) || isset($_POST["cidade"])) && ($_POST["oque"] != "" || isset($_POST["quando"]) || $_POST["cidade"] != "")) {

            $args = array(
            'post_type' => 'programacao',
            'category_name' => 'programacao',
            'orderby' => 'wpcf-event-start-date',
            'order' => 'desc',
			"meta_key" => "wpcf-event-start-date",
            'posts_per_page' => -1,
			'meta_query'=> array(
				  array(
					  'key' => 'wpcf-event-start-date',
					  'compare' => '>=', 
					  'value' => strtotime($year.'-01-01'),
					  'type' => 'numeric'
				   )
			)
			
			
			);

            $args['meta_query'] = array( 
                'relation' => 'AND'
            );

            if (isset($_POST["oque"]) && $_POST["oque"] != "") {
                unset($args["category_name"]);
                if ( (int)$_POST["oque"] > 0)
                    $args["cat"] = $_POST["oque"];
                else
                    $args["category_name"] = "programacao";
            }

            if (isset($_POST["quando"]) && $_POST["quando"] != "") {

                $arr_quando = array(
                    'key' => 'wpcf-event-start-date',
					  'compare' => 'between', 
					  'value' => array(
						strtotime($_POST["quando"] . ' 00:00'),
						strtotime($_POST["quando"] . ' 23:59')
                    ),
					  'type' => 'numeric'
                   
                );

                array_push( $args['meta_query'], $arr_quando);

            }

            if (isset($_POST["cidade"]) && $_POST["cidade"] != "") {

                $arr_cidade = array(
                    'key' => 'wpcf-cidade',
                    'value' => $_POST["cidade"],
                );

                array_push( $args['meta_query'], $arr_cidade);

            }

        } else {
			

		
		
			$args = array(
            'post_type' => 'programacao',
            'category_name' => 'programacao',
            'orderby' => 'wpcf-event-start-date',
            'order' => 'desc',
			"meta_key" => "wpcf-event-start-date",
            'posts_per_page' => -1,
			'meta_query'=> array(
				  array(
					  'key' => 'wpcf-event-start-date',
					  'compare' => 'between', 
					  'value' => array(
						strtotime($year.'-01-01'),
						strtotime($year.'-12-31')
                    ),
                   
					  'type' => 'numeric'
				   )
			)
			
			
			);

        }
		
		query_posts( $args ); 

        ?>


	<?php
$day_check = '';

$cont = 0;
        if( $wp_query->have_posts() ) :
		
while (have_posts()) : the_post();
	$start_date = do_shortcode( "[types field='event-start-date']" );
	
	$get_day = do_shortcode( "[types field='event-start-date' format='d' ]" );
	$get_month = do_shortcode( "[types field='event-start-date' format='m' ]" );
	$get_year = do_shortcode( "[types field='event-start-date' format='y' ]" );
	$dt = DateTime::createFromFormat('y', $get_year);
	
	$start_time = do_shortcode( "[types field='event-start-date' format='H:i']" );

	$end_date = do_shortcode( "[types field='event-start-date']" );
	$end_time = do_shortcode( "[types field='event-end-date' format='H:i']" );

	$event_time = ( isset( $end_time ) && ( $start_time === $end_time ) ) ? $start_time : $start_time . ' às ' . $end_time;

	list( $day, $month, $year ) = explode( '/', $start_date );
	list( $hour, $minute ) = explode( ':', $start_time );

	$event_city = do_shortcode( "[types field='cidade']" );
	$event_venue = do_shortcode( "[types field='event-venue']" );
  
  
	$day = $get_day;
	
	//date('d-m-Y', $start_date);
  
  
  if ($day != $day_check) {
    if ($day_check !== '') {
      echo '</div>'; // close the list here
    }
	$month1 = date("y",strtotime($start_date));
    echo '<div class="post"><div class="data">
                        <span class="dia">'.$day.'</span>' 
                        .'<span class="mes">'.$months [intval($get_month)-1].'</span><span class="ano">'.$dt->format('Y').'</span>'
                    .'</div>' ;
  }
  
  
  $day_check = $day;
?>
<div class="local-titulo">    
	<div class="cidade"><?php echo $event_city;?></div>
	<div class="horario"><?php echo $event_time; ?></div>
	<h2><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h2>
	<div class="local"><?php echo $event_venue; ?></div>                        
	<p><a href="<?php the_permalink(); ?>" title="<?php echo excerpt(20); ?>"><?php echo excerpt(20); ?></a></p>
	<br>
	<br>
</div>
<?php
$cont++;
endwhile; ?>
</div>
<?php else : ?>
            <div class="post">
                <h2>A programação da Semana Fluminense Não encontrada.</h2>
            </div>
        <?php endif; ?>
	
    </div>
	
	

<?php get_sidebar(); ?>

</div>


<?php get_footer(); ?>
