<?php
    (defined('ABSPATH')) || exit;
    global $title;

?>

<div id="wpbody-content">
    <div class="wrap arma_menu">
        <h1><?php echo esc_html($title) ?></h1>
        <hr class="wp-header-end">
        <form id="accordion-form" method="post" action="" novalidate="novalidate" class="ag_form">
            <?php wp_nonce_field('arma_nonce' . get_current_user_id()); ?>


            <div id="accordion-container">
                <!-- Accordions will be dynamically generated here -->
            </div>
            <input type="hidden" class="w-100" name="home_page" id="accordionData" value="<?php echo $arma_option[ 'home_page' ]?>">
            <button id="add-accordion-btn" type="button" onclick="addAccordion()">اضافه کردن</button>

            <p class="submit">
                <button type="submit" name="arma_act" value="arma__home_page" id="submit"
                    class="button button-primary">ذخیرهٔ
                    تغییرات</button>
            </p>
        </form>

    </div>





    <div class="clear"></div>
</div>