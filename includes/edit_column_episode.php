<?php
(defined('ABSPATH')) || exit;

function add_episode_columns($columns)
{

    if (isset($columns[ 'taxonomy-on_agents' ])) {
        unset($columns[ 'taxonomy-on_agents' ]);
    }
    if (isset($columns[ 'taxonomy-on_position' ])) {
        unset($columns[ 'taxonomy-on_position' ]);
    }

    return $columns;
}
add_filter('manage_episode_posts_columns', 'add_episode_columns');
add_filter('manage_episode_cat_posts_columns', 'add_episode_columns');
