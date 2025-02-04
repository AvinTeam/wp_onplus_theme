<?php
(defined('ABSPATH')) || exit;

add_action('wp_dashboard_setup', 'arma_dashboard_widget');
function arma_dashboard_widget()
{

    wp_add_dashboard_widget(
        'arma_visited_dashboard',
        'بازدید سایت',
        'arma_visited_dashboard',
        null,
        null,
        'normal',
        'high'
    );

    function arma_visited_dashboard()
    {

        echo '<canvas id="viewsChart"></canvas>';
    }

}
