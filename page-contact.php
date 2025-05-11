<?php
    /*
Template Name: تماس با ما
*/
    get_header();

    $phone         = get_post_meta(get_the_ID(), 'contact_phone', true);
    $phone_support = get_post_meta(get_the_ID(), 'contact_phone_support', true);
?>

<div class="container-fluid p-5 " style="background: #3a3a3a;">
    <!-- افزودن رنگ پس‌زمینه دارک -->
    <div class="contact_us w-50 my-5 mx-auto">
        <!-- Titles -->
        <div class="d-flex flex-column mb-4 text-center">
            <h2 style="font-size: 16px; " class=" d-none">پاسخ سوال خود را پیدا نکرده‌اید؟</h2>
            <h3 style="font-size: 19px;" class="text-white">با ما گفتگو کنید یا از طریق ارسال ایمیل تماس بگیرید.</h3>
        </div>

        <!-- FAQ Button -->
        <div class="mb-4 text-center d-none">
            <button class="btn btn-primary" style="font-size: 12px; background-color: #ffad00; border-color: #ffad00;">
                سوالات متداول
            </button>
        </div>

        <!-- Two Boxes Horizontally -->
        <div class="row g-4 mb-4 justify-content-between text-white">
            <div class="col-12 col-md-6 rounded-3" style="font-size: 12px;background-color: #282828;">
                <div class="p-4">
                    <h4 style="font-size: 12px;">با ارسال ایمیل به بخش مورد نظر خود می‌توانید با ما در تماس باشید.
                    </h4>
                    <div class="row g-3 mt-3">
                        <!-- Second Row -->
                        <div class="col-6">
                            <p class="text-start mb-1">پشتیبانی سایت</p>
                        </div>
                        <div class="col-6">
                            <p class="text-end mb-1"><?php echo esc_html($phone_support); ?></p>
                        </div>

                        <!-- Third Row -->
                        <div class="col-6">
                            <p class="text-start mb-1">پیشنهادات و انتقادات</p>
                        </div>
                        <div class="col-6">
                            <p class="text-end mb-1"><?php echo esc_html($phone); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second Box -->
            <div class="col-12 col-md-6 p-0">
                <div class="p-4 rounded-3" style="font-size: 12px;background-color: #282828;">
                    <p>
                        <?php the_content(); ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- Two Boxes Vertically -->
        <div class="row g-4 mb-4 justify-conrow g-4 mb-4 justify-content-between d-none">
            <div class="mb-4" style="font-size: 12px;background-color: #282828;">
                <div class="p-4 border rounded d-flex justify-content-between">
                    <h4 style="font-size: 16px;">درخواست اشتراک سازمانی ON</h4>
                    <button class="btn btn-light" style="background-color: #fff; border-color: #ccc;">اطلاعات
                        بیشتر</button>
                </div>
                <p>کارکنان، مشتریان و شرکای تجاریتون رو سوپرایز کنید!</p>
            </div>
            <div class="mb-4" style="font-size: 12px;background-color: #282828;">
                <div class="p-4 border rounded d-flex justify-content-between">
                    <h4 style="font-size: 16px;">دعوت به همکاری</h4>
                    <button class="btn btn-light" style="background-color: #fff; border-color: #ccc;">جزئیات
                        بیشتر</button>
                </div>
                <p>با ما همراه شوید و تجربه‌ای متفاوت در همکاری رقم بزنید!</p>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>