<?php

// Add RSS links to <head> section
add_theme_support( 'automatic-feed-links' );



// Get jquery Latest Version
function sfp_latest_jquery() {
    wp_deregister_script('jquery');
    wp_register_script('jquery', ("http://code.jquery.com/jquery-latest.js"), false);
    wp_enqueue_script('jquery');
}

// Load jQuery
if (!is_admin()) {
    add_action( 'wp_enqueue_scripts', 'sfp_latest_jquery' );
}

/**
 * Clean up wp_head()
 *
 * Remove unnecessary <link>'s
 * Remove inline CSS used by Recent Comments widget
 * Remove inline CSS used by posts with galleries
 * Remove self-closing tag and change ''s to "'s on rel_canonical()
 */
function sfp_head_cleanup() {
  // Originally from http://wpengineer.com/1438/wordpress-header/
  remove_action('wp_head', 'feed_links', 2);
  remove_action('wp_head', 'feed_links_extra', 3);
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

  global $wp_widget_factory;
  remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));

  add_filter('use_default_gallery_style', '__return_null');

  if (!class_exists('WPSEO_Frontend')) {
    remove_action('wp_head', 'rel_canonical');
    add_action('wp_head', 'sfp_rel_canonical');
  }
}

function sfp_rel_canonical() {
  global $wp_the_query;

  if (!is_singular()) {
    return;
  }

  if (!$id = $wp_the_query->get_queried_object_id()) {
    return;
  }

  $link = get_permalink($id);
  echo "\t<link rel=\"canonical\" href=\"$link\">\n";
}
add_action('init', 'sfp_head_cleanup');

/**
 * Remove the WordPress version from RSS feeds
 */
add_filter('the_generator', '__return_false');

/**
 * Automatically move JavaScript code to page footer, speeding up page loading time.
 */
remove_action('wp_head', 'wp_print_scripts');
remove_action('wp_head', 'wp_print_head_scripts', 9);
remove_action('wp_head', 'wp_enqueue_scripts', 1);
add_action('wp_footer', 'wp_print_scripts', 5);
add_action('wp_footer', 'wp_enqueue_scripts', 5);
add_action('wp_footer', 'wp_print_head_scripts', 5);

if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => 'Sidebar Widgets',
        'id' => 'sidebar-widgets',
        'description' => 'These are widgets for the sidebar.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    ));
}
if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => 'Flickr',
        'id' => 'sidebar-flickr',
        'description' => 'Widget do Flickr aqui',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    ));
}

/* Exibir Home no menu */

function home_page_menu_args($args) {
    $args['show_home'] = true;
    return $args;
}

add_filter('wp_page_menu_args', 'home_page_menu_args');
add_action('init', 'register_custom_menu');

function register_custom_menu() {
    register_nav_menu('custom_menu', __('Custom Menu'));
}

/* Esconder menu */
add_filter('show_admin_bar', '__return_false');

/* Thumbnails */
add_theme_support('post-thumbnails');
add_image_size('listagem', 160, 120, true);
add_image_size('listagem-videos', 100, 56, true);
add_image_size('slider-patrimonio', 325, 185, true);
add_image_size('slider-noticias', 100, 75, true);
add_image_size('concurso-fotografia-thumb', 302, 225, true);
add_image_size('concurso-fotografia-maior', 800, 533, true);
add_image_size('maps-thumb', 92, 92, true);
add_image_size('header-destaques', 670, 295, true);

/* Add Excerpts to Pages */
add_action('init', 'my_add_excerpts_to_pages');

function my_add_excerpts_to_pages() {
    add_post_type_support('page', 'excerpt');
}

//Begin Breadcrumb
function the_breadcrumb() {
    $delimiter = '<div class="limiter">&gt;</div>';
    $home = 'In&iacute;cio'; // text for the 'Home' link
    $before = '<li>'; // tag before the current crumb
    $after = '</li>'; // tag after the current crumb

    if (!is_home() && !is_front_page() || is_paged()) {

        echo '<div id="breadcrumb"><strong>Voc&ecirc; est&aacute; aqui: </strong> <ul>';

        global $post;
        $homeLink = get_bloginfo('url');
        echo '<li class="home"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

        if (is_category()) {
            global $wp_query;
            $cat_obj = $wp_query->get_queried_object();
            $thisCat = $cat_obj->term_id;
            $thisCat = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);
            if ($thisCat->parent != 0)
                echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
            echo $before . single_cat_title('', false) . '' . $after;
        } elseif (is_day()) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
            echo $before . get_the_time('d') . $after;
        } elseif (is_month()) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo $before . get_the_time('F') . $after;
        } elseif (is_year()) {
            echo $before . get_the_time('Y') . $after;
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
                echo $before . get_the_title() . $after;
            } else {
                $cat = get_the_category();
                $cat = $cat[0];
                echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                echo $before . get_the_title() . $after;
            }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;
        } elseif (is_attachment()) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID);
            $cat = $cat[0];
            echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
            echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
            echo $before . get_the_title() . $after;
        } elseif (is_page() && !$post->post_parent) {
            echo $before . get_the_title() . $after;
        } elseif (is_page() && $post->post_parent) {
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb)
                echo $crumb . ' ' . $delimiter . ' ';
            echo $before . get_the_title() . $after;
        } elseif (is_search()) {
            echo $before . 'Search results for "' . get_search_query() . '"' . $after;
        } elseif (is_tag()) {
            echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo $before . 'Articles posted by ' . $userdata->display_name . $after;
        } elseif (is_404()) {
            echo $before . 'Error 404' . $after;
        }

        if (get_query_var('paged')) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ' (';
            echo __('Page') . ' ' . get_query_var('paged');
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ')';
        }

        echo '</ul></div>';
    }
}

//Limitar resumo
function excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt) . '...';
    } else {
        $excerpt = implode(" ", $excerpt);
    }
    $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
    return $excerpt;
}

// Paginacao - Versao 2012
/*
function wp_corenavi() {
  global $wp_query, $wp_rewrite;
  $pages = '';
  $max = $wp_query->max_num_pages;
  if (!$current = get_query_var('paged')) $current = 1;
  $a['base'] = ($wp_rewrite->using_permalinks()) ? user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' ) : @add_query_arg('paged','%#%');
  if( !empty($wp_query->query_vars['s']) ) $a['add_args'] = array( 's' => get_query_var( 's' ) );
  $a['total'] = $max;
  $a['current'] = $current;

  $total = 1; //1 - display the text "Page N of N", 0 - not display
  $a['mid_size'] = 5; //how many links to show on the left and right of the current
  $a['end_size'] = 1; //how many links to show in the beginning and end
  $a['prev_text'] = '&laquo;'; //text of the "Previous page" link
  $a['next_text'] = '&raquo;'; //text of the "Next page" link

  if ($max > 1) echo '<div class="navigation">';
  //if ($total == 1 && $max > 1) $pages = '<span class="pages">Page ' . $current . ' of ' . $max . '</span>'."\r\n";
  echo $pages . paginate_links($a);
  if ($max > 1) echo '</div>';
}
*/
//Fim Paginacao

