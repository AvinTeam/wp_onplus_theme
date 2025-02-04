jalaliDatepicker.startWatch({
    minDate: "attr",
    maxDate: "attr"
});

document.addEventListener('DOMContentLoaded', function () {
    var customMetaBox = document.getElementById('arma_episode');
    var categoriesBox = document.getElementById('on_categorydiv');
    var tagsBox = document.getElementById('tagsdiv-on_tag');

    if (customMetaBox && categoriesBox && tagsBox) {
        // قرار دادن متاباکس بین دسته‌بندی‌ها و برچسب‌ها
        categoriesBox.parentNode.insertBefore(customMetaBox, tagsBox);
    }
});



const accordionContainer = document.getElementById("accordion-container");
const accordionDataInput = document.getElementById("accordionData");
// const accordionData = [{
//     title: "Accordion 1",
//     type: "link",
//     img: "10",
//     link: "https://",
//     typeShow: "auto",
//     option: "0",
//     listAll: [1, 2, 3, 4, 5]
// }, ];

let accordionData = [];


let jsonString = arma_js.option.home_page;

// حذف بک‌اسلش‌های اضافی
jsonString = jsonString.replace(/\\/g, "");

try {
    accordionData = JSON.parse(jsonString);
} catch (error) {
    console.error("خطا در تجزیه JSON:", error);
}


function renderAccordions() {
    accordionContainer.innerHTML = ""; // Clear container

    accordionData.forEach((item, index) => {
        const accordion = document.createElement("div");
        accordion.className = "accordion";
        accordion.style.backgroundColor = '#f0f0f1';



        let isImage = (item.img) ? item.img : '';
        let isImageClass = (item.img) ? '' : 'd-none';
        let isTypeClass = (item.type === 'on_category' || item.type === 'on_tag') ? '' : 'd-none';

        let optionLabel = "انتخاب برنامه / برچسب:";

        if (item.type === 'on_category') { optionLabel = "انتخاب برنامه:" }
        if (item.type === 'on_tag') { optionLabel = "انتخاب برچسب:" }


        accordion.innerHTML = `
<div class="accordion-header" onclick="toggleAccordion(${index})">
    <span>${item.title}</span>
    <button class="delete-btn" onclick="deleteAccordion(${index}); event.stopPropagation();">حذف</button>
</div>
<div class="accordion-content">
    <label>عنوان:</label>
    <input type="text" value="${item.title}" ondblclick="this.select()" oninput="updateAccordion(${index}, 'title', this.value)" onclick="event.stopPropagation()">
    <div class="accordion-box">
        <div class="accordion-right"  >
            <label>نوع داده:</label>
            <select class="w-100" onchange="updateAccordion(${index}, 'type', this.value, this)" onclick="event.stopPropagation()" id="arma_type">
            <option value="0" ${item.type === "0" ? "selected" : ""}>انتخاب ورودی</option>
            <option value="link" ${item.type === "link" ? "selected" : ""}>لینک</option>
            <option value="on_category" ${item.type === "on_category" ? "selected" : ""}>برنامه</option>
            <option value="on_tag" ${item.type === "on_tag" ? "selected" : ""}>برچسب</option>
            <option value="list_category" ${item.type === "list_category" ? "selected" : ""}>لیست برنامه ها</option>
            </select>
        </div>
        <div class="accordion-left"  >
            <div class="img ${isImageClass}">

                <label>آدرس صفحه:</label>
                <input type="text" value="${item.link}" ondblclick="this.select()" oninput="updateAccordion(${index}, 'link', this.value)" onclick="event.stopPropagation()">
                <label>انتخاب تصویر:</label>
                <button data-index="${index}" class="go_to_gallery" type="button" >انتخاب تصویر</button>
                <img class="w-100 m-top-10" src="${isImage}" id="arma_image_${index}"  >

            </div>
            <div class="list ${isTypeClass}  class="m-top-10"">
                <label>${optionLabel}</label>
                <select id="arma_option_${index}" onchange="updateAccordion(${index}, 'option', this.value)" onclick="event.stopPropagation()" data-selected="${item.option}">
                    <option value="0" ${item.option === "0" ? "selected" : ""}>انتخاب</option>
                </select>
            </div>
        </div>
    </div>
</div>`;


        accordionContainer.appendChild(accordion);

        if (item.type === 'on_category' || item.type === 'on_tag') {
            updateAccordion(index, 'type', item.type)
        }
    });

    updateHiddenInput();
}

