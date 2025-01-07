<?php

(defined('ABSPATH')) || exit;

function mat_taxonomies()
{
    $labels = array(
        'name' => 'دسته ها',
        'singular_name' => 'دسته ها',
        'search_items' => 'جست و جو دسته ها',
        'popular_items' => 'دسته ها محبوب',
        'all_items' => 'دسته ها',
        'edit_item' => 'ویرایش دسته ',
        'update_item' => 'بروزرسانی دسته ',
        'add_new_item' => 'افزودن دسته ',
        'new_item_name' => 'نام دسته جدید',
        'add_or_remove_items' => 'اضافه کردن یا حذف دسته ',
        'choose_from_most_used' => 'از میان دسته ها پرکاربرد انتخاب کنید',
        'not_found' => 'دسته ی را یافت نشد',
        'menu_name' => 'دسته ها',
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'public' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'on_category'),
    );

    register_taxonomy('on_category', 'onplus', $args);

    $subject_labels = array(
        'name' => 'برچسب ها',
        'singular_name' => 'برچسب ها',
        'search_items' => 'جست و جو برچسب ها',
        'popular_items' => 'برچسب ها محبوب',
        'all_items' => 'برچسب ها',
        'edit_item' => 'ویرایش برچسب',
        'update_item' => 'بروزرسانی برچسب',
        'add_new_item' => 'افزودن برچسب',
        'new_item_name' => 'نام برچسب جدید',
        'add_or_remove_items' => 'اضافه کردن یا حذف برچسب',
        'choose_from_most_used' => 'از میان برچسب ها پرکاربرد انتخاب کنید',
        'not_found' => 'برچسبی را یافت نشد',
        'menu_name' => 'برچسب ها',
    );

    $subject = array(
        'hierarchical' => false,
        'labels' => $subject_labels,
        'show_ui' => true,
        'show_in_rest' => false,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'on_tag'),
    );

    register_taxonomy('on_tag', 'onplus', $subject);



    $agents_labels = array(
        'name' => 'عوامل',
        'singular_name' => 'عوامل',
        'search_items' => 'جست و جو عوامل',
        'popular_items' => 'عوامل محبوب',
        'all_items' => 'عوامل',
        'edit_item' => 'ویرایش عامل',
        'update_item' => 'بروزرسانی عامل',
        'add_new_item' => 'افزودن عامل',
        'new_item_name' => 'نام عامل جدید',
        'add_or_remove_items' => 'اضافه کردن یا حذف عامل',
        'choose_from_most_used' => 'از میان عوامل پرکاربرد انتخاب کنید',
        'not_found' => 'عاملی را یافت نشد',
        'menu_name' => 'عوامل',
    );
//style="direction: ltr;"
    $agents = array(
        'hierarchical' => false,
        'labels' => $agents_labels,
        'show_ui' => true,
        'show_in_rest' => false,
        'show_admin_column' => true,
        'query_var' => true,
        'public' => true,
        'show_in_menu' => true, 
        'show_in_nav_menus' => false,
        'show_tagcloud' => false, 
        'show_in_quick_edit' => false, 
        'meta_box_cb' => false,
    );

    register_taxonomy('on_agents', 'onplus', $agents);



    $position_labels = array(
        'name' => 'سمت ها',
        'singular_name' => 'سمت ها',
        'search_items' => 'جست و جو سمت ها',
        'popular_items' => 'سمت ها محبوب',
        'all_items' => 'سمت ها',
        'edit_item' => 'ویرایش سمت',
        'update_item' => 'بروزرسانی سمت',
        'add_new_item' => 'افزودن سمت',
        'new_item_name' => 'نام سمت جدید',
        'add_or_remove_items' => 'اضافه کردن یا حذف سمت',
        'choose_from_most_used' => 'از میان سمت ها پرکاربرد انتخاب کنید',
        'not_found' => 'سمتی را یافت نشد',
        'menu_name' => 'سمت ها',
    );

    $position = array(
        'hierarchical' => false,
        'labels' => $position_labels,
        'show_ui' => true,
        'show_in_rest' => false,
        'show_admin_column' => true,
        'query_var' => true,
        'public' => true,
        'show_in_menu' => true, 
        'show_in_nav_menus' => false,
        'show_tagcloud' => false, 
        'show_in_quick_edit' => false, 
        'meta_box_cb' => false, 
    );

    register_taxonomy('on_position', 'onplus', $position);





}

add_action('init', 'mat_taxonomies');
