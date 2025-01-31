<?php
add_action('wp_ajax_ajax_select_colleagues', 'ajax_select_colleagues');

function ajax_select_colleagues()
{

    $terms = get_terms([
        'taxonomy'   => 'on_agents',
        'hide_empty' => false,                                   // نمایش ترم‌های خالی
        'search'     => sanitize_text_field($_POST[ 'search' ]), // متن جستجو
     ]);

    // بررسی وجود ترم‌ها
    if (! empty($terms) && ! is_wp_error($terms)) {

        $search_term = [  ];
        foreach ($terms as $term) {

            $search_term[  ] = [
                'id'    => $term->term_id,
                'title' => esc_html($term->name),
             ];
        }

        wp_send_json_success($search_term);

    } else {

        wp_send_json_error([ [
            'id'    => 0,
            'title' => 'نتیجه‌ای یافت نشد.',
         ] ]);

    }

    // $nasrdb = new NasrDB();

    // if (intval($_POST[ 'dataId' ]) && in_array($_POST[ 'dataType' ], [ 'successful', 'failed', 'delete' ])) {

    //     if (sanitize_text_field($_POST[ 'dataType' ]) == 'delete') {

    //         $delete_row = $nasrdb->delete(intval($_POST[ 'dataId' ]));
    //         if ($delete_row) {

    //             wp_send_json_success($delete_row);

    //         } else {
    //             wp_send_json_error('حذف انجام نشد', 403);

    //         }

    //     } else {
    //         $data = [ 'status' => sanitize_text_field($_POST[ 'dataType' ]) ];
    //         $where = [ 'ID' => intval($_POST[ 'dataId' ]) ];
    //         $format = [ '%s' ];
    //         $where_format = [ '%d' ];

    //         $rest_update = $nasrdb->update($data, $where, $format, $where_format);
    //         if ($rest_update) {
    //             wp_send_json_success($rest_update);

    //         } else {
    //             wp_send_json_error('بروزرسانی انجام نشد', 403);

    //         }
    //     }

    // } else {
    //     wp_send_json_error('خطا در ارسال اطلاعات', 403);
    // }

}

add_action('wp_ajax_ajax_select_position', 'ajax_select_position');

function ajax_select_position()
{

    $terms = get_terms([
        'taxonomy'   => 'on_position',
        'hide_empty' => false,                                   // نمایش ترم‌های خالی
        'search'     => sanitize_text_field($_POST[ 'search' ]), // متن جستجو
     ]);

    // بررسی وجود ترم‌ها
    if (! empty($terms) && ! is_wp_error($terms)) {

        $search_term = [  ];
        foreach ($terms as $term) {

            $search_term[  ] = [
                'id'    => $term->term_id,
                'title' => esc_html($term->name),
             ];
        }

        wp_send_json_success($search_term);

    } else {

        wp_send_json_error([ [
            'id'    => 0,
            'title' => 'نتیجه‌ای یافت نشد.',
         ] ]);

    }

    // $nasrdb = new NasrDB();

    // if (intval($_POST[ 'dataId' ]) && in_array($_POST[ 'dataType' ], [ 'successful', 'failed', 'delete' ])) {

    //     if (sanitize_text_field($_POST[ 'dataType' ]) == 'delete') {

    //         $delete_row = $nasrdb->delete(intval($_POST[ 'dataId' ]));
    //         if ($delete_row) {

    //             wp_send_json_success($delete_row);

    //         } else {
    //             wp_send_json_error('حذف انجام نشد', 403);

    //         }

    //     } else {
    //         $data = [ 'status' => sanitize_text_field($_POST[ 'dataType' ]) ];
    //         $where = [ 'ID' => intval($_POST[ 'dataId' ]) ];
    //         $format = [ '%s' ];
    //         $where_format = [ '%d' ];

    //         $rest_update = $nasrdb->update($data, $where, $format, $where_format);
    //         if ($rest_update) {
    //             wp_send_json_success($rest_update);

    //         } else {
    //             wp_send_json_error('بروزرسانی انجام نشد', 403);

    //         }
    //     }

    // } else {
    //     wp_send_json_error('خطا در ارسال اطلاعات', 403);
    // }

}

