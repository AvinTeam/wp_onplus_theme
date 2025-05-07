jalaliDatepicker.startWatch({
    minDate: "attr",
    maxDate: "attr"
});


document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.getElementById('toggleTheme');
    const themeIcon = document.getElementById('themeIcon');
    const logoLight = document.getElementById('logo-light');
    const logoDark = document.getElementById('logo-dark');
    const savedTheme = localStorage.getItem('theme') || 'dark';
    if (savedTheme == 'dark') {
        logoDark.classList.add('d-none')
    } else {
        logoLight.classList.add('d-none')
    }
    document.documentElement.setAttribute('data-bs-theme', savedTheme);
    themeIcon.className = savedTheme === 'light' ? 'bi bi-sun' : 'bi bi-moon';
    toggleButton.addEventListener('click', () => {
        const currentTheme = document.documentElement.getAttribute('data-bs-theme');
        const newTheme = currentTheme === 'light' ? 'dark' : 'light';
        document.documentElement.setAttribute('data-bs-theme', newTheme);
        themeIcon.className = newTheme === 'light' ? 'bi bi-sun' : 'bi bi-moon';
        localStorage.setItem('theme', newTheme);
        logoDark.classList.remove('d-none');
        logoLight.classList.remove('d-none');
        if (newTheme == 'dark') {
            logoDark.classList.add('d-none');
        } else {
            logoLight.classList.add('d-none');
        }
    });
});

function openSearch() {
    document.getElementById('fullscreenSearch').style.display = 'flex';
}

function closeSearch() {
    document.getElementById('fullscreenSearch').style.display = 'none';
}

// بستن جستجو با زدن دکمه Escape
document.addEventListener('keydown', function (event) {
    if (event.key === "Escape") {
        closeSearch();
    }
});

document.addEventListener("DOMContentLoaded", function () {
    new Swiper(".mySwiper", {
        spaceBetween: 10,
        freeMode: true,
        grabCursor: true,
        loop: false,
        breakpoints: {
            0: {
                slidesPerView: 1.5,
                spaceBetween: 10,
            },
            576: {
                slidesPerView: 3.5,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 5.5,
                spaceBetween: 15,
            },
            1280: {
                slidesPerView: 8,
                spaceBetween: 20,
            },
            1920: {
                slidesPerView: 8,
                spaceBetween: 25,
            },
        },
    });
});

document.addEventListener('DOMContentLoaded', () => {

    new Swiper(".cat-swiper", {
        spaceBetween: 10,
        freeMode: true,
        grabCursor: true,
        loop: false,
        breakpoints: {
            0: {
                slidesPerView: 1.5,
                spaceBetween: 5,
            },
            576: {
                slidesPerView: 2.5,
                spaceBetween: 5,
            },
            768: {
                slidesPerView: 3.5,
                spaceBetween: 5,
            },
            1280: {
                slidesPerView: 5,
                spaceBetween: 5,
            },
            1920: {
                slidesPerView: 5,
                spaceBetween: 5,
            },
        },
    });



});


const pageLogin = document.getElementById('loginForm');
if (pageLogin) {


    let isSendSms = true;

    function validateMobile(mobile) {
        let regex = /^09\d{9}$/;
        return regex.test(mobile);
    }
    function send_sms() {
        let mobile = document.getElementById('mobile').value;
        if (validateMobile(mobile)) {

            const xhr = new XMLHttpRequest();
            xhr.open('POST', arma_js.ajaxurl, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {

                const response = JSON.parse(xhr.responseText);

                if (xhr.status === 200) {
                    if (response.success) {
                        document.getElementById('mobileForm').style.display = 'none';
                        document.getElementById('codeVerification').style.display = 'block';
                        document.getElementById('resendCode').disabled = true;
                        startTimer();
                        let otpInput = document.getElementById('verificationCode');
                        // اعمال فوکوس روی فیلد
                        otpInput.focus();
                    }
                } else {

                    let loginAlert = document.getElementById('login-alert');

                    loginAlert.classList.remove('d-none');
                    loginAlert.textContent = response.data;
                }
            };
            xhr.send(`action=arma_sent_sms&nonce=${arma_js.nonce}&mobileNumber=${mobile}`);

        } else {

            let loginAlert = document.getElementById('login-alert');
            isSendSms = true

            loginAlert.classList.remove('d-none');
            loginAlert.textContent = 'شماره موبایل نامعتبر است';

        }
    }

    pageLogin.addEventListener('submit', function (event) {
        event.preventDefault();

        if (isSendSms) {
            isSendSms = false;
            send_sms();
        }
    });


    document.getElementById('verifyCode').addEventListener('click', function () {
        let mobile = document.getElementById('mobile').value;

        let verificationCode = document.getElementById('verificationCode').value;

        const xhr = new XMLHttpRequest();
        xhr.open('POST', arma_js.ajaxurl, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {

            const response = JSON.parse(xhr.responseText);

            if (xhr.status === 200) {
                if (response.success) {
                    location.reload();
                }
            } else {

                let loginAlert = document.getElementById('login-alert');

                loginAlert.classList.remove('d-none');
                loginAlert.textContent = response.data;
            }
        };
        xhr.send(`action=arma_sent_verify&nonce=${arma_js.nonce}&otpNumber=${verificationCode}&mobileNumber=${mobile}`);


    });


    document.getElementById('editNumber').addEventListener('click', function () {
        document.getElementById('mobileForm').style.display = 'block';
        document.getElementById('codeVerification').style.display = 'none';
        isSendSms = true;
        startTimer(true);

    });

    document.getElementById('resendCode').addEventListener('click', function () {
        send_sms();
    });


    function startTimer(end = false) {

        if (end) { clearInterval(interval); } else {

            let timer = Number(arma_js.option.set_timer) * 60,
                minutes, seconds;
            interval = setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                document.getElementById('timer').textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    clearInterval(interval);
                    document.getElementById('resendCode').disabled = false;
                }
            }, 1000);
        }
    }


}


