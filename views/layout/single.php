<div class="container-fluid px-5">
    <div class="row mt-2">
        <!-- Sidebar -->
        <div class="col-md-4 col-lg-3 order-md-last single-sidebar mt-2 d-none d-md-block">
            <h5 class="mb-3">سایر قسمت‌ها</h5>
            <div class="overflow-auto" style="max-height: 100vh;">

                <?php foreach ($related_episodes as $episode): ?>
                <div class="sidebar-item">
                    <a class="fw-bold nav-link" href="<?php echo $episode[ 'permalink' ] ?>">
                        <img src="<?php echo $episode[ 'image' ] ?>" alt="<?php echo $episode[ 'title' ] ?>">
                    </a>
                    <div class="sidebar-item-details">
                        <span class="sidebar-item-title"><?php echo $term_name ?>
                            -<?php echo $episode[ 'title' ] ?></span>
                        <span class="sidebar-item-date"><?php echo $episode[ 'relative_time' ] ?></span>
                    </div>
                    <a class="fw-bold nav-link arma-text"
                        href="<?php echo $episode[ 'permalink' ] ?>"><?php echo $episode[ 'title' ] ?></a>
                </div>

                <?php endforeach; ?>



            </div>
        </div>
        <!-- Main Video Section -->
        <div class="col-md-8 col-lg-9">
            <div class="video-container mb-3">

                <video id="videoPlayer" class="video-js vjs-default-skin vjs-big-play-centered rounded-3 w-100" controls
                    poster="<?php echo $episode_data[ 'image' ] ?>" width="100%" height="360">
                </video>

                <script>
                var player = videojs('videoPlayer', {
                    playbackRates: [0.5, 1, 1.5, 2],
                    controls: true,
                    autoplay: false,
                    preload: 'auto',
                    muted: true,
                    responsive: true,
                    fluid: true,
                    controlBar: {
                        pictureInPictureToggle: true
                    }
                });

                player.src({
                    src: "<?php echo $episode_data[ 'video' ][ 'm3u8' ] ?>",
                    type: "application/x-mpegURL"
                });

                player.ready(function() {
                    player.hlsQualitySelector({
                        displayCurrentQuality: true,
                        title: 'کیفیت'
                    });
                });
                </script>
            </div>
            <p class="video-title"><?php echo $episode_data[ 'title' ] ?></p>
            <p class="video-description">🔍 <?php echo $episode_data[ 'brief' ] ?></p>
            <div class="video-description"><?php echo $episode_data[ 'content' ] ?></div>


            <!-- New Section with Image and Titles in Horizontal Layout -->
            <div class="d-flex justify-content-between align-items-center my-4">
                <!-- Right Section with Image and Titles -->
                <div class="d-flex align-items-center">
                    <!-- Image Section -->
                    <img src="<?php echo $image_url ?>" alt="<?php echo $term_name ?>" class="rounded-circle"
                        style="width: 48px; height: 48px;">
                    <div class="ms-3">
                        <!-- Title and Subtitle -->
                        <p class="mb-1"><a class="nav-link"
                                href="<?php echo $category_link ?>"><?php echo $term_name ?></a></p>
                        <p class="text-muted m-0"><?php echo $term_name ?></p>
                    </div>
                </div>
                <!-- Left  Section with Icon and Titles (Horizontally) -->
                <div class="d-flex flex-row align-items-center justify-content-sm-end gap-2">
                    <!-- Icon for Adding to Favorites -->
                    <?php if ($bookmark): ?>
                    <div class="d-flex align-items-center bookmark-container">
                        <svg id="post_bookmark" data-bookmark-status="remove"
                            data-post-id="<?php echo $episode_data[ 'id' ] ?>"
                            data-type="<?php echo $episode_data[ 'type' ] ?>" xmlns="http://www.w3.org/2000/svg"
                            width="25" height="25" viewBox="0 0 24 24" fill="#ffad00" stroke="#ffad00" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bookmark">
                            <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z"></path>
                        </svg>
                        <span class="bookmark-tooltip fw-bold text-white">
                            حذف از لیست نشان شده‌ها
                            <span class="tooltip-arrow"></span>
                        </span>
                    </div>
                    <?php else: ?>
                    <div class="d-flex align-items-center bookmark-container">
                        <svg id="post_bookmark" data-bookmark-status="add"
                            data-post-id="<?php echo $episode_data[ 'id' ] ?>"
                            data-type="<?php echo $episode_data[ 'type' ] ?>" xmlns="http://www.w3.org/2000/svg"
                            width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="#ffad00" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bookmark">
                            <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z"></path>
                        </svg>
                        <span class="bookmark-tooltip fw-bold text-white">
                            افزودن به لیست نشان شده‌ها
                            <span class="tooltip-arrow"></span>
                        </span>
                    </div>
                    <?php endif; ?>

                    <?php if (! empty($episode_data[ 'video' ][ 'mp4' ])): ?>
                    <!-- Icon for Download -->
                    <div class="dropdown-container">
                        <button class="dropdown-button d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24"
                                fill="none">
                                <path id="download-svg" stroke="" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-miterlimit="10" stroke-width="1.5"
                                    d="M18.07 14.43L12 20.5l-6.07-6.07M12 3.5v16.83"></path>
                            </svg>
                            <span class="d-none d-md-block">دانلود</span>
                        </button>
                        <div class="dropdown-menu mb-5 bg-body">
                            <?php foreach ($episode_data[ 'video' ][ 'mp4' ] as $p => $link): ?>
                            <div class="dropdown-item"><a class="nav-link" href="<?php echo $link ?>">دانلود با کیفیت
                                    <?php echo $p ?></a></div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>


                    <!-- Icon for Sharing -->
                    <div class="d-flex align-items-center " id="sharingBtn"
                        data-link="<?php echo wp_get_shortlink($episode_data[ 'id' ]) ?>"
                        data-title="<?php echo $episode_data[ 'title' ] ?>">
                        <i class="bi bi-share-fill me-2"></i> <!-- آیکن اشتراک گذاری -->
                        <span class="d-none d-md-block">اشتراک گذاری</span>
                    </div>
                    <!-- Icon for Time -->
                    <div class="d-flex align-items-center bg-dark-subtle rounded-pill">
                        <span
                            class="p-2 small"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) ?>
                            قبل</span>

                    </div>

                </div>
            </div>

            <?php if (! empty($episode_cat)): ?>
            <div class="mx-auto p-4 swiper arma-swiper">
                <!-- عنوان و دکمه "نمایش همه" -->
                <div class="view-all d-flex justify-content-between align-items-center px-4 text-kama py-3">
                    <p class="fw-bold small">بخش های منتخب</p>
                    <a href="#" class="ms-3 d-none" style="font-size: 13px; color: #ffad00 ; text-decoration: none;">
                        نمایش همه
                        <svg fill="#ffad00 " height="8px" width="8px" viewBox="0 0 512.005 512.005">
                            <path d="M123.586,240.923L358.253,6.256c8.341-8.341,21.824-8.341,30.165,0s8.341,21.824,0,30.165L168.834,256.005
                l219.584,219.584c8.341,8.341,8.341,21.824,0,30.165c-4.16,4.16-9.621,6.251-15.083,6.251c-5.461,0-10.923-2.091-15.083-6.251
                L123.586,271.747C115.245,263.406,115.245,249.923,123.586,240.923z">
                            </path>
                        </svg>
                    </a>
                </div>

                <div class="swiper cat-swiper">
                    <div class="swiper-wrapper">

                        <?php
                            foreach ($episode_cat as $cat):
                        ?>
                        <div class="swiper-slide">
                            <div class="card position-relative">
                                <a href="<?php echo $cat[ 'permalink' ] ?>">
                                    <img src="<?php echo $cat[ 'image' ] ?>" class="card-img-top"
                                        alt="<?php echo $cat[ 'title' ] ?>">
                                </a>
                            </div>
                            <p class="card-text text-first mt-2">
                                <a class="nav-link"
                                    href="<?php echo $cat[ 'permalink' ] ?>"><?php echo $cat[ 'title' ] . ' - ' . $cat[ 'date' ] ?></a>
                            </p>
                        </div>
                        <?php
                            endforeach;
                        ?>
                    </div>

                </div>


            </div>
            <?php endif; ?>

            <div class="mx-auto p-4 swiper arma-swiper d-md-none d-block">
                <!-- عنوان و دکمه "نمایش همه" -->
                <div class="view-all d-flex  justify-content-between align-items-center px-4">
                    <p class="fw-bold small">سایر قسمت‌ها</p>
                    <a href="<?php echo $category_link ?>" class="ms-3"
                        style="font-size: 13px; color: #ffad00 ; text-decoration: none;">
                        نمایش همه
                        <svg fill="#ffad00 " height="8px" width="8px" viewBox="0 0 512.005 512.005">
                            <path d="M123.586,240.923L358.253,6.256c8.341-8.341,21.824-8.341,30.165,0s8.341,21.824,0,30.165L168.834,256.005
                l219.584,219.584c8.341,8.341,8.341,21.824,0,30.165c-4.16,4.16-9.621,6.251-15.083,6.251c-5.461,0-10.923-2.091-15.083-6.251
                L123.586,271.747C115.245,263.406,115.245,249.923,123.586,240.923z">
                            </path>
                        </svg>
                    </a>
                </div>

                <div class="swiper cat-swiper">
                    <div class="swiper-wrapper">

                        <?php
                            foreach ($related_episodes as $episode):
                        ?>
                        <div class="swiper-slide">
                            <div class="card position-relative">
                                <a href="<?php echo $episode[ 'permalink' ] ?>">
                                    <img src="<?php echo $episode[ 'image' ] ?>" class="card-img-top"
                                        alt="<?php echo $episode[ 'title' ] ?>">
                                </a>
                            </div>
                            <p class="card-text text-first mt-2">
                                <a class="nav-link  arma-text"
                                    href="<?php echo $episode[ 'permalink' ] ?>"><small><?php echo $episode[ 'title' ] ?></small></a>
                            </p>
                        </div>
                        <?php
                            endforeach;
                        ?>
                    </div>

                </div>


            </div>


            <div class="d-flex flex-row justify-content-start align-items-center my-4 gap-2 ">
                <img alt="profile" loading="lazy" decoding="async" class="rounded-circle bg-dark-subtle p-1"
                    style="width: 40px;" src="<?php echo arma_panel_image('comment.png') ?>">
                <div class="w-100 d-flex flex-row justify-content-start align-items-center my-4 gap-2">
                    <form method="POST" action="" id="comment-header"
                        class="arma-comment w-100 w-md-75 d-flex position-relative" data-post-id="<?php the_ID(); ?>">
                        <input type="text" name="comment" id="comment-header-input" class="form-control flex-grow-1"
                            aria-label="Search" placeholder="نظر خود را وارد کنید">
                        <button type="submit" id="fiter-btn"
                            class="comment-button position-absolute btn m-0 p-0 border-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="gray" viewBox="0 0 24 24" width="34"
                                height="26">
                                <path stroke="#gray" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.5 12H5.42m-.173.797L4.242 15.8c-.55 1.643-.826 2.465-.628 2.971.171.44.54.773.994.9.523.146 1.314-.21 2.894-.92l10.135-4.561c1.543-.695 2.314-1.042 2.553-1.524a1.5 1.5 0 0 0 0-1.33c-.239-.482-1.01-.83-2.553-1.524L7.485 5.243c-1.576-.71-2.364-1.064-2.887-.918a1.5 1.5 0 0 0-.994.897c-.198.505.074 1.325.618 2.966l1.026 3.091c.094.282.14.423.159.567a1.5 1.5 0 0 1 0 .385c-.02.144-.066.285-.16.566">
                                </path>
                            </svg>
                        </button>
                    </form>

                </div>
            </div>
            <div class="d-flex flex-column justify-content-start align-items-center my-4 gap-2 w-100 ">

                <?php
                    $comments = get_comments([
                        'post_id' => get_the_ID(),
                        'status'  => 'approve',
                        'parent'  => 0, // فقط نظرات اصلی رو بگیر
                     ]);

                    function display_comment($comment)
                    {
                        $attachment_url = "";
                        $attachment_id  = get_user_meta($comment->user_id, 'user_avatar', true);
                        if (! empty($attachment_id)) {
                            $attachment_url = wp_get_attachment_image_url($attachment_id); // دریافت URL تصویر

                        }

                        $comment_id = $comment->comment_ID;
                        $author     = get_comment_author($comment_id);
                        $date       = tarikh(get_comment_date('Y-m-d', $comment_id));
                        $content    = get_comment_text($comment_id);
                        $avatar     = $attachment_url;

                    ?>
                <div class="d-flex flex-row gap-2 w-100 comment-box" data-comment-id="<?php echo $comment_id; ?>">
                    <img alt="profile" loading="lazy" decoding="async" class="rounded-circle bg-dark-subtle p-1"
                        style="width: 40px; height: 40px;"
                        src="<?php echo $avatar ? $avatar : arma_panel_image('comment.png'); ?>">
                    <div class="d-flex flex-column w-100">
                        <div class="d-flex flex-row justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-2">
                                <p><?php echo esc_html($author); ?>
                                    <?php if (absint($comment->user_id) && user_can($comment->user_id, 'manage_options')) {echo "( مدیر سایت )";}?>
                                </p>
                                <p><?php echo esc_html($date); ?></p>
                            </div>
                            <?php if (is_user_logged_in()): ?>
                            <button class="btn btn-light reply-btn" data-comment-id="<?php echo $comment_id; ?>"
                                data-post-id="<?php echo get_the_ID() ?>">پاسخ</button>
                            <?php endif; ?>

                        </div>
                        <p><?php echo esc_html($content); ?></p>
                        <div class="replies">
                            <?php
                                // دریافت پاسخ‌های این نظر
                                    $replies = get_comments([
                                        'parent' => $comment_id,
                                        'status' => 'approve',
                                     ]);
                                    foreach ($replies as $reply) {
                                        display_comment($reply); // نمایش پاسخ‌ها
                                    }
                                ?>
                        </div>
                    </div>
                </div>
                <?php
                    }

                    // نمایش نظرات اصلی
                    foreach ($comments as $comment) {
                        display_comment($comment);
                    }
                ?>




            </div>
            <div id="reply-form-container" class="w-75 position-relative" style="display: none;">

                <button type="button" id="close-reply-form" class="btn-close position-absolute top-0 end-0 m-2 z-3"
                    aria-label="بستن"></button>
                <br><br>
                <form id="reply-form" class="arma-comment w-100 w-md-75 d-flex position-relative">

                    <input type="hidden" name="parent_comment_id" id="parent-comment-id">
                    <input type="hidden" name="post_id" id="new_comment_post_id">
                    <input type="text" name="comment" id="reply-input" class="form-control flex-grow-1"
                        placeholder="پاسخ خود را وارد کنید">
                    <button type="submit" class="comment-button position-absolute btn m-0 p-0 border-0">
                        ارسال
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>


<style>
.single-sidebar .sidebar-item-date {
    color: #ffffff;
    font-size: 9px !important;
    padding: 4px;
}
</style>


<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">ورود به حساب</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
            </div>
            <div class="modal-body">
                <p>برای ثبت نظر باید وارد حساب خود شوید.</p>
                <a href="/panel" class="btn btn-primary">ورود به سایت</a>
            </div>
        </div>
    </div>
</div>