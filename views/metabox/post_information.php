<?php (defined('ABSPATH')) || exit;

?>

<div class="onplus_parent">
    <div id="onplus-general-preview" class="menu-preview">
        <table class="form-table">


            <tr>
                <th>توضیحات مختصر</th>
                <td><?php

                        $editor_array = [
                            'media_buttons' => false,
                            'textarea_name' => 'onplus[brief]',
                            'textarea_rows' => 10,
                            'tinymce'       => [
                                'wpautop'                 => true,
                                'force_p_newlines'        => true,
                                'br_in_pre'               => true,
                                'valid_elements'          => '*[*]',
                                'extended_valid_elements' => 'p[*],br[*],span[*]',
                                'remove_linebreaks'       => false,

                             ],
                         ];

                    wp_editor($arma_brief, 'brief', $editor_array)?>

                </td>
            </tr>

            <tr>
                <th>آدرس ابر آروان</th>
                <td><input class="regular-text w-100 dir-ltr" name="onplus[video]" value="<?=$arma_video?>"></td>
                
            </tr>
            <tr>
                <th>تاریخ تولید</th>
                <td><input data-jdp class="regular-text" name="onplus[production_date]" value="<?=$arma_production_date?>"></td>
            </tr>
        </table>
    </div>

</div>