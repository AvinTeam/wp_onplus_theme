<?php

add_action('init', 'arma_panel_rewrite');
function arma_panel_rewrite()
{
    arma_cookie();
    arma_cookie_visiter();

    add_rewrite_rule(
        ARMA_PANEL_BASE . '/([^/]+)/?',
        'index.php?arma=$matches[1]',
        'top'
    );

    add_rewrite_rule(
        ARMA_PANEL_BASE . '/?',
        'index.php?arma=dashboard',
        'top'
    );

    add_rewrite_rule(
        'oncat/?',
        'index.php?oncat=cat',
        'top'
    );

    flush_rewrite_rules();

}

add_filter('query_vars', 'arma_query_vars');

/**
 * Filters the query variables allowed before processing.
 *
 * @param string[] $public_query_vars The array of allowed query variable names.
 * @return string[] The array of allowed query variable names.
 */
function arma_query_vars($public_query_vars)
{

    $public_query_vars[  ] = 'arma';
    $public_query_vars[  ] = 'oncat';

    return $public_query_vars;
}

add_filter('template_include', 'arma_template_include');

/**
 * Filters the path of the current template before including it.
 *
 * @param string $template The path of the template to include.
 * @return string The path of the template to include.
 */
function arma_template_include($template)
{

    $arma = get_query_var('arma');
    if ($arma) {

        $path = arma_template_path($arma);

        if ($path) {return $path;}

    }

    $oncat = get_query_var('oncat');

    if ($oncat) {

        return ARMA_VIEWS . 'layout/on_category.php';

    }

    return $template;
}

function restrict_admin_access()
{
    if (! is_user_logged_in()) {
        return;
    }

    $user             = wp_get_current_user();
    $restricted_roles = [ 'subscriber', 'responsible' ];

    if (array_intersect($restricted_roles, $user->roles) && ! defined('DOING_AJAX')) {
        wp_redirect(home_url());
        exit;
    }
}
add_action('admin_init', 'restrict_admin_access');

add_filter('show_admin_bar', 'disable_admin_bar_for_specific_roles');

function disable_admin_bar_for_specific_roles($show)
{
    if (is_user_logged_in()) {
        $user             = wp_get_current_user();
        $restricted_roles = [ 'subscriber', 'responsible' ];

        if (array_intersect($restricted_roles, $user->roles)) {
            return false;
        }
    }

    return $show;
}

function add_arma_admin_bar_menu($wp_admin_bar)
{
    if (! current_user_can('manage_options')) {
        return;
    }

    $wp_admin_bar->add_node([
        'id'    => 'arma-settings',
        'title' => 'تنظیمات کامامدیا',
        'href'  => admin_url('admin.php?page=arma'),
     ]);

    $wp_admin_bar->add_node([
        'id'     => 'arma-settings-general',
        'title'  => 'تنظیمات',
        'href'   => admin_url('admin.php?page=arma_setting'),
        'parent' => 'arma-settings',
     ]);

    $wp_admin_bar->add_node([
        'id'     => 'arma-sms_panels',
        'title'  => 'تنظیمات پنل پیامک',
        'href'   => admin_url('admin.php?page=sms_panels'),
        'parent' => 'arma-settings',
     ]);

    $wp_admin_bar->add_node([
        'id'     => 'arma-settings-home_page',
        'title'  => 'تنظیمات صفحه نخست',
        'href'   => admin_url('admin.php?page=arma_home_page'),
        'parent' => 'arma-settings',
     ]);
}
add_action('admin_bar_menu', 'add_arma_admin_bar_menu', 100);