function toggleAccordion(index) {
    const accordions = document.querySelectorAll(".accordion");
    accordions[index].classList.toggle("active");
}

function updateAccordion(index, key, value, element = null) {


    if (key === 'listAll') {
        let arr = accordionData[index][key];

        if (element.checked) {
            arr.push(value);
        } else {
            const indexOfArr = arr.indexOf(Number(value));
            arr.splice(indexOfArr, 1);
        }
        accordionData[index][key] = arr;
    } else {
        accordionData[index][key] = value;
    }
    updateHiddenInput();



    if (key === 'type') {

        const accordionBoxes = document.querySelectorAll('.accordion-box');
        const selectedBox = accordionBoxes[index];

        const img = selectedBox.querySelector('.img');
        const list = selectedBox.querySelector('.list');
        const optionTitle = selectedBox.querySelector('.list label');
        const optionSelect = selectedBox.querySelector('.list select');

        if (value === 'link') {
            img.classList.remove('d-none');
            list.classList.add('d-none');
        } else if (value === 'on_category' || value === 'on_tag') {

            let selectedValue = optionSelect.getAttribute("data-selected");


            armaSendAjax('arma_cat_tag', value, optionSelect, Number(selectedValue));
            if (value === 'on_category') { optionTitle.textContent = "انتخاب برنامه:" }
            if (value === 'on_tag') { optionTitle.textContent = "انتخاب برچسب:" }
            img.classList.add('d-none');
            list.classList.remove('d-none');
        } else if (value === 'list_category') {
            img.classList.add('d-none');
            list.classList.add('d-none');
        } else {
            img.classList.add('d-none');
            list.classList.add('d-none');
        }
    }


}

function updateHiddenInput() {
    accordionDataInput.value = JSON.stringify(accordionData);
}

function addAccordion() {
    accordionData.push({
        title: "سطر جدید",
        type: "0",
        img: "",
        link: "",
        option: "0",
    });
    renderAccordions();
}

function deleteAccordion(index) {
    accordionData.splice(index, 1);
    renderAccordions();
}

function armaSendAjax(action, value, options, selected = 0) {


    const xhr = new XMLHttpRequest();
    xhr.open('POST', arma_js.ajaxurl, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        const response = JSON.parse(xhr.responseText);
        if (xhr.status === 200 && response.success) {
            options.innerHTML = response.data;
            return response.data;
        }
        return false;

    };
    xhr.send(`action=${action}&nonce=${arma_js.nonce}&type=${value}&selected=${selected}`);

}

if (accordionContainer) {

    // Initialize Sortable.js
    new Sortable(accordionContainer, {
        animation: 150,
        onEnd: function (evt) {
            const movedItem = accordionData.splice(evt.oldIndex, 1)[0];
            accordionData.splice(evt.newIndex, 0, movedItem);
            renderAccordions();
        },
    });

    renderAccordions();
}

document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById('viewsChart');

    if (ctx) {
        ctx = ctx.getContext('2d');

        // داده‌ها رو اینجا دستی تعریف کن
        var postTitles = arma_js.visited.date;
        var postViews = arma_js.visited.count;

        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: postTitles, // عنوان‌های پست‌ها
                datasets: [{
                    label: 'تعداد بازدید',
                    data: postViews, // تعداد بازدیدها
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

    }
});



