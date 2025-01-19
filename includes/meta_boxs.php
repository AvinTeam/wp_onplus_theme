<?php
(defined('ABSPATH')) || exit;

add_action('add_meta_boxes', 'op_meta_box');

function op_meta_box()
{

    $op_page = (isset($_GET[ 'cat' ])) ? 'قسمت' : 'برش';
    add_meta_box(
        'op_post_information',
        "اطلاعات " . $op_page,
        'op_post_information_metabox_callback',
        [ 'episode', 'episode_cat' ],
        'normal',
        'high'
    );

    function op_post_information_metabox_callback($post)
    {
        $op_brief = get_post_meta($post->ID, '_op_brief', true);

        $op_video = get_post_meta($post->ID, '_op_video', true);

        include_once OP_VIEWS . 'metabox/post_information.php';

    }
    add_meta_box(
        'op_colleagues',
        "همکاران ",
        'op_colleagues_metabox_callback',
        [ 'episode' ],
        'normal',
        'high'
    );

    function op_colleagues_metabox_callback($post)
    {
        
        $op_brief = get_post_meta($post->ID, '_op_brief', true);

        $op_video = get_post_meta($post->ID, '_op_video', true);



        include_once OP_VIEWS . 'metabox/colleagues.php';

    }

    add_meta_box(
        'op_statistics',
        "آمار کلی",
        'op_statistics_metabox_callback',
        [ 'episode', 'episode_cat' ],
        'side',
        'high'
    );

    function op_statistics_metabox_callback($post)
    {

        $op_video = get_post_meta($post->ID, '_op_like', true);

        include_once OP_VIEWS . 'metabox/statistics.php';

    }

    add_meta_box(
        'op_episode',
        "انتخاب اپیزود",
        'op_episode_metabox_callback',
        [ 'episode_cat' ],
        'side',
        'core'
    );

    function op_episode_metabox_callback($post)
    {

        $op_video = get_post_meta($post->ID, '_op_like', true);

        echo 'saalm';
        //include_once OP_VIEWS . 'metabox/statistics.php';

    }

}

add_action('save_post', 'op_save_bax', 10, 3);

function op_save_bax($post_id, $post, $updata)
{
    if (isset($_POST[ 'op_video' ])) {

        update_post_meta($post_id, '_op_video', sanitize_url($_POST[ 'op_video' ]));

    }
}
