<?php

    add_filter('cron_schedules', 'add_custom_cron_schedule');

    function add_custom_cron_schedule($schedules)
    {
        $schedules[ 'every_second' ] = [
            'interval' => 1,
            'display'  => __('every_second'),
         ];
        return $schedules;
    }

    // function schedule_my_custom_cron()
    // {
    //     if (!wp_next_scheduled('avin_it_cron_job')) {
    //         wp_schedule_event(time(), 'every_second', 'avin_it_cron_job');
    //     }
    // }
    // add_action('wp', 'schedule_my_custom_cron');

    function action_init(): void
    {

        // if (isset($_POST[ 'act' ]) && $_POST[ 'act' ] == 'form___submin') {

        //     if (isset($_POST[ 'mob' ]) && $_POST[ 'name' ] != "") {

        //         $nasrdb = new NasrDB();

        //         $frm = [
        //             'full_name' => sanitize_text_field($_POST[ 'name' ]),
        //             'mobile' => sanitize_phone($_POST[ 'mob' ]),
        //             'avatar' => (isset($_POST[ 'avatar' ])) ? sanitize_text_field($_POST[ 'avatar' ]) : 'no',
        //             'ostan' => absint($_POST[ 'user_ostan' ]),
        //             'description' => (isset($_POST[ 'description' ])) ? sanitize_textarea_field($_POST[ 'description' ]) : '',
        //             'signature' => (isset($_POST[ 'Comment' ])) ? sanitize_textarea_field($_POST[ 'Comment' ]) : '',
        //             'status' => 'waiting',

        //          ];

        //         $format = [ '%s', '%s', '%s', '%d', '%s', '%s', '%s' ];

        //         $my_res = $nasrdb->insert($frm, $format);

        //         if ($my_res) {
        //             set_transient('nasr_transient', '<div class="alert alert-success" role="alert">درخواست شما با موفقیت ثبت شد</div>');
        //         } else {
        //             set_transient('nasr_transient', '<div class="alert alert-danger" role="alert">با عرض پوزش درخواست شما ثبت نشد</div>');
        //         }
        //     } else {
        //         set_transient('nasr_transient', '<div class="alert alert-danger" role="alert">لطفا اطلاعات خود را کامل وارد کنید</div>');

        //     }
        //     wp_redirect('/');

        // }
    }

    add_action('init', 'action_init');

    function arma_title_filter($title)
    {
        if (is_home() || is_front_page()) {
            $title = get_bloginfo('name') . " | صفحه اصلی";
        } elseif (is_single()) {
            $title = get_the_title() . " | " . get_bloginfo('name');
        } elseif (is_category()) {
            $title = single_cat_title('', false) . " | دسته‌بندی";
        } elseif (is_tag()) {
            $title = single_tag_title('', false) . " | برچسب";
        } elseif (is_search()) {
            $title = "نتایج جستجو برای " . get_search_query();
        } elseif (is_404()) {
            $title = get_bloginfo('name') . "صفحه پیدا نشد | ";
        } else {
            $title = get_bloginfo('name');
        }
        return $title;
    }
    add_filter('wp_title', 'arma_title_filter');

    function change_admin_title_based_on_arg($admin_title, $title)
    {
        global $pagenow;

        if ($pagenow === 'post-new.php' && isset($_GET[ 'post_type' ]) && $_GET[ 'post_type' ] === 'episode' && isset($_GET[ 'cat' ])) {
            $admin_title = 'افزودن برش &lsaquo; آن پلاس &#8212; وردپرس';
        }

        return $admin_title;
    }

    add_filter('admin_title', 'change_admin_title_based_on_arg', 10, 2);

    function change_page_h1_title_based_on_arg()
    {
        global $pagenow;

        if ($pagenow === 'post-new.php' && isset($_GET[ 'post_type' ]) && $_GET[ 'post_type' ] === 'episode' && isset($_GET[ 'cat' ])) {
        ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let pageTitle = document.querySelector('.wrap > h1');
                if (pageTitle) {
                    pageTitle.textContent = 'افزودن برش';
                }
            });
        </script>
        <?php
            }
            }

            add_action('admin_head', 'change_page_h1_title_based_on_arg');

            function move_meta_box_between_categories_and_tags()
            {
            ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var customMetaBox = document.getElementById('arma_episode');
            var categoriesBox = document.getElementById('on_categorydiv');
            var tagsBox = document.getElementById('tagsdiv-on_tag');

            if (customMetaBox && categoriesBox && tagsBox) {
                // قرار دادن متاباکس بین دسته‌بندی‌ها و برچسب‌ها
                categoriesBox.parentNode.insertBefore(customMetaBox, tagsBox);
            }
        });
    </script>
    <?php
        }
        add_action('admin_footer', 'move_meta_box_between_categories_and_tags');