add_action('wp_ajax_arma_send_category', 'arma_send_category');

function arma_send_category()
{

    if (! wp_verify_nonce($_POST[ 'nonce' ], 'ajax-nonce' . arma_cookie())) {wp_send_json_error('خطا');}

    $all_option = '<option value="0">انتخاب اپیزود</option>';

    $args = [
        'post_type' => 'episode',
        'tax_query' => [
            [
                'taxonomy' => 'on_category',
                'field'    => 'term_id',
                'terms'    => absint($_POST[ 'cat_id' ]),
             ],
         ],
     ];

    $posts = get_posts($args);

    if (! empty($posts)) {
        foreach ($posts as $post) {
            setup_postdata($post);
            $all_option .= '<option value="' . $post->ID . '">' . get_the_title($post) . '</option>';
        }
        wp_send_json_success($all_option);

        wp_reset_postdata();
    } else {
        wp_send_json_error('هیچ پستی پیدا نشد.');
    }
    wp_send_json_error('هیچ پستی پیدا نشد.');

}

add_action('wp_ajax_arma_cat_tag', 'arma_cat_tag');

function arma_cat_tag()
{

    if (! wp_verify_nonce($_POST[ 'nonce' ], 'ajax-nonce' . arma_cookie())) {wp_send_json_error('خطا');}
    $title = "";

    if ($_POST[ 'type' ] == "on_category") {$title = "برنامه";} elseif ($_POST[ 'type' ] == "on_tag") {$title = "برچسب";}

    $all_option = '<option value="0">انتخاب ' . $title . '</option>';

    $terms = get_terms([
        'taxonomy'   => sanitize_text_field($_POST[ 'type' ]), // نام تکسونومی
        'hide_empty' => false,                                 // نمایش تمام دسته‌ها، حتی اگر بدون نوشته باشند
     ]);
    if (! empty($terms)) {
        foreach ($terms as $term) {

            if ($term->term_id == $_POST[ 'selected' ]) {$selected = 'selected';} else { $selected = '';}
            $all_option .= '<option ' . $selected . '  value="' . $term->term_id . '">' . esc_html($term->name) . '</option>';
        }
        wp_send_json_success($all_option);

    } else {
        wp_send_json_error('هیچ پستی پیدا نشد.');
    }
    wp_send_json_error('هیچ پستی پیدا نشد.');

}

// add_action('wp_ajax_nasr_sent_sms', 'nasr_sent_sms');
// add_action('wp_ajax_nopriv_nasr_sent_sms', 'nasr_sent_sms');

// function nasr_sent_sms()
// {

//     if (wp_verify_nonce($_POST[ 'wpnonce' ], 'nasr_login_page' . nasr_cookie())) {
//         if ($_POST[ 'mobileNumber' ] !== "") {
//             $mobile = sanitize_text_field($_POST[ 'mobileNumber' ]);

//             $nasrdb = new NasrDB();
//             $mobile_num = $nasrdb->num($mobile, 'all');

//             if (!absint($mobile_num)) {

//                 $nasr_send_sms = nasr_send_sms($mobile, 'otp');

//                 if ($nasr_send_sms[ 'code' ] == 1) {
//                     wp_send_json_success($nasr_send_sms[ 'massage' ]);
//                 }
//                 wp_send_json_error($nasr_send_sms[ 'massage' ], 403);

//             } else {
//                 wp_send_json_error('شماره شما قبلا ثبت شده است', 403);

//             }

//         } else {
//             wp_send_json_error('شماره شما به درستی وارد نشده است', 403);

//         }
//     } else {
//         wp_send_json_error('لطفا یکبار صفحه را بروزرسانی کنید', 403);

//     }

// }

// add_action('wp_ajax_nasr_sent_verify', 'nasr_sent_verify');
// add_action('wp_ajax_nopriv_nasr_sent_verify', 'nasr_sent_verify');

