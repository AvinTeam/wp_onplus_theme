<?php
(defined('ABSPATH')) || exit;

function arma_title_filter($title)
{
    if (is_home() || is_front_page()) {
        $title = get_bloginfo('name') . " | صفحه اصلی";
    } elseif (is_single() || is_page()) {
        $title = get_the_title() . " | " . get_bloginfo('name');
    } elseif (is_category()) {
        $title = single_cat_title('', false) . " | دسته‌بندی";
    } elseif (is_tag()) {
        $title = single_tag_title('', false) . " | برچسب";
    } elseif (is_search()) {
        $title = "نتایج جستجو برای " . get_search_query();
    } elseif (is_404()) {
        $title = get_bloginfo('name') . "صفحه پیدا نشد | ";
    } else {
        $title = get_bloginfo('name');
    }
    return $title;
}
add_filter('wp_title', 'arma_title_filter');

function custom_single_template($single)
{
    global $post;

    // بررسی نوع پست و استفاده از episode.php
    if ($post->post_type == 'episode' || $post->post_type == 'episode_cat') {
        if (file_exists(get_template_directory() . '/episode.php')) {
            return get_template_directory() . '/episode.php';
        }
    }

    return $single;
}
add_filter('single_template', 'custom_single_template');


function custom_avatar_with_attachment($avatar, $id_or_email, $size, $default, $alt)
{
    $user = false;

    if (is_numeric($id_or_email)) {
        $user = get_user_by('id', $id_or_email);
    } elseif (is_object($id_or_email)) {
        if (!empty($id_or_email->user_id)) {
            $user = get_user_by('id', $id_or_email->user_id);
        } elseif (!empty($id_or_email->comment_author_email) && is_email($id_or_email->comment_author_email)) {
            $user = get_user_by('email', $id_or_email->comment_author_email);
        }
    } elseif (is_string($id_or_email) && is_email($id_or_email)) {
        $user = get_user_by('email', $id_or_email);
    }

    if ($user) {
        $attachment_id = get_user_meta($user->ID, 'user_avatar', true);
        if (!empty($attachment_id)) {
            $attachment_url = wp_get_attachment_image_url($attachment_id, [$size, $size]); // دریافت URL تصویر
            if ($attachment_url) {
                return "<img src='" . esc_url($attachment_url) . "' alt='" . esc_attr($alt) . "' class='avatar avatar-$size' height='$size' width='$size' />";
            }
        }
    }

    return $avatar;
}

add_filter('get_avatar', 'custom_avatar_with_attachment', 10, 5);
