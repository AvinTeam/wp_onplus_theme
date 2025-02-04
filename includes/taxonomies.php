<?php

(defined('ABSPATH')) || exit;

function mat_taxonomies()
{
    $labels = [
        'name'                  => 'برنامه ها',
        'singular_name'         => 'برنامه ها',
        'search_items'          => 'جست و جو برنامه ها',
        'popular_items'         => 'برنامه ها محبوب',
        'all_items'             => 'برنامه ها',
        'edit_item'             => 'ویرایش برنامه ',
        'update_item'           => 'بروزرسانی برنامه ',
        'add_new_item'          => 'افزودن برنامه ',
        'new_item_name'         => 'نام برنامه جدید',
        'add_or_remove_items'   => 'اضافه کردن یا حذف برنامه ',
        'choose_from_most_used' => 'از میان برنامه ها پرکاربرد انتخاب کنید',
        'not_found'             => 'برنامه ی را یافت نشد',
        'menu_name'             => 'برنامه ها',
     ];

    $args = [
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'public'            => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => [ 'slug' => 'on_category', 'with_front' => false ],
     ];

    register_taxonomy('on_category', [ 'episode', 'episode_cat' ], $args);

    $subject_labels = [
        'name'                  => 'برچسب ها',
        'singular_name'         => 'برچسب ها',
        'search_items'          => 'جست و جو برچسب ها',
        'popular_items'         => 'برچسب ها محبوب',
        'all_items'             => 'برچسب ها',
        'edit_item'             => 'ویرایش برچسب',
        'update_item'           => 'بروزرسانی برچسب',
        'add_new_item'          => 'افزودن برچسب',
        'new_item_name'         => 'نام برچسب جدید',
        'add_or_remove_items'   => 'اضافه کردن یا حذف برچسب',
        'choose_from_most_used' => 'از میان برچسب ها پرکاربرد انتخاب کنید',
        'not_found'             => 'برچسبی را یافت نشد',
        'menu_name'             => 'برچسب ها',
     ];

    $subject = [
        'hierarchical'      => false,
        'labels'            => $subject_labels,
        'show_ui'           => true,
        'show_in_rest'      => false,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => [ 'slug' => 'on_tag' ],
     ];

    register_taxonomy('on_tag', [ 'episode', 'episode_cat' ], $subject);

    $agents_labels = [
        'name'                  => 'عوامل',
        'singular_name'         => 'عوامل',
        'search_items'          => 'جست و جو عوامل',
        'popular_items'         => 'عوامل محبوب',
        'all_items'             => 'عوامل',
        'edit_item'             => 'ویرایش عامل',
        'update_item'           => 'بروزرسانی عامل',
        'add_new_item'          => 'افزودن عامل',
        'new_item_name'         => 'نام عامل جدید',
        'add_or_remove_items'   => 'اضافه کردن یا حذف عامل',
        'choose_from_most_used' => 'از میان عوامل پرکاربرد انتخاب کنید',
        'not_found'             => 'عاملی را یافت نشد',
        'menu_name'             => 'عوامل',
     ];
//style="direction: ltr;"
    $agents = [
        'hierarchical'       => false,
        'labels'             => $agents_labels,
        'show_ui'            => true,
        'show_in_rest'       => false,
        'show_admin_column'  => true,
        'query_var'          => true,
        'public'             => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => false,
        'show_tagcloud'      => false,
        'show_in_quick_edit' => false,
        'meta_box_cb'        => false,
     ];

    register_taxonomy('on_agents', [ 'episode', 'episode_cat' ], $agents);

    $position_labels = [
        'name'                  => 'سمت ها',
        'singular_name'         => 'سمت ها',
        'search_items'          => 'جست و جو سمت ها',
        'popular_items'         => 'سمت ها محبوب',
        'all_items'             => 'سمت ها',
        'edit_item'             => 'ویرایش سمت',
        'update_item'           => 'بروزرسانی سمت',
        'add_new_item'          => 'افزودن سمت',
        'new_item_name'         => 'نام سمت جدید',
        'add_or_remove_items'   => 'اضافه کردن یا حذف سمت',
        'choose_from_most_used' => 'از میان سمت ها پرکاربرد انتخاب کنید',
        'not_found'             => 'سمتی را یافت نشد',
        'menu_name'             => 'سمت ها',
     ];

    $position = [
        'hierarchical'       => false,
        'labels'             => $position_labels,
        'show_ui'            => true,
        'show_in_rest'       => false,
        'show_admin_column'  => true,
        'query_var'          => true,
        'public'             => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => false,
        'show_tagcloud'      => false,
        'show_in_quick_edit' => false,
        'meta_box_cb'        => false,
     ];

    register_taxonomy('on_position', [ 'episode', 'episode_cat' ], $position);

}

add_action('init', 'mat_taxonomies');
