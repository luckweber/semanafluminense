
<?php
if(isset($_POST['name'])){
    $input = $_POST['name'];
    //echo $get;
}

if(isset($_POST['cat'])){
    $select = $_POST['cat'];
} 

if(isset($_POST['num'])){
    $page = $_POST['num'];
}

$wp_analytify = new WP_Analytify_Simple();

$url = $_SERVER['REQUEST_URI'];

?>
<div class="wrap">
    <h2 class='opt-title'><span id='icon-options-general' class='analytics-options'><img src="<?php echo plugins_url('vote-plus-coc/images/list-alt-32.png'); ?>" alt=""></span>
        <?php echo __('Listas de Imagens Votadas', 'wp-analytify'); ?>
    </h2>
<br>



<form id="form" action="<?php echo admin_url();?>admin.php?page=painel-votacao" method="post">
      <?php if($input != ""){
            
            echo '<label>
            Nome do Poste
            <input type="text" value="'.$input.'" name="name"/>
        </label>';
            
        }else{
            echo '<label>
            Nome do Poste
            <input type="text" name="name"/>
        </label>';
        }
        ?>
        
       
    
    
     

<?php
$args = array(
   'public'   => true,
);
  
$output = 'objects'; // 'names' or 'objects' (default: 'names')
$operator = 'and'; // 'and' or 'or' (default: 'and')
  
$post_types = get_post_types( $args, $output, $operator );
  
if ( $post_types ) { // If there are any custom public post types.
  
    echo '<select  class="cat" name="cat">';
   
    
    if($select != ""){
        echo'<option>'.$select.'</option>';
        echo'<option>todos</option>';
    }else{
         echo'<option>todos</option>';
    }
	
	$categoria = get_category_by_slug("programacao");
    $categoriasoque = get_categories("child_of=" . $categoria->term_id . '&hide_empty=0');

  
    foreach ( $categoriasoque  as $post_type ) {
        
        echo '<option value=" '. $post_type->name .'">' . $post_type->name. '</option>';
		
	
	}
  
    echo '</select>';
  
}
?>
   <?php if($page ==""){ 
       echo'
   <select class="num" name="num">
        <option>'.$page.'</option>
        <option>10</option>
        <option>25</option>
        <option>50</option>
        <option>100</option>
        <option>200</option>
		<option>500</option>
		<option>1000</option>
    </select> ';
   }else{
        echo'
   <select class="num" name="num">
        <option>'.$page.'</option>
        <option>10</option>
        <option>25</option>
        <option>50</option>
        <option>100</option>
        <option>200</option>
		<option>500</option>
		<option>1000</option>
    </select> ';
   }
   
   ?>
 <input type="submit" value="Pesquisar" />
        
 </form>
  

    
    <?php
    global $wpdb;
    
// example args
    
    
    if($page !=""){
        $pages = $page;
    }else{
        $pages = 10;
    }
    
    if($input != "" and $select =="todos"){
        $args = array('post_type'=> 'programacao', 's' => $input,  'posts_per_page' => $pages );
        
       }else if($select != "todos" and $input == ""){
        $args = array( 'post_type'=> 'programacao', 'category_name' => $select, 'posts_per_page' => $pages );
          
    }else if($select != "todos" and $input !== ""){
        $args = array( 'post_type' => $select, 's' => $input, 'posts_per_page' => $pages );
        
    }
   
  
    
    
    $the_query = new WP_Query( $args );
    ?>


   

    <?php if ($the_query->have_posts()) : ?>
        <table>
            <thead>
                <tr>
                    <th scope="col" colspan="2">Nome do Poster</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Votos</th>
                     <th scope="col">Editar</th>
                </tr>
            </thead>
            <tbody>
                <!-- start of the secondary loop -->
                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>

                    <tr>
                        <td>
                            
                            <strong class="book-title"><a  title="Abrir em outro aba" target="_blank" href="<?php the_permalink(); ?>"><img src="<?php echo plugins_url('vote-plus-coc/images/1473008732_ic_open_in_new_48px.png'); ?>" ><?php the_title(); ?></a></strong>
                            <span class="text-offset">by Steve Krug<?php the_attachment_link($attachment->ID, false); ?></span>
                        </td>
                        <td class="item-stock"> <?php
                            if (has_post_thumbnail()) {
                                $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large');
                                if (!empty($large_image_url[0])) {
                                    echo '<a class="lightbox"  href="' . esc_url($large_image_url[0]) . '" title="' . the_title_attribute(array('echo' => 0)) . '">';
                                    echo get_the_post_thumbnail($post->ID, 'thumbnail');
                                    echo '</a>';
                                }
                            }
                            ?></td>
                        <td class="item-qty"> <?php echo get_edit_post_link( $id, $context ); ?> </td>
                        <td class="item-price"> <?php echo $photo_votes = (int)get_post_meta( get_the_ID(), 'votes', true );?></td>
                        <td class="item-price"><a href="<?php echo get_edit_post_link( $id, $context ); ?>"><img src="<?php echo plugins_url('vote-plus-coc/images/1472924210_pen-checkbox.png'); ?>" alt="" /></a> </td>
                    </tr>
    <?php endwhile; ?>
                <!-- end of the secondary loop -->
            </tbody>
        </table>

        <!-- put pagination functions here -->

        <!-- reset the main query loop -->
        <?php wp_reset_postdata(); ?>

<?php else: ?>

        <p><?php _e('Desculpa Poste Não encontrado".'); ?></p>

<?php endif; ?>
</div>


  <script>
        jQuery(document).ready(function( $ ) {
            $(".cat").on('change', function(){
                
                name =  $(".cat option:selected").text();
                $("#form").submit();
             
            });
            
            
            $(".num").on('change', function(){
                
                $("#form").submit();
             
            });
    });
    </script>