<?php
global $wpdb;
define( 'PLUGIN_DIR', plugin_dir_path( __FILE__ ));
define( 'PLUGIN_AG_DIR_NAME', 'art-gallery');
define( 'PLUGIN_BASE_URL', admin_url('admin.php?page=ag-page'));
define( 'GALLERY_PAGE_TEMPLATE_URL', admin_url('admin.php?page=ag-gallery&name='));

define( 'GALLERY_LIST_TABLE', $wpdb->prefix . "gallery_list");
define( 'IMG_TABLE', $wpdb->prefix . "img_list");

define( 'GALLERY_NUMBER_ALLOWED', 5);

define( 'ITEMS_ON_PAGE', 5);