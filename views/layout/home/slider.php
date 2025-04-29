<style>
.swiper {
    width: 100%;
    height: <?=$row['slider']?>px;
}

.swiper-slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: all 0.3s ease;
}

.swiper-button-next,
.swiper-button-prev {
    color: #000000;
}
</style>













<div class="swiper mySliderSwiper">
    <div class="swiper-wrapper">

        <?php
                $image_ids = ! empty($arma_option[ 'slider_images' ]) ? explode(',', $arma_option[ 'slider_images' ]) : [  ];
            foreach ($image_ids as $image_id): ?>
        <?php $image_url = wp_get_attachment_image_url($image_id, 'full'); ?>
        <?php if ($image_url): ?>



        <div class="swiper-slide  overflow-hidden">
            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_the_title($image_id)); ?>">
        </div>
        <?php endif; ?>
        <?php endforeach; ?>

    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>

<script>
var swiper = new Swiper(".mySliderSwiper", {

    loop: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
});
</script>