// Paginacao - Versao 2014
function wp_corenavi() {
  global $wp_query, $wp_rewrite;
  $pages = '';
  $max = $wp_query->max_num_pages;
  if (!$current = get_query_var('paged')) $current = 1;

  list( $url, $params ) = explode( '?', get_pagenum_link( 1 ) );
  $params = ( !empty( $params ) ) ? '?' . $params : $params;
  
  $a['base'] = ( $wp_rewrite->using_permalinks() ) ? user_trailingslashit( trailingslashit( $url ) . 'page/%#%/' . $params, 'paged' ) : @add_query_arg('paged','%#%');

  if( !empty($wp_query->query_vars['s']) )
    $a['add_args'] = array( 's' => get_query_var( 's' ) );
  
  $a['total'] = $max;
  $a['current'] = $current;

  $total = 1; //1 - display the text "Page N of N", 0 - not display
  $a['mid_size'] = 5; //how many links to show on the left and right of the current
  $a['end_size'] = 1; //how many links to show in the beginning and end
  $a['prev_text'] = '&laquo;'; //text of the "Previous page" link
  $a['next_text'] = '&raquo;'; //text of the "Next page" link

  if ($max > 1) echo '<div class="navigation">';
  //if ($total == 1 && $max > 1) $pages = '<span class="pages">Page ' . $current . ' of ' . $max . '</span>'."\r\n";
  echo $pages . paginate_links($a);
  if ($max > 1) echo '</div>';
}
//Fim Paginacao

/* Adicionar CPT no RSS */
function myfeed_request($qv) {
	if (isset($qv['feed']) && !isset($qv['post_type']))
		$qv['post_type'] = array('post', 'programacao', 'videos', 'patrimonio-cultural', 'noticias');
	return $qv;
}
add_filter('request', 'myfeed_request');



add_action('wp_enqueue_scripts', 'wpmidia_enqueue_masked_input');
function wpmidia_enqueue_masked_input(){
 
     wp_enqueue_script('masked-input', get_template_directory_uri().'/js/jquery.maskedinput.min.js', array('jquery'));
 
}

add_action('wp_footer', 'wpmidia_activate_masked_input');
 
function wpmidia_activate_masked_input(){
        
    echo'
         <script type="text/javascript">
 
                jQuery( function($){
                 
                   
                    $("#proponente_cep").on("keyup", function(){
                        if($(this).val().length  == 9){
                            text = $(this).val();
                             vars =  "https://viacep.com.br/ws/"+text+"/json"; 
                            $.getJSON( vars, function( data ) {

                                //alert(data.bairro);
                                
                                $("#proponente_bairro").val(data.bairro);
                                $("#proponente_complemento").val(data.complemento);
                                $("#proponente_estado").val(data.uf);
                                $("#proponente_cidade").val(data.localidade);


                                //$(this).removeClass();    
                                //$(this).addClass("cep");  
                                //$(".cep").mask("99999-999");

                            });
                            }
                        

                    });
                    
                     $("#cep").on("keyup", function(){
                            if($(this).val().length  == 9){
                            text = $(this).val();
                             vars =  "https://viacep.com.br/ws/"+text+"/json"; 
                            $.getJSON( vars, function( data ) {

                                //alert(data.bairro);
                                
                                $("#grupo_bairro").val(data.bairro);
                                $("#grupo_complemento").val(data.complemento);
                                $("#grupo_estado").val(data.uf);
                                $("#grupo_cidade").val(data.localidade);


                                //$(this).removeClass();    
                                //$(this).addClass("cep");  
                                //$(".cep").mask("99999-999");

                            });
                            }
                       });   
                    

                    cpf_cnpf = $("#cpf_cnpj");
                    
                    
                    values = $("#select-razao").prop("selectedIndex"); 
                    
                    
                    if(values === 0){
                        cpf_cnpf.removeClass();
                        cpf_cnpf.addClass("cpf");

                    }else if(values === 1){
                        cpf_cnpf.removeClass();
                        cpf_cnpf.addClass("cnpj");
                    }
                    
                    select1 = $("#regiao");
                    selectValues1 = { "1": "Aperib�", "2": "Bom Jesus do Itabapoana", "3": "Campos dos Goytacazes ", "4": "Cardoso Moreira ", "5": "Cambuci", "6": "Italva", "7": "Itaperuna", "8": "Laje do Muria�", "9": "Natividade", "10": "Miracema", "11": "Maca� " ,"11": "Miracema" , "12": "S�o Fid�lis " , "13": "S�o Francisco de Itabapoana " , "14": "S�o Jo�o da Barra ", "15": "Santo Ant�nio de P�dua " , "16": "S�o Jos� de Ub� " , "17": "Varre-Sai "  };
                    selectValues2 = { "1": "Barra Mansa", "2": "Itatiaia", "3": "Pinheiral" , "4": "Pira�" , "5": "Porto Real" , "6": "Quatis" , "7": "Resende" , "8": "Rio Claro", "9": "Volta Redonda" };
                    selectValues3 = { "1": "Petr�polis", "2": "Teres�polis", "3": "S�o Jos� do Vale do Rio Preto" };
                    selectValues4 = { "1": "Belford Roxo", "2": "Cachoeiras de Macacu", "3": "Duque de Caxias", "4": "Guapimirim", "5": "Itabora�", "6": "Mag�", "7": "Maric�", "8": "Mesquita", "9": "Nil�polis", "10": "Niter�i", "11": "Nova Igua�u", "12": "Paracambi", "13": "Queimados", "14": "Rio Bonito", "15": "Rio de Janeiro", "16": "Serop�dica", "17": "S�o Gon�alo", "18": "S�o Jo�o de Meriti", "19": "Tangu�" };
                    selectValues5 = { "1": " Araruama", "2": "Arma��o dos B�zios", "3": "Arraial do Cabo", "4": "Cabo Frio", "5": "Iguaba Grande", "6": "S�o Pedro da Aldeia", "7": "Saquarema" };
                    selectValues6 = { "1": "Angra dos Reis", "2": "Ilha Grande", "3": "Mangaratiba", "4": "Itacuru�a","5": "Paraty" };
                    
                     a = $("#regiao").prop("selectedIndex"); 
                      select1.after("<p><label>Cidade<br><select name=cidade id=cidade required></select></label><p>");

                   if(a !== 0 ){
                      
                        if(a === 1){
                            $("#cidade").empty();
                            $.each(selectValues1, function(key, value) {
                            $("#cidade").append($("<option/>", {
                                value: value,
                                text: value
                            }));
                        });
                        $("#cidade").parent().show();
                        $("#cidade").show();
                        
                        }else if(a === 2){
                            $("#cidade").empty();
                            $.each(selectValues2, function(key, value) {
                            $("#cidade").append($("<option/>", {
                                value: value,
                                text: value
                            }));
                        });
                        $("#cidade").parent().show();
                        $("#cidade").show();
                        }else if(a === 3){
                            $("#cidade").empty();
                            $.each(selectValues3, function(key, value) {
                            $("#cidade").append($("<option/>", {
                                value: value,
                                text: value
                            }));
                        });
                        $("#cidade").parent().show();
                        $("#cidade").show();
                        }else if(a === 4){
                            $("#cidade").empty();
                            $.each(selectValues4, function(key, value) {
                            $("#cidade").append($("<option/>", {
                                value: value,
                                text: value
                            }));
                        });
                            $("#cidade").parent().show();
                            $("#cidade").show();
                       }else if(a === 5){
                            $("#cidade").empty();
                            $.each(selectValues5, function(key, value) {
                            $("#cidade").append($("<option/>", {
                                value: value,
                                text: value
                            }));
                        });
                            $("#cidade").parent().show();
                            $("#cidade").show();
                        }else if(a === 6){
                            $("#cidade").empty();
                            $.each(selectValues6, function(key, value) {
                            $("#cidade").append($("<option/>", {
                                value: value,
                                text: value
                            }));
                        });
                            $("#cidade").parent().show();
                            $("#cidade").show();
                        }


                    }else{
                    $("#cidade").hide();
                    $("#cidade").parent().hide();
                    }

                    
                     $("body").on("change", "#regiao", function(){
                        a = $(this).prop("selectedIndex"); 
                        
                        if(a === 0){
                            $("#cidade").parent().hide();
                            $("#cidade").show();
                            $("#cidade").empty();
                            $("#cidade").hide();
                        }else if(a === 1){
                            $("#cidade").empty();
                            $.each(selectValues1, function(key, value) {
                            $("#cidade").append($("<option/>", {
                                value: key,
                                text: value
                            }));
                        });
                        
                        $("#cidade").parent().show();
                            $("#cidade").show();
                        
                        }else if( a === 2){
                            $("#cidade").empty();
                            $.each(selectValues2, function(key, value) {
                            $("#cidade").append($("<option/>", {
                                value: key,
                                text: value
                            }));
                        });
                        
                             $("#cidade").parent().show();
                            $("#cidade").show();
                        }else if( a === 3){
                            $("#cidade").empty();
                            $.each(selectValues3, function(key, value) {
                            $("#cidade").append($("<option/>", {
                                value: key,
                                text: value
                            }));
                        });
                        
                             $("#cidade").show();
                        }else if( a === 4){
                            $("#cidade").empty();
                            $.each(selectValues4, function(key, value) {
                            $("#cidade").append($("<option/>", {
                                value: key,
                                text: value
                            }));
                        });
                        
                             $("#cidade").parent().show();
                            $("#cidade").show();
                        }else if( a === 5){
                            $("#cidade").empty();
                            $.each(selectValues5, function(key, value) {
                            $("#cidade").append($("<option/>", {
                                value: key,
                                text: value
                            }));
                        });
                        
                             $("#cidade").parent().show();
                            $("#cidade").show();
                        }else if( a === 6){
                            $("#cidade").empty();
                            $.each(selectValues6, function(key, value) {
                            $("#cidade").append($("<option/>", {
                                value: key,
                                text: value
                            }));
                        });
                        
                             $("#cidade").parent().show();
                            $("#cidade").show();
                        }
                    
                    });

                     
                     
                     $("body").on("change", "#select-razao", function(){
                        a = $(this).prop("selectedIndex"); 
                    
                    
                    if(a === 0){
                        cpf_cnpf.removeClass();
                        cpf_cnpf.addClass("cpf");

                    }else if(a === 1){
                        cpf_cnpf.removeClass();
                        cpf_cnpf.addClass("cnpj");
                    }
                    
                     $(".data").mask("99/99/9999");
                     $(".cpf").mask("999.999.999-99");
                     $(".cnpj").mask("99.999.999/9999-99");

                    });
 
                    $(".data").mask("99/99/9999");
                     $(".tel").mask("(999) 9999-9999");
                     $(".cpf").mask("999.999.999-99");
                     $(".cnpj").mask("99.999.999/9999-99");
                     $(".cep").mask("99999-999");
                     $(".hora").mask("99:99");
                     //$(".cep").mask("99999-999",{placeholder:"99999-999"});

                });
 
         </script>
 ';

}

