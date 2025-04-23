<?php

(defined('ABSPATH')) || exit;
function arma_row_install()
{
    arma_panel_rewrite();
    flush_rewrite_rules();


    if (get_role('opuploader') == null) {
        add_role(
            'opuploader',
            'آپلودر',
            [
                'read'                     => true,
                'opuploader'               => true,
                'edit_onplus'              => true,
                'read_onplus'              => true,
                'delete_onplus'            => true,
                'edit_onpluss'             => true,
                'edit_others_onpluss'      => true,
                'delete_onpluss'           => true,
                'publish_onpluss'          => true,
                'edit_published_onpluss'   => true,
                'edit_private_onpluss'     => true,
                'delete_others_onpluss'    => true,
                'read_private_onpluss'     => true,
                'delete_published_onpluss' => true,
                'delete_private_onpluss'   => true,

             ]
        );

    }

    $admin_role = get_role('administrator');

    if (! array_key_exists('edit_onplus', $admin_role->capabilities)) {
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

    global $wpdb;
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    $wpdb_collate = $wpdb->collate;

    $tabel_bookmark_row = $wpdb->prefix . 'arma_bookmark';
    $sql_bookmark       = "CREATE TABLE IF NOT EXISTS `$tabel_bookmark_row` (
                            `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                            `post_type` varchar(50) COLLATE $wpdb_collate NOT NULL,
                            `idpost` bigint NOT NULL,
                            `iduser` bigint NOT NULL,
                            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                            PRIMARY KEY (`id`)
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=$wpdb_collate ";

    dbDelta($sql_bookmark);

    $tabel_visit_row = $wpdb->prefix . 'arma_visit';
    $sql_visit       = "CREATE TABLE IF NOT EXISTS `$tabel_visit_row` (
                            `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                            `visiter` varchar(255) NOT NULL,
                            `type_track` varchar(20) NOT NULL,
                            `idtrack` bigint unsigned NOT NULL DEFAULT '0',
                            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                            PRIMARY KEY (`id`)
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=$wpdb_collate ";

    dbDelta($sql_visit);

    $tabel_like_row = $wpdb->prefix . 'arma_like';
    $sql_like       = "CREATE TABLE IF NOT EXISTS `$tabel_like_row` (
                        `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                        `iduser` bigint unsigned NOT NULL,
                        `idpost` bigint unsigned NOT NULL,
                        `post_type` varchar(50) NOT NULL,
                        `like_type` varchar(10) NOT NULL,
                        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                        PRIMARY KEY (`id`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=$wpdb_collate ";

    dbDelta($sql_like);

}

add_action('after_switch_theme', 'arma_row_install');