//انتخاب همکار باقی مانده
jQuery(document).ready(function ($) {

    $('.onlyNumbersInput').on('input paste', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });



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

        $('.select2colleagues').each(function (index, element) {
            let selectedcolleagues = $(this).data('select');
            if (selectedcolleagues) {
                $(this).val(selectedcolleagues).trigger('change');
            }

        });




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

        $('.select2position').each(function (index, element) {
            let selectedcolleagues = $(this).data('select');
            if (selectedcolleagues) {
                $(this).val(selectedcolleagues).trigger('change');
            }

        });

    }
    // results.forEach(item => {})
    onPlusSelect2(arma_js.agents_term, arma_js.position_term);

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

        onPlusSelect2(arma_js.agents_term, arma_js.position_term);





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
            url: arma_js.ajaxurl,
            dataType: 'json',
            type: 'POST',
            delay: 250,
            data: function (params) {
                return {
                    action: 'ajax_select_colleagues',
                    search: params.term,
                    nonce: arma_js.nonce
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
            url: arma_js.ajaxurl,
            dataType: 'json',
            type: 'POST',
            delay: 250,
            data: function (params) {
                return {
                    action: 'ajax_select_position',
                    search: params.term,
                    nonce: arma_js.nonce
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

    $('#on_category-adder').addClass('d-none');

    $('#on_categorydiv input[type=checkbox]').attr('type', 'radio');

    $('#on_categorydiv input[type=radio]').change(function (e) {
        const _this = this;

        const formData = {
            action: 'arma_send_category',
            nonce: arma_js.nonce,
            cat_id: $(this).val(),
        };

        $.ajax({
            url: arma_js.ajaxurl,
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {

                $('#select-episode').html();
                $('#select-episode').html(response.data);

            }//select2
        });



    });


    var background_uploader;
    $(document).on("click", ".go_to_gallery", function (e) {
        e.preventDefault();

        let isIndex = $(this).attr('data-index');

        if (background_uploader !== undefined) {
            background_uploader.open();
            return;
        }
        
        background_uploader = wp.media({
            title: 'انتخاب تصویر',
            button: {
                text: 'انتخاب',
            },
            library: {
                type: ['image']
            }

        })


        background_uploader.on('select', function () {
            let selected = background_uploader.state().get('selection');

            let mph_utl = selected.first().toJSON().url;

            updateAccordion(isIndex, 'img', mph_utl);
            $('#arma_image_' + isIndex).attr('src', mph_utl);

            // $('.' + mph_id + ' input').val(mph_utl);

            // $('.' + mph_id + ' img').attr('src', mph_utl);

        });


        background_uploader.open();




    });


    function setImageField(imageUrl, imageId) {
        $("#category_image_preview").html('<img src="' + imageUrl + '" style="max-width: 150px; height: auto;">');
        $("#category_image").val(imageId);
    }

    $(".category_image_upload").click(function (e) {
        e.preventDefault();

        let mediaUploader = wp.media({
            title: "انتخاب تصویر دسته‌بندی",
            button: { text: "انتخاب تصویر" },
            library: { type: ['image'] },
            multiple: false
        }).on("select", function () {
            let attachment = mediaUploader.state().get("selection").first().toJSON();
            setImageField(attachment.url, attachment.id);
        }).open();
    });

    $(".category_image_remove").click(function (e) {
        e.preventDefault();
        setImageField("", "");
    });

    function setImageFieldbanner(imageUrl, imageId) {
        $("#category_banner_preview").html('<img src="' + imageUrl + '" style="max-width: 150px; height: auto;">');
        $("#category_banner").val(imageId);
    }

    $(".category_banner_upload").click(function (e) {
        e.preventDefault();

        let mediaUploader = wp.media({
            title: "انتخاب بنر دسته‌بندی",
            button: { text: "انتخاب بنر" },
            library: { type: ['image'] },
            multiple: false
        }).on("select", function () {
            let attachment = mediaUploader.state().get("selection").first().toJSON();
            setImageFieldbanner(attachment.url, attachment.id);
        }).open();
    });

    $(".category_banner_remove").click(function (e) {
        e.preventDefault();
        setImageFieldbanner("", "");
    });

    $('#addtag #submit').click(function (e) {

        setTimeout(function () {
            $('#category_image_preview img').attr('src', '');
            $('#category_banner_preview img').attr('src', '');
        }, 1000);

    });




    var select_image;
    $(document).on("click", ".select-image", function (e) {
        e.preventDefault();

        let _this = this;

        if (select_image !== undefined) {
            select_image.open();
            return;
        }

        select_image = wp.media({
            title: 'انتخاب تصویر',
            button: {
                text: 'انتخاب',
            },
            library: {
                type: ['image']
            }

        })


        select_image.on('select', function () {
            let selected = select_image.state().get('selection');

            let mph_utl = selected.first().toJSON().url;

            let row = $(_this).closest("tr");

            row.find("input").val(mph_utl);

            row.find("img").attr("src", mph_utl);

        });

        select_image.open();

    });





});