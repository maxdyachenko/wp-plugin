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
 *
 */
include_once PLUGIN_DIR . 'admin/model/class-model-admin.php';
class Ag_Admin {



	public function __construct() {
        $this->model = new Ag_Admin_Model();
//		$this->plugin_name = $plugin_name;
//		$this->version = $version;

	}


	public function enqueueStyles($hook) {
        if($hook === 'toplevel_page_ag-page' || $hook === 'gallery-list_page_ag-create-gallery' || $hook === 'gallery-list_page_ag-gallery') {
            wp_register_style( 'ag_bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css');
            wp_enqueue_style('ag_bootstrap');
            wp_register_style( 'ag_main',  plugins_url('/assets/styles/main.css', PLUGIN_DIR . PLUGIN_AG_DIR_NAME ));
            wp_enqueue_style('ag_main');

            wp_register_style('ag_fa', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
            wp_enqueue_style('ag_fa');
        }
	}

	public function enqueueScripts($hook) {
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
            wp_register_script( 'ag_gallery_list',  plugins_url( '/assets/scripts/gallery-list.js', PLUGIN_DIR . PLUGIN_AG_DIR_NAME));
            wp_enqueue_script('ag_gallery_list');
        }
        if ($hook === 'gallery-list_page_ag-create-gallery') {
            wp_register_script( 'ag_create_gallery',  plugins_url('/assets/scripts/gallery-page-create.js', PLUGIN_DIR . PLUGIN_AG_DIR_NAME));
            wp_enqueue_script('ag_create_gallery');
        }
        if ($hook === 'gallery-list_page_ag-gallery') {
            wp_register_script( 'ag_gallery',  plugins_url('/assets/scripts/gallery-page.js', PLUGIN_DIR . PLUGIN_AG_DIR_NAME));
            wp_enqueue_script('ag_gallery');
        }
	}

	public function registerCustomPage() {
        add_menu_page(
            'Art gallery',
            'Gallery list',
            'administrator',
            'ag-page',
            array($this, 'galleryListPage')
        );
        add_submenu_page(
            'ag-page',
            'Create Gallery',
            'Create Gallery',
            'administrator',
            'ag-create-gallery',
            array($this,'createGalleryPage')
        );
        add_submenu_page(
            'ag-page',
            'Gallery',
            'Gallery',
            'administrator',
            'ag-gallery',
            array($this, 'galleryPage')
        );
    }

    public function removeGalleryPage() {
        remove_submenu_page( 'ag-page', 'ag-gallery' );
    }

    public function saveGallery() {
	    $this->checkSecurity('ag_verify_gallery', 'ag_input_nonce');

        $this->model->saveGallery();

        wp_redirect(PLUGIN_BASE_URL);
    }

    public function galleryListPage() {
	    $gallerylist_data = $this->model->getGallerysList();
        include(PLUGIN_DIR . 'admin/view/gallery-list.php');
    }
    public function createGalleryPage() {
        $limit = $this->model->checkGalleryLimit();
        include(PLUGIN_DIR . 'admin/view/create-gallery.php');
    }
    public function galleryPage() {
        $gallery_name = sanitize_text_field($_GET['name']);
        $gallery_data = $this->model->getGalleryData();
        include(PLUGIN_DIR . 'admin/view/gallery.php');
    }

    public function deleteGallery() {
	    $this->checkSecurity('ag_verify_del_gallery', 'ag_input_nonce');

	    $this->model->deleteGallery();

        wp_redirect(PLUGIN_BASE_URL);
    }

    public function addImage() {
	    $this->checkSecurity('ag_add_image_action', 'ag_input_nonce');

	    $this->model->addIMage();
    }

    public function deleteImage() {
	    $this->checkSecurity('ag_del_image', 'ag_input_nonce');

	    $this->model->deleteImage();
    }

    public function deleteAllImages() {
	    $this->checkSecurity('ag_del_all_images', 'ag_input_nonce');

	    $this->model->deleteAllImages();
    }

    public function checkSecurity($action, $input){
        if (!current_user_can('edit_theme_options')) {
            wp_die("Access denied");
        }
        check_admin_referer($action, $input);
    }

}
