<?php

(defined('ABSPATH')) || exit;

/**
 * Register a custom post type called "book".
 *
 * @see get_post_type_labels() for label keys.
 */
function op_onplus_init()
{
    $labels = array(
        'name' => 'برنامه',
        'singular_name' => 'برنامه',
        'menu_name' => 'برنامه ها',
        'name_admin_bar' => 'برنامه',
        'add_new' => 'اضافه کردن',
        'add_new_item' => 'اضافه کردن برنامه',
        'new_item' => 'برنامه جدید',
        'edit_item' => 'ویرایش برنامه',
        'view_item' => 'نمایش برنامه',
        'all_items' => 'همه برنامه ها',
        'search_items' => 'جست و جو برنامه',
        'parent_item_colon' => 'برنامه والد: ',
        'not_found' => 'کتابی یافت نشد',
        'not_found_in_trash' => 'کتابی در سطل زباله یافت نشد',
        'featured_image' => 'کاور برنامه',
        'set_featured_image' => 'انتخاب تصویر',
        'remove_featured_image' => 'حذف تصویر',
        'use_featured_image' => 'استفاده به عنوان کاور',
        'archives' => 'دسته بندی برنامه',
        'insert_into_item' => 'در برنامه درج کنید',
        'uploaded_to_this_item' => 'در این برنامه درج کنید',
        'filter_items_list' => 'فیلتر برنامه',
        'items_list_navigation' => 'پیمایش برنامه',
        'items_list' => 'لیست برنامه',
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

    register_post_type('onplus', $args);
}

add_action('init', 'op_onplus_init');
