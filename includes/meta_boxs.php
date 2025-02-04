<?php

use oniclass\ARMADB;

(defined('ABSPATH')) || exit;

add_action('add_meta_boxes', 'arma_meta_box');

function arma_meta_box()
{

    $arma_page = (isset($_GET[ 'cat' ])) ? 'قسمت' : 'برش';
    add_meta_box(
        'arma_post_information',
        "اطلاعات " . $arma_page,
        'arma_post_information_metabox_callback',
        [ 'episode', 'episode_cat' ],
        'normal',
        'high'
    );

    function arma_post_information_metabox_callback($post)
    {
        $arma_brief           = get_post_meta($post->ID, '_arma_brief', true);
        $arma_video           = get_post_meta($post->ID, '_arma_video', true);
        $arma_production_date = get_post_meta($post->ID, '_arma_production_date', true);

        include_once ARMA_VIEWS . 'metabox/post_information.php';

    }
    add_meta_box(
        'arma_colleagues',
        "همکاران ",
        'arma_colleagues_metabox_callback',
        [ 'episode' ],
        'normal',
        'high'
    );

    function arma_colleagues_metabox_callback($post)
    {

        $arma_colleagues = get_post_meta($post->ID, '_arma_colleagues', true);

        $arma_colleagues = (is_array($arma_colleagues)) ? $arma_colleagues : [  ];

        include_once ARMA_VIEWS . 'metabox/colleagues.php';

    }

    add_meta_box(
        'arma_statistics',
        "آمار کلی",
        'arma_statistics_metabox_callback',
        [ 'episode', 'episode_cat' ],
        'side',
        'high'
    );

    function arma_statistics_metabox_callback($post)
    {

        $all_visited = intval(get_post_meta($post->ID, '_arma_visited', true));

        $bookmarkdb     = new ARMADB('bookmark');
        $bookmark_count = $bookmarkdb->num([ 
            'post_type' => get_post_type($post->ID),
            'idpost' => $post->ID,
         ]);

        $visitdb = new ARMADB('visit');

        $this_data = date('Y-m-d');

        $data = [
            'type_track' => get_post_type($post->ID),
            'idtrack'    => $post->ID,
         ];
        $today_visited = $visitdb->num($data, "DATE(`created_at`) = '$this_data'");

        include_once ARMA_VIEWS . 'metabox/statistics.php';

    }

    add_meta_box(
        'arma_episode',
        "انتخاب اپیزود",
        'arma_episode_metabox_callback',
        [ 'episode_cat' ],
        'side',
        'core'
    );

    function arma_episode_metabox_callback($post)
    {
        $arma_episode = absint(get_post_meta($post->ID, '_arma_episode', true));

        $all_post_obtion = '';

        // دریافت تمام دسته‌بندی‌های مربوط به پست
        $terms = wp_get_post_terms($post->ID, 'on_category');

        if (! empty($terms) && ! is_wp_error($terms)) {
            // آرایه‌ای از آی‌دی دسته‌بندی‌ها
            $term_ids = wp_list_pluck($terms, 'term_id');

            // حالا پست‌های مرتبط با این دسته‌بندی‌ها رو واکشی کن
            $args = [
                'post_type'      => 'episode', // نوع پست (اگر سفارشی داری، اسمش رو عوض کن)
                'tax_query'      => [
                    [
                        'taxonomy' => 'on_category', // نام تاکسونومی
                        'field'    => 'term_id',     // جستجو بر اساس آی‌دی دسته‌بندی
                        'terms'    => $term_ids,     // آی‌دی دسته‌بندی‌ها
                     ],
                 ],
                'posts_per_page' => -1, // تعداد پست‌هایی که می‌خوای واکشی کنی (اینجا همه)
             ];

            $related_posts = get_posts($args);

            // نمایش لیست پست‌ها
            if (! empty($related_posts)) {
                foreach ($related_posts as $post) {
                    setup_postdata($post);

                    $selected = ($arma_episode == $post->ID) ? " selected='selected'" : ' ';

                    $all_post_obtion .= '<option ' . $selected . '  value="' . $post->ID . '">' . get_the_title($post) . '</option>';
                }
                wp_reset_postdata();
            }
        }
        include_once ARMA_VIEWS . 'metabox/episode.php';

    }

}

add_action('save_post', 'arma_save_bax', 10, 3);

function arma_save_bax($post_id, $post, $updata)
{

    if (isset($_POST[ 'onplus' ])) {

        $POST       = $_POST[ 'onplus' ];
        $colleagues = [  ];

        update_post_meta($post_id, '_arma_brief', wp_kses_post(wp_unslash(nl2br($POST[ 'brief' ]))));
        update_post_meta($post_id, '_arma_production_date', sanitize_text_field($POST[ 'production_date' ]));
        update_post_meta($post_id, '_arma_video', sanitize_text_field($POST[ 'video' ]));

        $video_time = (empty($POST[ 'video' ])) ? '00:00:00' : getVideoDuration(sanitize_url($POST[ 'video' ]));

        update_post_meta($post_id, '_arma_video_duration', $video_time);

        if (isset($POST[ 'colleagues' ])) {
            foreach ($POST[ 'colleagues' ] as $index => $value) {

                $colleagues[  ] = [
                    'colleagues' => $value,
                    'position'   => $POST[ 'position' ][ $index ],
                 ];

            }

            update_post_meta($post_id, '_arma_colleagues', $colleagues);

        }
        if (isset($POST[ 'episode' ])) {

            update_post_meta($post_id, '_arma_episode', absint($POST[ 'episode' ]));

        }

    }

}

function custom_page_metabox()
{
    add_meta_box(
        'custom_page_fields',
        'اطلاعات اضافی صفحه',
        'custom_page_metabox_callback',
        'page',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'custom_page_metabox');

function custom_page_metabox_callback($post)
{
    $page_template = get_page_template_slug($post->ID);

    if ($page_template !== 'page-contact.php' && $page_template !== 'page-about.php') {
        echo '<p>این متاباکس فقط برای صفحه "تماس با ما" فعال است.</p>';
        return;
    }

    $phone         = get_post_meta($post->ID, 'contact_phone', true);
    $phone_support = get_post_meta($post->ID, 'contact_phone_support', true);

    wp_nonce_field('custom_page_meta_nonce', 'custom_page_nonce');

    if ($page_template == 'page-contact.php') {
        echo '<p><label>شماره تماس پیشنهادات و انتقادات:</label>';
        echo '<input type="text" name="contact_phone" value="' . esc_attr($phone) . '" class="widefat"></p>';

        echo '<p><label>شماره تماس پشتیبانی سایت:</label>';
        echo '<input type="text" name="contact_phone_support" value="' . esc_attr($phone_support) . '" class="widefat"></p>';
    }
}

function save_custom_page_meta($post_id)
{
    if (! isset($_POST[ 'custom_page_nonce' ]) || ! wp_verify_nonce($_POST[ 'custom_page_nonce' ], 'custom_page_meta_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (isset($_POST[ 'contact_phone' ])) {
        update_post_meta($post_id, 'contact_phone', sanitize_text_field($_POST[ 'contact_phone' ]));
    }
    if (isset($_POST[ 'contact_phone_support' ])) {
        update_post_meta($post_id, 'contact_phone_support', sanitize_text_field($_POST[ 'contact_phone_support' ]));
    }

}
add_action('save_post', 'save_custom_page_meta');