/* Detectar browser */

function browser_detection_indiv() {
    $browser = $_SERVER['HTTP_USER_AGENT'];
    if (preg_match("/MSIE 6.0/i", $browser)) {
        ?>
        <?php
    } elseif (preg_match("/MSIE 7.0/i", $browser)) {
        ?>
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/na.css" type="text/css" />
    <?php }
} ?>
<?php
add_action('wp_head', 'browser_detection_indiv');
?>
<?php
function my_force_login() {
    global $post;
    if (!is_page()) return;
    $ids = array(716); // array of post IDs that force login to read
    if (in_array((int)$post->ID, $ids) && !is_user_logged_in()) {
        auth_redirect();
    }
}

// IntegraÃƒÂ§ÃƒÂ£o do Contact Form 7 com o Post Type Eventos
function sfp_wpcf7_save( $data ) {

    $form_title = $data->title;
    $form_data = $data->posted_data;
    if( isset( $data->uploaded_files['event_photo'] ) ) {
        $event_photo = $data->uploaded_files['event_photo'];
    }

    if( $form_title == 'Cadastro de Eventos - Novo' ) {

        // Avoid Sending Emails
        $data->skip_mail = true;

        $title = $form_data['event_title'];
        $description = $form_data['event_description'];

        // Convert Date Format to Milliseconds
        $start_date = str_replace( '/', '-', $form_data['event_start_date'] );
        $start_time = $form_data['event_start_time_h'] . ':' . $form_data['event_start_time_m'];
        $start_date = strtotime( $start_date . 'T' . $start_time );

        // Convert Date Format to Milliseconds
        $end_date = str_replace( '/', '-', $form_data['event_end_date'] );
        $end_time = $form_data['event_end_time_h'] . ':' . $form_data['event_end_time_m'];
        $end_date = strtotime( $end_date . 'T' . $end_time );

        $city = $form_data['event_city'];
        $venue = $form_data['event_venue'];
        $address = $form_data['event_address'];
        $bairro = $form_data['bairro'];
        
        $ticket_option = $form_data['event_ticket_option'];
        $ticket_price = ( isset( $form_data['event_ticket_price'] ) ) ? $form_data['event_ticket_price'] : '';
        $event_category_id = $form_data['event_category'];

        $proponent_option = $form_data['event_proponent_option'];
        $proponent_name = $form_data['event_proponent_name'];
        $proponent_email = $form_data['event_proponent_email'];
        $proponent_site = $form_data['event_proponent_site'];
        $proponent_phone = $form_data['event_proponent_phone'];

        $owner_name = ( isset( $form_data['event_owner_name'] ) ) ? $form_data['event_owner_name'] : '';
        $owner_email = ( isset( $form_data['event_owner_email'] ) ) ? $form_data['event_owner_email'] : '';
        $owner_phone = ( isset( $form_data['event_owner_phone'] ) ) ? $form_data['event_owner_phone'] : '';
        $owner_option = ( isset( $form_data['event_owner_option'] ) ) ? $form_data['event_owner_option'] : '';
        
        $contact_name = ( isset( $form_data['event_contact_name'] ) ) ? $form_data['event_contact_name'] : '';
        $contact_email = ( isset( $form_data['event_contact_email'] ) ) ? $form_data['event_contact_email'] : '';
        $contact_phone = ( isset( $form_data['event_contact_phone'] ) ) ? $form_data['event_contact_phone'] : '';

        $partner_option = $form_data['event_partner_option'];
        $partner_name = ( isset( $form_data['event_partner_name'] ) ) ? $form_data['event_partner_name'] : '';


        // ADD THE FORM INPUT TO $new_post ARRAY
        $new_post = array(
            'post_title'    =>  $title,
            'post_content'  =>  $description,
            'post_status'   =>  'pending', // Should be sent to review before publish
            'post_type'     =>  'programacao',  // Evento CPT
        );

        $post_category = get_term_by( 'slug', 'programacao', 'category' );

        $categories = array( $post_category->term_id, $event_category_id );

        // SAVE THE POST
        $pid = wp_insert_post($new_post);

        if( isset( $pid ) && $pid > 0 ) {

            // Tag Event City
            if( isset( $city ) && $city != '' )
                wp_set_post_tags($pid, $city);

            // Set Event Categories
            if( isset( $post_category ) && $post_category != false )
                wp_set_post_categories($pid, $categories);

            // Handle Image Upload
            if( isset( $event_photo ) && !empty( $event_photo ) ) {

                $upload_dir = wp_upload_dir();

                $upload_file = $upload_dir['path'] . '/' . basename( $event_photo );

                $copy_file = copy( $event_photo, $upload_file);

                if( $copy_file ) {

                    $wp_filetype = wp_check_filetype( basename( $upload_file ), null );

                    $attachment = array(
                        'guid' => $upload_dir['url'] . '/' . basename( $upload_file ), 
                        'post_mime_type' => $wp_filetype['type'],
                        'post_title' => preg_replace('/\.[^.]+$/', '', basename( $upload_file ) ),
                        'post_content' => '',
                        'post_status' => 'inherit'
                    );

                    $attach_id = wp_insert_attachment( $attachment, $upload_file, $pid );

                    // Set Featured Image
                    set_post_thumbnail( $pid, $attach_id );
                    
                    // you must first include the image.php file
                    // for the function wp_generate_attachment_metadata() to work
                    require_once(ABSPATH . 'wp-admin/includes/image.php');
                    
                    $attach_data = wp_generate_attachment_metadata( $attach_id, $upload_file );
                    
                    wp_update_attachment_metadata( $attach_id, $attach_data );

                }

            }

            // Event Information
            add_post_meta( $pid, 'wpcf-event-start-date',       $start_date, true );
            add_post_meta( $pid, 'wpcf-event-end-date',         $end_date, true );
            add_post_meta( $pid, 'wpcf-cidade',                 $city, true );
            add_post_meta( $pid, 'wpcf-event-venue',            $venue, true );
            add_post_meta( $pid, 'wpcf-event-address',          $address, true );
            add_post_meta( $pid, 'wpcf-bairro',                 $bairro, true );

            // Get Latitude And Longitude Via Google Maps API
            $bairro = ( !isset( $bairro ) && !empty( $bairro ) ) ? ' - ' . $bairro : '';
            $arr_lat_long = sfp_get_lat_long( $address . $bairro . ', ' . $city );

            if( $arr_lat_long != null ) {
                add_post_meta( $pid, 'wpcf-latitude',               $arr_lat_long['lat'], true );
                add_post_meta( $pid, 'wpcf-longitude',              $arr_lat_long['long'], true );
            }

            add_post_meta( $pid, 'wpcf-event-ticket-option',    $ticket_option, true );
            add_post_meta( $pid, 'wpcf-event-ticket-price',     $ticket_price, true );

            // Event Proponent
            add_post_meta( $pid, 'wpcf-event-proponent-option', $proponent_option, true );
            add_post_meta( $pid, 'wpcf-event-proponent-name',   $proponent_name, true );
            add_post_meta( $pid, 'wpcf-event-proponent-email',  $proponent_email, true );
            add_post_meta( $pid, 'wpcf-event-proponent-site',   $proponent_site, true );
            add_post_meta( $pid, 'wpcf-event-proponent-phone',  $proponent_phone, true );

            // Event Owner
            add_post_meta( $pid, 'wpcf-event-owner-name',       $owner_name, true );
            add_post_meta( $pid, 'wpcf-event-owner-email',      $owner_email, true );
            add_post_meta( $pid, 'wpcf-event-owner-phone',      $owner_phone, true );
            add_post_meta( $pid, 'wpcf-event-owner-option',     $owner_option, true );

            // Event Contact
            add_post_meta( $pid, 'wpcf-event-contact-name',     $contact_name, true );
            add_post_meta( $pid, 'wpcf-event-contact-email',    $contact_email, true );
            add_post_meta( $pid, 'wpcf-event-contact-phone',    $contact_phone, true );

            // Event Partner
            add_post_meta( $pid, 'wpcf-event-partner-option',   $partner_option, true );
            add_post_meta( $pid, 'wpcf-event-partner-name',     $partner_name, true );

        } // End If

    } // End Cadastro de Eventos - Novo

    if( $form_title == 'Cadastro de Grupos Culturais' ) {

        // var_dump( $form_data ); exit;

        // Avoid Sending Emails
        $data->skip_mail = true;

        $title = $form_data['grupo-nome'];
        $description = $form_data['evento-artista-descricao'];

        // Grupo
        $grupo_nome_resp = $form_data['grupo-nome-responsavel'];
        $grupo_cpf = $form_data['grupo-cpf-cnpj'];
        $grupo_endereco = $form_data['grupo-endereco'];
        $grupo_telefone = $form_data['grupo-telefone'];
        $grupo_email = $form_data['grupo-email'];
        $grupo_site = $form_data['grupo-site'];

        // Proponente
        $prop_nome = $form_data['proponente-nome'];
        $prop_endereco = $form_data['proponente-endereco'];
        $prop_telefone = $form_data['proponente-telefone'];
        $prop_email = $form_data['proponente-email'];
        $prop_site = $form_data['proponente-site'];

        // Evento
        $evento_tipo = $form_data['evento-tipo'];
        $evento_regiao = $form_data['evento-regiao'];
        $evento_data = $form_data['evento-data'];
        $evento_hora = $form_data['evento-hora'];
        $evento_local = $form_data['evento-local'];
        $evento_endereco = $form_data['evento-endereco'];
        $evento_descricao = $form_data['evento-descricao'];


        // ADD THE FORM INPUT TO $new_post ARRAY
        $new_post = array(
            'post_title'    =>  $title,
            'post_content'  =>  $description,
            'post_status'   =>  'pending', // Should be sent to review before publish
            'post_type'     =>  'grupo_cultural',  // Evento CPT
        );

        // SAVE THE POST
        $pid = wp_insert_post( $new_post );

        if( isset( $pid ) && $pid > 0 ) {

            $grupo_cultural_tipo = get_term_by( 'slug', $evento_tipo, 'grupo_cultural_tipo' );
            if( $grupo_cultural_tipo ) {
                wp_set_post_terms( $pid, $grupo_cultural_tipo->term_id, 'grupo_cultural_tipo' );
            }

            $grupo_cultural_regiao = get_term_by( 'slug', $evento_regiao, 'grupo_cultural_regiao' );
            if( $grupo_cultural_regiao ) {
                wp_set_post_terms( $pid, $grupo_cultural_regiao->term_id, 'grupo_cultural_regiao' );
            }

            // Dados do Grupo
            update_field( 'field_539536fe8c2f9', $grupo_nome_resp, $pid );
            update_field( 'field_539537118c2fa', $grupo_cpf, $pid );
            update_field( 'field_539537228c2fb', $grupo_endereco, $pid );
            update_field( 'field_539537448c2fc', $grupo_telefone, $pid );
            update_field( 'field_539537528c2fd', $grupo_email, $pid );
            update_field( 'field_539537638c2fe', $grupo_site, $pid );

            // Dados do Proponente
            update_field( 'field_539537a7e77fb', $prop_nome, $pid );
            update_field( 'field_539537bce77fc', $prop_endereco, $pid );
            update_field( 'field_539537cae77fd', $prop_telefone, $pid );
            update_field( 'field_539537d3e77fe', $prop_email, $pid );
            update_field( 'field_539537e0e77ff', $prop_site, $pid );

            // Dados do Evento
            update_field( 'field_5395380cd6ebd', $evento_data, $pid );
            update_field( 'field_53953831d6ebe', $evento_hora, $pid );
            update_field( 'field_5395384ed6ebf', $evento_local, $pid );
            update_field( 'field_53953857d6ec0', $evento_endereco, $pid );
            update_field( 'field_53953866d6ec1', $evento_descricao, $pid );

            $field_value = array(
                'anexo-01' => 'field_539538a8a2872',
                'anexo-02' => 'field_539538c0a2873',
                'anexo-03' => 'field_53d1d018738bd',
                'anexo-04' => 'field_53d1d026738be',
                'anexo-05' => 'field_53d1d031738bf',
                'anexo-06' => 'field_53d1d03b738c0',
                'anexo-07' => 'field_53d1d045738c1'
            );

            // Handle Image Upload
            if( $data->uploaded_files ) {

                $upload_dir = wp_upload_dir();

                foreach( $data->uploaded_files as $field_key => $file ) {

                    $upload_file = $upload_dir['path'] . '/' . basename( $file );

                    $copy_file = copy( $file, $upload_file );

                    if( $copy_file ) {

                        $wp_filetype = wp_check_filetype( basename( $upload_file ), null );

                        $attachment = array(
                            'guid' => $upload_dir['url'] . '/' . basename( $upload_file ), 
                            'post_mime_type' => $wp_filetype['type'],
                            'post_title' => preg_replace('/\.[^.]+$/', '', basename( $upload_file ) ),
                            'post_content' => '',
                            'post_status' => 'inherit'
                        );

                        $attach_id = wp_insert_attachment( $attachment, $upload_file, $pid );

                        update_field( $field_value[ $field_key ], $attach_id, $pid );

                    }

                }

            }

        } // End If

        if( $form_title == 'Ficha de inscriÃƒÂ§ÃƒÂ£o' ) {
          // Avoid Sending Emails
          $data->skip_mail = true;
        }

    } // End Cadastro de Grupos Culturais

}
add_action( 'wpcf7_before_send_mail', 'sfp_wpcf7_save' );

