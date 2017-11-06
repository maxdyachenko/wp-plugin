<?php

class Ag_Shortcode {
    public function __construct()
    {
        $this->model = new Ag_Admin_Model();
    }

    public function addShortcode($atts){
        $gallery_data = $this->model->getGalleryDataByName($atts['id']);

        include_once (PLUGIN_DIR . 'public/view/gallery.php');
    }
}