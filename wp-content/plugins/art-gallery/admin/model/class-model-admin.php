<?php

class Ag_Admin_Model {
    public $wpdb;

    public function __construct() {
        global $wpdb;
        $this->wpdb = $wpdb;
    }

    public function getGallerysList() {
        $table = GALLERY_LIST_TABLE;
        return $this->wpdb->get_results( "SELECT gallery_name, gallery_img FROM $table" );
    }

    public function checkGalleryLimit() {
        $table = GALLERY_LIST_TABLE;
        $gallery_count =  $this->wpdb->get_var( "SELECT COUNT(*) FROM $table");
        return $gallery_count == GALLERY_NUMBER_ALLOWED;
    }

    public function galleryExist($name) {
        $table = GALLERY_LIST_TABLE;
        return $this->wpdb->get_row( "SELECT id FROM $table WHERE gallery_name = '$name'" );
    }

    public function saveGallery() {
        $table = GALLERY_LIST_TABLE;
        $name = sanitize_text_field($_POST['ag_name']);
        $file = sanitize_text_field($_POST['ag_file']);
        $gallery_name = str_replace(" ", "_", $name);

        if ($this->checkGalleryLimit() || $this->galleryExist($gallery_name)) {
            wp_redirect(PLUGIN_BASE_URL);
            return;
        }

        $this->wpdb->insert(
            $table,
            array(
                'gallery_name' => $gallery_name,
                'gallery_img' => $file
            ),
            array(
                '%s',
                '%s'
            )
        );
    }

    public function deleteGallery(){
        $table = GALLERY_LIST_TABLE;
        $name = sanitize_text_field($_POST['name']);
        $this->wpdb->delete( $table, array( 'gallery_name' => $name ), array( '%s' ) );

        $table2 = IMG_TABLE;
        $this->wpdb->delete( $table2, array( 'gallery_name' => $name ), array( '%s' ) );
    }

    public function getGalleryData() {
        $gallery_name = sanitize_text_field($_GET['name']);
        $table = IMG_TABLE;
        return $this->wpdb->get_results( "SELECT img_name, gallery_name FROM $table WHERE gallery_name = '$gallery_name'" );
    }

    public function addImage() {
        $table = IMG_TABLE;

        $gallery_name = sanitize_text_field($_POST['ag_gallery']);
        $img_name = sanitize_text_field($_POST['ag_file']);
        if ($this->wpdb->get_row( "SELECT id FROM $table WHERE gallery_name = '$gallery_name' AND img_name = '$img_name'" )) {
            wp_redirect(admin_url('admin.php?page=ag-gallery&name=' . $gallery_name));
            return;
        }

        $this->wpdb->insert(
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
        wp_redirect(admin_url('admin.php?page=ag-gallery&name=' . $gallery_name));
    }

    public function deleteImage() {
        $table = IMG_TABLE;
        $img = sanitize_text_field($_POST['ag_img']);
        $gallery = sanitize_text_field($_POST['ag_gallery']);
        $this->wpdb->delete( $table, array( 'img_name' => $img, 'gallery_name' => $gallery ), array( '%s', '%s' ) );
        wp_redirect(admin_url('admin.php?page=ag-gallery&name=' . $gallery));
    }

    public function deleteAllImages() {
        $table = IMG_TABLE;
        $gallery = sanitize_text_field($_POST['ag_gallery']);
        $this->wpdb->delete( $table, array( 'gallery_name' => $gallery), array( '%s') );
        wp_redirect(admin_url('admin.php?page=ag-gallery&name=' . $gallery));
    }

}