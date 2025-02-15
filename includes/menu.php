<?php
(defined('ABSPATH')) || exit;

add_action('admin_menu', 'arma_admin_menu');

/**
 * Fires before the administration menu loads in the admin.
 *
 * @param string $context Empty context.
 */
function arma_admin_menu(string $context): void
{

    add_menu_page(
        'کامامدیا',
        'کامامدیا',
        'manage_options',
        'arma',
        'arma_visited',
        'dashicons-hammer',
        2
    );

    $visited_suffix = add_submenu_page(
        'arma',
        'آمارگیر',
        'آمارگیر',
        'manage_options',
        'arma',
        'arma_visited',
    );

    function arma_visited()
    {
        $arma_option = arma_start_working();

        require_once ARMA_VIEWS . 'menu/visited.php';

    }

    $setting_suffix = add_submenu_page(
        'arma',
        'تنظیمات',
        'تنظیمات',
        'manage_options',
        'arma_setting',
        'setting_panels',
    );

    function setting_panels()
    {
        $arma_option = arma_start_working();

        require_once ARMA_VIEWS . 'menu/setting.php';

    }

    $sms_panels_suffix = add_submenu_page(
        'arma',
        'تنظیمات پنل پیامک',
        'تنظیمات پنل پیامک',
        'manage_options',
        'sms_panels',
        'arma_sms_panels',
    );

    function arma_sms_panels()
    {
        $arma_option = arma_start_working();

        require_once ARMA_VIEWS . 'menu/setting_sms_panels.php';

    }

    $home_page_suffix = add_submenu_page(
        'arma',
        'تنظیمات صفحه نخست',
        'تنظیمات صفحه نخست',
        'manage_options',
        'arma_home_page',
        'arma_home_page',
    );

    function arma_home_page()
    {
        $arma_option = arma_start_working();

        require_once ARMA_VIEWS . 'menu/home_page.php';

    }

    add_action('load-' . $setting_suffix, 'arma__submit');
    add_action('load-' . $sms_panels_suffix, 'arma__submit');
    add_action('load-' . $home_page_suffix, 'arma__home_page');

    function arma__submit()
    {

        if (isset($_POST[ 'arma_act' ]) && $_POST[ 'arma_act' ] == 'arma__submit') {

            if (wp_verify_nonce($_POST[ '_wpnonce' ], 'arma_nonce' . get_current_user_id())) {
                if (isset($_POST[ 'tsms' ])) {
                    $_POST[ 'tsms' ] = array_map('sanitize_text_field', $_POST[ 'tsms' ]);
                }
                if (isset($_POST[ 'ghasedaksms' ])) {
                    $_POST[ 'ghasedaksms' ] = array_map('sanitize_text_field', $_POST[ 'ghasedaksms' ]);
                }

                arma_update_option($_POST);

                wp_admin_notice(
                    'تغییر شما با موفقیت ثبت شد',
                    [
                        'id'          => 'message',
                        'type'        => 'success',
                        'dismissible' => true,
                     ]
                );

            } else {
                wp_admin_notice(
                    'ذخیره سازی به مشکل خورده دوباره تلاش کنید',
                    [
                        'id'          => 'arma_message',
                        'type'        => 'error',
                        'dismissible' => true,
                     ]
                );

            }

        }

    }

    function arma__home_page()
    {

        if (isset($_POST[ 'arma_act' ]) && $_POST[ 'arma_act' ] == 'arma__home_page') {

            if (wp_verify_nonce($_POST[ '_wpnonce' ], 'arma_nonce' . get_current_user_id())) {

                arma_update_option($_POST);
                wp_admin_notice(
                    'تغییر شما با موفقیت ثبت شد',
                    [
                        'id'          => 'message',
                        'type'        => 'success',
                        'dismissible' => true,
                     ]
                );

            } else {
                wp_admin_notice(
                    'ذخیره سازی به مشکل خورده دوباره تلاش کنید',
                    [
                        'id'          => 'arma_message',
                        'type'        => 'error',
                        'dismissible' => true,
                     ]
                );

            }
        }

    }

}

function remove_duplicate_taxonomy_submenus()
{
    global $submenu;

    // حذف زیرمنوی اضافی تاکسونومی از بخش پست تایپ‌های خاص
    if (isset($submenu[ 'edit.php?post_type=episode_cat' ])) {

        foreach ($submenu[ 'edit.php?post_type=episode_cat' ] as $key => $menu_item) {

            if ($menu_item[ 2 ] == 'edit-tags.php?taxonomy=on_category&amp;post_type=episode_cat') {
                unset($submenu[ 'edit.php?post_type=episode_cat' ][ $key ]);
            }
            if ($menu_item[ 2 ] == 'edit-tags.php?taxonomy=on_tag&amp;post_type=episode_cat') {
                unset($submenu[ 'edit.php?post_type=episode_cat' ][ $key ]);
            }
            if ($menu_item[ 2 ] == 'edit-tags.php?taxonomy=on_agents&amp;post_type=episode_cat') {
                unset($submenu[ 'edit.php?post_type=episode_cat' ][ $key ]);
            }
            if ($menu_item[ 2 ] == 'edit-tags.php?taxonomy=on_position&amp;post_type=episode_cat') {
                unset($submenu[ 'edit.php?post_type=episode_cat' ][ $key ]);
            }
        }

    }
}

add_action('admin_menu', 'remove_duplicate_taxonomy_submenus', 100);
