<?php

(defined('ABSPATH')) || exit;

add_action('admin_enqueue_scripts', 'arma_admin_script');

function arma_admin_script()
{

    wp_register_style(
        'select2',
        ARMA_VENDOR . 'select2/select2.min.css',
        [  ],
        '4.1.0-rc.0'
    );
    wp_register_script(
        'select2',
        ARMA_VENDOR . 'select2/select2.min.js',
        [  ],
        '4.1.0-rc.0',
        true
    );

    wp_register_style(
        'jalalidatepicker',
        ARMA_VENDOR . 'jalalidatepicker/jalalidatepicker.min.css',
        [  ],
        '0.9.6'
    );
    wp_register_script(
        'jalalidatepicker',
        ARMA_VENDOR . 'jalalidatepicker/jalalidatepicker.min.js',
        [  ],
        '0.9.6',
        true
    );

    wp_register_script(
        'sortable',
        ARMA_JS . 'Sortable.min.js',
        [  ],
        '1.15.0',

    );

    wp_register_script(
        'chartjs',
        ARMA_VENDOR . 'chartjs/chart.js',
        [  ],
        '4.4.7',
    );

    wp_enqueue_style(
        'arma_admin',
        ARMA_CSS . 'admin.css',
        [ 'select2', 'jalalidatepicker' ],
        ARMA_VERSION
    );

    wp_enqueue_media();

    wp_enqueue_script(
        'arma_admin',
        ARMA_JS . 'admin.js',
        [ 'jquery', 'select2', 'jalalidatepicker', 'sortable', 'chartjs' ],
        ARMA_VERSION,
        true
    );

    $agents_term = [ [
        'id'   => 0,
        'text' => 'انتخاب همکار',
     ] ];

    $agents_terms = get_terms([
        'taxonomy'   => 'on_agents',
        'hide_empty' => false,
     ]);

    if (! empty($agents_terms) && ! is_wp_error($agents_terms)) {

        foreach ($agents_terms as $term) {

            $agents_term[  ] = [
                'id'   => $term->term_id,
                'text' => esc_html($term->name),
             ];
        }

    }

    $position_term = [ [
        'id'   => 0,
        'text' => 'انتخاب سمت',
     ] ];

    $position_terms = get_terms([
        'taxonomy'   => 'on_position',
        'hide_empty' => false,
     ]);

    if (! empty($position_terms) && ! is_wp_error($position_terms)) {

        foreach ($position_terms as $term) {

            $position_term[  ] = [
                'id'   => $term->term_id,
                'text' => esc_html($term->name),
             ];
        }

    }

    wp_localize_script(
        'arma_admin',
        'arma_js',
        [
            'ajaxurl'       => admin_url('admin-ajax.php'),
            'nonce'         => wp_create_nonce('ajax-nonce' . arma_cookie()),
            'agents_term'   => $agents_term,
            'position_term' => $position_term,
            'option'        => arma_start_working(),
            'visited'        => arma_show_visited(),

         ]
    );

}

add_action('wp_enqueue_scripts', 'arma_style');

function arma_style()
{

    wp_register_style(
        'bootstrap',
        ARMA_VENDOR . 'bootstrap/bootstrap.min.css',
        [  ],
        '5.3.3'
    );
    wp_register_style(
        'bootstrap.rtl',
        ARMA_VENDOR . 'bootstrap/bootstrap.rtl.min.css',
        [ 'bootstrap' ],
        '5.3.3'
    );

    wp_register_style(
        'bootstrap-icons',
        ARMA_VENDOR . 'bootstrap/bootstrap-icons.css',
        [ 'bootstrap' ],
        '1.11.3',
    );

    wp_register_script(
        'bootstrap',
        ARMA_VENDOR . 'bootstrap/bootstrap.min.js',
        [  ],
        '5.3.3',
        true
    );

    wp_register_style(
        'videojs',
        ARMA_VENDOR . 'videojs/video-js.min.css',
        [  ],
        '8.7.0',
    );

    wp_register_script(
        'videojs',
        ARMA_VENDOR . 'videojs/video.min.js',
        [  ],
        '8.7.0',

    );
    wp_register_style(
        'swiper',
        ARMA_VENDOR . 'swiper/swiper-bundle.min.css',
        [  ],
        '11.2.2',
    );

    wp_register_script(
        'swiper',
        ARMA_VENDOR . 'swiper/swiper-bundle.min.js',
        [  ],
        '11.2.2',

    );

    wp_register_style(
        'jalalidatepicker',
        ARMA_VENDOR . 'jalalidatepicker/jalalidatepicker.min.css',
        [  ],
        '0.9.6'
    );
    wp_register_script(
        'jalalidatepicker',
        ARMA_VENDOR . 'jalalidatepicker/jalalidatepicker.min.js',
        [  ],
        '0.9.6',
        true
    );

    wp_enqueue_style(
        'arma_style',
        ARMA_CSS . 'public.css',
        [ 'bootstrap.rtl', 'bootstrap-icons', 'videojs', 'swiper', 'jalalidatepicker' ],
        ARMA_VERSION
    );

    wp_enqueue_script(
        'arma_js',
        ARMA_JS . 'public.js',
        [ 'jquery', 'bootstrap', 'videojs', 'swiper', 'jalalidatepicker' ],
        ARMA_VERSION,
        true
    );

    wp_localize_script(
        'arma_js',
        'arma_js',
        [
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('ajax-nonce' . arma_cookie()),
            'option'  => arma_start_working(),

         ]
    );

}
