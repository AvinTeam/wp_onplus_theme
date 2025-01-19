<?php (defined('ABSPATH')) || exit; ?>



<input name="colleagues" value="" id="colleagues" style="width: 100%;">
<div class="onplus_parent">
    <div id="onplus-general-preview" class="menu-preview">
        <table class="form-table">
            <tr>
                <th>عوامل</th>
                <td>
                    <div class="agents_list">

                        <div class="agents-row">
                            <select class="select2colleagues regular-text" name="onplus[colleagues][]" data-select="0">
                                <option value="0">انتخاب همکار</option>
                            </select>
                            <select class="select2position regular-text" name="onplus[position][]" data-select="0">
                                <option value="0">انتخاب سمت</option>
                            </select>

                            <button type="button" class="button button-primary button-error agents-remove">حذف</button>
                        </div>


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