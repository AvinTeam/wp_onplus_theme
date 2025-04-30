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

                    <img src="<?php echo($this_user->user_avatar) ? wp_get_attachment_image_url($this_user->user_avatar) : arma_panel_image('panel/placeHolderUserImage.png') ?>"
                        alt="<?php echo($this_user->display_name) ? $this_user->display_name : 'کاربر جدید' ?>"
                        class="img-fluid rounded-circle mb-2 border border-5"
                        style="width: 100px; height: 100px; object-fit: cover; border-color: #3899a0 !important;">

                    <h5 class="mt-2 text-white">
                        <?php echo($this_user->display_name != $this_user->user_login) ? $this_user->display_name : 'کاربر جدید' ?></h5>
                    <p class="text-white"><?php echo $this_user->mobile ?></p>
                </div>

                <!-- Right Column (Clickable Elements) -->
                <div class="list-group" style="background-color: #171717;">
                    <a href="<?php echo arma_base_url('edit-profile') ?>"
                        class="list-group-item border-0 list-group-item-action d-flex align-items-center"
                        style="background-color: #171717; color: white;">
                        <i class="bi bi-person me-2"></i>
                        ویرایش پروفایل
                    </a>
                    <a href="<?php echo arma_base_url('show') ?>"
                        class="list-group-item border-0 list-group-item-action d-flex align-items-center d-none"
                        style="background-color: #171717; color: white;">
                        <i class="bi bi-clock-history me-2"></i>
                        تاریخچه تماشا
                    </a>
                    <a href="<?php echo arma_base_url('bookmark') ?>"
                        class="list-group-item border-0 list-group-item-action d-flex align-items-center"
                        style="background-color: #171717; color: white;">
                        <i class="bi bi-bookmarks me-2"></i>
                        نشان شده&zwnj;ها
                    </a>
                    <a href="<?php echo arma_base_url('mobile') ?>"
                        class="list-group-item border-0 list-group-item-action d-flex align-items-center"
                        style="background-color: #171717; color: white;">
                        <i class="bi bi-phone me-2"></i>
                        تغییر شماره موبایل
                    </a>
                    <a href="<?php echo arma_base_url('logout') ?>"
                        class="list-group-item border-0 border-0 list-group-item-action d-flex align-items-center"
                        style="background-color: #171717; color: white;">
                        <i class="bi bi-box-arrow-right me-2"></i>
                        خروج از حساب کاربری
                    </a>
                </div>
            </div>
        </div>


        <!-- Column (Content Area) -->
        <div class="col-12 col-md-9 p-md-3 py-5">
            <?php echo arma_transient() ?>

            <?php

                require_once ARMA_VIEWS . 'layout/panel/edit-profile.php';
                require_once ARMA_VIEWS . 'layout/panel/bookmark.php';
                require_once ARMA_VIEWS . 'layout/panel/mobile.php';
                require_once ARMA_VIEWS . 'layout/panel/show.php';

            ?>



            <script>
            // function showContent(contentId) {
            //     const contentBoxes = document.querySelectorAll('.content-box');
            //     contentBoxes.forEach(box => box.style.display = 'none');

            //     const contentToShow = document.getElementById(contentId);
            //     if (contentToShow) {
            //         contentToShow.style.display = 'block';
            //     }
            // }
            // let hashPart = window.location.hash.substring(1); // حذف #

            // if (hashPart) {
            //     showContent(hashPart)
            // }
            </script>
        </div>
    </div>
</div>
<?php
            get_footer();