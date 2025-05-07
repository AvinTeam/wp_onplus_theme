<?php

use oniclass\ARMADB;

get_header();

if (have_posts()):
    the_post();

    // اطلاعات پست فعلی
    $current_post_id = get_the_ID();

    // دریافت دسته‌های پست فعلی
    $categories = wp_get_post_terms($current_post_id, 'on_category');

    $video_status = get_post_meta($current_post_id, '_arma_video_status', true);
    $show_post    = true;
    if ($video_status != 'complete') {
        $status = arma_set_video_post($current_post_id, get_post_meta($current_post_id, '_arma_video', true));
        if ($status != 'complete') {
            $show_post = false;
            echo '<div class="alert alert-warning text-center mt-4" role="alert">ویدئو این قسمت هنوز تکیمل نشده است</div>';
        }
    }

    // دریافت اطلاعات پست فعلی
    $episode_data = [
        'id'              => $current_post_id,
        'title'           => get_the_title(),
        'permalink'       => get_permalink(),
        'excerpt'         => get_the_excerpt(),
        'content'         => nl2br(get_the_content()),
        'image'           => (has_post_thumbnail()) ? get_the_post_thumbnail_url($current_post_id, 'full') : '',
        'categories'      => wp_get_post_terms($current_post_id, 'on_category', [ 'fields' => 'names' ]),
        'date'            => tarikh(get_the_date('Y-m-d')),
        'relative_time'   => human_time_diff(get_the_time('U'), current_time('timestamp')) . ' قبل',
        'brief'           => get_post_meta($current_post_id, '_arma_brief', true),
        'production_date' => get_post_meta($current_post_id, '_arma_production_date', true),
        'video'           => get_post_meta($current_post_id, '_arma_video_res', true),
        'colleagues'      => get_post_meta($current_post_id, '_arma_colleagues', true),
        'type'            => get_post_type($current_post_id),
     ];





    $term_id       = $categories[ 0 ]->term_id; // آی‌دی دسته
    $term_name     = $categories[ 0 ]->name;    // نام دسته
    $category_link = get_term_link($categories[ 0 ]);

    $image_id  = get_term_meta($term_id, 'category_image', true);
    $image_url = $image_id ? wp_get_attachment_url($image_id) : '';

    // تنظیمات کوئری برای دریافت پست‌های مرتبط
    $args = [
        'post_type'      => 'episode',
        'posts_per_page' => 10,                   // تعداد پست‌های مرتبط
        'post__not_in'   => [ $current_post_id ], // حذف پست فعلی
        'tax_query'      => [
            [
                'taxonomy' => 'on_category',
                'field'    => 'term_id',
                'terms'    => $term_id,
             ],
         ],
     ];

    $related_query    = new WP_Query($args);
    $related_episodes = [  ];

    if ($related_query->have_posts()):
        while ($related_query->have_posts()): $related_query->the_post();
            $related_episodes[  ] = [
                'id'            => get_the_ID(),
                'title'         => get_the_title(),
                'permalink'     => get_permalink(),
                'excerpt'       => get_the_excerpt(),
                'image'         => (has_post_thumbnail()) ? get_the_post_thumbnail_url(get_the_ID(), 'medium') : '',
                'date'          => tarikh(get_the_date('Y-m-d')),
                'relative_time' => human_time_diff(get_the_time('U'), current_time('timestamp')) . ' قبل',
             ];
        endwhile;
        wp_reset_postdata();
    endif;

endif;

$bookmark = false;

if (is_user_logged_in()) {

    $armadb = new ARMADB('bookmark');

    if ($armadb->num([
        'post_type' => get_post_type($current_post_id),
        'iduser'    => get_current_user_id(),
        'idpost'    => $current_post_id,

     ])) {$bookmark = true;}

}

$args = [
    'post_type'      => 'episode_cat', // یا هر پست تایپ دیگه مثل 'episode'
    'posts_per_page' => -1,            // دریافت همه پست‌ها
    'meta_query'     => [
        [
            'key'     => '_arma_episode',
            'value'   => absint($episode_data[ 'id' ]),
            'compare' => '=',
         ],
     ],
 ];

$query_episode_cat = new WP_Query($args);
$episode_cat       = [  ];

if ($query_episode_cat->have_posts()) {
    while ($query_episode_cat->have_posts()) {
        $query_episode_cat->the_post();
        $episode_cat[  ] = [
            'id'            => get_the_ID(),
            'title'         => get_the_title(),
            'permalink'     => get_permalink(),
            'excerpt'       => get_the_excerpt(),
            'image'         => (has_post_thumbnail()) ? get_the_post_thumbnail_url(get_the_ID(), 'medium') : '',
            'date'          => tarikh(get_the_date('Y-m-d')),
            'relative_time' => human_time_diff(get_the_time('U'), current_time('timestamp')) . ' قبل',
         ];
    }
}

wp_reset_postdata(); // ریست کوئری
if ($show_post) {
    require_once ARMA_VIEWS . 'layout/single.php';
}
get_footer();
