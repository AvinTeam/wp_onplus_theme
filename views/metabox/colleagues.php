<?php (defined('ABSPATH')) || exit; ?>



<div class="onplus_parent">
    <div id="onplus-general-preview" class="menu-preview">
        <table class="form-table">
            <tr>
                <th>عوامل</th>
                <td>
                    <div class="agents_list">

                    <?php foreach ($arma_colleagues as $colleague): ?>

                        <div class="agents-row">
                            <select class="select2colleagues regular-text" name="onplus[colleagues][]" data-select="<?php echo $colleague[ 'colleagues' ]?>">
                                <option value="0">انتخاب همکار</option>
                            </select>
                            <select class="select2position regular-text" name="onplus[position][]" data-select="<?php echo $colleague[ 'position' ]?>">
                                <option value="0">انتخاب سمت</option>
                            </select>

                            <button type="button" class="button button-primary button-error agents-remove">حذف</button>
                        </div>
                        <?php endforeach; ?>


                    </div>
                    <div class="agents-row">
                        <button type="button"
                            class="button button-primary button-success button-large agents-add">افزودن</button>
                    </div>
                </td>
            </tr>
        </table>
    </div>

</div>