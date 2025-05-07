<?php
    /*
Template Name: درباره ما
*/
    get_header();
?>

    <!-- سطر اول -->
    <div class="container-fluid bg-custom py-5 text-center" style="background-color: #181818;">
        <h2 class="mb-3 fw-bold" style="font-size: 24px; color: #ffad00;"><?php the_title(); ?></h2>
        <h2 class="text-white d-none" style="font-size: 16px;">صفحه اصلی / <?php the_title(); ?></h2>
    </div>

    <!-- سطر دوم -->
    <div class="container py-5">
        <div class="row">
            <!-- ستون راست - 20% -->
            <div class="col-12 col-md-2 text-center" style="border-radius: 7px;">
                <img src="<?=arma_panel_image('about.png')?>" class="img-fluid rounded mb-4" alt="درباره <?= bloginfo('name')?>">
            </div>

            <!-- ستون چپ - 80% -->
            <div class="col-12 col-md-10">
                <?php the_content(); ?>

            </div>
        </div>

        <!-- سطر جدید برای عنوان توضیحی -->
        <div class="row d-none">
            <div class="col-12 col-md-2 text-center">
                <h4 class="mb-2" style="font-size: 16px; color: #606770;">عنوان توضیحی</h4>
                <h4 style="font-size: 16px; color: #606770;">عنوان توضیحی</h4>
            </div>
        </div>
    </div>

































    <?php get_footer(); ?>