<div id="bookmark" class="content-box"
    style="<?php echo(get_query_var('arma') != 'bookmark') ? 'display: none;' : '' ?> ">
    <div class="card mx-auto"
        style=" position: relative; border-radius: 10px; overflow: hidden; background-color: #242323;">
        <!-- Title Row with Gray Background -->
        <div style="background-color: #333; padding: 20px; text-align: center; width: 100%; position: relative;">
            <h5 class="m-0" style="font-size: 24px; color: white;">لیست نشان شده‌ها</h5>
        </div>
        <?php

            use oniclass\ARMADB;

            $armadb = new ARMADB('bookmark');

            $bookmarked_posts = $armadb->select([
                'data'     => [ 'iduser' => get_current_user_id() ],
                'order_by' => [ 'created_at', 'DESC' ],
                'star'     => "post_type,idpost",
             ]);

            $bookmark_array = [  ];

            foreach ($bookmarked_posts as $bookmark) {
                if ($bookmark->post_type == 'episode' || $bookmark->post_type == 'episode_cat') {

                    $args = [
                        'post_type'      => $bookmark->post_type,  // فقط پست تایپ‌های مورد نظر
                        'post__in'       => [ $bookmark->idpost ], // فیلتر کردن فقط برای این ID ها
                        'posts_per_page' => 1,                     // نمایش تمام پست‌ها
                     ];

                    $query = new WP_Query($args);

                    if (! $query->have_posts()) {continue;}

                    $query->the_post();

                    $categories = wp_get_post_terms(get_the_ID(), 'on_category');

                    $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'medium');

                    $image_id  = get_term_meta($categories[ 0 ]->term_id, 'category_image', true);
                    $thumbnail = $image_id ? wp_get_attachment_url($image_id) : '';

                    $bookmark_array[  ] = [
                        'link'       => get_permalink(),
                        'image'      => $thumbnail,
                        'title'      => get_the_title(),
                        'show_title' => esc_html($categories[ 0 ]->name) . '-' . tarikh(get_the_date('Y-m-d')),
                     ];

                    wp_reset_postdata();

                }
                if ($bookmark->post_type == 'on_category' || $bookmark->post_type == 'on_tag') {

                    $term = get_term($bookmark->idpost, $bookmark->post_type);

                    if (! $term && is_wp_error($term)) {continue;}

                    $image_id = get_term_meta($bookmark->idpost, 'category_image', true);

                    $bookmark_array[  ] = [
                        'link'       => get_term_link($term),
                        'image'      => $image_id ? wp_get_attachment_url($image_id) : '',
                        'title'      => $term->name,
                        'show_title' => $term->name,
                     ];
                }

            }

            if (! empty($bookmark_array)) {
                echo '<div class="container">';
                echo '<div class="row">';

            foreach ($bookmark_array as $bookmark): ?>
        <div class="col-lg-2 col-md-2 col-sm-4 col-6 mb-4">
            <div class="card post-card">
                <div style="position: relative;">
                    <a href="<?php echo $bookmark[ 'link' ] ?>">
                        <img src="<?php echo esc_url($bookmark[ 'image' ]); ?>" class="card-img-top"
                            alt="<?php $bookmark[ 'title' ]; ?>">
                        <div class="title-overlay">
                            <span><?php $bookmark[ 'title' ]; ?></span>
                        </div>
                    </a>

                </div>
                <div class="card-body">
                    <ul class="category-list">
                        <li><?php echo $bookmark[ 'show_title' ]; ?> </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php

                endforeach;
                echo '</div>';
                echo '</div>';
        } else {?>


        <div class="row" style="background-color: #242323; color: #fff; text-align: center;">
            <!-- Icon: Bookmark -->
            <div class="mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="185" height="185" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-bookmark">
                    <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z"></path>
                </svg>
            </div>
            <!-- Message: No marked films -->
            <p class="mb-0" style="font-size: 16px;">شما تاکنون هیچ فیلمی را نشان نکرده‌اید</p>
        </div>



        <?php
            }

        ?>















    </div>
</div>