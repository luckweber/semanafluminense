<?php>
public function wpa_styles( $page ) {

    wp_enqueue_style( 'wp-analytify-style', plugins_url('css/style.css', __FILE__));
	}
	
		add_action( 'admin_enqueue_scripts', array( $this, 'wpa_styles') );


?>

<ul>
<?php $the_query = new WP_Query( array( 'category__in' => 1 ) );?>

<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>

<li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>

<li><?php the_excerpt(__('(more…)')); ?></li>
<li><?php  echo get_the_post_thumbnail( $post->ID, 'thumbnail' ); ?></li>


<?php 
endwhile;
wp_reset_postdata();
?>
</ul>


<div class="wrapper">
  
  <div class="table">
    
    <div class="row header">
      <div class="cell">
        Name
      </div>
      <div class="cell">
        Age
      </div>
      <div class="cell">
        Occupation
      </div>
      <div class="cell">
        Location
      </div>
    </div>
    
    <div class="row">
      <div class="cell">
        Luke Peters
      </div>
      <div class="cell">
        25
      </div>
      <div class="cell">
        Freelance Web Developer
      </div>
      <div class="cell">
        Brookline, MA
      </div>
    </div>
    
    <div class="row">
      <div class="cell">
        Joseph Smith
      </div>
      <div class="cell">
        27
      </div>
      <div class="cell">
        Project Manager
      </div>
      <div class="cell">
        Somerville, MA
      </div>
    </div>
    
    <div class="row">
      <div class="cell">
        Maxwell Johnson
      </div>
      <div class="cell">
        26
      </div>
      <div class="cell">
        UX Architect & Designer
      </div>
      <div class="cell">
        Arlington, MA
      </div>
    </div>
    
    <div class="row">
      <div class="cell">
        Harry Harrison
      </div>
      <div class="cell">
        25
      </div>
      <div class="cell">
        Front-End Developer
      </div>
      <div class="cell">
        Boston, MA
      </div>
    </div>
    
  </div>
  
  <div class="table">
    
    <div class="row header green">
      <div class="cell">
        Product
      </div>
      <div class="cell">
        Unit Price
      </div>
      <div class="cell">
        Quantity
      </div>
      <div class="cell">
        Date Sold
      </div>
      <div class="cell">
        Status
      </div>
    </div>
    
    <div class="row">
      <div class="cell">
        Solid oak work table
      </div>
      <div class="cell">
        $800
      </div>
      <div class="cell">
        10
      </div>
      <div class="cell">
        03/15/2014
      </div>
      <div class="cell">
        Waiting for Pickup
      </div>
    </div>
    
    <div class="row">
      <div class="cell">
        Leather iPhone wallet
      </div>
      <div class="cell">
        $45
      </div>
      <div class="cell">
        120
      </div>
      <div class="cell">
        02/28/2014
      </div>
      <div class="cell">
        In Transit
      </div>
    </div>
    
    <div class="row">
      <div class="cell">
        27" Apple Thunderbolt displays
      </div>
      <div class="cell">
        $1000
      </div>
      <div class="cell">
        25
      </div>
      <div class="cell">
        02/10/2014
      </div>
      <div class="cell">
        Delivered
      </div>
    </div>
    
    <div class="row">
      <div class="cell">
        Bose studio headphones
      </div>
      <div class="cell">
        $60
      </div>
      <div class="cell">
        90
      </div>
      <div class="cell">
        01/14/2014
      </div>
      <div class="cell">
        Delivered
      </div>
    </div>
    
  </div>
  
  <div class="table">
    
    <div class="row header blue">
      <div class="cell">
        Username
      </div>
      <div class="cell">
        Email
      </div>
      <div class="cell">
        Password
      </div>
      <div class="cell">
        Active
      </div>
    </div>
    
    <div class="row">
      <div class="cell">
        ninjalug
      </div>
      <div class="cell">
        misterninja@hotmail.com
      </div>
      <div class="cell">
        ************
      </div>
      <div class="cell">
        Yes
      </div>
    </div>
    
    <div class="row">
      <div class="cell">
        jsmith41
      </div>
      <div class="cell">
        joseph.smith@gmail.com
      </div>
      <div class="cell">
        ************
      </div>
      <div class="cell">
        No
      </div>
    </div>
    
    <div class="row">
      <div class="cell">
        1337hax0r15
      </div>
      <div class="cell">
        hackerdude1000@aol.com
      </div>
      <div class="cell">
        ************
      </div>
      <div class="cell">
        Yes
      </div>
    </div>
    
    <div class="row">
      <div class="cell">
        hairyharry19
      </div>
      <div class="cell">
        harryharry@gmail.com
      </div>
      <div class="cell">
        ************
      </div>
      <div class="cell">
        Yes
      </div>
    </div>
    
  </div>
  
</div>