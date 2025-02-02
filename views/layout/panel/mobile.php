<div id="mobile" class="content-box" style=" <?=(get_query_var('arma') != 'mobile')?'display: none;' : ''?> ">
    <h5 class="m-0 text-center">تغییر شماره موبایل</h5>
    <div class="container mt-5">
        <div class="card mx-auto"
            style="max-width: 500px; position: relative; border-radius: 10px; overflow: hidden; background-color: #242323;">
            <div class="card-header bg-primary text-white text-center py-3">
            </div>
            <div class="card-body p-4" style="background-color: #242323; color: #fff;">
                <!-- Mobile Field -->
                <div class="mb-3">
                    <label for="profileName" class="form-label d-block text-white">شماره موبایل:</label>
                    <input type="text" id="profileName" class="form-control"
                        placeholder="لطفا شماره موبایل خود را وارد نمایید"
                        style="background-color: #333; color: #fff; border: 1px solid #444;">
                </div>
                <!-- Action Buttons (Full-width button) -->
                <div class="row mt-4">
                    <div class="col-12">
                        <button class="btn w-100"
                            style="background-color: #3899A0; border-radius: 5px; color: white;">ارسال</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>