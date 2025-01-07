<?php

(defined('ABSPATH')) || exit;
function nasr_row_install()
{


    if (get_role('mat_user') == null) {
        add_role(
            'mat_user',
            'عضو تیم',
            [
                'read' => true,

             ]
        );

    }

    if (get_role('mat_leader') == null) {
        add_role(
            'mat_leader',
            'سر تیم',
            [
                'read' => true,
                'read_onplus' => true,
                'edit_onplus' => true,
                'edit_onpluss' => true,
                'publish_onpluss' => true,
                'edit_published_onpluss' => true,
                'mat_alf' => true,
                'mat_leader' => true,

             ]
        );

    }

    if (get_role('mat_referee') == null) {
        add_role(
            'mat_referee',
            'داور جشنواره',
            [
                'read' => true,
                'read_onplus' => true,
                'edit_onpluss' => true,
                //'edit_others_onpluss' => true,
                'mat_alf' => true,
                'mat_referee' => true,
             ]
        );

    }

    if (get_role('mat_admin') == null) {
        add_role(
            'opuploader',
            'آپلودر',
            [
                'read' => true,
                'opuploader' => true,
                'edit_onplus' => true,
                'read_onplus' => true,
                'delete_onplus' => true,
                'edit_onpluss' => true,
                'edit_others_onpluss' => true,
                'delete_onpluss' => true,
                'publish_onpluss' => true,
                'edit_published_onpluss' => true,
                'edit_private_onpluss' => true,
                'delete_others_onpluss' => true,
                'read_private_onpluss' => true,
                'delete_published_onpluss' => true,
                'delete_private_onpluss' => true,
             

             ]
        );

    }

    $admin_role = get_role('administrator');

    if (!array_key_exists('edit_onplus', $admin_role->capabilities)) {
        $admin_role->add_cap('opuploader');
        $admin_role->add_cap('edit_onplus');
        $admin_role->add_cap('read_onplus');
        $admin_role->add_cap('delete_onplus');
        $admin_role->add_cap('edit_onpluss');
        $admin_role->add_cap('edit_others_onpluss');
        $admin_role->add_cap('delete_onpluss');
        $admin_role->add_cap('publish_onpluss');
        $admin_role->add_cap('edit_published_onpluss');
        $admin_role->add_cap('edit_private_onpluss');
        $admin_role->add_cap('delete_others_onpluss');
        $admin_role->add_cap('read_private_onpluss');
        $admin_role->add_cap('delete_published_onpluss');
        $admin_role->add_cap('delete_private_onpluss');
    }



    // global $wpdb;
    // $tabel_nasr_row = $wpdb->prefix . 'nasr_row';
    // $wpdb_collate_nasr_row = $wpdb->collate;
    // $sql = "CREATE TABLE IF NOT EXISTS `$tabel_nasr_row` (
    //         `ID` bigint unsigned NOT NULL AUTO_INCREMENT,
    //         `full_name` varchar(50) CHARACTER SET utf8mb4 COLLATE $wpdb_collate_nasr_row NOT NULL DEFAULT '',
    //         `mobile` varchar(11) COLLATE $wpdb_collate_nasr_row NOT NULL,
    //         `avatar` varchar(20) CHARACTER SET utf8mb4 COLLATE $wpdb_collate_nasr_row NOT NULL DEFAULT 'no',
    //         `ostan` int NOT NULL DEFAULT '0',
    //         `description` text COLLATE $wpdb_collate_nasr_row,
    //         `signature` longtext CHARACTER SET utf8mb4 COLLATE $wpdb_collate_nasr_row,
    //         `status` varchar(20) COLLATE $wpdb_collate_nasr_row NOT NULL,
    //         `created_at` timestamp NOT NULL,
    //         PRIMARY KEY (`ID`),
    //         UNIQUE KEY `mobile` (`mobile`)
    //         ) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=$wpdb_collate_nasr_row";

    // require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    // dbDelta($sql);

}

add_action('after_switch_theme', 'nasr_row_install');
