<?php
    get_header();

    $search_value = get_search_query();
    $paged        = (get_query_var('paged')) ? get_query_var('paged') : 1;
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">نتایج جستجو برای: "<?php echo $search_value; ?>"</h2>

    <!-- جستجو در دسته‌بندی‌ها -->
    <?php
        $category_args = [
            'taxonomy'   => 'on_category',
            'hide_empty' => false,
            'name__like' => $search_value,
         ];
        $categories = get_terms($category_args);

        if (! empty($categories)) {
            echo '<h3 class="mt-4">برنامه ها</h3><div class="row">';
            foreach ($categories as $category) {
                $category_image = get_term_meta($category->term_id, 'category_image', true);
                $category_image = $category_image ? wp_get_attachment_url($category_image) : '';

                echo '<div class="col-lg-3 col-md-4 col-sm-6 mb-4">';
                echo '<div class="card">';
                if ($category_image) {
                    echo '<a href="' . get_term_link($category) . '"><img src="' . esc_url($category_image) . '" class="card-img-top" alt="' . esc_attr($category->name) . '"></a>';
                }
                echo '<div class="card-body text-center">';
                echo '<h5 class="card-title"><a href="' . get_term_link($category) . '" class="text-body">' . esc_html($category->name) . '</a></h5>';
                echo '</div></div></div>';
            }
            echo '</div>';
        }
    ?>

    <!-- جستجو در تگ‌ها -->
    <?php
        $tag_args = [
            'taxonomy'   => 'on_tag',
            'hide_empty' => false,
            'name__like' => $search_value,
         ];
        $tags = get_terms($tag_args);

        if (! empty($tags)) {
            echo '<h3 class="mt-4">تگ‌ها</h3><ul class="list-group mb-4">';
            foreach ($tags as $tag) {
                echo '<li class="list-group-item"><a href="' . get_term_link($tag) . '">' . esc_html($tag->name) . '</a></li>';
            }
            echo '</ul>';
        }
    ?>

    <!-- جستجو در پست‌ها و اپیزودها -->
    <?php
        $post_args = [
            'post_type'      => [ 'post', 'episode' ],
            'posts_per_page' => 24,
            'paged'          => $paged,
            's'              => $search_value,
         ];

        $post_query = new WP_Query($post_args);

        if ($post_query->have_posts()) {
            echo '<h3 class="mt-4">نتایج قسمت ها</h3><div class="row">';
            while ($post_query->have_posts()) {
                $post_query->the_post();
                $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'medium');

                echo '<div class="col-lg-2 col-md-4 col-sm-6 mb-4">';
                echo '<div class="card">';
                if ($thumbnail) {
                    echo '<a href="' . get_permalink() . '"><img src="' . esc_url($thumbnail) . '" class="card-img-top" alt="' . get_the_title() . '"></a>';
                }
                echo '<div class="card-body text-center">';
                echo '<h5 class="card-title"><a href="' . get_permalink() . '" class="text-body">' . get_the_title() . '</a></h5>';
                echo '</div></div></div>';
            }
            echo '</div>';

        if ($post_query->max_num_pages > 1): ?>


    <nav class="mt-4 mb-5">
        <ul class="pagination justify-content-center  mb-5">

            <?php

                    $big              = 999999999; // need an unlikely integer
                    $translated       = '///';
                    $pagination_links = paginate_links([
                        'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                        'total'     => $post_query->max_num_pages,
                        'format'    => '?paged=%#%',
                        'current'   => $paged,
                        'prev_text' => 'قبلی',
                        'next_text' => 'بعدی',
                        'type'      => 'array',

                     ]);

                    if ($pagination_links):
                        foreach ($pagination_links as $link):
                            // بررسی آیا این لینک صفحه فعلی است یا نه
                            if (strpos($link, 'current') !== false):
                                echo '<li class="page-item active">' . str_replace('page-numbers', 'page-link', $link) . '</li>';
                            else:
                                echo '<li class="page-item">' . str_replace('page-numbers', 'page-link', $link) . '</li>';
                            endif;
                        endforeach;
                    endif;
                ?>

        </ul>
    </nav>
    <?php endif;

        } else {
            echo '<p class="alert alert-warning">نتیجه‌ای یافت نشد.</p>';
        }

        wp_reset_postdata();
    ?>
</div>

<?php get_footer(); ?>