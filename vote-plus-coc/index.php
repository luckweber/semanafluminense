<?php

/**
 * Plugin Name: Votacao COC
 * Plugin URI: http://fiocruz.br.com
 * Description: Votação das imagens do evento Semana Fluminense.
 * Version: 1.0.0
 * Author: Thiago pereira da Silva
 * Author URI: http://fiocruz.br.com
 * License: GPL2
 */
define('ROOT_PATH', dirname(__FILE__));

class WP_Analytify_Simple {
    

    // Constructor
    function __construct() {
        //add_action( 'init', array($this, 'codex_custom_init'));
        
        //add_action('wp_head','hook_css');

        
        add_action('admin_menu', array($this, 'wpa_add_menu'));
        
        add_action('the_content', array($this, 'rate'));
        
        add_action('admin_enqueue_scripts', array($this, 'wpa_styles'));
        add_action('admin_enqueue_scripts', array($this,  'wpa_script'));
        
        register_activation_hook(__FILE__, array($this, 'my_plugin_create_db'));
        register_deactivation_hook(__FILE__, array($this, 'wpa_unstall'));
        
        
        add_action( 'wp_enqueue_scripts', 'wpa_script' );

        
    }

    /*
     * Actions perform at loading of admin menu
     */

    function wpa_add_menu() {

        add_menu_page('Votação de Imagens', 'Votação de Imagens', 'manage_options', 'painel-votacao', array(
            __CLASS__,
            'wpa_page_file_path'
                ), plugins_url('images/icon_instagram.png', __FILE__), '2.2.9');

        add_submenu_page('painel-votacao', 'Analytify simple' . ' Dashboard', 'Lista de Imagens', 'manage_options', 'painel-votacao', array(
            __CLASS__,
            'wpa_page_file_path'
        ));

        add_submenu_page('painel-votacao', 'Configurar ' . ' Dashboard', 'Configurar', 'manage_options', 'configurar', array(
            __CLASS__,
            'wpa_page_file_path'
        ));

    }
    
    
    function hook_css() {

	$output="<style> .wp_head_example { background-color : #f1f1f1; } </style>";

	echo $output;

        }
    
        function my_plugin_create_db() {

        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . 'vote_image_plugin';

        $sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
                post mediumint(9) NOT NULL,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		views smallint(5) NOT NULL,
                url int(100) NOT NULL,
		clicks smallint(5) NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta($sql);
    }

    function  rate(){
        
        //include 'module/rate-vote.php';
    }
    
    function codex_custom_init() {
        $args = array(
          'public' => true,
          'label'  => 'Books'
        );
        register_post_type( 'book', $args );
    }

    static function wpa_page_file_path() {

        $screen = get_current_screen();
        if(strpos($screen->base, 'add-post') !== false){
            
        }
        else if (strpos($screen->base, 'configurar') !== false) {
            include( dirname(__FILE__) . '/include/configurar.php' );
        } else {
            include( dirname(__FILE__) . '/include/painel.php' );
        }
    }

    public function pa_settings_tabs($current = 'authentication') {

        $tabs = array('authentication' => 'Authentication',
            'profile' => 'Profile'
        );
        echo '<div class="left-area">';
        echo '<div id="icon-themes" class="icon32"><br></div>';
        echo '<h2 class="nav-tab-wrapper">';
        foreach ($tabs as $tab => $name) {
            $class = ( $tab == $current ) ? ' nav-tab-active' : '';
            echo "<a class='nav-tab$class' href='?page=analytify-settings&tab=$tab'>$name</a>";
        }
        echo '</h2>';
    }

    public function wpa_styles($page) {
         $screen = get_current_screen();
        if (strpos($screen->base, 'painel-votacao') !== false) {
            wp_enqueue_style('aa', plugins_url('css/lightboxPlus-style.css', __FILE__));
            wp_enqueue_script("jquery");
            wp_enqueue_script('lightbox', plugins_url('js/lightbox.js', __FILE__), array('jquery'));
            wp_enqueue_script('wp-analytify-script', plugins_url('js/script.js', __FILE__), array('jquery', 'lightbox'));
            wp_enqueue_style('wp-analytify-style', plugins_url('css/style.css', __FILE__));
        } else {
          
        }
    }
    
     public function wpa_script($page) {
        wp_enqueue_script("jquery");
        wp_enqueue_script('rate', plugins_url('js/rate.js', __FILE__), array('jquery'));

         
     }
     
  

    /*
     * Actions perform on loading of menu pages
     */
}

$seila = new WP_Analytify_Simple();
?>