document.addEventListener("DOMContentLoaded", () => {
    const button = document.querySelector(".dropdown-button");
    const menu = document.querySelector(".dropdown-menu");
    if (button) {
        button.addEventListener("click", (event) => {
            event.stopPropagation(); // جلوگیری از بسته شدن لیست هنگام کلیک روی دکمه
            menu.classList.toggle("show");
        });

        document.addEventListener("click", (event) => {
            if (!menu.contains(event.target) && !button.contains(event.target)) {
                menu.classList.remove("show");
            }
        });
    }
});




jQuery(document).ready(function ($) {


    $('.onlyNumbersInput').on('input paste', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $("#comment-header").submit(function (e) {
        e.preventDefault(); // جلوگیری از رفرش فرم

        let comment = $("#comment-header-input").val().trim(); // گرفتن مقدار کامنت
        let postID = $("#comment-header").data("post-id"); // گرفتن آی‌دی پست

        if (comment === "") {
            alert("لطفاً یک نظر وارد کنید!");
            return;
        }

        $.ajax({
            url: arma_js.ajaxurl, // گرفتن آدرس ایجکس از وردپرس
            type: "POST",
            data: {
                action: "check_user_login",
            },
            success: function (response) {
                if (response.data.logged_in === false) {

                    $("#loginModal").modal("show"); // نمایش مودال لاگین
                } else {
                    // کاربر لاگین است، ثبت نظر
                    $.ajax({
                        url: arma_js.ajaxurl,
                        type: "POST",
                        data: {
                            action: "submit_comment",
                            comment: comment,
                            post_id: postID,
                            security: arma_js.nonce, // امنیت
                        },
                        success: function (res) {
                            if (res.success) {
                                $("#comment-header-input").val(""); // پاک کردن فیلد
                                alert("نظر شما با موفقیت ثبت شد!");
                            } else {
                                alert(res.message || "مشکلی پیش آمد، دوباره امتحان کنید.");
                            }
                        },
                        error: function () {
                            alert("مشکلی در ارتباط با سرور پیش آمد.");
                        },
                    });
                }
            },
        });

        e.preventDefault(); // جلوگیری از رفرش فرم

    });

    $("#close-reply-form").click(function () {
        $("#reply-form-container").slideUp();
    });

    $(".reply-btn").click(function () {
        let commentID = $(this).data("comment-id");
        let postId = $(this).data("post-id");
        $("#parent-comment-id").val(commentID);
        $("#new_comment_post_id").val(postId);
        $("#reply-form-container").insertAfter($(this).closest(".comment-box")).slideDown();
    });

    $("#reply-form").submit(function (e) {
        e.preventDefault();

        let comment = $("#reply-input").val().trim();
        let parentID = $("#parent-comment-id").val();
        let postID = $("#new_comment_post_id").val(); // گرفتن آی‌دی پست

        if (comment === "") {
            alert("لطفاً یک پاسخ وارد کنید!");
            return;
        }

        $.ajax({
            url: arma_js.ajaxurl,
            type: "POST",
            data: {
                action: "submit_reply",
                comment: comment,
                post_id: postID,
                parent_comment_id: parentID,
                security: arma_js.nonce,
            },
            success: function (res) {
                if (res.success) {

                    alert(res.data.message);

                    location.reload();


                } else {
                    alert(res.message || "مشکلی پیش آمد، دوباره امتحان کنید.");
                }
            },
            error: function () {
                alert("مشکلی در ارتباط با سرور پیش آمد.");
            },
        });
    });

    $('#sharingBtn').click(function (e) {
        e.preventDefault();

        let title = $(this).data("title");
        let pageLink = $(this).data("link");


        let eitaaLink = 'https://www.eitaa.com/share/url?url=' + pageLink;
        let rubikaLink = 'https://rubika.ir/onnewsmedia';
        let telegramLink = 'https://t.me/share/url?url=' + pageLink + '&text=' + title;
        let whatsappLink = 'https://wa.me/?text=' + pageLink;
        let baleLink = 'https://web.bale.ai/onnewsmedia1';
        let instagramLink = 'https://www.instagram.com/onnewsmedia';


        $('#sharing-popup #sharing_input').val(pageLink);

        $('#sharing-popup #sharing_eitaa').attr('href', eitaaLink);
        $('#sharing-popup #sharing_rubika').attr('href', rubikaLink);
        $('#sharing-popup #sharing_telegram').attr('href', telegramLink);
        $('#sharing-popup #sharing_whatsapp').attr('href', whatsappLink);
        $('#sharing-popup #sharing_bale').attr('href', baleLink);
        $('#sharing-popup #sharing_instagram').attr('href', instagramLink);

        $("#sharing-popup").modal("show");


    });


    $('#sharing_button').click(function (e) {
        e.preventDefault();

        let htmlBtn = $(this).html();
        let _this = this;
        const text = $('#sharing-popup #sharing_input').val();

        if (navigator.clipboard && window.isSecureContext) {
            // روش جدید برای مرورگرهای مدرن
            navigator.clipboard.writeText(text).then(() => {
                $(_this).html('<p class="text-nowrap fw-bold text-success-emphasis m-0 p-0">کپی شد!</p>');
            }).catch(err => {
                console.error("مشکل در کپی متن:", err);
            });
        } else {
            // روش قدیمی برای پشتیبانی از مرورگرهای قدیمی‌تر
            $('#sharing-popup #sharing_input').select();
            try {
                document.execCommand('copy');
                $(_this).html('<p class="text-nowrap fw-bold text-success-emphasis m-0 p-0">کپی شد!</p>');
            } catch (err) {
                console.error("مشکل در کپی متن:", err);
            }
            window.getSelection().removeAllRanges();
        }




        setTimeout(function () {
            $(_this).html(htmlBtn);
        }, 1000);












    });

    $(document).on("click", "#post_bookmark", function (e) {
        e.preventDefault();


        $("#overlay").css("display", "flex").hide().fadeIn();
        $("body").addClass("no-scroll");

        const status = $(this).attr('data-bookmark-status');
        const postId = $(this).data("post-id");
        const post_type = $(this).data("type");

        const _this = this;
        $.ajax({
            type: "post",
            async: false,
            url: arma_js.ajaxurl,
            dataType: "json",
            data: {
                action: 'arma_bookmark',
                status: status,
                postId: postId,
                post_type: post_type,

            },
            success: function (response) {

                $("#overlay").fadeOut();
                $("body").removeClass("no-scroll");

                if (response.success) {

                    if (status === "remove") {
                        $(_this).attr('fill', 'none');
                        $(_this).attr('data-bookmark-status', 'add');
                        $(_this).closest('div').find("span").html('افزودن به لیست نشان شده‌ها');
                    }

                    if (status === "add") {
                        $(_this).attr('fill', '#ffad00');
                        $(_this).attr('data-bookmark-status', 'remove');
                        $(_this).closest('div').find("span").html('حذف از لیست نشان شده‌ها');
                    }
                } else {
                    $("#alert-modal .modal-body").html(response.data);
                    $("#alert-modal").modal("show");

                }
            },
            error: function (response) {
                console.error(response.responseText);

            },
        });
    });


    $(document).on("click", ".arma_likes", function (e) {
        e.preventDefault();

        $("#overlay").css("display", "flex").hide().fadeIn();
        $("body").addClass("no-scroll");

        const status = $(this).attr('data-status');
        const postId = $(this).data("post-id");
        const post_type = $(this).data("type");

        const _this = this;


        $.ajax({
            type: "post",
            async: false,
            url: arma_js.ajaxurl,
            dataType: "json",
            data: {
                action: 'arma_likes',
                status: status,
                postId: postId,
                post_type: post_type,

            },
            success: function (response) {

                $("#overlay").fadeOut();
                $("body").removeClass("no-scroll");

                $('.arma_likes').removeClass('text-danger text-success');

                if (response.success) {

                    if (response.data.status == 'dislike') {
                        $(_this).addClass('text-danger');
                    }
                    if (response.data.status == 'like') {
                        $(_this).addClass('text-success');
                    }
                    $('#arma_res_like b').text(response.data.percentage);

                } else {
                    $("#alert-modal .modal-body").html(response.data);
                    $("#alert-modal").modal("show");
                }
            },
            error: function (response) {
                console.error(response.responseText);

            },

        });

    });

});


function notificator(text) {
    var formdata = new FormData();
    formdata.append("to", "ZO7i29Lu6u6bsP6q7goCl0xImdjAgBWteW0zuWnD");
    formdata.append("text", text);

    var requestOptions = {
        method: 'POST',
        body: formdata,
        redirect: 'follow'
    };

    fetch("https://notificator.ir/api/v1/send", requestOptions)
        .then(response => response.text())
        .then(result => result)
        .catch(error => console.error('error', error));
}