// Contact Form 7 Custom Validation
include( 'includes/cf7-custom-validation.php' );

function has_parent($post, $post_id) {
    if ($post->ID == $post_id) return true;
    else if ($post->post_parent == 0) return false;
    else return has_parent(get_post($post->post_parent),$post_id);
}

function sfp_get_lat_long( $address ) {
    
    $url = "http://maps.google.com/maps/api/geocode/json?address=" . urlencode( $address ) . "&sensor=false&region=Brazil";

    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $ch, CURLOPT_PROXYPORT, 3128 );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
    
    $response = curl_exec( $ch );
    
    curl_close( $ch );
    
    $response_a = json_decode( $response );

    if( count( $response_a ) > 0 ) {

        $arr_lat_long = array(
            'lat' => $response_a->results[0]->geometry->location->lat,
            'long' => $response_a->results[0]->geometry->location->lng
        );
        return $arr_lat_long;

    } else {

        return null;

    }
}

/**
 * Remove Contact Form 7 scripts + styles from unnecessary pages
 * 
 */
add_action( 'wp_enqueue_scripts', 'ac_remove_cf7_scripts' );
function ac_remove_cf7_scripts() {
    if ( !is_page( 'cadastre-seu-evento' ) ) {
        // wp_deregister_style( 'contact-form-7' );
        // wp_deregister_script( 'contact-form-7' );
    }
}

