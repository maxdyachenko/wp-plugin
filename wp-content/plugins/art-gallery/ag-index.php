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


require plugin_dir_path( __FILE__ ) . 'includes/class-ag.php';

function run_ag() {

    $plugin = new AG();
    $plugin->run();

}
run_ag();


//add_action('admin_post_ag_delete_selected', 'ag_delete_selected');
//function ag_delete_selected() {
//    global $wpdb;
//    if (!current_user_can('edit_theme_options')) {
//        wp_die("Access denied");
//    }
//
//    check_admin_referer('ag_del_selected', 'ag_input_nonce');
//    $table = IMG_TABLE;
//    $names =  explode( ',', $_POST['ag_name'] ) ;
//    $str = "";
//    for ($i = 0;$i < count($names); $i++){
//        $str .= "'" . $names[$i] . "'";
//        if ($i != count($names) - 1) {
//            $str .= ',';
//        }
//    }
//
//    $sql = "DELETE FROM $table WHERE img_name IN ($str)";
//
//    $wpdb->query($sql);
//    wp_redirect(admin_url('admin.php?page=ag-gallery&name=' . $_POST['ag_gallery']));
//}
