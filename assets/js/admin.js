jalaliDatepicker.startWatch({
    minDate: "attr",
    maxDate: "attr"
});

//انتخاب همکار باقی مانده
jQuery(document).ready(function ($) {


    $('.select2').select2({
        placeholder: 'جستجو کنید...',
        dir: 'rtl',
        language: {
            noResults: function () {
                return 'نتیجه‌ای یافت نشد.';
            },
            searching: function () {
                return 'در حال جستجو...';
            }
        },
    });

    function onPlusSelect2(colleaguesData, positionData) {
        $('.select2colleagues').select2({

            placeholder: 'جستجو کنید...',
            data: colleaguesData,
            dir: 'rtl',
            language: {
                noResults: function () {
                    return 'نتیجه‌ای یافت نشد.';
                },
                searching: function () {
                    return 'در حال جستجو...';
                }
            },
        });

        let selectedcolleagues = $('.select2colleagues').data('select');
        if (selectedcolleagues) {
            $('.select2colleagues').val(selectedcolleagues).trigger('change');
        }


        $('.select2position').select2({
            placeholder: 'جستجو کنید...',
            data: positionData,
            dir: 'rtl',
            language: {
                noResults: function () {
                    return 'نتیجه‌ای یافت نشد.';
                },
                searching: function () {
                    return 'در حال جستجو...';
                }
            },
        });
        let selectedposition = $('.select2position').data('select');
        if (selectedposition) {
            $('.select2position').val(selectedposition).trigger('change');
        }
    }
    // results.forEach(item => {})
    onPlusSelect2(op_js.agents_term, op_js.position_term);



    $(document).on("click", ".agents-add", function (e) {
        e.preventDefault();
        const newRow = `<div class="agents-row">
                                <select class="select2colleagues   regular-text" name="onplus[colleagues][]">
                                    <option value="0">انتخاب همکار</option>
                                </select>
                                <select class="select2position regular-text"  name="onplus[position][]">
                                    <option value="0">انتخاب سمت</option>
                                </select>

                                <button type="button" class="button button-primary button-error agents-remove">حذف</button>
                            </div>`;

        $('.agents_list').append(newRow);

        onPlusSelect2(op_js.agents_term, op_js.position_term);





    });

    $(document).on("click", ".agents-remove", function (e) {
        e.preventDefault();
        $(this).closest(".agents-row").remove();
    });

    $('.ajax-select-colleagues').select2({
        placeholder: 'جستجو کنید...',
        dir: 'rtl',
        language: {
            noResults: function () {
                return 'نتیجه‌ای یافت نشد.';
            },
            searching: function () {
                return 'در حال جستجو...';
            }
        },
        ajax: {
            url: op_js.ajaxurl,
            dataType: 'json',
            type: 'POST',
            delay: 250,
            data: function (params) {
                return {
                    action: 'ajax_select_colleagues',
                    search: params.term,
                    nonce: op_js.nonce
                };
            },
            processResults: function (data) {
                return {
                    results: data.data.map(function (item) {
                        return { id: item.id, text: item.title };
                    })
                };
            },
            cache: true,

        }
    });

    $('.ajax-select-position').select2({
        placeholder: 'جستجو کنید...',
        dir: 'rtl',
        language: {
            noResults: function () {
                return 'نتیجه‌ای یافت نشد.';
            },
            searching: function () {
                return 'در حال جستجو...';
            }
        },
        ajax: {
            url: op_js.ajaxurl,
            dataType: 'json',
            type: 'POST',
            delay: 250,
            data: function (params) {
                return {
                    action: 'ajax_select_position',
                    search: params.term,
                    nonce: op_js.nonce
                };
            },
            processResults: function (data) {
                return {
                    results: data.data.map(function (item) {
                        return { id: item.id, text: item.title };
                    })
                };
            },
            cache: true,

        }
    });




});