/**
 * Notifica proponente quando o evento ÃƒÂ© aprovado
 */
function sfp_notify_event_author( $new_status, $old_status, $post ) {

    $pid                = $post->ID;
    $event_title        = $post->post_title;
    $accepted_status    = array( 'publish', 'trash' );

    // Avoids re-sending e-mails on update
    if( ( in_array( $new_status, $accepted_status) == true ) && $new_status != $old_status && $post->post_type == 'programacao' ) {

        $event_proponent_email  = get_post_meta( $pid, 'wpcf-event-proponent-email', true );
        $event_owner_email      = get_post_meta( $pid, 'wpcf-event-owner-email', true );
        $event_contact_email    = get_post_meta( $pid, 'wpcf-event-contact-email', true );

        $email_to = '';
        if( !empty( $event_proponent_email ) ) {
            $email_to = $event_proponent_email;
        }

        if( !empty( $event_owner_email ) ) {
            $email_to = $event_owner_email;
        }

        if( !empty( $event_contact_email ) ) {
            $email_to = $event_contact_email;
        }

        //$email_to = 'cadu@bluefactory.com.br'; // For debugging purposes

        // Event Approved
        if( $new_status == 'publish' ) {

            $message = '<p>ParabÃƒÂ©ns!</p>';
            $message .= '<p>O evento <strong>' . $event_title . '</strong> que vocÃƒÂª enviou para fazer parte da programaÃƒÂ§ÃƒÂ£o de 2014 ';
            $message .= 'da IV Semana Fluminense do PatrimÃƒÂ´nio foi aprovado.</p>';
            $message .= '<p>Agradecemos o seu contato e esperamos que seu evento seja um sucesso!</p>';
            $message .= '<p>Atenciosamente,</p>';
            $message .= '<p>ComitÃƒÂª de AprovaÃƒÂ§ÃƒÂ£o de Eventos Externos<br />';
            $message .= 'Semana Fluminense do PatrimÃƒÂ´nio</p>';

            $subject = 'Seu evento foi aprovado na ' . get_bloginfo( 'name' );

        }

        // Event Unapproved
        if( $new_status == 'trash' ) {

            $reason                 = get_post_meta( $pid, 'wpcf-motivo-programacao', true );
            $other_reason           = get_post_meta( $pid, 'wpcf-outro-motivo-programacao', true );

            $reason_message = '';
            if( !empty( $reason ) && $reason != 'Nenhum' ) {
                $reason_message = ( empty( $other_reason ) ) ? $reason : $other_reason;
            } else {
                return null;
            }

            $message = '<p>OlÃƒÂ¡!</p>';
            $message .= '<p>Infelizmente, o evento <strong>' . $event_title . '</strong> que vocÃƒÂª enviou para fazer parte da programaÃƒÂ§ÃƒÂ£o de 2014 ';
            $message .= 'da IV Semana Fluminense do PatrimÃƒÂ´nio <strong>foi reprovado</strong>.</p>';
            $message .= '<p>O motivo foi: ' . $reason_message . '</p>';
            $message .= '<p>Mesmo assim, agradecemos o seu contato e esperamos que seu evento seja um sucesso!</p>';
            $message .= '<p>Atenciosamente,</p>';
            $message .= '<p>ComitÃƒÂª de AprovaÃƒÂ§ÃƒÂ£o de Eventos Externos<br />';
            $message .= 'Semana Fluminense do PatrimÃƒÂ´nio</p>';

            $subject = 'Seu evento foi reprovado na ' . get_bloginfo( 'name' );

        }

        $headers[] = 'From: ' . get_bloginfo( 'name' ) . ' <' . get_bloginfo( 'admin_email' ) . '>';

        add_filter( 'wp_mail_content_type', 'set_html_content_type' );

        // Avoids sending e-mail when restoring or undoing from Trash
        if( $old_status != 'trash' )
            wp_mail( $email_to, $subject, $message, $headers );

        // Reset content-type to avoid conflicts -- http://core.trac.wordpress.org/ticket/23578
        remove_filter( 'wp_mail_content_type', 'set_html_content_type' );

        return $pid;

    }

}
add_action( 'transition_post_status', 'sfp_notify_event_author', 10, 3 );

/**
 * Notifica proponente quando a fotografia ÃƒÂ© aprovada
 */
