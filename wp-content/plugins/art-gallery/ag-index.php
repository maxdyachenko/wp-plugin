<?php
/*
Plugin Name:  Art gallery plugin
Description:  Plugin to create your own images galleries and paste it to the page
Author:       Max Dyachenko
*/


if (!function_exists('add_action')) {
    echo "Not allowed!";
    wp_die();
}

include plugin_dir_path( __FILE__ ) . 'ag-config.php';


register_activation_hook( __FILE__, 'ag_activate' );
register_deactivation_hook( __FILE__, 'ag_deactivate' );

function ag_activate(){
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-ag-activator.php';
    Ag_Activator::activate();
}

function ag_deactivate() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-ag-deactivator.php';
    Ag_Deactivator::deactivate();
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
    add_submenu_page(
        'ag-page',  //or null to create page that is not tied to anything
        'Gallery',
        'Gallery',
        'administrator',
        'ag-gallery',
        'ag_gallery'
    );
}

//hach to highlight parent menu when page is not menu item
function my_admin_head() {

    remove_submenu_page( 'ag-page', 'ag-gallery' );
}
add_action( 'admin_head', 'my_admin_head' );
add_action( 'admin_menu', 'ag_register_my_custom_menu_page' );

function ag_gallery_list(){
    global $wpdb;
    $table = GALLERY_LIST_TABLE;
    $gallerylist_data = $wpdb->get_results( "SELECT gallery_name, gallery_img FROM $table" );
    include(PLUGIN_DIR . 'views/gallery-list.php');
}
function ag_create_gallery() {
    $limit = checkGalleryLimit();
    include(PLUGIN_DIR . 'views/create-gallery.php');
}
function ag_gallery() {
    $gallery_name = sanitize_text_field($_GET['name']);
    global $wpdb;
    $table = IMG_TABLE;
    $gallery_data = $wpdb->get_results( "SELECT img_name FROM $table WHERE gallery_name = '$gallery_name'" );
    include(PLUGIN_DIR . 'views/gallery.php');

}
//this function should be global
function checkGalleryLimit() {
    global $wpdb;
    $table = GALLERY_LIST_TABLE;
    $gallery_count =  $wpdb->get_var( "SELECT COUNT(*) FROM $table");
    return $gallery_count == 5;
}



