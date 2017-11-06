<?php

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 */
class Ag_Activator {

	public static function activate() {
        global $wpdb;
        $table = GALLERY_LIST_TABLE;
        $sql = "CREATE TABLE IF NOT EXISTS `$table` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `gallery_name` varchar(255) NOT NULL,
          `gallery_img` varchar(255) NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        $wpdb->query($sql);
        $table2 = IMG_TABLE;
        $sql = "CREATE TABLE IF NOT EXISTS `$table2` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `gallery_name` varchar(255) NOT NULL,
          `img_name` varchar(255) NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        $wpdb->query($sql);
	}

}
