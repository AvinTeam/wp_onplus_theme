<?php
    (defined('ABSPATH')) || exit;
    global $title;

?>

<div id="wpbody-content">
    <div class="wrap arma_menu">
        <h1><?php echo esc_html($title) ?></h1>

        <hr class="wp-header-end">

        <?php if ($error = get_transient('error_mat')) {?>
        <div class="notice notice-error settings-error is-dismissible">
            <p><?php echo esc_html($error); ?></p>
        </div>
        <?php set_transient('error_mat', '');}?>

        <?php if ($success = get_transient('success_mat')) {?>
        <div class="notice notice-success settings-error is-dismissible">
            <p><?php echo esc_html($success); ?></p>
        </div>
        <?php set_transient('success_mat', '');}?>

        <form id="accordion-form" method="post" action="" novalidate="novalidate" class="ag_form">
            <?php wp_nonce_field('arma_nonce' . get_current_user_id()); ?>


            <div id="accordion-container">
                <!-- Accordions will be dynamically generated here -->
            </div>
            <input type="" class="w-100" name="home_page" id="accordionData">
            <button id="add-accordion-btn" type="button" onclick="addAccordion()">Add Accordion</button>

            <p class="submit">
                <button type="submit" name="arma_act" value="arma__home_page" id="submit"
                    class="button button-primary">ذخیرهٔ
                    تغییرات</button>
            </p>
        </form>

    </div>


    <div class="clear"></div>
</div>