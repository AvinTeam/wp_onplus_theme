<?php

// دریافت اطلاعات دسته فعلی
$term             = get_queried_object();
$term_id          = $term->term_id;     // آی‌دی دسته
$term_name        = $term->name;        // نام دسته
$term_description = $term->description; // توضیحات دسته

$image_id  = get_term_meta($term_id, 'category_image', true);
$image_url = $image_id ? wp_get_attachment_url($image_id) : '';

$image_id_banner  = get_term_meta($term_id, 'category_banner', true);
$image_url_banner = $image_id ? wp_get_attachment_url($image_id_banner) : '';

function atlas_title_filter_cat($title)
{
    global $term_name;
    $title = $term_name . " | " . get_bloginfo('name');

    return $title;
}
add_filter('wp_title', 'atlas_title_filter_cat');

// تنظیمات کوئری برای دریافت پست‌های مرتبط
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$paged = (get_query_var('paged') > 1) ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);

$args = [
    'post_type'      => 'episode',
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
            'duration'  => (is_string($duration)) ? $duration : 0,
         ];
    endwhile;
    wp_reset_postdata();

endif;

get_header();
require_once ARMA_VIEWS . 'layout/taxonomy.php';
get_footer();