jalaliDatepicker.startWatch({
    minDate: "attr",
    maxDate: "attr"
});




const accordionContainer = document.getElementById("accordion-container");
const accordionDataInput = document.getElementById("accordionData");
const accordionData = [{
        title: "Accordion 1",
        text: "",
        color: "#ff0000",
        option: "Option 1"
    },
    {
        title: "Accordion 2",
        text: "",
        color: "#00ff00",
        option: "Option 2"
    },
    {
        title: "Accordion 3",
        text: "",
        color: "#0000ff",
        option: "Option 3"
    },
    {
        title: "Accordion 4",
        text: "",
        color: "#ffff00",
        option: "Option 4"
    },
    {
        title: "Accordion 5",
        text: "",
        color: "#ff00ff",
        option: "Option 5"
    },
];

function renderAccordions() {
    accordionContainer.innerHTML = ""; // Clear container

    accordionData.forEach((item, index) => {
        const accordion = document.createElement("div");
        accordion.className = "accordion";
        accordion.style.backgroundColor = item.color;
        accordion.innerHTML = `
  <div class="accordion-header" onclick="toggleAccordion(${index})">
    <span>${item.title}</span>
    <button class="delete-btn" onclick="deleteAccordion(${index}); event.stopPropagation();">Delete</button>
  </div>
  <div class="accordion-content">
    <label>Title:</label>
    <input type="text" value="${item.title}" ondblclick="this.select()" oninput="updateAccordion(${index}, 'title', this.value)" onclick="event.stopPropagation()">
    <label>Text:</label>
    <textarea oninput="updateAccordion(${index}, 'text', this.value)" onclick="event.stopPropagation()">${item.text}</textarea>
    <label>Color:</label>
    <input type="color" value="${item.color}" onchange="updateAccordion(${index}, 'color', this.value, this.parentElement.parentElement)" onclick="event.stopPropagation()">
    <label>Options:</label>
    <select onchange="updateAccordion(${index}, 'option', this.value)" onclick="event.stopPropagation()">
      <option value="Option 1" ${item.option === "Option 1" ? "selected" : ""}>Option 1</option>
      <option value="Option 2" ${item.option === "Option 2" ? "selected" : ""}>Option 2</option>
      <option value="Option 3" ${item.option === "Option 3" ? "selected" : ""}>Option 3</option>
      <option value="Option 4" ${item.option === "Option 4" ? "selected" : ""}>Option 4</option>
      <option value="Option 5" ${item.option === "Option 5" ? "selected" : ""}>Option 5</option>
    </select>
  </div>
`;
        accordionContainer.appendChild(accordion);
    });

    updateHiddenInput();
}

function toggleAccordion(index) {
    const accordions = document.querySelectorAll(".accordion");
    accordions[index].classList.toggle("active");
}

function updateAccordion(index, key, value, element = null) {
    accordionData[index][key] = value;
    if (key === 'color' && element) {
        element.style.backgroundColor = value;
    }
    updateHiddenInput();
}

function updateHiddenInput() {
    accordionDataInput.value = JSON.stringify(accordionData);
}

function addAccordion() {
    accordionData.push({
        title: `Accordion ${accordionData.length + 1}`,
        text: "",
        color: "#ffffff",
        option: "Option 1",
    });
    renderAccordions();
}

function deleteAccordion(index) {
    accordionData.splice(index, 1);
    renderAccordions();
}

// Initialize Sortable.js
new Sortable(accordionContainer, {
    animation: 150,
    onEnd: function(evt) {
        const movedItem = accordionData.splice(evt.oldIndex, 1)[0];
        accordionData.splice(evt.newIndex, 0, movedItem);
        renderAccordions();
    },
});

renderAccordions();







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









});