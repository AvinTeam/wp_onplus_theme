<?php
(defined('ABSPATH')) || exit;

function update_video_status_function()
{
    $args = [
        'post_type'      => [ 'episode', 'episode_cat' ], // می‌توان نوع پست را تغییر داد
        'posts_per_page' => -1,                           // دریافت تمام پست‌های دارای شرط
        'meta_query'     => [
            [
                'key'     => '_arma_video_status',
                'value'   => 'complete',
                'compare' => '!=', // پست‌هایی که مقدارشان "complete" نیست
             ],
         ],
     ];

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();
            $url     = get_post_meta($post_id, '_arma_video', true);
            if (empty($url)) {continue;}
            arma_set_video_post($post_id, $url);

        }
    }

    wp_reset_postdata();
}

$arma_cron = absint(get_option('arma_cron'));

if ($arma_cron < time()) {
    update_video_status_function();
    update_option('arma_cron', (time() + (15 * 60)));
}
