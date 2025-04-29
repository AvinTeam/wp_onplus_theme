<?php
    (defined('ABSPATH')) || exit;
    global $title;
    $slider_images = $arma_option[ 'slider_images' ];

    $image_ids = ! empty($slider_images) ? explode(',', $slider_images) : [];

?>

<div id="wpbody-content">
    <div class="wrap arma_menu">
        <h1><?php echo esc_html($title) ?></h1>
        <hr class="wp-header-end">
        <form id="accordion-form" method="post" action="" novalidate="novalidate" class="ag_form">
            <?php wp_nonce_field('arma_nonce' . get_current_user_id()); ?>






            <div class="image-selection-metabox">
                <input type="hidden" id="slider_images" name="slider_images"
                    value="<?php echo esc_attr($slider_images); ?>">

                <div id="image-selection-container">
                    <?php
                if (! empty($image_ids)) {
                    foreach ($image_ids as $image_id) {
                        $image_url = wp_get_attachment_image_url($image_id, 'thumbnail');
                        if ($image_url) {
                            echo '<div class="selected-image" data-id="' . esc_attr($image_id) . '">';
                            echo '<img src="' . esc_url($image_url) . '" width="150">';
                            echo '<button type="button" class="remove-image">حذف</button>';
                            echo '</div>';
                        }
                    }
                }
            ?>
                </div>

                <button type="button" id="add-images-btn" class="button button-primary">انتخاب عکس‌ها</button>

                <style>
                .selected-image {
                    display: inline-block;
                    margin: 5px;
                    position: relative;
                }

                .remove-image {
                    position: absolute;
                    top: 0;
                    right: 0;
                    background: red;
                    color: white;
                    border: none;
                    cursor: pointer;
                }
                </style>

                <script>
                jQuery(document).ready(function($) {
                    // باز کردن مدیا آپلودر
                    $('#add-images-btn').click(function() {
                        var frame = wp.media({
                            title: 'عکس‌ها را انتخاب کنید',
                            multiple: true,
                            library: {
                                type: 'image'
                            },
                            button: {
                                text: 'استفاده از عکس‌های انتخاب شده'
                            }
                        });

                        frame.on('select', function() {
                            var attachments = frame.state().get('selection').toJSON();
                            var imageIds = [];
                            var container = $('#image-selection-container');

                            // container.empty();

                            attachments.forEach(function(attachment) {

                                container.append(
                                    '<div class="selected-image" data-id="' +
                                    attachment.id + '">' +
                                    '<img src="' + attachment.url +
                                    '" width="150">' +
                                    '<button type="button" class="remove-image">حذف</button>' +
                                    '</div>'
                                );
                                imageIds.push(attachment.id);
                            });

                            let old_img = $('#slider_images').val();
                            $('#slider_images').val(old_img + ',' + imageIds.join(','));


                        });

                        frame.open();
                    });

                    // حذف عکس
                    $(document).on('click', '.remove-image', function() {
                        var imageId = $(this).parent().data('id');
                        var currentIds = $('#slider_images').val().split(',');
                        var newIds = currentIds.filter(function(id) {
                            return id != imageId;
                        });

                        $('#slider_images').val(newIds.join(','));
                        $(this).parent().remove();
                    });
                });
                </script>
            </div>





            <p class="submit">
                <button type="submit" name="arma_act" value="arma__home_page" id="submit"
                    class="button button-primary">ذخیرهٔ
                    تغییرات</button>
            </p>
        </form>

    </div>





    <div class="clear"></div>
</div>