function sfp_notify_photo_author( $new_status, $old_status, $post ) {

    $pid                = $post->ID;
    $photo_title        = $post->post_title;
    $accepted_status    = array( 'publish', 'trash' );

    // Avoids re-sending e-mails on update
    if( ( in_array( $new_status, $accepted_status) == true ) && $new_status != $old_status && $post->post_type == 'fotografias' ) {

        $author_email   = get_post_meta( $pid, 'wpcf-email', true );
        $parent_email   = get_post_meta( $pid, 'wpcf-responsavel-email', true );

        $email_to = array();
        if( !empty( $author_email ) ) {
            $email_to[] = $author_email;
        }

        if( !empty( $parent_email ) ) {
            $email_to[] = $parent_email;
        }

        //$email_to = 'cadu@bluefactory.com.br'; // For debugging purposes

        // Photo Approved
        if( $new_status == 'publish' ) {

            $message = '<p>ParabÃƒÂ©ns!</p>';
            $message .= '<p>Sua inscriÃƒÂ§ÃƒÂ£o no Concurso Cultural Olhares sobre o PatrimÃƒÂ´nio Fluminense 2014, ';
            $message .= 'com a fotografia ' . $photo_title . ', foi efetivada com sucesso.</p>';
            $message .= '<p>Agradecemos a sua participaÃƒÂ§ÃƒÂ£o e desejamos boa sorte!</p>';
            $message .= '<p>Cordialmente,</p>';
            $message .= '<p>ComissÃƒÂ£o de organizaÃƒÂ§ÃƒÂ£o da IV Semana Fluminense do PatrimÃƒÂ´nio 2014</p>';

            $subject = 'Sua fotografia foi aprovada na ' . get_bloginfo( 'name' );

        }

        // Photo Unapproved
        if( $new_status == 'trash' ) {

            $reason                 = get_post_meta( $pid, 'wpcf-motivo-concurso', true );
            $other_reason           = get_post_meta( $pid, 'wpcf-outro-motivo-concurso', true );

            $reason_message = '';
            if( !empty( $reason ) && $reason != 'Nenhum' ) {
                $reason_message = ( empty( $other_reason ) ) ? $reason : $other_reason;
            } else {
                return null;
            }

            $message = '<p>OlÃƒÂ¡!</p>';
            $message .= '<p>Sua inscriÃƒÂ§ÃƒÂ£o no Concurso Cultural Olhares sobre o PatrimÃƒÂ´nio Fluminense 2014, ';
            $message .= 'com a fotografia ' . $photo_title . ', nÃƒÂ£o foi efetivada por nÃƒÂ£o se adequar ao tema escolhido.</p>';
            $message .= '<p>Agradecemos o seu interesse e contamos com a sua participaÃƒÂ§ÃƒÂ£o nos prÃƒÂ³ximos concursos.</p>';
            $message .= '<p>Cordialmente,</p>';
            $message .= '<p>ComissÃƒÂ£o de organizaÃƒÂ§ÃƒÂ£o da IV Semana Fluminense do PatrimÃƒÂ´nio 2014</p>';

            $subject = 'Sua fotografia foi reprovada na ' . get_bloginfo( 'name' );

        }

        $headers[] = 'From: ' . get_bloginfo( 'name' ) . ' <' . get_bloginfo( 'admin_email' ) . '>';

        add_filter( 'wp_mail_content_type', 'set_html_content_type' );

        // Avoids sending e-mail when restoring or undoing from Trash
        if( $old_status != 'trash' )
            wp_mail( $email_to, $subject, $message, $headers );

        // Reset content-type to avoid conflicts -- http://core.trac.wordpress.org/ticket/23578
        remove_filter( 'wp_mail_content_type', 'set_html_content_type' );

        return $pid;

    }

}
add_action( 'transition_post_status', 'sfp_notify_photo_author', 10, 3 );

/**
 * Notifica proponente quando a poesia ÃƒÂ© aprovada
 */
function sfp_notify_poetry_author( $new_status, $old_status, $post ) {

    $pid                = $post->ID;
    $poetry_title       = $post->post_title;
    $accepted_status    = array( 'publish', 'trash' );

    // Avoids re-sending e-mails on update
    if( ( in_array( $new_status, $accepted_status) == true ) && $new_status != $old_status && $post->post_type == 'poesias' ) {

        $author_email   = get_post_meta( $pid, 'wpcf-email', true );
        $parent_email   = get_post_meta( $pid, 'wpcf-responsavel-email', true );

        $email_to = array();
        if( !empty( $author_email ) ) {
            $email_to[] = $author_email;
        }

        if( !empty( $parent_email ) ) {
            $email_to[] = $parent_email;
        }

        //$email_to = 'cadu@bluefactory.com.br'; // For debugging purposes

        // Poetry Approved
        if( $new_status == 'publish' ) {

            $message = '<p>ParabÃƒÂ©ns!</p>';
            $message .= '<p>Sua inscriÃƒÂ§ÃƒÂ£o no Concurso Cultural Olhares sobre o PatrimÃƒÂ´nio Fluminense 2014, ';
            $message .= 'com a poesia ' . $poetry_title . ', foi efetivada com sucesso.</p>';
            $message .= '<p>Agradecemos a sua participaÃƒÂ§ÃƒÂ£o e desejamos boa sorte!</p>';
            $message .= '<p>Cordialmente,</p>';
            $message .= '<p>ComissÃƒÂ£o de organizaÃƒÂ§ÃƒÂ£o da IV Semana Fluminense do PatrimÃƒÂ´nio 2014</p>';

            $subject = 'Sua poesia foi aprovada na ' . get_bloginfo( 'name' );

        }

        // Poetry Unapproved
        if( $new_status == 'trash' ) {

            $reason                 = get_post_meta( $pid, 'wpcf-motivo-concurso', true );
            $other_reason           = get_post_meta( $pid, 'wpcf-outro-motivo-concurso', true );

            $reason_message = '';
            if( !empty( $reason ) && $reason != 'Nenhum' ) {
                $reason_message = ( empty( $other_reason ) ) ? $reason : $other_reason;
            } else {
                return null;
            }

            $message = '<p>OlÃƒÂ¡!</p>';
            $message .= '<p>Sua inscriÃƒÂ§ÃƒÂ£o no Concurso Cultural Olhares sobre o PatrimÃƒÂ´nio Fluminense 2014, ';
            $message .= 'com a poesia ' . $poetry_title . ', nÃƒÂ£o foi efetivada por nÃƒÂ£o se adequar ao tema escolhido.</p>';
            $message .= '<p>Agradecemos o seu interesse e contamos com a sua participaÃƒÂ§ÃƒÂ£o nos prÃƒÂ³ximos concursos.</p>';
            $message .= '<p>Cordialmente,</p>';
            $message .= '<p>ComissÃƒÂ£o de organizaÃƒÂ§ÃƒÂ£o da IV Semana Fluminense do PatrimÃƒÂ´nio 2014</p>';

            $subject = 'Sua poesia foi reprovada na ' . get_bloginfo( 'name' );

        }

        $headers[] = 'From: ' . get_bloginfo( 'name' ) . ' <' . get_bloginfo( 'admin_email' ) . '>';

        add_filter( 'wp_mail_content_type', 'set_html_content_type' );

        // Avoids sending e-mail when restoring or undoing from Trash
        if( $old_status != 'trash' )
            wp_mail( $email_to, $subject, $message, $headers );

        // Reset content-type to avoid conflicts -- http://core.trac.wordpress.org/ticket/23578
        remove_filter( 'wp_mail_content_type', 'set_html_content_type' );

        return $pid;

    }

}
add_action( 'transition_post_status', 'sfp_notify_poetry_author', 10, 3 );

function set_html_content_type() {
    return 'text/html';
}

function log_me($message) {
    if (WP_DEBUG === true) {
        if (is_array($message) || is_object($message)) {
            error_log(print_r($message, true));
        } else {
            error_log($message);
        }
    }
}

/**
 * This plugin will fix the problem where next/previous of page number buttons are broken on list
 * of posts in a category when the custom permalink string is:
 * /%category%/%postname%/ 
 * The problem is that with a url like this:
 * /categoryname/page/2
 * the 'page' looks like a post name, not the keyword "page"
 */
function remove_page_from_query_string($query_string)
{ 
    if( isset($query_string['page']) && (isset($query_string['name']) && $query_string['name'] == 'page' ) ) {
    // if( isset($query_string['page']) && $query_string['name'] == 'page' ) {
        unset($query_string['name']);
        // 'page' in the query_string looks like '/2', so i'm spliting it out
        list($delim, $page_index) = split('/', $query_string['page']);
        $query_string['paged'] = $page_index;
    }      
    return $query_string;
}
// I will kill you if you remove this. I died two days for this line 
add_filter('request', 'remove_page_from_query_string');

