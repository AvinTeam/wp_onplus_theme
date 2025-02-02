<?php
(defined('ABSPATH')) || exit;

add_filter('manage_users_columns', 'add_institute_posts_column');
function add_institute_posts_column($columns)
{
    if (isset($columns[ 'email' ])) {
        unset($columns[ 'email' ]);
    }
    if (isset($columns[ 'posts' ])) {
        unset($columns[ 'posts' ]);

    }
    $columns[ 'mobile' ] = 'شماره موبایل';

    return $columns;
}

add_action('manage_users_custom_column', 'show_institute_posts_count', 10, 3);
function show_institute_posts_count($output, $column_name, $user_id)
{

    if ($column_name === 'mobile') {

        $mobile = get_user_meta($user_id, 'mobile', true);

        return $mobile;
    }

    return $output;

}

function custom_user_search($search, $query)
{
    global $wpdb;

    if (! is_admin() || ! $query->query_vars[ 'search' ]) {
        return $search;
    }

    $search_value = trim($query->query_vars[ 'search' ]);

    if (! empty($search_value)) {
        $search = "
        OR EXISTS (
            SELECT * FROM {$wpdb->usermeta}
            WHERE {$wpdb->users}.ID = {$wpdb->usermeta}.user_id
            AND {$wpdb->usermeta}.meta_key = 'mobile'
            AND {$wpdb->usermeta}.meta_value LIKE '%" . esc_sql($search_value) . "%'
        )";
    }

    return $search;
}
add_filter('user_search_columns', 'custom_user_search', 10, 2);

function add_csv_export_button()
{
    if (is_admin() && 'users.php' === $GLOBALS[ 'pagenow' ]) {
        echo '<div class="alignleft actions"><a href="' . esc_url(add_query_arg('action', 'user_csv', get_current_relative_url())) . '" class="button button-primary">خروجی CSV</a></div>';
        echo '<div class="alignleft actions"><a href="' . esc_url(add_query_arg('action', 'user_exel', get_current_relative_url())) . '" class="button button-primary">خروجی EXEL</a></div>';
    }
}
//add_action('manage_users_extra_tablenav', 'add_csv_export_button');
