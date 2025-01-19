<?php
(defined('ABSPATH')) || exit;

add_action('admin_menu', 'op_admin_menu');

/**
 * Fires before the administration menu loads in the admin.
 *
 * @param string $context Empty context.
 */
function op_admin_menu(string $context): void
{



    $menu_suffix = add_menu_page(
        'نصرالله',
        'نصرالله',
        'manage_options',
        'onplus',
        'op_menu_callback',
        'dashicons-hammer',
        55
    );

    add_submenu_page(
        'onplus',
        'لیست',
        'لیست',
        'manage_options',
        'nasr',
        'op_menu_callback',
    );

    function op_menu_callback()
    {
        $op_option = op_start_working();

        $nasrListTable = new List_Table;

        require_once OP_VIEWS . 'list.php';

    }

    $setting_suffix = add_submenu_page(
        'nasr',
        'تنظیمات کلی',
        'تنظیمات کلی',
        'manage_options',
        'setting_panels',
        'setting_panels',
    );

    function setting_panels()
    {
        $op_option = op_start_working();

        require_once OP_VIEWS . 'setting.php';

    }

    $sms_panels_suffix = add_submenu_page(
        'nasr',
        'تنظیمات پنل پیامک',
        'تنظیمات پنل پیامک',
        'manage_options',
        'sms_panels',
        'op_sms_panels',
    );

    function op_sms_panels()
    {
        $op_option = op_start_working();

        require_once OP_VIEWS . 'setting_sms_panels.php';

    }
    $form_panels_suffix = add_submenu_page(
        'nasr',
        'تنظیمات فرم',
        'تنظیمات فرم',
        'manage_options',
        'form_panels',
        'op_form_panels',
    );

    function op_form_panels()
    {
        $op_option = op_start_working();

        require_once OP_VIEWS . 'setting_form_panels.php';

    }

    add_action('load-' . $menu_suffix, 'op__list');
    add_action('load-' . $setting_suffix, 'op__submit');
    add_action('load-' . $sms_panels_suffix, 'op__submit');
    add_action('load-' . $form_panels_suffix, 'op__submit');

    function op__list()
    {

        if (isset($_POST[ 'action2' ]) && in_array($_POST[ 'action2' ], [ 'successful', 'failed', 'delete' ])) {

            $nasrdb = new NasrDB();

            if (sanitize_text_field($_POST[ 'action2' ]) == 'delete') {

                foreach ($_POST[ 'op_row' ] as $row) {
                    $delete_row = $nasrdb->delete(intval($row));

                }

            } else {

                foreach ($_POST[ 'op_row' ] as $row) {
                    $data         = [ 'status' => sanitize_text_field($_POST[ 'action2' ]) ];
                    $where        = [ 'ID' => intval($row) ];
                    $format       = [ '%s' ];
                    $where_format = [ '%d' ];

                    $nasrdb->update($data, $where, $format, $where_format);
                }

            }

        }

    }

    function op__submit()
    {

        if (isset($_POST[ 'op_act' ]) && $_POST[ 'op_act' ] == 'op__submit') {

            if (isset($_POST[ 'form' ])) {

                $_POST[ 'form' ][ 'text' ]           = wp_kses_post(wp_unslash(nl2br($_POST[ 'form' ][ 'text' ])));
                $_POST[ 'form' ][ 'ostan' ]          = (isset($_POST[ 'form' ][ 'ostan' ])) ? true : false;
                $_POST[ 'form' ][ 'ostan_required' ] = (isset($_POST[ 'form' ][ 'ostan_required' ])) ? true : false;
                $_POST[ 'form' ][ 'avatar' ]         = (isset($_POST[ 'form' ][ 'avatar' ])) ? true : false;
                $_POST[ 'form' ][ 'description' ]    = (isset($_POST[ 'form' ][ 'description' ])) ? true : false;
                $_POST[ 'form' ][ 'signature' ]      = (isset($_POST[ 'form' ][ 'signature' ])) ? true : false;

            }

            if (wp_verify_nonce($_POST[ '_wpnonce' ], 'op_nonce' . get_current_user_id())) {
                if (isset($_POST[ 'tsms' ])) {
                    $_POST[ 'tsms' ] = array_map('sanitize_text_field', $_POST[ 'tsms' ]);
                }
                if (isset($_POST[ 'ghasedaksms' ])) {
                    $_POST[ 'ghasedaksms' ] = array_map('sanitize_text_field', $_POST[ 'ghasedaksms' ]);
                }

                op_update_option($_POST);

                set_transient('success_mat', 'تغییر با موفقیت ثبت شد');

            } else {
                set_transient('error_mat', 'ذخیره سازی به مشکل خورده دوباره تلاش کنید');

            }

        }

    }

}








function remove_duplicate_taxonomy_submenus() {
    global $submenu;

    // حذف زیرمنوی اضافی تاکسونومی از بخش پست تایپ‌های خاص
    if (isset($submenu['edit.php?post_type=episode_cat'])) {


        foreach ($submenu['edit.php?post_type=episode_cat'] as $key => $menu_item) {


            if ($menu_item[2] == 'edit-tags.php?taxonomy=on_category&amp;post_type=episode_cat') {
                unset($submenu['edit.php?post_type=episode_cat'][$key]);
            }
            if ($menu_item[2] == 'edit-tags.php?taxonomy=on_tag&amp;post_type=episode_cat') {
                unset($submenu['edit.php?post_type=episode_cat'][$key]);
            }
            if ($menu_item[2] == 'edit-tags.php?taxonomy=on_agents&amp;post_type=episode_cat') {
                unset($submenu['edit.php?post_type=episode_cat'][$key]);
            }
            if ($menu_item[2] == 'edit-tags.php?taxonomy=on_position&amp;post_type=episode_cat') {
                unset($submenu['edit.php?post_type=episode_cat'][$key]);
            }
        }

        
        
    }
}

add_action('admin_menu', 'remove_duplicate_taxonomy_submenus', 100);