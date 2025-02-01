<?php
    (defined('ABSPATH')) || exit;

    // اضافه کردن فیلد تصویر به فرم افزودن دسته‌بندی جدید
    function add_category_image_field($term)
    {
        $image_id        = get_term_meta($term->term_id, 'category_image', true);
        $image_url       = $image_id ? wp_get_attachment_url($image_id) : '';
        $image_id_banner  = get_term_meta($term->term_id, 'category_banner', true);
        $image_url_banner = $image_id ? wp_get_attachment_url($image_id_banner) : '';

    ?>
    <tr class="form-field">
        <th scope="row"><label for="category_image">تصویر دسته‌بندی</label></th>
        <td>
            <input type="hidden" id="category_image" name="category_image" value="<?php echo esc_attr($image_id); ?>">
            <div id="category_image_preview">
                <?php if ($image_url): ?>
                    <img src="<?php echo esc_url($image_url); ?>" style="max-width: 150px; height: auto;">
                <?php endif; ?>
            </div>
            <br>
            <button type="button" class="button category_image_upload">آپلود تصویر</button>
            <button type="button" class="button category_image_remove">حذف تصویر</button>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row"><label for="category_banner">بنر دسته‌بندی</label></th>
        <td>
            <input type="hidden" id="category_banner" name="category_banner" value="<?php echo esc_attr($image_id_banner); ?>">
            <div id="category_banner_preview">
                <?php if ($image_id_banner): ?>
                    <img src="<?php echo esc_url($image_url_banner); ?>" style="max-width: 150px; height: auto;">
                <?php endif; ?>
            </div>
            <br>
            <button type="button" class="button category_banner_upload">آپلود تصویر</button>
            <button type="button" class="button category_banner_remove">حذف تصویر</button>
        </td>
    </tr>
    <?php
        }
        add_action('on_category_edit_form_fields', 'add_category_image_field');
        add_action('on_category_add_form_fields', function () {
        ?>
    <div class="form-field">
        <label for="category_image">تصویر دسته‌بندی</label>
        <input type="hidden" id="category_image" name="category_image" value="">
        <div id="category_image_preview"></div>
        <br>
        <button type="button" class="button category_image_upload">آپلود تصویر</button>
        <button type="button" class="button category_image_remove">حذف تصویر</button>
    </div>
    <div class="form-field">
        <label for="category_banner">بنر دسته‌بندی</label>
        <input type="hidden" id="category_banner" name="category_banner" value="">
        <div id="category_banner_preview"></div>
        <br>
        <button type="button" class="button category_banner_upload">آپلود تصویر</button>
        <button type="button" class="button category_banner_remove">حذف تصویر</button>
    </div>
    <?php
        });

        function save_category_image($term_id)
        {
            if (isset($_POST[ 'category_image' ])) {
                update_term_meta($term_id, 'category_image', sanitize_text_field($_POST[ 'category_image' ]));
            }
            if (isset($_POST[ 'category_banner' ])) {
                update_term_meta($term_id, 'category_banner', sanitize_text_field($_POST[ 'category_banner' ]));
            }
        }
    add_action('edited_on_category', 'save_category_image');
    add_action('created_on_category', 'save_category_image');