<?php get_header();

// دریافت اطلاعات دسته فعلی
$term             = get_queried_object();
$term_id          = $term->term_id;     // آی‌دی دسته
$term_name        = $term->name;        // نام دسته
$term_description = $term->description; // توضیحات دسته

$image_id  = get_term_meta($term_id, 'category_image', true);
$image_url = $image_id ? wp_get_attachment_url($image_id) : '';

$image_id_baner  = get_term_meta($term_id, 'category_baner', true);
$image_url_baner = $image_id ? wp_get_attachment_url($image_id_baner) : '';

// تنظیمات کوئری برای دریافت پست‌های مرتبط
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = [
    'post_type'      => 'episode', // فقط پست تایپ episode
    'tax_query'      => [
        [
            'taxonomy' => 'on_category', // نام taxonomy
            'field'    => 'term_id',
            'terms'    => $term_id,
         ],
     ],
    'posts_per_page' => 10,     // تعداد پست‌ها در هر صفحه
    'paged'          => $paged, // پشتیبانی از صفحه‌بندی
 ];

$query = new WP_Query($args);

$all_episode = [  ];

if ($query->have_posts()):
    while ($query->have_posts()): $query->the_post();
        // دریافت تصویر شاخص
        $image = (has_post_thumbnail()) ? get_the_post_thumbnail_url(get_the_ID(), 'medium') : '';

        // ذخیره اطلاعات در آرایه
        $all_episode[  ] = [
            'title'     => get_the_title(),
            'permalink' => get_permalink(),
            'excerpt'   => get_the_excerpt(),
            'image'     => $image,
         ];
    endwhile;
endif;

require_once ARMA_VIEWS . 'layout/taxonomy.php';
wp_reset_postdata();

get_footer();
