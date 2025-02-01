<?php

    // تنظیمات کوئری برای دریافت پست‌های مرتبط
    $args = [
        'post_type'      => 'episode',
        'posts_per_page' => 5, // تعداد پست‌های مرتبط
        'tax_query'      => [
            [
                'taxonomy' => trim($row[ 'type' ]),
                'field'    => 'term_id',
                'terms'    => absint($row[ 'option' ]),
             ],
         ],
     ];

    $related_query = new WP_Query($args);

    $term_link = get_term_link(absint($row[ 'option' ]), trim($row[ 'type' ]));
    $term      = get_term(absint($row[ 'option' ]), trim($row[ 'type' ]));

?>

<div class="mx-auto p-4 swiper arma-swiper">
    <!-- عنوان و دکمه "نمایش همه" -->
    <div class="view-all d-flex justify-content-between align-items-center px-4">
        <h5 style="font-size: 20px;" class="fw-bold"><?php echo trim($row[ 'title' ]) ?></h5>
        <a href="#" class="ms-3" style="font-size: 13px; color: #3FB1D9; text-decoration: none;">
            نمایش همه
            <svg fill="#3FB2DA" height="8px" width="8px" viewBox="0 0 512.005 512.005">
                <path d="M123.586,240.923L358.253,6.256c8.341-8.341,21.824-8.341,30.165,0s8.341,21.824,0,30.165L168.834,256.005
                l219.584,219.584c8.341,8.341,8.341,21.824,0,30.165c-4.16,4.16-9.621,6.251-15.083,6.251c-5.461,0-10.923-2.091-15.083-6.251
                L123.586,271.747C115.245,263.406,115.245,249.923,123.586,240.923z">
                </path>
            </svg>
        </a>
    </div>

    <!-- اسلایدر Swiper -->
    <div class="swiper-wrapper">



    </div>

    <div class="swiper cat-swiper">
        <div class="swiper-wrapper">

            <?php

                if ($related_query->have_posts()):
                    while ($related_query->have_posts()): $related_query->the_post();
                    ?>
		            <div class="swiper-slide">
		                <div class="card position-relative">
		                    <a href="<?php echo get_permalink() ?>">
		                        <img src="<?php echo(has_post_thumbnail()) ? get_the_post_thumbnail_url(get_the_ID(), 'medium') : '' ?>"
		                            class="card-img-top" alt="<?php echo get_the_title() ?>">
		                    </a>
		                </div>
		                <p class="card-text text-first mt-2">
		                    <a class="nav-link" href="<?php echo get_permalink()?>"><?php echo get_the_title() . ' - ' . tarikh(get_the_date('Y-m-d')) ?></a>
		                </p>
		            </div>
		            <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                    ?>
        </div>

    </div>


</div>