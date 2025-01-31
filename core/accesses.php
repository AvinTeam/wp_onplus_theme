<?php

(defined('ABSPATH')) || exit;

add_theme_support('post-thumbnails');
add_theme_support('menus'); 


function hide_default_meta_boxes($hidden, $screen)
{
    $hidden[  ] = 'authordiv';
    $hidden[  ] = 'commentsdiv';
    $hidden[  ] = 'postcustom';
    $hidden[  ] = 'commentstatusdiv';
    return $hidden;
}
add_filter('default_hidden_meta_boxes', 'hide_default_meta_boxes', 10, 2);


function custom_theme_setup() {
    register_nav_menus([
        'main-menu' => 'فهرست اصلی',
        'footer-menu' => 'فهرست فوتر',
    ]);
}
add_action('after_setup_theme', 'custom_theme_setup');


class Custom_Nav_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = null) {
        $output .= '<ul class="dropdown-menu">';
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        // بررسی مقدار `classes` و تبدیل آن به آرایه در صورت نیاز
        $classes = isset($item->classes) && is_array($item->classes) ? $item->classes : [];

        $class_names = join(' ', $classes);
        $active_class = in_array('current-menu-item', $classes) ? ' active' : '';
        
        $output .= '<li class="nav-item ms-2 ' . esc_attr($class_names . $active_class) . '">';

        $attributes = ' class="nav-link' . esc_attr($active_class) . '" href="' . esc_url($item->url) . '"';

        $output .= '<a' . $attributes . '>';
        $output .= esc_html($item->title);
        $output .= '</a>';
    }
}
