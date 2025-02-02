<div id="edit-profile" class="content-box"
    style="                       <?php echo(get_query_var('arma') != 'edit-profile') ? 'display: none;' : '' ?> ">
    <h5 class="m-0 text-center">ویرایش پروفایل</h5>
    <div class="card mx-auto mt-5"
        style="max-width: 500px; position: relative; border-radius: 10px; overflow: hidden; background-color: #242323;">
        <div class="card-header bg-primary text-white text-center py-3">
            ***
        </div>
        <form accept="" method="POST" enctype="multipart/form-data">
            <?php wp_nonce_field('arma_nonce' . arma_cookie()); ?>

            <div class="card-body p-4" style="background-color: #242323; color: #fff;">
                <!-- Profile Image -->
                <div class="text-center mb-3">
                    <img id="profileImage"
                        src="<?php echo($this_user->user_avatar) ? wp_get_attachment_image_url($this_user->user_avatar) : arma_panel_image('panel/placeHolderUserImage.png') ?>"
                        alt="Profile Image" class="img-fluid rounded-circle mb-2"
                        style="width: 70px; height: 70px; object-fit: cover; border: 5px solid #3899a0;">
                    <div>
                        <button class="btn btn-link text-white mt-2" type="button"
                            onclick="document.getElementById('fileInput').click();">انتخاب تصویر</button>
                        <input type="file" id="fileInput" style="display: none;" name="user_image" accept="image/*"
                            onchange="updateImage(event)">
                    </div>
                </div>

                <!-- Name Field -->
                <div class="mb-3">
                    <label for="profileName" class="form-label d-block text-white">نام پروفایل</label>
                    <input type="text" id="profileName" name="profileName" class="form-control"
                        placeholder="نام پروفایل خود را وارد کنید"
                        style="background-color: #333; color: #fff; border: 1px solid #444;"
                        value="<?php echo $this_user->display_name ?>">
                </div>

                <!-- Gender Field -->
                <div class="mb-3">
                    <label for="gender" class="form-label d-block text-white">جنسیت</label>
                    <select id="gender" class="form-select w-100" name="gender"
                        style="background-color: #333; color: #fff; border: 1px solid #444;">
                        <option <?php selected('man', $this_user->gender)?> value="man" selected>آقا</option>
                        <option <?php selected('woman', $this_user->gender)?> value="woman">خانم</option>
                        <option <?php selected('know', $this_user->gender)?> value="know">ترجیح میدهم اعلام نکنم
                        </option>
                    </select>
                </div>

                <!-- Date of Birth Field -->
                <div class="mb-3">
                    <label class="form-label d-block text-white" for="birthday">تاریخ تولد</label>
                    <div class="d-flex justify-content-between">
                        <input data-jdp id="birthday" name="birthday" type="text" class="form-control"
                            placeholder="تاریخ تولد خود را وارد کنید"
                            style="background-color: #333; color: #fff; border: 1px solid #444;"
                            value="<?php echo($this_user->birthday) ? tarikh($this_user->birthday) : '' ?>">
                    </div>
                </div>


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