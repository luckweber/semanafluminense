<?php
  $post = $wp_query->post;

 if (in_category('noticias')) {
      include(TEMPLATEPATH.'/single-default.php'); 
  } else {
      include(TEMPLATEPATH.'/single-default.php');
}
?>