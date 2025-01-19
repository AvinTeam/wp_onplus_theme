<?php

(defined('ABSPATH')) || exit;

add_action('admin_enqueue_scripts', 'op_admin_script');

function op_admin_script()
{

    wp_register_style(
        'select2',
        OP_VENDOR . 'select2/select2.min.css',
        [  ],
        '4.1.0-rc.0'
    );
    wp_register_script(
        'select2',
        OP_VENDOR . 'select2/select2.min.js',
        [  ],
        '4.1.0-rc.0',
        true
    );

    wp_register_style(
        'jalalidatepicker',
        OP_VENDOR . 'jalalidatepicker/jalalidatepicker.min.css',
        [  ],
        '0.9.6'
    );
    wp_register_script(
        'jalalidatepicker',
        OP_VENDOR . 'jalalidatepicker/jalalidatepicker.min.js',
        [  ],
        '0.9.6',
        true
    );

    wp_enqueue_style(
        'op_admin',
        OP_CSS . 'admin.css',
        [ 'select2', 'jalalidatepicker' ],
        OP_VERSION
    );

    wp_enqueue_media();

    wp_enqueue_script(
        'op_admin',
        OP_JS . 'admin.js',
        [ 'jquery', 'select2', 'jalalidatepicker' ],
        OP_VERSION,
        true
    );

    $agents_terms = get_terms([
        'taxonomy'   => 'on_agents',
        'hide_empty' => false,
     ]);

    if (! empty($agents_terms) && ! is_wp_error($agents_terms)) {

        $agents_term = [ [
            'id'    => 0,
            'text' => 'انتخاب همکار',
         ] ];
        foreach ($agents_terms as $term) {

            $agents_term[  ] = [
                'id'    => $term->term_id,
                'text' => esc_html($term->name),
             ];
        }

    }

    $position_terms = get_terms([
        'taxonomy'   => 'on_position',
        'hide_empty' => false,
     ]);


    if (! empty($position_terms) && ! is_wp_error($position_terms)) {

        $position_term = [ [
            'id'    => 0,
            'text' => 'انتخاب سمت',
         ] ];
        foreach ($position_terms as $term) {

            $position_term[  ] = [
                'id'    => $term->term_id,
                'text' => esc_html($term->name),
             ];
        }

    }

    wp_localize_script(
        'op_admin',
        'op_js',
        [
            'ajaxurl'       => admin_url('admin-ajax.php'),
            'nonce'         => wp_create_nonce('ajax-nonce'),
            'agents_term'   => $agents_term,
            'position_term' => $position_term,

         ]
    );

}

add_action('wp_enqueue_scripts', 'op_style');

function op_style()
{

    wp_register_style(
        'bootstrap',
        OP_VENDOR . 'bootstrap/bootstrap.min.css',
        [  ],
        '5.3.3'
    );
    wp_register_style(
        'bootstrap.rtl',
        OP_VENDOR . 'bootstrap/bootstrap.rtl.min.css',
        [ 'bootstrap' ],
        '5.3.3'
    );

    wp_register_script(
        'bootstrap',
        OP_VENDOR . 'bootstrap/bootstrap.min.js',
        [  ],
        '5.3.3',
        true
    );

    wp_register_style(
        'select2',
        OP_VENDOR . 'select2/select2.min.css',
        [ 'bootstrap' ],
        '4.1.0-rc.0'
    );
    wp_register_script(
        'select2',
        OP_VENDOR . 'select2/select2.min.js',
        [  ],
        '4.1.0-rc.0',
        true
    );

    wp_enqueue_style(
        'op_style',
        OP_CSS . 'public.css',
        [ 'bootstrap.rtl', 'select2' ],
        OP_VERSION
    );

    wp_enqueue_script(
        'op_js',
        OP_JS . 'public.js',
        [ 'jquery', 'bootstrap', 'select2' ],
        OP_VERSION,
        true
    );

    wp_localize_script(
        'op_js',
        'op_js',
        [
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('ajax-nonce' . op_cookie()),
            'option'  => op_start_working(),

         ]
    );

}
