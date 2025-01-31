<?php
    (defined('ABSPATH')) || exit;

    // اضافه کردن فیلد تصویر به فرم افزودن دسته‌بندی جدید
    function add_category_image_field($term)
    {
        $image_id        = get_term_meta($term->term_id, 'category_image', true);
        $image_url       = $image_id ? wp_get_attachment_url($image_id) : '';
        $image_id_baner  = get_term_meta($term->term_id, 'category_baner', true);
        $image_url_baner = $image_id ? wp_get_attachment_url($image_id_baner) : '';

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
        <th scope="row"><label for="category_baner">بنر دسته‌بندی</label></th>
        <td>
            <input type="hidden" id="category_baner" name="category_baner" value="<?php echo esc_attr($image_id_baner); ?>">
            <div id="category_baner_preview">
                <?php if ($image_id_baner): ?>
                    <img src="<?php echo esc_url($image_url_baner); ?>" style="max-width: 150px; height: auto;">
                <?php endif; ?>
            </div>
            <br>
            <button type="button" class="button category_baner_upload">آپلود تصویر</button>
            <button type="button" class="button category_baner_remove">حذف تصویر</button>
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
        <label for="category_baner">بنر دسته‌بندی</label>
        <input type="hidden" id="category_baner" name="category_baner" value="">
        <div id="category_baner_preview"></div>
        <br>
        <button type="button" class="button category_baner_upload">آپلود تصویر</button>
        <button type="button" class="button category_baner_remove">حذف تصویر</button>
    </div>
    <?php
        });

        function save_category_image($term_id)
        {
            if (isset($_POST[ 'category_image' ])) {
                update_term_meta($term_id, 'category_image', sanitize_text_field($_POST[ 'category_image' ]));
            }
            if (isset($_POST[ 'category_baner' ])) {
                update_term_meta($term_id, 'category_baner', sanitize_text_field($_POST[ 'category_baner' ]));
            }
        }
    add_action('edited_on_category', 'save_category_image');
    add_action('created_on_category', 'save_category_image');