// following are code adapted from Custom Post Type Category Pagination Fix by jdantzer
function fix_category_pagination($qs){
    if(isset($qs['category_name']) && isset($qs['paged'])){
        $qs['post_type'] = get_post_types($args = array(
            'public'   => true,
            '_builtin' => false
        ));
        array_push($qs['post_type'],'post');
    }
    return $qs;
}
add_filter('request', 'fix_category_pagination');

function get_total_votes( $post_type ) {

    $args_total_votes = array(
        'post_type' => $post_type,
        'posts_per_page' => -1,
        'meta_key' => 'votes',
        'orderby' => 'meta_value_num',
    );
    $query_total_votes = new WP_Query( $args_total_votes );

    $count_total_votes = 0;
    if( $query_total_votes->have_posts() ) {
        while ( $query_total_votes->have_posts() ) {
            $query_total_votes->the_post();
            $votes = (int)get_post_meta( get_the_ID(), 'votes', true );
            $count_total_votes = $count_total_votes + $votes;
        }
    }
    return $count_total_votes;

}

// Register Custom Post Type
function grupos_culturais_cpt() {

  $labels = array(
    'name'                => _x( 'Grupos Culturais', 'Post Type General Name', 'sfp' ),
    'singular_name'       => _x( 'Grupo Cultural', 'Post Type Singular Name', 'sfp' ),
    'menu_name'           => __( 'Grupos Culturais', 'sfp' ),
    'parent_item_colon'   => __( 'Grupo Cultural pai:', 'sfp' ),
    'all_items'           => __( 'Todos os Grupos Culturais', 'sfp' ),
    'view_item'           => __( 'Ver Grupo Cultural', 'sfp' ),
    'add_new_item'        => __( 'Adicionar Grupo Cultural', 'sfp' ),
    'add_new'             => __( 'Adicionar Grupo Cultural', 'sfp' ),
    'edit_item'           => __( 'Editar Grupo Cultural', 'sfp' ),
    'update_item'         => __( 'Atualizar Grupo Cultural', 'sfp' ),
    'search_items'        => __( 'Procurar Grupo Cultural', 'sfp' ),
    'not_found'           => __( 'NÃƒÂ£o encontrado', 'sfp' ),
    'not_found_in_trash'  => __( 'NÃƒÂ£o encontrado na lixeira', 'sfp' ),
  );
  $rewrite = array(
    'slug'                => 'grupo-cultural',
    'with_front'          => true,
    'pages'               => true,
    'feeds'               => true,
  );
  $args = array(
    'label'               => __( 'grupo_cultural', 'sfp' ),
    'description'         => __( 'Cadastro de Grupos Culturais', 'sfp' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'editor', 'thumbnail', ),
    'taxonomies'          => array( 'grupo_cultural', 'regiao' ),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 5,
    'menu_icon'           => '',
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'rewrite'             => $rewrite,
    'capability_type'     => 'post',
  );
  register_post_type( 'grupo_cultural', $args );

}

// Hook into the 'init' action
add_action( 'init', 'grupos_culturais_cpt', 0 );

