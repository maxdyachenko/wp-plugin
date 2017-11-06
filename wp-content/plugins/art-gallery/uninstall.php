<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

global $wpdb;

$table = GALLERY_LIST_TABLE;
$table2 = IMG_TABLE;

$sql = "DELETE $table";
$sql2 = "DELETE $table2";

$wpdb->query($sql);
$wpdb->query($sql2);