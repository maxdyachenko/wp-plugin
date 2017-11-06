<?php


/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin
 * @author     Your Name <email@example.com>
 */
class Ag_Admin {




	public function __construct() {

//		$this->plugin_name = $plugin_name;
//		$this->version = $version;

	}


	public function enqueue_styles($hook) {
        if($hook === 'toplevel_page_ag-page' || $hook === 'gallery-list_page_ag-create-gallery' || $hook === 'gallery-list_page_ag-gallery') {
            wp_register_style( 'ag_bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css');
            wp_enqueue_style('ag_bootstrap');

            wp_register_style( 'ag_main',  plugins_url('/assets/styles/main.css',__FILE__ ));
            wp_enqueue_style('ag_main');

            wp_register_style('ag_fa', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
            wp_enqueue_style('ag_fa');
        }
	}

	public function enqueue_scripts($hook) {
        if($hook === 'toplevel_page_ag-page' || $hook === 'gallery-list_page_ag-create-gallery' || $hook === 'gallery-list_page_ag-gallery') {
            wp_register_script('ag_jquery', 'https://code.jquery.com/jquery-3.0.0.min.js');
            wp_enqueue_script('ag_jquery');

            wp_register_script('ag_popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js', array('ag_jquery'));
            wp_enqueue_script('ag_popper');

            wp_register_script('ag_bootstrap_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js', array('ag_jquery'));
            wp_enqueue_script('ag_bootstrap_js');

            wp_enqueue_media();
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

	public function register_custom_page() {
        add_menu_page(
            'Art gallery',
            'Gallery list',
            'administrator',
            'ag-page',
            array($this, 'gallery_list_page')
        );
        add_submenu_page(
            'ag-page',  //or null to create page that is not tied to anything
            'Create Gallery',
            'Create Gallery',
            'administrator',
            'ag-create-gallery',
            array($this,'create_gallery_page')
        );
        add_submenu_page(
            'ag-page',  //or null to create page that is not tied to anything
            'Gallery',
            'Gallery',
            'administrator',
            'ag-gallery',
            array($this, 'gallery_page')
        );
    }

    public function remove_gallery_page() {
        remove_submenu_page( 'ag-page', 'ag-gallery' );
    }

    public function gallery_list_page() {

    }
    public function create_gallery_page() {
	    
    }
    public function gallery_page() {

    }

}
