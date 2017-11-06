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

