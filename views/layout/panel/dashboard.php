<?php
    function arma_title_filter_dashboard($title)
    {

        $title = "پنل کاریری | " . get_bloginfo('name');
        return $title;
    }
    add_filter('wp_title', 'arma_title_filter_dashboard');

get_header(); 


$this_user = wp_get_current_user();


?>

<style>
/* حالت دارک */
.dark .sidebar {
    background-color: #343a40 !important;
    /* خاکستری تیره */
}

*/ .dark .sidebar .nav-link {
    color: #ccc !important;
}

.dark .sidebar .nav-link:hover {
    color: #fff !important;
}

.dark .sidebar .nav-link.active {
    color: #fff !important;
    background-color: #495057 !important;
}

*/

/* حالت لایت */
.light .sidebar {
    background-color: #f8f9fa !important;
    /* رنگ روشن برای سایدبار */
}

.light .sidebar .nav-link {
    color: #333 !important;
    /* رنگ تیره برای لینک‌ها */
}

.light .sidebar .nav-link:hover {
    color: #000 !important;
    /* رنگ تیره‌تر برای هاور */
}

.light .sidebar .nav-link.active {
    color: #000 !important;
    background-color: #ddd !important;
    /* رنگ فعال روشن‌تر */
}
</style>


</style>
<div class="space-y-10 p-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-12 col-md-3 col-lg-2 p-3 rounded-3"
            style="max-height: 100vh; overflow-y: auto; background-color: #171717;">
            <div class="d-flex flex-column">
                <div class="text-center mb-4" style="background-color: #171717;">
                    <img src="<?php echo arma_panel_image('panel/placeHolderUserImage.png') ?>" alt="User Avatar"
                        class="rounded-circle" width="100">
                    <h5 class="mt-2 text-white"><?=($this_user->nickname)?$this_user->display_name:'کاربر جدید' ?></h5>
                    <p class="text-white"><?=$this_user->mobile?></p>
                </div>

                <!-- Right Column (Clickable Elements) -->
                <div class="list-group" style="background-color: #171717;">
                    <a href="#" class="list-group-item border-0 list-group-item-action d-flex align-items-center"
                        onclick="showContent('content2')" style="background-color: #171717; color: white;">
                        <i class="bi bi-person me-2"></i>
                        ویرایش پروفایل
                    </a>
                    <a href="#" class="list-group-item border-0 list-group-item-action d-flex align-items-center"
                        onclick="showContent('content3')" style="background-color: #171717; color: white;">
                        <i class="bi bi-person me-2"></i>
                        تاریخچه تماشا
                    </a>
                    <a href="#" class="list-group-item border-0 list-group-item-action d-flex align-items-center"
                        onclick="showContent('content4')" style="background-color: #171717; color: white;">
                        <i class="bi bi-file-earmark me-2"></i>
                        نشان شده&zwnj;ها
                    </a>
                    <a href="#" class="list-group-item border-0 list-group-item-action d-flex align-items-center"
                        onclick="showContent('content6')" style="background-color: #171717; color: white;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-cog me-2" viewBox="0 0 16 16">
                            <path
                                d="M8 0a1 1 0 0 1 1 1v1.107a6.967 6.967 0 0 1 2.61.92L12.426 3.5a1 1 0 0 1 1.2 1.6l-1.1 1.9a6.977 6.977 0 0 1 .06 2.4l1.14 1.93a1 1 0 0 1-1.2 1.6l-1.816-.627a6.95 6.95 0 0 1-1.728 1.616L9 13.864V15a1 1 0 0 1-2 0v-1.136a6.948 6.948 0 0 1-1.616-1.728l-1.93 1.14a1 1 0 0 1-1.6-1.2l.627-1.816a6.96 6.96 0 0 1-2.4-.06l-1.9 1.1a1 1 0 0 1-1.6-1.2l.92-2.61H0a1 1 0 0 1 0-2h1.107a6.967 6.967 0 0 1-.92-2.61L3.5 3.574a1 1 0 0 1 1.6-1.2l1.9 1.1a6.957 6.957 0 0 1 2.4-.06l1.93-1.14a1 1 0 0 1 1.2 1.6L8 0z">
                            </path>
                        </svg>
                        تغییر شماره موبایل
                    </a>
                    <a href="#"
                        class="list-group-item border-0 border-0 list-group-item-action d-flex align-items-center"
                        onclick="showContent('content7')" style="background-color: #171717; color: white;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-cog me-2" viewBox="0 0 16 16">
                            <path
                                d="M8 0a1 1 0 0 1 1 1v1.107a6.967 6.967 0 0 1 2.61.92L12.426 3.5a1 1 0 0 1 1.2 1.6l-1.1 1.9a6.977 6.977 0 0 1 .06 2.4l1.14 1.93a1 1 0 0 1-1.2 1.6l-1.816-.627a6.95 6.95 0 0 1-1.728 1.616L9 13.864V15a1 1 0 0 1-2 0v-1.136a6.948 6.948 0 0 1-1.616-1.728l-1.93 1.14a1 1 0 0 1-1.6-1.2l.627-1.816a6.96 6.96 0 0 1-2.4-.06l-1.9 1.1a1 1 0 0 1-1.6-1.2l.92-2.61H0a1 1 0 0 1 0-2h1.107a6.967 6.967 0 0 1-.92-2.61L3.5 3.574a1 1 0 0 1 1.6-1.2l1.9 1.1a6.957 6.957 0 0 1 2.4-.06l1.93-1.14a1 1 0 0 1 1.2 1.6L8 0z">
                            </path>
                        </svg>
                        خروج از حساب کاربری
                    </a>
                </div>
            </div>
        </div>


        <!-- Column (Content Area) -->
        <div class="col-12 col-md-9 p-md-3 py-5">

            <?php

                require_once ARMA_VIEWS . 'layout/panel/edit-profile.php';
                require_once ARMA_VIEWS . 'layout/panel/bookmark.php';
                require_once ARMA_VIEWS . 'layout/panel/mobile.php';

            ?>

            <div id="content3" class="content-box" style="display: none;">
                <p>تاریخچه تماشا</p>
            </div>

  
            <script>
            function showContent(contentId) {
                const contents = document.querySelectorAll('.content-box');
                contents.forEach(content => {
                    content.style.display = 'none';
                });
                document.getElementById(contentId).style.display = 'block';
            }
            </script>
            <script>
            function showContent(contentId) {
                // Hide all content boxes
                const contentBoxes = document.querySelectorAll('.content-box');
                contentBoxes.forEach(box => box.style.display = 'none');

                // Show the clicked content
                const contentToShow = document.getElementById(contentId);
                if (contentToShow) {
                    contentToShow.style.display = 'block';
                }
            }
            </script>
            <?php
            get_footer();