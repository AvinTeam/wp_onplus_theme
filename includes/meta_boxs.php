<?php
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

        $arma_video = get_post_meta($post->ID, '_arma_like', true);

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
        update_post_meta($post_id, '_arma_video', sanitize_url($POST[ 'video' ]));
        update_post_meta($post_id, '_arma_video_duration', getVideoDuration(sanitize_url($POST[ 'video' ])));

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
