<?php (defined('ABSPATH')) || exit;

?>

<div class="onplus_parent">
    <div id="onplus-general-preview" class="menu-preview">
        <table class="form-table">


            <tr>
                <th>توضیحات مختصر</th>
                <td>
                    <?php
                        wp_editor('', 'content', [
                            'textarea_name' => 'post_content',
                            'media_buttons' => true,
                            'textarea_rows' => 10,
                         ]);
                    ?>
                </td>
            </tr>

            <tr>
                <th>آدرس فایل w3u8</th>
                <td><input class="regular-text" name="onplus[responsible]" value=""></td>
            </tr>
            <tr>
                <th>تاریخ تولید</th>
                <td><input data-jdp class="regular-text" name="onplus[responsible]" value=""></td>
            </tr>
        </table>
    </div>

</div>