<!-- New Section with Background -->
<div class="container-fluid position-relative w-100 m-0" style="background: linear-gradient(90deg, rgba(52,17,115,0.4) 0%, rgba(34,29,31,0.9) 100%),
               url('<?php echo $image_url_banner ?>');
               background-size: cover;
               background-position: center;
               height: 500px;">
    <div class="row h-100 align-items-center justify-content-center justify-content-md-start text-white">
        <div class="col-md-3 col-12 d-none text-center text-md-end mt-2 d-md-block ">
            <img src="<?php echo $image_url ?>" class="img-fluid w-50 rounded-2" alt="Thumbnail">
        </div>
        <div class="col-lg-3 col-12 px-5">
            <div class="d-flex align-items-center justify-content-start gap-2">
                <h3><?php echo $term_name ?></h3>

                <?php if ($bookmark): ?>
                <div class="d-flex align-items-center bookmark-container">
                    <svg id="post_bookmark" data-bookmark-status="remove" data-post-id="<?php echo $term_id ?>"
                        data-type="<?php echo $term_type ?>" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                        viewBox="0 0 24 24" fill="#ffad00" stroke="#ffad00" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-bookmark">
                        <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z"></path>
                    </svg>
                    <span class="bookmark-tooltip fw-bold text-white">
                        حذف از لیست نشان شده‌ها
                        <span class="tooltip-arrow"></span>
                    </span>
                </div>
                <?php else: ?>
                <div class="d-flex align-items-center bookmark-container">
                    <svg id="post_bookmark" data-bookmark-status="add" data-post-id="<?php echo $term_id ?>"
                        data-type="<?php echo $term_type ?>" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                        viewBox="0 0 24 24" fill="none" stroke="#ffad00" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-bookmark">
                        <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z"></path>
                    </svg>
                    <span class="bookmark-tooltip fw-bold text-white">
                        افزودن به لیست نشان شده‌ها
                        <span class="tooltip-arrow"></span>
                    </span>
                </div>
                <?php endif; ?>

                <!-- Icon for Sharing -->
                <div class="d-flex align-items-center " id="sharingBtn"
                    data-link="<?php echo $term_link ?>"
                    data-title="<?php echo $term_name ?>">
                    <i class="bi bi-share-fill me-2"></i> <!-- آیکن اشتراک گذاری -->
                    <span class="d-none d-md-block">اشتراک گذاری</span>
                </div>


            </div>
            <p class="text-justify"><?php echo $term_description ?></p>
            <div class="d-flex align-items-center " id="arma_res_like">
                <i class="bi bi-hand-thumbs-up-fill text-warning me-2 fs-4"></i>
                <span><b><?=$percentage?></b> درصد کاربران این برنامه را دوست داشتن</span>
            </div>
            <div class="mt-2">
                <i id="arma_like" class="bi bi-hand-thumbs-up-fill me-2 fs-4 arma_likes <?=$like_btn_class?>"
                    data-post-id="<?php echo $term_id ?>" data-type="<?php echo $term_type ?>" data-status="like"></i>
                <i id="arma_dislike" class="bi bi-hand-thumbs-down-fill fs-4 arma_likes <?=$dislike_btn_class?>"
                    data-post-id="<?php echo $term_id ?>" data-type="<?php echo $term_type ?>"
                    data-status="dislike"></i>
            </div>
        </div>
    </div>
</div>

<!-- Card Row with Pagination -->
<div class="view-all d-flex justify-content-between align-items-center px-3 my-2">
    <h5>قسمت ها</h5>
</div>
<div class="row row-cols-2 row-cols-sm-1 row-cols-md-4 row-cols-lg-5 g-4 mx-0" id="video-cards">
    <!-- Card 1 -->

    <?php foreach ($all_episode as $episode): ?>

    <div class="col on_category">
        <div class="card position-relative">
            <a href="<?php echo $episode[ 'permalink' ] ?>"><img src="<?php echo $episode[ 'image' ] ?>"
                    class="card-img-top rounded-2" alt="<?php echo $episode[ 'title' ] ?>"></a>

        </div>
        <div class="card-body d-flex flex-column flex-md-row justify-content-between px-0 ">
            <h6 class="text-right px-0 px-md-3 pt-2 arma_data "><?php echo $term_name ?> -<?php echo $episode[ 'data' ] ?></h6>
            <span class="text-secondary px-0 px-md-3 pt-2 arma_duration"><?php echo $episode[ 'duration' ] ?></span>
        </div>
        <a class="nav-link " href="<?php echo $episode[ 'permalink' ] ?>">
            <p class="card-text text-first text-right arma-text"><?php echo $episode[ 'title' ] ?></p>
        </a>
    </div>
    <?php endforeach; ?>
</div>

<!-- Pagination -->
<?php
if ($query->max_num_pages > 1): ?>


<nav class="mt-4 mb-5">
    <ul class="pagination justify-content-center">

        <?php

            $big              = 999999999; // need an unlikely integer
            $translated       = '///';
            $pagination_links = paginate_links([
                'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'total'     => $query->max_num_pages,
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
<?php endif; ?>

<div class="container-fluid mt-5">
    <!-- Background Section -->
    <div class="row justify-content-center align-items-center py-5 colleagues">
        <div class="w-75 mx-auto text-first text-white">
            <!-- Main Title -->
            <h2 class="mb-3" style="font-size: 18px;">عوامل برنامه</h2>
            <div class="row row-cols-1 row-cols-md-4 ">
                <?php foreach ($all_colleagues as $colleague): ?>
                <div class="col mb-3 d-flex flex-row justify-content-start align-items-center gap-2">
                    <img src="<?php echo $colleague[ 'image' ] ?>" class="img-fluid rounded-circle"
                        alt="<?php echo $colleague[ 'colleagues' ] ?>" style="width: 56px; height: 56px;">
                    <div class="">
                        <h4 class="text-light" style="font-size: 18px;"><?php echo $colleague[ 'colleagues' ] ?></h4>
                        <h5 class="text-light" style="font-size: 16px;"><?php echo $colleague[ 'position' ] ?></h5>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>