// Register Custom Taxonomy
function grupo_cultural_tipo() {

  $labels = array(
    'name'                       => _x( 'Tipos de Grupos', 'Taxonomy General Name', 'sfp' ),
    'singular_name'              => _x( 'Tipo de Grupo', 'Taxonomy Singular Name', 'sfp' ),
    'menu_name'                  => __( 'Tipos', 'sfp' ),
    'all_items'                  => __( 'Todos os Tipos', 'sfp' ),
    'parent_item'                => __( 'Tipo Pai', 'sfp' ),
    'parent_item_colon'          => __( 'Tipo Pai:', 'sfp' ),
    'new_item_name'              => __( 'Novo Tipo', 'sfp' ),
    'add_new_item'               => __( 'Novo Tipo', 'sfp' ),
    'edit_item'                  => __( 'Editar Tipo', 'sfp' ),
    'update_item'                => __( 'Atualizar Tipo', 'sfp' ),
    'separate_items_with_commas' => __( 'Separar tipos com vÃƒÂ­rgulas', 'sfp' ),
    'search_items'               => __( 'Procurar tipos', 'sfp' ),
    'add_or_remove_items'        => __( 'Adicionar ou remover tipos', 'sfp' ),
    'choose_from_most_used'      => __( 'Escolhe o tipo mais usado', 'sfp' ),
    'not_found'                  => __( 'NÃƒÂ£o encontrado', 'sfp' ),
  );
  $rewrite = array(
    'slug'                       => 'tipo-grupo-cultural',
    'with_front'                 => true,
    'hierarchical'               => false,
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'rewrite'                    => $rewrite,
  );
  register_taxonomy( 'grupo_cultural_tipo', array( 'grupo_cultural' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'grupo_cultural_tipo', 0 );

// Register Custom Taxonomy
function grupo_cultural_regiao() {

  $labels = array(
    'name'                       => _x( 'RegiÃƒÂµes', 'Taxonomy General Name', 'sfp' ),
    'singular_name'              => _x( 'RegiÃƒÂ£o', 'Taxonomy Singular Name', 'sfp' ),
    'menu_name'                  => __( 'RegiÃƒÂµes', 'sfp' ),
    'all_items'                  => __( 'Todas as RegiÃƒÂµes', 'sfp' ),
    'parent_item'                => __( 'RegiÃƒÂ£o Pai', 'sfp' ),
    'parent_item_colon'          => __( 'RegiÃƒÂ£o Pai:', 'sfp' ),
    'new_item_name'              => __( 'Nova RegiÃƒÂ£o', 'sfp' ),
    'add_new_item'               => __( 'Nova RegiÃƒÂ£o', 'sfp' ),
    'edit_item'                  => __( 'Editar RegiÃƒÂ£o', 'sfp' ),
    'update_item'                => __( 'Atualizar RegiÃƒÂ£o', 'sfp' ),
    'separate_items_with_commas' => __( 'Separar regiÃƒÂµes com vÃƒÂ­rgulas', 'sfp' ),
    'search_items'               => __( 'Procurar regiÃƒÂµes', 'sfp' ),
    'add_or_remove_items'        => __( 'Adicionar ou remover regiÃƒÂµes', 'sfp' ),
    'choose_from_most_used'      => __( 'Escolhe a regiÃƒÂ£o mais usado', 'sfp' ),
    'not_found'                  => __( 'NÃƒÂ£o encontrado', 'sfp' ),
  );
  $rewrite = array(
    'slug'                       => 'regiao-grupo-cultural',
    'with_front'                 => true,
    'hierarchical'               => false,
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'rewrite'                    => $rewrite,
  );
  register_taxonomy( 'grupo_cultural_regiao', array( 'grupo_cultural' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'grupo_cultural_regiao', 0 );




/**
 * [bloco_fotografia description]
 * @author Leonardo Jorge
 * @since   2014-06-20
 * @version [0.1]
 * @param   [type]     $categoria      [description]
 * @param   [type]     $tema           [description]
 * @param   [type]     $tipo_resultado [description]
 * @param   integer    $ano            [description]
 * @return  [type]                     [description]
 */
function bloco_fotografia($categoria = null,$tema = null, $tipo_resultado = null,$ano = 2014) {

	$args = array(
		'post_type' => 'fotografias',
		'category__and' => array( $categoria->term_id, $tema->term_id, $tipo_resultado->term_id ),
		'posts_per_page' => 3,
		'meta_key' => 'wpcf-posicao',
		'orderby' => 'meta_value_num',
		'order' => 'ASC'
		);

	$query = new WP_Query( $args );


	if( $query->have_posts() ): 
		
			$html .= '<ul class="lista-votocao">';
			$i = 1;
			while( $query->have_posts() ) : 
				$query->the_post(); 

				$html .= '<li class="lista-votacao-item">';

					

					$html .= '<div class="voto">';

						$html .= '<h1 class="photo-place">'.$i.'Ã‚Âº Lugar &nbsp;&nbsp;<span>'. $tipo_resultado->cat_name.'</span></h1>';

						$autor = do_shortcode("[types field='concurso-foto-autor']");
						$local = do_shortcode("[types field='concurso-foto-local']");

						$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
						$thumb = ( $post_thumbnail_id != '' ) ? wp_get_attachment_image_src( $post_thumbnail_id, 'concurso-fotografia-maior') : '';
						$url = ( $thumb == true ) ? $thumb['0'] : '';

						$html .= '<a href="'.$url.'" title="'. get_the_title().'" class="group1">';
							$html .= get_the_post_thumbnail(get_the_ID(),'concurso-fotografia-thumb'); 
						$html .= '</a>';

					$html .= '</div>';

					$html .= '<h2 class="photo-title">'. get_the_title(). '</h2>';
					$html .= '<div class="photo-location"><strong>Local:</strong>'. $local .'</div>';
					$html .= '<div class="photo-author"><strong>Autor: </strong>'. $autor .'</div>';
					// $html .= '<div class="photo-location"><strong>Local:</strong>'. $local .'</div>';

				$html .= '</li>';
				$i++;
			endwhile;

			$html .= '</ul>';

		endif; //$query_afj
		// restore original post
		wp_reset_postdata();

		return $html;
}

function bloco_poesia($categoria = null,$tema = null, $tipo_resultado = null,$ano = 2014) {
	$args = array(
	    'post_type' => 'poesias',
	    'category__and' => array( $categoria->term_id, $tema->term_id, $tipo_resultado->term_id ),
	    'posts_per_page' => 3,
	    'meta_key' => 'wpcf-posicao',
	    'orderby' => 'meta_value_num',
	    'order' => 'ASC'
	);
	
	$query = new WP_Query( $args );

	if( $query->have_posts() ): 


		$html .= '<ul class="lista-votocao lista-poesia">';
			$i = 1;
			while( $query->have_posts() ) : 
				$query->the_post(); 

				$html .= '<li class="lista-votacao-item">';

					

					$html .= '<div class="voto">';

						$html .= '<h1 class="poetry-place">'.$i.'Ã‚Âº Lugar &nbsp;&nbsp;<span>'. $tipo_resultado->cat_name.'</span></h1>';

						$autor = do_shortcode("[types field='nome']");
                    	$votos = get_post_meta( get_the_ID(), 'votes', true );
					$html .= '</div>';

					$html .= '<div class="desc-autor">';
                        $html .= '<p class="poetry-title"><strong>TÃƒÂ­tulo:</strong> '. get_the_title(). '</p>';
                        $html .= '<p class="poetry-author"><strong>Autor:</strong> '. $autor. '</p>';
                    $html .= '</div>';

                    $html .= '<div class="texto-poesia">';
                        $html .= '<p>'. str_replace("\r", "<br />", get_the_content('')) .'</p>';
                    $html .= '</div>';
					

				$html .= '</li>';
				$i++;
			endwhile;

			$html .= '</ul>';
	endif;

	return $html;
}

// Adiciona submenu de acordo com o menu pai
// Source: http://christianvarga.com/how-to-get-submenu-items-from-a-wordpress-menu-based-on-parent-or-sibling/

// add hook
add_filter( 'wp_nav_menu_objects', 'my_wp_nav_menu_objects_sub_menu', 10, 2 );
 
// filter_hook function to react on sub_menu flag
function my_wp_nav_menu_objects_sub_menu( $sorted_menu_items, $args ) {

  global $post;

  if ( isset( $args->sub_menu ) ) {
    $root_id = 0;
    
    // find the current menu item
    foreach ( $sorted_menu_items as $menu_item ) {
      if ( $menu_item->current ) {
        // set the root id based on whether the current menu item has a parent or not
        $root_id = ( $menu_item->menu_item_parent ) ? $menu_item->menu_item_parent : $menu_item->ID;
        break;
      }
      // set the root id based on the post type
      if( preg_match( "/{$post->post_type}/", $menu_item->post_name ) ) {
        $root_id = $menu_item->ID;
        break;
      }
    }
    
    // find the top level parent
    if ( ! isset( $args->direct_parent ) ) {
      $prev_root_id = $root_id;
      while ( $prev_root_id != 0 ) {
        foreach ( $sorted_menu_items as $menu_item ) {
          if ( $menu_item->ID == $prev_root_id ) {
            $prev_root_id = $menu_item->menu_item_parent;
            // don't set the root_id to 0 if we've reached the top of the menu
            if ( $prev_root_id != 0 ) $root_id = $menu_item->menu_item_parent;
            break;
          } 
        }
      }
    }
 
    $menu_item_parents = array();
    foreach ( $sorted_menu_items as $key => $item ) {
      // init menu_item_parents
      if ( $item->ID == $root_id ) $menu_item_parents[] = $item->ID;
 
      if ( in_array( $item->menu_item_parent, $menu_item_parents ) ) {
        // part of sub-tree: keep!
        $menu_item_parents[] = $item->ID;
      } else if ( ! ( isset( $args->show_parent ) && in_array( $item->ID, $menu_item_parents ) ) ) {
        // not part of sub-tree: away with it!
        unset( $sorted_menu_items[$key] );
      }
    }
    
    return $sorted_menu_items;
  } else {
    return $sorted_menu_items;
  }
}

/**
 * Post type dos banners
 */

add_action( 'init', 'create_post_type_banner_slider' );
function create_post_type_banner_slider() {
	register_post_type( 'banner_slider',
		array(
			'supports' => array(
				/* Post titles ($post->post_title). */
            	'title',
            	'thumbnail'
			),
			'labels' => array(
	            'name'               => __( 'Banner Slider'),
	            'singular_name'      => __( 'Banner Slider'),
	            'menu_name'          => __( 'Banner Slider'),
	            'name_admin_bar'     => __( 'Banner Slider'),
	            'add_new'            => __( 'Adicionar Banner'),
	            'add_new_item'       => __( 'Adicionar novo Banner'),
	            'edit_item'          => __( 'Editar Banner'),
	            'new_item'           => __( 'Novo Banner'),
	            'view_item'          => __( 'Ver Banner'),
	            'search_items'       => __( 'Procurar Banner'),
	            'not_found'          => __( 'Nenhum Banner encontrado'),
	            'not_found_in_trash' => __( 'Nenhum Banner encontrado na lixeira'),
	            'all_items'          => __( 'Todos os Banners'),

	            /* Labels for hierarchical post types only. */
	            'parent_item'        => __( 'Banner pai'),
	            'parent_item_colon'  => __( 'Banner pai'),

	            /* Custom archive label.  Must filter 'post_type_archive_title' to use. */
	            'archive_title'      => __( 'Banners'),
	        ),
			'public' => true,
			'has_archive' => false,
		)
	);
}

add_action('do_meta_boxes', 'banner_slider_image_box');

function banner_slider_image_box() {

	remove_meta_box( 'postimagediv', 'banner_slider', 'side' );

	add_meta_box('postimagediv', __('Custom Image'), 'post_thumbnail_meta_box', 'banner_slider', 'normal', 'high');

}

