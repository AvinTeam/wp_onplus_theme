<?php
(defined('ABSPATH')) || exit;

add_action('init', 'action_init');

/**
 * Fires after WordPress has finished loading but before any headers are sent.
 *
 */
function action_init(): void
{
    if (isset($_POST[ 'act' ])) {

        $massage = '';

        if ($_POST[ 'act' ] == 'submit_profile') {

            if (is_user_logged_in() && wp_verify_nonce($_POST[ '_wpnonce' ], 'arma_nonce' . arma_cookie())) {
                $current_user_id = get_current_user_id();

                // گرفتن و تمیز کردن داده‌های متنی
                $first_name   = sanitize_text_field($_POST[ 'first_name' ]);
                $last_name    = sanitize_text_field($_POST[ 'last_name' ]);
                $home_address = sanitize_textarea_field($_POST[ 'home_address' ]);

                if ($first_name != "") {
                    update_user_meta($current_user_id, 'first_name', $first_name);

                } else {
                    $massage .= '<div class="alert alert-danger" role="alert">نام نمیتواند خالی باشد</div>';
                }

                if ($last_name != "") {
                    update_user_meta($current_user_id, 'last_name', $last_name);

                } else {
                    $massage .= '<div class="alert alert-danger" role="alert">نام خانوادگی نمیتواند خالی باشد</div>';
                }

                if ($home_address != "") {
                    update_user_meta($current_user_id, 'home_address', $home_address);

                } else {
                    $massage .= '<div class="alert alert-danger" role="alert">آدرس نمیتواند خالی باشد</div>';
                }

                if (isset($_POST[ 'checke_rules' ]) || absint(get_user_meta($current_user_id, 'checke_rules', true))) {
                    update_user_meta($current_user_id, 'checke_rules', 1);

                } else {
                    $massage .= '<div class="alert alert-danger" role="alert">شرایط و قوانین استفاده از جشنواره را تایید نکردید</div>';
                }

                $full_name = $first_name . ' ' . $last_name;

                update_user_meta($current_user_id, 'nickname', $full_name);

                $user_id = wp_update_user([
                    'ID'           => $current_user_id,
                    'display_name' => $full_name,
                 ]);

                if (! empty($_FILES[ 'user_image' ][ 'name' ])) {
                    $upload = arma_upload_file($_FILES[ 'user_image' ]);

                    if ($upload[ 'code' ]) {

                        $attach_id = $upload[ 'massage' ];
                        update_user_meta($current_user_id, 'user_avatar', $attach_id);

                    } else {
                        $massage .= $upload[ 'massage' ];
                    }
                }
            } else {
                $massage .= '<div class="alert alert-danger" role="alert">خطایی در زمان ذخیره تغییرات رخ داده است</div>';
            }

            if ($massage == "") {

                $massage .= '<div class="alert alert-success" role="alert">تغییرات شما با موفقیت ذخیره شد</div>';

            }
        }

        if (isset($_POST[ '_wp_http_referer' ])) {

            set_transient('arma_transient', $massage, MINUTE_IN_SECONDS);

            $updated_url = str_replace('/panel/', '', $_POST[ '_wp_http_referer' ]);
            arma_cookie();
            wp_redirect(arma_template_path($updated_url));
            exit;

        }

    }

}
