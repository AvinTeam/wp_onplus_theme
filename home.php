<?php get_header();
    // ابتدا چک کن که مقدار یک رشته واقعی JSON هست
    $json_string = $arma_option[ 'home_page' ];

    // اگر بک‌اسلش‌های اضافی داره، پاکشون کن
    $json_string = stripslashes($json_string);

    // حالا JSON رو تبدیل به آرایه کن
    $data = json_decode($json_string, true);

    if (is_array($data)) {
        foreach ($data as $row) {

            $row_file = "";
            switch ($row[ 'type' ]) {
                case 'link':
                    $row_file = "link";
                    break;
                case 'on_category':
                    $row_file = "category";
                    break;
                case 'on_tag':
                    $row_file = "category";
                    break;
                case 'list_category':
                    $row_file = "list_category";
                    break;
                case 'shortcode':
                    $row_file = "shortcode";
                    break;

                default:
                    $row_file = "";
                    break;
            }
            if ($row_file != "") {
                require ARMA_VIEWS . "layout/home/{$row_file}.php";
            }
        }
    }
?>


<?php

get_footer();