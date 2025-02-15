<?php
    (defined('ABSPATH')) || exit;
    global $title;

?>

<div id="wpbody-content">
    <div class="wrap arma_menu">
        <h1><?php echo esc_html($title) ?></h1>


        <hr class="wp-header-end">

        <form method="post" action="" novalidate="novalidate" class="ag_form">
            <?php wp_nonce_field('arma_nonce' . get_current_user_id()); ?>

            <h2>ابر آروان</h2>

            <table class="form-table" role="presentation">
                <tbody>
                    <tr>
                        <th scope="row"><label for="arvancloud_key">کلید</label></th>
                        <td>
                            <input name="arvancloud_key" type="text" class="regular-text dir-ltr" id="arvancloud_key"
                                value="<?php echo $arma_option[ 'arvancloud_key' ] ?>">
                        </td>
                    </tr>
                </tbody>
            </table>

            <h2>لوگو سایت</h2>

            <table class="form-table" role="presentation">
                <tbody>
                    <tr>
                        <th scope="row"><label for="light-logo">لوگو روز</label></th>
                        <td>
                            <img src="<?php echo $arma_option[ 'light-logo' ] ?>" style="max-width: 100px;">
                            <br>
                            <button type="button" class="button select-image">انتخاب لوگو</button>
                            <input name="light-logo" type="hidden" id="light-logo"
                                value="<?php echo $arma_option[ 'light-logo' ] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="dark-logo">لوگو روز</label></th>
                        <td>
                            <img src="<?php echo $arma_option[ 'dark-logo' ] ?>" style="max-width: 100px;">
                            <br>
                            <button type="button" class="button select-image">انتخاب لوگو</button>
                            <input name="dark-logo" type="hidden" id="dark-logo"
                                value="<?php echo $arma_option[ 'dark-logo' ] ?>">
                        </td>
                    </tr>
                </tbody>
            </table>


            <p class="submit">
                <button type="submit" name="arma_act" value="arma__submit" id="submit"
                    class="button button-primary">ذخیرهٔ
                    تغییرات</button>
            </p>



        </form>

    </div>


    <div class="clear"></div>
    <div class="oni-loader "></div>
</div>