<?php

(defined('ABSPATH')) || exit;

function arma_panel_js($path)
{
    return ARMA_JS . $path . '?ver=' . ARMA_VERSION;
}

function arma_panel_css($path)
{
    return ARMA_CSS . $path . '?ver=' . ARMA_VERSION;
}

function arma_panel_image($path)
{
    return ARMA_IMAGE . $path;
}

function arma_remote(string $url)
{
    $res = wp_remote_get(
        $url,
        [
            'timeout' => 1000,
         ]);

    if (is_wp_error($res)) {
        $result = [
            'code'   => 1,
            'result' => $res->get_error_message(),
         ];
    } else {
        $result = [
            'code'   => 0,
            'result' => json_decode($res[ 'body' ]),
         ];
    }

    return $result;
}

function arma_start_working(): array
{

    arma_cookie();

    $arma_option = get_option('arma_option');

    if (! isset($arma_option[ 'version' ]) || version_compare(ARMA_VERSION, $arma_option[ 'version' ], '>')) {

        update_option(
            'arma_option',
            [
                'version'           => ARMA_VERSION,
                'tsms'              => (isset($arma_option[ 'tsms' ])) ? $arma_option[ 'tsms' ] : [ 'username' => '', 'password' => '', 'number' => '' ],
                'ghasedaksms'       => (isset($arma_option[ 'ghasedaksms' ])) ? $arma_option[ 'ghasedaksms' ] : [ 'ApiKey' => '', 'number' => '' ],
                'sms_text_otp'      => (isset($arma_option[ 'sms_text_otp' ])) ? $arma_option[ 'sms_text_otp' ] : 'کد تأیید شما: %otp%',
                'set_timer'         => (isset($arma_option[ 'set_timer' ])) ? $arma_option[ 'set_timer' ] : 1,
                'set_code_count'    => (isset($arma_option[ 'set_code_count' ])) ? $arma_option[ 'set_code_count' ] : 4,
                'show_signature'    => (isset($arma_option[ 'show_signature' ])) ? $arma_option[ 'show_signature' ] : 12,
                'start_signature'   => (isset($arma_option[ 'start_signature' ])) ? $arma_option[ 'start_signature' ] : 0,
                'sms_type'          => (isset($arma_option[ 'sms_type' ])) ? $arma_option[ 'sms_type' ] : 'tsms',
                'notificator_token' => (isset($arma_option[ 'notificator_token' ])) ? $arma_option[ 'notificator_token' ] : '',
                'home_page'         => (isset($arma_option[ 'home_page' ])) ? $arma_option[ 'home_page' ] : '',
                'light-logo'        => (isset($arma_option[ 'light-logo' ])) ? $arma_option[ 'light-logo' ] : arma_panel_image('Logo-Light.png'),
                'dark-logo'         => (isset($arma_option[ 'dark-logo' ])) ? $arma_option[ 'dark-logo' ] : arma_panel_image('Logo-Dark.png'),

             ]

        );
    }

    return get_option('arma_option');

}

function arma_update_option($data)
{

    $arma_option = get_option('arma_option');

    $arma_option = [
        'version'           => ARMA_VERSION,
        'tsms'              => (isset($data[ 'tsms' ])) ? $data[ 'tsms' ] : $arma_option[ 'tsms' ],
        'ghasedaksms'       => (isset($data[ 'ghasedaksms' ])) ? $data[ 'ghasedaksms' ] : $arma_option[ 'ghasedaksms' ],
        'set_timer'         => (isset($data[ 'set_timer' ])) ? absint($data[ 'set_timer' ]) : $arma_option[ 'set_timer' ],
        'set_code_count'    => (isset($data[ 'set_code_count' ])) ? absint($data[ 'set_code_count' ]) : $arma_option[ 'set_code_count' ],
        'show_signature'    => (isset($data[ 'show_signature' ])) ? $data[ 'show_signature' ] : $arma_option[ 'show_signature' ],
        'start_signature'   => (isset($data[ 'start_signature' ])) ? $data[ 'start_signature' ] : $arma_option[ 'start_signature' ],
        'sms_text_otp'      => (isset($data[ 'sms_text_otp' ])) ? sanitize_textarea_field($data[ 'sms_text_otp' ]) : $arma_option[ 'sms_text_otp' ],
        'sms_type'          => (isset($data[ 'sms_type' ])) ? sanitize_text_field($data[ 'sms_type' ]) : $arma_option[ 'sms_type' ],
        'notificator_token' => (isset($data[ 'notificator_token' ])) ? sanitize_text_field($data[ 'notificator_token' ]) : $arma_option[ 'notificator_token' ],
        'home_page'         => (isset($data[ 'home_page' ])) ? $data[ 'home_page' ] : $arma_option[ 'home_page' ],
        'light-logo'        => (isset($data[ 'light-logo' ])) ? $data[ 'light-logo' ] : $arma_option[ 'light-logo' ],
        'dark-logo'         => (isset($data[ 'dark-logo' ])) ? $data[ 'dark-logo' ] : $arma_option[ 'dark-logo' ],

     ];
    //json_encode($data[ 'home_page' ], JSON_UNESCAPED_UNICODE)

    update_option('arma_option', $arma_option);

}