// function nasr_sent_verify()
// {
//     $mobile = sanitize_phone($_POST[ 'mobileNumber' ]);

//     if (wp_verify_nonce($_POST[ 'wpnonce' ], 'nasr_login_page' . nasr_cookie())) {

//         if ($_POST[ 'mobileNumber' ] !== "" && $_POST[ 'otpNumber' ] !== "") {

//             $otp = sanitize_text_field($_POST[ 'otpNumber' ]);

//             // دریافت کد ذخیره‌شده
//             $saved_otp = get_transient('otp_' . $mobile);

//             if (!$saved_otp || $saved_otp !== $otp) {
//                 set_transient('nasr_transient', '<div class="alert alert-danger" role="alert">کد تأیید اشتباه یا منقضی شده است. </div>');
//             } else {
//                 delete_transient('otp_' . $mobile);
//                 wp_send_json_success('');
//             }
//         }
//     } else {
//         delete_transient('otp_' . $mobile);
//         set_transient('nasr_transient', '<div class="alert alert-danger" role="alert">لطفا یکبار صفحه را بروزرسانی کنید. </div>');

//     }
//     wp_send_json_error('لطفا دوباره تلاش کنید', 403);
// }

// add_action('wp_ajax_nasr_get_count', 'nasr_get_count');
// add_action('wp_ajax_nopriv_nasr_get_count', 'nasr_get_count');

// function nasr_get_count()
// {
//     $nasr_option = get_option('nasr_option');
//     $nasrdb = new NasrDB();
//     $num = $nasrdb->num('', 'all');
//     $num += $nasr_option[ 'start_signature' ];

//     if ($num > intval($_POST[ 'nowCount' ])) {
//         wp_send_json_success($num);

//     } else {
//         wp_send_json_error(intval($_POST[ 'nowCount' ]));
//     }

// }

// add_action('wp_ajax_nasr_update_row', 'nasr_update_row');

// function nasr_update_row()
// {
//     $nasrdb = new NasrDB();

//     if (intval($_POST[ 'dataId' ]) && in_array($_POST[ 'dataType' ], [ 'successful', 'failed', 'delete' ])) {

//         if (sanitize_text_field($_POST[ 'dataType' ]) == 'delete') {

//             $delete_row = $nasrdb->delete(intval($_POST[ 'dataId' ]));
//             if ($delete_row) {

//                 wp_send_json_success($delete_row);

//             } else {
//                 wp_send_json_error('حذف انجام نشد', 403);

//             }

//         } else {
//             $data = [ 'status' => sanitize_text_field($_POST[ 'dataType' ]) ];
//             $where = [ 'ID' => intval($_POST[ 'dataId' ]) ];
//             $format = [ '%s' ];
//             $where_format = [ '%d' ];

//             $rest_update = $nasrdb->update($data, $where, $format, $where_format);
//             if ($rest_update) {
//                 wp_send_json_success($rest_update);

//             } else {
//                 wp_send_json_error('بروزرسانی انجام نشد', 403);

//             }
//         }

//     } else {
//         wp_send_json_error('خطا در ارسال اطلاعات', 403);
//     }

// }

// add_action('wp_ajax_nast_loadSignature', 'nast_loadSignature');
// add_action('wp_ajax_nopriv_nast_loadSignature', 'nast_loadSignature');

// function nast_loadSignature()
// {

//     $nasrdb = new NasrDB();

//     $nasr_option = get_option('nasr_option');

//     $par_page = $nasr_option[ 'show_signature' ];
//     $offset = $par_page * (absint($_POST[ 'thisPage' ]) - 1);

//     $status = 'successful';

//     $all_results = $nasrdb->select($par_page, $offset, $status, $_POST[ 'date' ]);

//     $num = $nasrdb->num('', $status);

//     $end = (($offset + $par_page >= $num)) ? 'end' : '';

//     wp_send_json_success([
//         'results' => $all_results,
//         'end' => $end,

//      ]);
// }
