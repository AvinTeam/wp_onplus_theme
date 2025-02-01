<?php

(defined('ABSPATH')) || exit;
function arma_row_install()
{
    arma_panel_rewrite();
    flush_rewrite_rules();


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





}

add_action('after_switch_theme', 'arma_row_install');
