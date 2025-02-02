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
                $profileName = sanitize_text_field($_POST[ 'profileName' ]);
                $gender      = sanitize_text_field($_POST[ 'gender' ]);
                $birthday    = sanitize_textarea_field($_POST[ 'birthday' ]);

                update_user_meta($current_user_id, 'gender', $gender);

                if ($profileName != "") {
                    update_user_meta($current_user_id, 'nickname', $profileName);

                    $user_id = wp_update_user([
                        'ID'           => $current_user_id,
                        'display_name' => $profileName,
                     ]);

                } else {
                    $massage .= '<div class="alert alert-danger" role="alert">نام پروفایل نمیتواند خالی باشد</div>';
                }

                if ($birthday != "") {
                    update_user_meta($current_user_id, 'birthday', tarikh($birthday));

                }

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

            $updated_url = str_replace('/panel/', '', $_POST[ '_wp_http_referer' ]);

            set_transient('arma_transient', $massage, MINUTE_IN_SECONDS);

            wp_redirect(arma_base_url($updated_url));

            exit;

        }

    }

}
