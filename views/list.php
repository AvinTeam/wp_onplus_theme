<?php (defined('ABSPATH')) || exit;
global $title;?>
<div class="wrap mph_big_style">


    <h1 class="wp-heading-inline"> <?php echo esc_html($title) ?></h1>

    <?php

//$armaListTable->arma_res($row);
$armaListTable->prepare_items();

echo '<form method="post" action="" class="arma-table" >';
$armaListTable->views();

$armaListTable->display();

wp_nonce_field('mph_nonce' . get_current_user_id());

?>

    </form>

</div>
<div class="arma-loader"></div>

<div class="clear"></div>

