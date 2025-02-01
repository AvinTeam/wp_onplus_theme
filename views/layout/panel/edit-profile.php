<div id="content2" class="content-box" style="display: none;">
    <h5 class="m-0 text-center">ویرایش پروفایل</h5>
    <div class="card mx-auto mt-5"
        style="max-width: 500px; position: relative; border-radius: 10px; overflow: hidden; background-color: #242323;">
        <div class="card-header bg-primary text-white text-center py-3">
            ***
        </div>
        <form accept="" method="POST">
            <div class="card-body p-4" style="background-color: #242323; color: #fff;">
                <!-- Profile Image -->
                <div class="text-center mb-3">
                    <img id="profileImage" src="<?php echo arma_panel_image('panel/placeHolderUserImage.png') ?>"
                        alt="Profile Image" class="img-fluid rounded-circle mb-2"
                        style="width: 70px; height: 70px; object-fit: cover; border: 5px solid #3899a0;">
                    <div>
                        <button class="btn btn-link text-white mt-2"
                            onclick="document.getElementById('fileInput').click();">انتخاب تصویر</button>
                        <input type="file" id="fileInput" style="display: none;" accept="image/*"
                            onchange="updateImage(event)">
                    </div>
                </div>

                <!-- Name Field -->
                <div class="mb-3">
                    <label for="profileName" class="form-label d-block text-white">نام پروفایل</label>
                    <input type="text" id="profileName" class="form-control" placeholder="نام پروفایل خود را وارد کنید"
                        style="background-color: #333; color: #fff; border: 1px solid #444;">
                </div>

                <!-- Gender Field -->
                <div class="mb-3">
                    <label for="gender" class="form-label d-block text-white">جنسیت</label>
                    <select id="gender" class="form-select w-100"
                        style="background-color: #333; color: #fff; border: 1px solid #444;">
                        <option selected>آقا</option>
                        <option>خانم</option>
                        <option>ترجیح میدهم اعلام نکنم</option>
                    </select>
                </div>

                <!-- Date of Birth Field -->
                <div class="mb-3">
                    <label class="form-label d-block text-white">تاریخ تولد</label>
                    <div class="d-flex justify-content-between">
                        <select id="daySelect" class="form-select">
                            <option selected>روز</option>
                        </select>
                        <select id="monthSelect" class="form-select">
                            <option selected>ماه</option>
                        </select>
                        <select id="yearSelect" class="form-select">
                            <option selected>سال</option>
                        </select>
                    </div>
                </div>

                <script>
                document.addEventListener("DOMContentLoaded", function() {
                    // افزودن گزینه‌های روز
                    const daySelect = document.getElementById("daySelect");
                    for (let day = 1; day <= 31; day++) {
                        let option = document.createElement("option");
                        option.value = day;
                        option.textContent = day;
                        daySelect.appendChild(option);
                    }

                    // افزودن گزینه‌های ماه
                    const months = [
                        "فروردین", "اردیبهشت", "خرداد", "تیر",
                        "مرداد", "شهریور", "مهر", "آبان",
                        "آذر", "دی", "بهمن", "اسفند"
                    ];
                    const monthSelect = document.getElementById("monthSelect");
                    months.forEach((month, index) => {
                        let option = document.createElement("option");
                        option.value = index + 1;
                        option.textContent = month;
                        monthSelect.appendChild(option);
                    });

                    // افزودن گزینه‌های سال
                    const yearSelect = document.getElementById("yearSelect");
                    for (let year = 1403; year >= 1303; year--) {
                        let option = document.createElement("option");
                        option.value = year;
                        option.textContent = year;
                        yearSelect.appendChild(option);
                    }
                });
                </script>
                <style>
                .form-select {
                    width: 32%;
                    background-color: #333;
                    color: #fff;
                    border: 1px solid #444;
                    text-align: right;
                    padding: 5px;
                }
                </style>



                <!-- Action Buttons (Half-width buttons) -->
                <div class="row mt-4">
                    <div class="col-6">
                        <button class="btn w-100" name="act" value="submit_profile"
                            style="background-color: #3899A0; border-radius: 5px; color: white;">تایید</button>
                    </div>
                    <div class="col-6">
                        <button class="btn w-100 btn-secondary" style="border-radius: 5px;">بازگشت</button>
                    </div>
                </div>
            </div>


        </form>
    </div>
    <script>
    // Function to update the profile image when a new image is selected
    function updateImage(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            const profileImage = document.getElementById('profileImage');
            profileImage.src = e.target.result; // Update the profile image
        }

        if (file) {
            reader.readAsDataURL(file); // Read the file as a data URL
        }
    }
    </script>
</div>