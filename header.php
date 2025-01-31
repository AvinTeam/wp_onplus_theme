<?php

    global $arma_option;
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php wp_title('|', true, 'right'); ?></title>
    <?php wp_head(); ?>


    <!--
\    <link href="css/swiper-bundle.min.css" rel="stylesheet">
\    <link href="css/video-js.css" rel="stylesheet">
\    <script src="js/video.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
     -->

</head>

<body dir="rtl">
    <!-- Header Section -->
    <header class="border-bottom">
        <div class="container-fluid d-flex justify-content-between align-items-center py-2">
            <!-- Logo -->
            <div class="d-flex">
                <a href="#" class="navbar-brand d-flex align-items-center">
                    <img src="<?php echo $arma_option[ 'light-logo' ] ?>" alt="لوگو نسخه روشن"
                        class="rounded me-2 logo-light" id="logo-light">
                    <img src="<?php echo $arma_option[ 'dark-logo' ] ?>" alt="لوگو نسخه تیره"
                        class="rounded me-2 logo-dark" id="logo-dark">
                </a>
                <!-- Navigation Menu -->
                <nav class="navbar navbar-expand-lg" id="navbar">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="تغییر وضعیت ناوبری">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav me-auto">
                                <?php wp_nav_menu([
                                        'theme_location' => 'main-menu',
                                        'container'      => false,                             // حذف `div` اضافی
                                        'menu_class'     => 'navbar-nav ms-auto mb-2 mb-lg-0', // کلاس‌های سفارشی
                                        'walker'         => new Custom_Nav_Walker(),           // استفاده از Walker سفارشی
                                 ]); ?>

                                <li onclick="openSearch()" role="button"
                                    class="nav-item d-flex align-items-center my-2 mx-2">
                                    <i class="bi bi-search"></i>
                                    <span class="ms-2">جستجو</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <!-- Buttons -->
            <div class="d-flex align-items-center">
                <button id="toggleTheme" class="btn btn-outline-secondary mx-2">
                    <i id="themeIcon" class="bi bi-sun"></i>
                </button>
                <!-- متن ورود/ثبت نام اضافه شده -->
                <span class="ms-4">ورود/ثبت نام</span>
            </div>
        </div>
    </header>

    <!-- Toggle Theme Script -->


    <!-- Fullscreen Search Modal -->
    <div class="fullscreen-search" id="fullscreenSearch">
        <span class="close-btn" onclick="closeSearch()">&times;</span>
        <div class="search-box">

            <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                <input type="search" name="s" class="form-control search-input"
                    placeholder="عبارت مورد نظر را جستجو کنید..." value="<?php echo get_search_query(); ?>">
                <button type="submit" class="btn btn-success mt-3 w-100">جستجو</button>
            </form>
        </div>
    </div>