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

        <form method="post" action="" novalidate="novalidate" class="ag_form">
            <?php wp_nonce_field('arma_nonce' . get_current_user_id()); ?>
            <h2 class="title">نوتیویکیتور ( <a href="https://notificator.ir">لینک</a> )</h2>
            <table class="form-table" role="presentation">
                <tbody>
                    <tr>
                        <th scope="row"><label for="notificator_token">توکن نوتیو</label></th>
                        <td>
                            <input name="notificator_token" type="text" id="notificator_token"
                                value="<?php echo $arma_option[ 'notificator_token' ]?>" class="regular-text dir-ltr">
                        </td>
                    </tr>
                </tbody>
            </table>

            <h2 class="title">تی اس ام اس ( <a href="https://www.tsms.ir/">لینک</a> )</h2>
            <table class="form-table" role="presentation">
                <tbody>
                    <tr>
                        <th scope="row"><label for="tsms_username">نام کاربری</label></th>
                        <td>
                            <input name="tsms[username]" type="text" id="tsms_username"
                                value="<?php echo $arma_option[ 'tsms' ][ 'username' ]?>" class="regular-text dir-ltr">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="tsms_password">رمز عبور پنل پیامک</label></th>
                        <td>
                            <input name="tsms[password]" type="text" id="tsms_password"
                                value="<?php echo $arma_option[ 'tsms' ][ 'password' ]?>" class="regular-text dir-ltr">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="tsms_number">شماره ارسال پیامک</label></th>
                        <td>
                            <input name="tsms[number]" type="text" id="tsms_number"
                                value="<?php echo $arma_option[ 'tsms' ][ 'number' ]?>" class="regular-text dir-ltr onlyNumbersInput" inputmode="numeric" pattern="\d*">
                        </td>
                    </tr>
                </tbody>
            </table>
            <h2 class="title">قاصدک ( <a href="https://panel.ghasedaksms.com/">لینک</a> )</h2>
            <table class="form-table" role="presentation">
                <tbody>

                    <tr>
                        <th scope="row"><label for="ghasedaksms_ApiKey">ApiKey</label></th>
                        <td>
                            <input name="ghasedaksms[ApiKey]" type="text" id="ghasedaksms_ApiKey"
                                value="<?php echo $arma_option[ 'ghasedaksms' ][ 'ApiKey' ]?>" class="regular-text dir-ltr">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="ghasedaksms_number">شماره ارسال پیامک</label></th>
                        <td>
                            <input name="ghasedaksms[number]" type="text" id="ghasedaksms_number"
                                value="<?php echo $arma_option[ 'ghasedaksms' ][ 'number' ]?>" class="regular-text dir-ltr onlyNumbersInput" inputmode="numeric" pattern="\d*">
                        </td>
                    </tr>
                </tbody>
            </table>






            <h2 class="title">تنظیمات پیامک</h2>

            <table class="form-table" role="presentation">
                <tbody>
                    <tr>
                        <th scope="row"><label for="set_timer">رمان اعتبار کد های ارسالی</label></th>
                        <td><input name="set_timer" type="text" id="set_timer"
                                value="<?php echo $arma_option[ 'set_timer' ] ?>" class="regular-text onlyNumbersInput"
                                inputmode="numeric" pattern="\d*"> دقیقه
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="set_code_count">تعداد کارکتر های پیامک</label></th>
                        <td><input name="set_code_count" type="text" id="set_code_count"
                                value="<?php echo $arma_option[ 'set_code_count' ] ?>"
                                class="regular-text onlyNumbersInput" inputmode="numeric" pattern="\d*">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="sms_text_otp">متن پیامک کد تایید</label></th>
                        <td>
                            <textarea rows="4" name="sms_text_otp" type="number" id="sms_text_otp"
                                class="regular-text"><?php echo $arma_option[ 'sms_text_otp' ] ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">نوع پنل پیامک</th>
                        <td class="radio-td">
                            <fieldset>
                                <label><input type="radio" name="sms_type"
                                        <?php checked($arma_option[ 'sms_type' ], 'notificator')?> value="notificator">
                                    <span class="date-time-text">notificator</span></label>
                                <label><input type="radio" name="sms_type"
                                        <?php checked($arma_option[ 'sms_type' ], 'tsms')?> value="tsms"> <span
                                        class="date-time-text">tsms</span></label>
                                <label><input type="radio" name="sms_type"
                                        <?php checked($arma_option[ 'sms_type' ], 'ghasedaksms')?> value="ghasedaksms">
                                    <span class="date-time-text">ghasedaksms</span></label>
                            </fieldset>
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
</div>