function arma_massage_otp($otp)
{
    global $arma_option;

    $server_name = $_SERVER[ 'SERVER_NAME' ];

    $finalMessage = str_replace('%otp%', $otp, $arma_option[ 'sms_text_otp' ]);

    //$massage = $finalMessage . PHP_EOL . "@" . $server_name . " #" . $otp;
    $massage = $finalMessage;

    return $massage;

}

function arma_massage_format($data)
{
    global $arma_option;
    $server_name = $_SERVER[ 'SERVER_NAME' ];

    $finalMessage = str_replace([ '%username%', '%password%', '%url%' ], $data, $arma_option[ 'sms_text_format' ]);
    $massage      = $finalMessage . PHP_EOL . $server_name;

    return $massage;

}

function notificator($mobile, $massage)
{
    global $arma_option;

    $data = [
        'to'   => $arma_option[ 'notificator_token' ],
        'text' => $mobile . PHP_EOL . $massage,
     ];

    // درخواست POST با wp_remote_post
    $response = wp_remote_post('https://notificator.ir/api/v1/send', [
        'body' => $data,
     ]);

    $result = json_decode(wp_remote_retrieve_body($response));

    $result = [
        'code'    => $result->success,
        'massage' => ($result->success) ? 'پیام با موفقیت ارسال شد' : 'پیام به خطا خورده است ',
     ];

    return $result;

}

function tsms($mobile, $massage)
{

    global $arma_option;

    $msg_array = [ $massage ];

    $data = [
        'method'     => 'sendSms',
        'username'   => $arma_option[ 'tsms' ][ 'username' ],
        'password'   => $arma_option[ 'tsms' ][ 'password' ],
        'sms_number' => [ $arma_option[ 'tsms' ][ 'number' ] ],
        'mobile'     => [ $mobile ],
        'msg'        => $msg_array,
        'mclass'     => [ '' ],
        'messagid'   => rand(),
     ];

    $response = wp_remote_post('https://www.tsms.ir/json/json.php', [
        'body' => http_build_query($data),
     ]);

    $response = json_decode(wp_remote_retrieve_body($response));

    $result = [
        'code'    => ($response->code == 200) ? 1 : $response->code,
        'massage' => ($response->code == 200) ? 'پیام با موفقیت ارسال شد' : 'پیام به خطا خورده است',
     ];
    return $result;

}

function ghasedaksms($mobile, $massage)
{

    global $arma_option;
    $data = [
        'message'  => $massage,
        'sender'   => $arma_option[ 'ghasedaksms' ][ 'number' ],
        'receptor' => $mobile,
     ];
    $header = [
        'ApiKey' => $arma_option[ 'ghasedaksms' ][ 'ApiKey' ],
     ];

    $response = wp_remote_post('http://api.ghasedaksms.com/v2/sms/send/bulk2', [
        'headers' => $header,
        'body'    => http_build_query($data),
     ]);

    $response = json_decode(wp_remote_retrieve_body($response));

    $result = [
        'code'    => ($response->result == 'success' && strlen($response->messageids) > 5) ? 1 : $response->messageids,
        'massage' => ($response->result == 'success' && strlen($response->messageids) > 5) ? 'پیام با موفقیت ارسال شد' : 'پیام به خطا خورده است',
     ];
    return $result;

}

function arma_send_sms($mobile, $type, $data = [  ])
{

    global $arma_option;
    $massage = '';

    $result = [
        'code'    => 0,
        'massage' => $mobile,
     ];

    // بررسی فرمت شماره موبایل
    if (! preg_match('/^09[0-9]{9}$/', $mobile)) {
        $result = [
            'code'    => -1,
            'massage' => 'شماره موبایل معتبر نیست.',
         ];
    }

    if ($type == 'otp') {
        if (get_transient('otp_' . $mobile)) {
            $result = [
                'code'    => -2,
                'massage' => 'لطفا چند دقیقه دیگر تلاش کنید.',
             ];
        }

        $otp = '';

        for ($i = 0; $i < $arma_option[ 'set_code_count' ]; $i++) {
            $otp .= rand(0, 9);
        }
        set_transient('otp_' . $mobile, $otp, $arma_option[ 'set_timer' ] * MINUTE_IN_SECONDS);

        if ($result[ 'code' ] == 0) {
            $result = $arma_option[ 'sms_type' ]($mobile, arma_massage_otp($otp));
            if ($result[ 'code' ] != 1) {
                delete_transient('otp_' . $mobile);

            }

        }
    }

    if ($type == 'forarma_art') {
        $result = $arma_option[ 'sms_type' ]($mobile, arma_massage_format($data));

    }

    return $result;
}
function sanitize_phone($phone)
{

    /**
     * Convert all chars to en digits
     */
    $western = [ '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' ];
    $persian = [ '۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹' ];
    $arabic  = [ '٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩' ];
    $phone   = str_replace($persian, $western, $phone);
    $phone   = str_replace($arabic, $western, $phone);

    //.9158636712   => 09158636712
    if (strpos($phone, '.') === 0) {
        $phone = '0' . substr($phone, 1);
    }

    //00989185223232 => 9185223232
    if (strpos($phone, '0098') === 0) {
        $phone = substr($phone, 4);
    }
    //0989108210911 => 9108210911
    if (strlen($phone) == 13 && strpos($phone, '098') === 0) {
        $phone = substr($phone, 3);
    }
    //+989156040160 => 9156040160
    if (strlen($phone) == 13 && strpos($phone, '+98') === 0) {
        $phone = substr($phone, 3);
    }
    //+98 9156040160 => 9156040160
    if (strlen($phone) == 14 && strpos($phone, '+98 ') === 0) {
        $phone = substr($phone, 4);
    }
    //989152532120 => 9152532120
    if (strlen($phone) == 12 && strpos($phone, '98') === 0) {
        $phone = substr($phone, 2);
    }
    //Prepend 0
    if (strpos($phone, '0') !== 0) {
        $phone = '0' . $phone;
    }
    /**
     * check for all character was digit
     */
    if (! ctype_digit($phone)) {
        return '';
    }

    if (strlen($phone) != 11) {
        return '';
    }

    return $phone;

}

