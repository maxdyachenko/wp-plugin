<?php
/*
Plugin Name:  Art gallery plugin
Description:  Plugin to create your own images galleries and paste it to the page
Author:       Max Dyachenko
*/

//config
define( 'PLUGIN_DIR', plugin_dir_path( __FILE__ ));
define( 'PLUGIN_BASE_URL', admin_url('admin.php?page=ag-page'));

define( 'GALLERY_LIST_TABLE', $wpdb->prefix . "gallery_list");
define( 'IMG_TABLE', $wpdb->prefix . "img_list");


register_activation_hook( __FILE__, 'ag_init' );
function ag_init() {
    //include all hooks and filters
    global $wpdb;
    $table = GALLERY_LIST_TABLE;
    $sql = "CREATE TABLE `$table` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `gallery_name` varchar(255) NOT NULL,
      `gallery_img` varchar(255) NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
    $wpdb->query($sql);
    $table2 = IMG_TABLE;
    $sql = "CREATE TABLE `$table2` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `gallery_name` varchar(255) NOT NULL,
      `img_name` varchar(255) NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
    $wpdb->query($sql);
}


/**
 * Register a custom menu page.
 */
function ag_register_my_custom_menu_page(){
    add_menu_page(
        'Art gallery',
        'Gallery list',
        'administrator',
        'ag-page',
        'ag_gallery_list'
    );
    add_submenu_page(
        'ag-page',  //or null to create page that is not tied to anything
        'Create Gallery',
        'Create Gallery',
        'administrator',
        'ag-create-gallery',
        'ag_create_gallery'
	);
}
add_action( 'admin_menu', 'ag_register_my_custom_menu_page' );

function ag_gallery_list(){
    global $wpdb;
    $table = GALLERY_LIST_TABLE;
    $gallerylist_data = $wpdb->get_results( "SELECT gallery_name, gallery_img FROM $table" );
    include(PLUGIN_DIR . 'views/gallery-list.php');
}
function ag_create_gallery() {
    include(PLUGIN_DIR . 'views/create-gallery.php');
}


//enqueu styles
add_action('admin_init', 'ag_include_styles');
function ag_include_styles() {
    add_action('admin_enqueue_scripts','ag_include_scripts');
}
function ag_include_scripts($hook) {
    if($hook === 'toplevel_page_ag-page' || $hook === 'gallery-list_page_ag-create-gallery') {
        wp_register_style( 'ag_bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css');
        wp_enqueue_style('ag_bootstrap');

        wp_register_style( 'ag_main',  plugins_url('/assets/styles/main.css',__FILE__ ));
        wp_enqueue_style('ag_main');

        wp_register_script('ag_jquery', 'https://code.jquery.com/jquery-3.0.0.min.js');
        wp_enqueue_script('ag_jquery');

        wp_register_script('ag_popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js', array('ag_jquery'));
        wp_enqueue_script('ag_popper');

        wp_register_script('ag_bootstrap_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js', array('ag_jquery'));
        wp_enqueue_script('ag_bootstrap_js');

    }
    else {
        return;
    }
    if ($hook === 'toplevel_page_ag-page') {
        wp_register_script( 'ag_gallery_list',  plugins_url('/assets/scripts/gallery-list.js',__FILE__ ));
        wp_enqueue_script('ag_gallery_list');
    }
    if ($hook === 'gallery-list_page_ag-create-gallery') {
        wp_register_script( 'ag_create_gallery',  plugins_url('/assets/scripts/gallery-page-create.js',__FILE__ ));
        wp_enqueue_script('ag_create_gallery');
    }
}

add_action('admin_post_ag_save_gallery', 'ag_save_gallery');
function ag_save_gallery() {
    global $wpdb;
    if (!current_user_can('edit_theme_options')) {
        wp_die("Access denied");
    }

    check_admin_referer('ag_verify_gallery', 'ag_input_nonce');

    //TODO sanitize data here  sanitize_text_field, absint
    $table_name = $wpdb->prefix . 'gallery_list';
    $wpdb->insert(
        $table_name,
        array(
            'gallery_name' => $_POST['ag_name'],
            'gallery_img' => "12"
        ),
        array(
            '%s',
            '%s'
        )
    );
    wp_redirect(PLUGIN_BASE_URL);
}