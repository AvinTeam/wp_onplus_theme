<div class="d-flex flex-column g-1 mx-auto p-4 gx-2 gy-0">
       <!-- عنوان و دکمه "نمایش همه" -->
       <div class="view-all d-flex justify-content-between align-items-center px-4 text-kama py-3">
        <h5 style="font-size: 20px;" class="fw-bold"><?php echo trim($row[ 'title' ]) ?></h5>
        <a href="/oncat/" class="ms-3" style="font-size: 13px; color: #ffad00 ; text-decoration: none;">
            نمایش همه
            <svg fill="#ffad00 " height="8px" width="8px" viewBox="0 0 512.005 512.005">
                <path d="M123.586,240.923L358.253,6.256c8.341-8.341,21.824-8.341,30.165,0s8.341,21.824,0,30.165L168.834,256.005
                l219.584,219.584c8.341,8.341,8.341,21.824,0,30.165c-4.16,4.16-9.621,6.251-15.083,6.251c-5.461,0-10.923-2.091-15.083-6.251
                L123.586,271.747C115.245,263.406,115.245,249.923,123.586,240.923z">
                </path>
            </svg>
        </a>
    </div>
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
                                <img src="' . $image_url . '" class="card-img-top rounded-3 shadow" alt="' . $term->name . '">
                            </a>
                        </div>
                        <a class="nav-link" href="' . get_term_link($term) . '"> <div class="ps-2 card-hover-text">' . $term->name . '</div></a>
                    </div>';
                        }
                    } else {
                        echo "<div class='swiper-slide'>هیچ دسته‌ای یافت نشد!</div>";
                    }
                ?>
            </div>

        </div>
</div>




