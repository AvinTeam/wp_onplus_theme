<?php

(defined('ABSPATH')) || exit;

/**
 * Register a custom post type called "book".
 *
 * @see get_post_type_labels() for label keys.
 */
function op_episode_init()
{
    $labels = array(
        'name' => 'اپیزود',
        'singular_name' => 'episode',
        'menu_name' => 'اپیزود ها',
        'name_admin_bar' => 'اپیزود',
        'add_new' => 'اضافه کردن',
        'add_new_item' => 'اضافه کردن اپیزود',
        'new_item' => 'اپیزود جدید',
        'edit_item' => 'ویرایش اپیزود',
        'view_item' => 'نمایش اپیزود',
        'all_items' => 'همه اپیزود ها',
        'search_items' => 'جست و جو اپیزود',
        'parent_item_colon' => 'اپیزود والد: ',
        'not_found' => 'اپیزود یافت نشد',
        'not_found_in_trash' => 'اپیزود در سطل زباله یافت نشد',
        'featured_image' => 'کاور اپیزود',
        'set_featured_image' => 'انتخاب تصویر',
        'remove_featured_image' => 'حذف تصویر',
        'use_featured_image' => 'استفاده به عنوان کاور',
        'archives' => 'دسته بندی اپیزود',
        'insert_into_item' => 'در اپیزود درج کنید',
        'uploaded_to_this_item' => 'در این اپیزود درج کنید',
        'filter_items_list' => 'فیلتر اپیزود',
        'items_list_navigation' => 'پیمایش اپیزود',
        'items_list' => 'لیست اپیزود',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'hierarchical' => false,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,        
        'menu_position' => null,
        'query_var' => true,
        'menu_icon' => 'dashicons-format-video',
        'capability_type' => 'onplus',
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'comments','custom-fields'),
        'rewrite' => array('slug' => 'on'),
        'has_archive' => true,
    );

    register_post_type('episode', $args);


    $labels = array(
        'name' => 'برش',
        'singular_name' => 'episode_cat',
        'menu_name' => 'برش ها',
        'name_admin_bar' => 'برش',
        'add_new' => 'اضافه کردن',
        'add_new_item' => 'اضافه کردن برش',
        'new_item' => 'برش جدید',
        'edit_item' => 'ویرایش برش',
        'view_item' => 'نمایش برش',
        'all_items' => 'همه برش ها',
        'search_items' => 'جست و جو برش',
        'parent_item_colon' => 'برش والد: ',
        'not_found' => 'برش یافت نشد',
        'not_found_in_trash' => 'برش در سطل زباله یافت نشد',
        'featured_image' => 'کاور برش',
        'set_featured_image' => 'انتخاب تصویر',
        'remove_featured_image' => 'حذف تصویر',
        'use_featured_image' => 'استفاده به عنوان کاور',
        'archives' => 'دسته بندی برش',
        'insert_into_item' => 'در برش درج کنید',
        'uploaded_to_this_item' => 'در این برش درج کنید',
        'filter_items_list' => 'فیلتر برش',
        'items_list_navigation' => 'پیمایش برش',
        'items_list' => 'لیست برش',
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'hierarchical' => false,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,        
        'menu_position' => null,
        'query_var' => true,
        'menu_icon' => 'dashicons-format-video',
        'capability_type' => 'onplus',
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'comments','custom-fields'),
        'rewrite' => array('slug' => 'on'),
        'has_archive' => true,
    );


    
    register_post_type('episode_cat', $args);

}

add_action('init', 'op_episode_init');
