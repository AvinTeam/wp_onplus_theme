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
                'data' => [ 'iduser' => get_current_user_id() ],
                'star' => "idpost",
             ]);

            // استخراج ID پست‌ها از آرایه
            $post_ids = array_map(function ($item) {
                return $item->idpost;
            }, $bookmarked_posts);
            

            if (! empty($post_ids)) {
                $args = [
                    'post_type'      => 'any',
                    'post__in'       => $post_ids,
                    'orderby'        => 'post__in',
                    'posts_per_page' => -1,
                 ];

                $query = new WP_Query($args);

                if ($query->have_posts()):
                    echo '<div class="container">';
                    echo '<div class="row">';

                    while ($query->have_posts()):
                        $query->the_post();

                        $categories = wp_get_post_terms(get_the_ID(), 'on_category');

                        $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'medium');

                        $image_id  = get_term_meta($categories[ 0 ]->term_id, 'category_image', true);
                        $thumbnail = $image_id ? wp_get_attachment_url($image_id) : '';
                    ?>
        <div class="col-lg-2 col-md-2 col-sm-4 col-6 mb-4">
            <div class="card post-card">
                <div style="position: relative;">
                    <a href="<?php echo get_permalink() ?>">
                        <?php if ($thumbnail): ?>
                        <img src="<?php echo esc_url($thumbnail); ?>" class="card-img-top" alt="<?php the_title(); ?>">
                        <?php else: ?>
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="بدون تصویر">
                        <?php endif; ?>

                        <div class="title-overlay">
                            <span><?php the_title(); ?></span>
                        </div>
                    </a>

                </div>
                <div class="card-body">
                    <ul class="category-list">
                        <li><?php echo esc_html($categories[ 0 ]->name); ?>
                            -<?php echo tarikh(get_the_date('Y-m-d')); ?> </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php

                endwhile;
                echo '</div>';
                echo '</div>';
                wp_reset_postdata();
                else:
                    echo "<p class='text-center text-danger'>هیچ پستی در بوکمارک‌ها پیدا نشد!</p>";
                endif;
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