//enqueu styles
add_action('admin_init', 'ag_include_styles');
function ag_include_styles() {
    add_action('admin_enqueue_scripts','ag_include_scripts');
}
function ag_include_scripts($hook) {
    if($hook === 'toplevel_page_ag-page' || $hook === 'gallery-list_page_ag-create-gallery' || $hook === 'gallery-list_page_ag-gallery') {
        wp_register_style( 'ag_bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css');
        wp_enqueue_style('ag_bootstrap');

        wp_register_style( 'ag_main',  plugins_url('/assets/styles/main.css',__FILE__ ));
        wp_enqueue_style('ag_main');

        wp_register_style('ag_fa', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        wp_enqueue_style('ag_fa');

        wp_register_script('ag_jquery', 'https://code.jquery.com/jquery-3.0.0.min.js');
        wp_enqueue_script('ag_jquery');

        wp_register_script('ag_popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js', array('ag_jquery'));
        wp_enqueue_script('ag_popper');

        wp_register_script('ag_bootstrap_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js', array('ag_jquery'));
        wp_enqueue_script('ag_bootstrap_js');

        wp_enqueue_media();
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
    if ($hook === 'gallery-list_page_ag-gallery') {
        wp_register_script( 'ag_gallery',  plugins_url('/assets/scripts/gallery-page.js',__FILE__ ));
        wp_enqueue_script('ag_gallery');
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
    $table = GALLERY_LIST_TABLE;
    $gallery_name = str_replace(" ", "_", $_POST['ag_name']);

    if (checkGalleryLimit() || galleryExist($gallery_name)) {
        wp_redirect(PLUGIN_BASE_URL);
        return;
    }

    $wpdb->insert(
        $table,
        array(
            'gallery_name' => $gallery_name,
            'gallery_img' => $_POST['ag_file']
        ),
        array(
            '%s',
            '%s'
        )
    );
    wp_redirect(PLUGIN_BASE_URL);
}
add_action('admin_post_ag_add_image', 'ag_add_image');
function ag_add_image() {
    global $wpdb;
    if (!current_user_can('edit_theme_options')) {
        wp_die("Access denied");
    }

    check_admin_referer('ag_add_image_action', 'ag_input_nonce');

    $table = IMG_TABLE;

    $gallery_name = $_POST['ag_gallery'];
    $img_name = $_POST['ag_file'];
    if ($wpdb->get_row( "SELECT id FROM $table WHERE gallery_name = '$gallery_name' AND img_name = '$img_name'" )) {
        wp_redirect(admin_url('admin.php?page=ag-gallery&name=' . $gallery_name));
        return;
    }

    $wpdb->insert(
        $table,
        array(
            'gallery_name' => $gallery_name,
            'img_name' => $img_name
        ),
        array(
            '%s',
            '%s'
        )
    );
    wp_redirect(PLUGIN_BASE_URL);
}

function galleryExist($name) {
    global $wpdb;
    $table = GALLERY_LIST_TABLE;
    return $wpdb->get_row( "SELECT id FROM $table WHERE gallery_name = '$name'" );
}

add_action('admin_post_ag_delete_gallery', 'ag_delete_gallery');
function ag_delete_gallery(){
    global $wpdb;
    if (!current_user_can('edit_theme_options')) {
        wp_die("Access denied");
    }

    check_admin_referer('ag_verify_del_gallery', 'ag_input_nonce');

    $table = GALLERY_LIST_TABLE;
    $wpdb->delete( $table, array( 'gallery_name' => $_POST['name'] ), array( '%s' ) );
    wp_redirect(PLUGIN_BASE_URL);

    $table2 = IMG_TABLE;
    $wpdb->delete( $table2, array( 'gallery_name' => $_POST['name'] ), array( '%s' ) );

}

add_action('admin_post_ag_delete_image', 'ag_delete_image');
function ag_delete_image() {
    global $wpdb;
    if (!current_user_can('edit_theme_options')) {
        wp_die("Access denied");
    }

    check_admin_referer('ag_del_image', 'ag_input_nonce');
    $table = IMG_TABLE;
    $wpdb->delete( $table, array( 'img_name' => $_POST['ag_img'], 'gallery_name' => $_POST['ag_gallery'] ), array( '%s', '%s' ) );
    wp_redirect(PLUGIN_BASE_URL);
}
add_action('admin_post_ag_delete_all_images', 'ag_delete_all_images');
function ag_delete_all_images() {
    global $wpdb;
    if (!current_user_can('edit_theme_options')) {
        wp_die("Access denied");
    }

    check_admin_referer('ag_del_all_images', 'ag_input_nonce');
    $table = IMG_TABLE;
    $wpdb->delete( $table, array( 'gallery_name' => $_POST['ag_gallery']), array( '%s') );
    wp_redirect(admin_url('admin.php?page=ag-gallery&name=' . $_POST['ag_gallery']));
}

add_action('admin_post_ag_delete_selected', 'ag_delete_selected');
function ag_delete_selected() {
    global $wpdb;
    if (!current_user_can('edit_theme_options')) {
        wp_die("Access denied");
    }

    check_admin_referer('ag_del_selected', 'ag_input_nonce');
    $table = IMG_TABLE;
    $names =  explode( ',', $_POST['ag_name'] ) ;
    $str = "";
    for ($i = 0;$i < count($names); $i++){
        $str .= "'" . $names[$i] . "'";
        if ($i != count($names) - 1) {
            $str .= ',';
        }
    }

    $sql = "DELETE FROM $table WHERE img_name IN ($str)";

    $wpdb->query($sql);
    wp_redirect(admin_url('admin.php?page=ag-gallery&name=' . $_POST['ag_gallery']));
}
