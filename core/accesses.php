<?php

(defined('ABSPATH')) || exit;

add_theme_support('post-thumbnails');

function hide_default_meta_boxes($hidden, $screen)
{
    $hidden[  ] = 'authordiv';
    $hidden[  ] = 'commentsdiv';
    $hidden[  ] = 'postcustom';
    $hidden[  ] = 'commentstatusdiv';
    return $hidden;
}
add_filter('default_hidden_meta_boxes', 'hide_default_meta_boxes', 10, 2);
