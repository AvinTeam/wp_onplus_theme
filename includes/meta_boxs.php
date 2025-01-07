<?php
(defined('ABSPATH')) || exit;

add_action('add_meta_boxes', 'op_meta_box');

function op_meta_box()
{
    add_meta_box(
        'op_video',
        "لینک ویدئو",
        'op_video_metabox_callback',
        'onplus',
        'normal',
        'high'
    );

    function op_video_metabox_callback($post)
    {

        $op_video = get_post_meta($post->ID, '_op_video', true);

        include_once OP_VIEWS . 'metabox/video.php';

    }


    
    add_meta_box(
        'op_like',
        "لیست لایک کنندگان",
        'op_like_metabox_callback',
        'onplus',
        'normal',
        'high'
    );

    function op_like_metabox_callback($post)
    {

        $op_video = get_post_meta($post->ID, '_op_like', true);

        include_once OP_VIEWS . 'metabox/like.php';

    }

    
    add_meta_box(
        'op_bookmark',
        "لیست ذخیره کنندگان",
        'op_bookmark_metabox_callback',
        'onplus',
        'normal',
        'high'
    );

    function op_bookmark_metabox_callback($post)
    {

        $op_video = get_post_meta($post->ID, '_op_like', true);

        include_once OP_VIEWS . 'metabox/bookmark.php';

    }



}

add_action('save_post', 'op_save_bax', 10, 3);

function op_save_bax($post_id, $post, $updata)
{
    if (isset($_POST[ 'op_video' ])) {

        update_post_meta($post_id, '_op_video', sanitize_url($_POST[ 'op_video' ]));

    }
}