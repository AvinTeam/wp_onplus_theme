<?php

use oniclass\ARMADB;

$bookmark = false;

// دریافت اطلاعات دسته فعلی
$term             = get_queried_object();
$term_id          = $term->term_id;     // آی‌دی دسته
$term_name        = $term->name;        // نام دسته
$term_description = $term->description; // توضیحات دسته
$term_type        = $term->taxonomy;
$term_link        = get_term_link($term);

$image_id  = get_term_meta($term_id, 'category_image', true);
$image_url = $image_id ? wp_get_attachment_url($image_id) : '';

$image_id_banner  = get_term_meta($term_id, 'category_banner', true);
$image_url_banner = $image_id ? wp_get_attachment_url($image_id_banner) : '';

$likedb = new ARMADB('like');

$like_conut = $likedb->num([
    'post_type' => $term_type,
    'like_type' => 'like',
    'idpost'    => $term_id,
 ]);
$dislike_conut = $likedb->num([
    'post_type' => $term_type,
    'like_type' => 'dislike',
    'idpost'    => $term_id,
 ]);

$total_votes = $like_conut + $dislike_conut; // مجموع کل آرا

$percentage    = 0; // درصد لایک

if ($total_votes > 0) {
    if ($like_conut >= $dislike_conut) {
        $percentage    = round(($like_conut / $total_votes) * 100); // درصد لایک
    } else {
        $percentage    = 0; // درصد دیس‌لایک
    }

}

$user_like = $likedb->get([
    'post_type' => $term_type,
    'iduser'    => get_current_user_id(),
    'idpost'    => $term_id,
 ]);

$like_btn_class    = ($user_like && $user_like->like_type == "like") ? "text-success" : "";
$dislike_btn_class = ($user_like && $user_like->like_type == "dislike") ? "text-danger" : "";

function atlas_title_filter_cat($title)
{
    global $term_name;
    $title = $term_name . " | " . get_bloginfo('name');

    return $title;
}
add_filter('wp_title', 'atlas_title_filter_cat');

if (is_user_logged_in()) {

    $armadb = new ARMADB('bookmark');

    if ($armadb->num([
        'post_type' => $term_type,
        'iduser'    => get_current_user_id(),
        'idpost'    => $term_id,

     ])) {$bookmark = true;}

}

// تنظیمات کوئری برای دریافت پست‌های مرتبط
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$paged = (get_query_var('paged') > 1) ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);

$args = [
    'post_type'      => 'episode',
    'meta_query'     => [
        [
            'key'     => '_arma_video_status', // کلید متا
            'value'   => 'complete',           // مقدار متا که باید برابر باشد
            'compare' => '=',                  // شرط بررسی برابری
         ],
     ],
    'tax_query'      => [
        [
            'taxonomy' => 'on_category',
            'field'    => 'term_id',
            'terms'    => $term_id,
         ],
     ],
    'posts_per_page' => 10, // حتماً این مقدار رو چک کن
    'paged'          => $paged,
 ];

$query = new WP_Query($args);

$all_episode = [  ];

if ($query->have_posts()):
    while ($query->have_posts()): $query->the_post();
        // دریافت تصویر شاخص
        $image    = (has_post_thumbnail()) ? get_the_post_thumbnail_url(get_the_ID(), 'medium') : '';
        $duration = get_post_meta(get_the_ID(), '_arma_video_duration', true);

        // ذخیره اطلاعات در آرایه
        $all_episode[  ] = [
            'title'     => get_the_title(),
            'permalink' => get_permalink(),
            'excerpt'   => get_the_excerpt(),
            'image'     => $image,
            'data'      => tarikh($query->post->post_date, 'd'),
            'duration'  => (is_string($duration)) ? $duration : '00:00:00',
         ];
    endwhile;
endif;
wp_reset_postdata();

$args_agents = [
    'post_type'      => 'episode',
    'posts_per_page' => -1,
    'meta_query'     => [
        [
            'key'     => '_arma_video_status',
            'value'   => 'complete',
            'compare' => '=',
         ],
     ],
    'tax_query'      => [
        [
            'taxonomy' => 'on_category',
            'field'    => 'term_id',
            'terms'    => $term_id,
         ],
     ],
 ];

$query_agents = new WP_Query($args_agents);

$arma_colleagues_list = [  ];

if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();

        // دریافت متای پست به‌صورت آرایه
        $arma_colleagues = get_post_meta(get_the_ID(), '_arma_colleagues', true);

        if (empty($arma_colleagues)) {continue;}

        $arma_colleagues_list[  ] = $arma_colleagues;

    }
}

wp_reset_postdata();

$all_colleagues = [  ];
$seen           = [  ];

foreach ($arma_colleagues_list as $subArray) {
    foreach ($subArray as $item) {
        $key = $item[ 'colleagues' ] . '-' . $item[ 'position' ];

        if (! isset($seen[ $key ])) {
            $seen[ $key ] = true;

            $colleague_term = get_term($item[ 'colleagues' ], 'on_agents');

            $position_term = get_term($item[ 'position' ], 'on_position');

            $image_id = get_term_meta($item[ 'colleagues' ], 'category_image', true);

            $all_colleagues[  ] = [
                "image"      => $image_id ? wp_get_attachment_url($image_id) : arma_panel_image('avatar.jpg'),
                "colleagues" => ($colleague_term && ! is_wp_error($colleague_term)) ? $colleague_term->name : 'نامشخص',
                "position"   => ($position_term && ! is_wp_error($position_term)) ? $position_term->name : 'نامشخص',
             ];
        }
    }
}

get_header();
require_once ARMA_VIEWS . 'layout/taxonomy.php';
get_footer();