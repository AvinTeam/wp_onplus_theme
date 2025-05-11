<div style="height: 45px; opacity: 0; ">0</div>
<!-- Modal -->
<div class="modal fade" id="alert-modal" tabindex="-1" aria-labelledby="alert-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="alert-modalLabel">اطلاعیه</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="sharing-popup" tabindex="-1" aria-labelledby="sharing-popup_Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="sharing-popup_Label">اشتراک در شبکه های اجتماعی</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-bodyd-flex flex-column justify-content-center align-content-center text-center m-3 ">
                <div class="d-flex flex-row row-cols-6 justify-content-center align-content-center gap-2 w-75 mx-auto">

                    <a class="col sharing-logo d-flex flex-column align-content-center  justify-content-center "
                        id="sharing_eitaa" href="#">
                        <img src="<?php echo arma_panel_image('eitaa.svg') ?>">
                        <span class="text-body">ایتا</span>
                    </a><a class="col sharing-logo d-flex flex-column align-content-center  justify-content-center "
                        id="sharing_rubika" href="#">
                        <img src="<?php echo arma_panel_image('rubika.png') ?>">
                        <span class="text-body">روبیکا</span>
                    </a><a class="col sharing-logo d-flex flex-column align-content-center  justify-content-center "
                        id="sharing_telegram" href="#">
                        <img src="<?php echo arma_panel_image('telegram.svg') ?>">
                        <span class="text-body">تلگرام</span>
                    </a><a class="col sharing-logo d-flex flex-column align-content-center  justify-content-center "
                        id="sharing_whatsapp" href="#">
                        <img src="<?php echo arma_panel_image('whatsapp.png') ?>">
                        <span class="text-body">واتس اپ</span>
                    </a><a class="col sharing-logo d-flex flex-column align-content-center  justify-content-center "
                        id="sharing_bale" href="#">
                        <img src="<?php echo arma_panel_image('Bale.png') ?>">
                        <span class="text-body">بله</span>
                    </a><a class="col sharing-logo d-flex flex-column align-content-center  justify-content-center "
                        id="sharing_instagram" href="#">
                        <img src="<?php echo arma_panel_image('instagram.png') ?>">
                        <span class="text-body">اینستاگرام</span>
                    </a>


                </div>
                <div class="d-flex flex-row justify-content-center align-content-center mt-4 gap-2">
                    <button class="btn btn-secondary" id="sharing_button"><i
                            class="bi h5 bi-copy fw-bold text-success-emphasis m-0 p-0"></i></button>
                    <input class="form-control" id="sharing_input" class="" disabled="" style="direction: ltr;"
                        readonly="" type="text" value="#">
                </div>
            </div>
        </div>
    </div>
</div>
<?php wp_footer()?>

<!-- لودر تمام صفحه -->
<div class="overlay" id="overlay">
    <div class="loader"></div>
</div>
<!-- فوتر -->
<footer class="footer mt-5 bg-body border-top-3 border-dark">
<hr class="mt-0 pt-0">
    <div class="container d-flex justify-content-between">

        <div>
            <?php wp_nav_menu([
                    'theme_location' => 'footer-menu',
                    'container'      => false,
                    'menu_class'     => '',
                    'items_wrap'     => '%3$s', // فقط آیتم‌های منو
                    'walker'         => new Footer_Menu_Walker(),
             ]); ?>

        </div>


        <div class="social-container">
            <span class="social-title">
                شبکه های اجتماعی
                <svg class="arrow-icon" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="white"
                    viewBox="0 0 24 24">
                    <path d="M12 8l-6 6h12z"></path>
                </svg>
            </span>
            <ul class="social-list bg-body">

                <li><a class="text-body" target="_blank" href="https://www.aparat.com/kamaitv"><img src="<?php echo arma_panel_image('aparat.png') ?>"
                            alt="bale">آپارات</a></li>

                <li><a class="text-body" target="_blank" href="https://eitaa.com/kamaitv"><img src="<?php echo arma_panel_image('eitaa.svg') ?>"
                            alt="eita">ایتا</a></li>

                <li><a class="text-body" target="_blank" href="https://t.me/kamaitv"><img src="<?php echo arma_panel_image('telegram.svg') ?>"
                            alt="telegram">تلگرام</a></li>


                <li class="d-none"><a class="text-body" target="_blank" href="#"><img src="<?php echo arma_panel_image('instagram.png') ?>"
                            alt="instagram">اینستاگرام</a></li>
                            
                <li class="d-none"><a class="text-body" target="_blank" href="#"><img src="<?php echo arma_panel_image('Bale.png') ?>"
                            alt="bale">بله</a></li>
                            
                <li class="d-none"><a class="text-body" target="_blank" href="#"><img src="<?php echo arma_panel_image('rubika.png') ?>"
                            alt="rubika">روبیکا</a></li>
            </ul>
        </div>
    </div>
</footer>

</body>

</html>

<?php arma_visiter()?>