function arma_cookie(): string
{

    if (! is_user_logged_in()) {

        if (! isset($_COOKIE[ "setcookie_arma_nonce" ])) {

            $is_key_cookie = arma_rand_string(15);
            ob_start();

            setcookie("setcookie_arma_nonce", $is_key_cookie, time() + 1800, "/");

            ob_end_flush();

            header("Refresh:0");
            exit;

        } else {
            $is_key_cookie = $_COOKIE[ "setcookie_arma_nonce" ];
        }
    } else {

        $is_key_cookie = get_current_user_id();

    }
    return $is_key_cookie;
}

function arma_rand_string($length = 20)
{
    $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; // اعداد و حروف
    $charactersLength = strlen($characters);
    $randomString     = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[ rand(0, $charactersLength - 1) ];
    }
    return $randomString;
}

function arma_mask_mobile($mobile)
{
    // بررسی طول شماره موبایل
    if (strlen($mobile) === 11) {
        $lastFour = substr($mobile, -4); // گرفتن 4 رقم آخر

        $masked = $lastFour . "*****" . substr($mobile, 0, 4);

        return $masked;
    }
    return "شماره موبایل نامعتبر است.";
}

function tarikh($data, $type = '')
{

    $data_array = explode(" ", $data);

    $data = $data_array[ 0 ];
    $time = (sizeof($data_array) >= 2) ? $data_array[ 1 ] : 0;

    $has_mode = (strpos($data, '-')) ? '-' : '/';

    list($y, $m, $d) = explode($has_mode, $data);

    $ch_date = (strpos($data, '-')) ? gregorian_to_jalali($y, $m, $d, '/') : jalali_to_gregorian($y, $m, $d, '-');

    if ($type == 'time') {
        $new_date = $time;
    } elseif ($type == 'date') {
        $new_date = $ch_date;
    } else {
        $new_date = ($time === 0) ? $ch_date : $ch_date . ' ' . $time;
    }

    return $new_date;

}

function get_current_relative_url()
{
    // گرفتن مسیر فعلی بدون دامنه
    $path = esc_url_raw(wp_unslash($_SERVER[ 'REQUEST_URI' ]));

                                                // حذف دامنه و فقط نگه داشتن مسیر نسبی + پارامترها
    $relative_url = strtok($path, '?');         // مسیر قبل از پارامترها
    $query_string = $_SERVER[ 'QUERY_STRING' ]; // پارامترهای GET

    // اگر پارامتر وجود داره، به مسیر اضافه کن
    if ($query_string) {
        $relative_url .= '?' . $query_string;
    }

    return $relative_url;
}

function get_name_by_id($data, $id)
{
    $filtered = array_filter($data, function ($item) use ($id) {
        return $item->id == $id;
    });

    // برگرداندن اولین مقدار پیدا شده
    if (! empty($filtered)) {
        return array_values($filtered)[ 0 ]->name;
    }
    return null;
}

function arma_transient()
{
    $arma_transient = get_transient('arma_transient');

    if ($arma_transient) {
        delete_transient('arma_transient');
        return $arma_transient;
    }

}

function arma_to_enghlish($text)
{

    $western = [ '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' ];
    $persian = [ '۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹' ];
    $arabic  = [ '٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩' ];
    $text    = str_replace($persian, $western, $text);
    $text    = str_replace($arabic, $western, $text);
    return $text;

}

function sanitize_text_no_item($item)
{
    $new_item = [  ];

    foreach ($item as $value) {
        if (empty($value)) {continue;}
        $new_item[  ] = sanitize_text_field($value);
    }

    return $new_item;

}
