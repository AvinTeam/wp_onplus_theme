<div class="container-fluid px-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-4 col-lg-3 order-md-last single-sidebar mt-2">
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
                    <a class="fw-bold nav-link"
                        href="<?php echo $episode[ 'permalink' ] ?>"><?php echo $episode[ 'title' ] ?></a>
                </div>

                <?php endforeach; ?>



            </div>
        </div>
        <!-- Main Video Section -->
        <div class="col-md-8 col-lg-9">
            <div class="video-container mb-3">

                <video id="my-video" class="video-js vjs-default-skin vjs-big-play-centered" controls preload="auto"
                    poster="<?php echo $episode_data[ 'image' ] ?>" width="100%" height="360"
                    style="border-radius: 7px; width: 100%; ">
                    <source src="<?php echo $episode_data[ 'video' ] ?>" type="application/x-mpegURL">
                    مرورگر شما از پخش ویدئو پشتیبانی نمی‌کند.

                </video>

                <script>
                var player = videojs('my-video', {
                    playbackRates: [0.5, 1, 1.5, 2], // تنظیم سرعت‌های قابل انتخاب
                    controls: true,
                    autoplay: false,
                    fluid: true,
                    muted: true,
                    responsive: true,
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
                <div class="d-flex flex-row align-items-center ms-4">
                    <!-- Icon for Adding to Favorites -->




                    <?php if ($bookmark): ?>


                    <div class="d-flex align-items-center me-3 bookmark-container">
                        <svg id="post_bookmark" data-bookmark-status="remove"
                            data-post-id="<?php echo $episode_data[ 'id' ] ?>" xmlns="http://www.w3.org/2000/svg"
                            width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="#3899a0" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bookmark">
                            <path fill="#3899a0" d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z"></path>
                        </svg>
                        <span class="bookmark-tooltip fw-bold text-white">
                            حذف از لیست نشان شده‌ها
                            <span class="tooltip-arrow"></span>
                        </span>
                    </div>



                    <?php else: ?>

                    <div class="d-flex align-items-center me-3 bookmark-container">
                        <svg id="post_bookmark" data-bookmark-status="add"
                            data-post-id="<?php echo $episode_data[ 'id' ] ?>" xmlns="http://www.w3.org/2000/svg"
                            width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="#3899a0" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bookmark">
                            <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z"></path>
                        </svg>
                        <span class="bookmark-tooltip fw-bold text-white">
                            افزودن به لیست نشان شده‌ها
                            <span class="tooltip-arrow"></span>
                        </span>
                    </div>

                    <?php endif; ?>

                    <!-- Icon for Download -->
                    <div class="dropdown-container">
                        <button class="dropdown-button">دانلود</button>
                        <div class="dropdown-menu mb-5">
                            <?php foreach ($episode_data[ 'download_list' ] as $p => $link): ?>
                            <div class="dropdown-item"><a class="nav-link" href="<?php echo $link ?>">دانلود با کیفیت
                                    <?php echo $p ?></a></div>
                            <?php endforeach; ?>
                        </div>
                    </div>


                    <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        const button = document.querySelector(".dropdown-button");
                        const menu = document.querySelector(".dropdown-menu");

                        button.addEventListener("click", (event) => {
                            event.stopPropagation(); // جلوگیری از بسته شدن لیست هنگام کلیک روی دکمه
                            menu.classList.toggle("show");
                        });

                        document.addEventListener("click", (event) => {
                            if (!menu.contains(event.target) && !button.contains(event.target)) {
                                menu.classList.remove("show");
                            }
                        });
                    });
                    </script>

                    <!-- Icon for Sharing -->
                    <div class="d-flex align-items-center me-3">
                        <i class="bi bi-share-fill me-2"></i> <!-- آیکن اشتراک گذاری -->
                        <span>اشتراک گذاری</span>
                    </div>
                    <!-- Icon for Time -->
                    <div class="d-flex align-items-center me-3 bg-dark-subtle rounded-pill">
                        <span class="p-2"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) ?>
                            قبل</span>

                    </div>

                </div>
            </div>
            <div id="top" class="pt-9"></div>
            <div class="d-flex flex-row justify-content-start align-items-center my-4 gap-2 ">
                <div class="text-end">
                    <img alt="profile" loading="lazy" decoding="async" class="rounded-circle bg-dark-subtle p-1 w-25"
                        src="<?php echo arma_panel_image('comment.png') ?>">
                </div>

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
                        $avatar = $attachment_url;

                    ?>
                <div class="d-flex flex-row gap-2 w-75 comment-box" data-comment-id="<?php echo $comment_id; ?>">
                    <img alt="profile" loading="lazy" decoding="async" class="rounded-circle bg-dark-subtle p-1"
                        style="width: 40px; height: 40px;"
                        src="<?php echo $avatar ? $avatar : arma_panel_image('comment.png'); ?>">
                    <div class="d-flex flex-column w-100">
                        <div class="d-flex flex-row justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-2">
                                <p><?php echo esc_html($author); ?></p>
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
    <div class="modal-dialog">
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

<!-- Modal -->
<div class="modal fade" id="bookmark-modal" tabindex="-1" aria-labelledby="bookmark-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="bookmark-modalLabel">اطلاعیه</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
        </div>
    </div>
</div>