<div class="d-flex g-1 mx-auto p-4 gx-2 gy-0">
        <div class="swiper mySwiper w-100">
            <div class="swiper-wrapper">
                <?php
                    $terms = get_terms([
                        'taxonomy'   => 'on_category',
                        'hide_empty' => false,
                        'number'     => 8, // نمایش ۸ دسته در حالت عادی
                     ]);

                    if (! is_wp_error($terms) && ! empty($terms)) {
                        foreach ($terms as $term) {
                            $term_link = get_term_link($term);
                            $image_id  = get_term_meta($term->term_id, 'category_image', true);
                            $image_url = $image_id ? wp_get_attachment_url($image_id) : '';

                            echo '
                    <div class="swiper-slide">
                        <div class="card position-relative">
                            <a href="' . get_term_link($term) . '">
                                <img src="' . $image_url . '" class="card-img-top" alt="' . $term->name . '">
                            </a>
                        </div>
                        <a class="nav-link" href="' . get_term_link($term) . '"> <div class="card-hover-text">' . $term->name . '</div></a>
                    </div>';
                        }
                    } else {
                        echo "<div class='swiper-slide'>هیچ دسته‌ای یافت نشد!</div>";
                    }
                ?>
            </div>

        </div>
</div>




