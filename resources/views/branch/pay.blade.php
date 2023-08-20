<div class="reservation-tabs notes pt-5 mt-5" id="pay">
    <div class="container">
        <div class="row">
            <div class="col-md-10"></div>
            <div class="col-md-2">
                <div class="change-content btn btn-primary" data-id="#alltime">السابق</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <ol class="list-group reversed paing-wrp">
                    <li class="list-group-item no-number" id="reservation-details">
                        <div class="sub-total d-flex justify-content-between align-items-start w-100">
                            <div class="me-2 ms-auto">
                                <div class="fw-bold"> المجموع </div>
                            </div>
                            <span class="payment-price"> </span>
                            <span>ريال</span>
                        </div>
                        <!--<div-->
                        <!--    class="tax d-flex justify-content-between align-items-start mt-4 w-100">-->
                        <!--    <div class="me-2 ms-auto">-->
                        <!--        <div class="fw-bold"> ضريبة</div>-->
                        <!--    </div>-->
                        <!--    <span class="tax">10%</span>-->
                        <!--</div>-->
                        <div class="tax d-flex justify-content-between align-items-start mt-4 total w-100">
                            <div class="me-2 ms-auto">
                                <div class="fw-bold"> الضريبة 15% </div>
                            </div>
                            <span class="pay-tax"> </span>
                            <span>ريال</span>
                        </div>
                        <div class="tax d-flex justify-content-between align-items-start mt-4 total w-100">
                            <div class="me-2 ms-auto">
                                <div class="fw-bold"> الأجمالى </div>
                            </div>
                            <span class="pay-total"> </span>
                            <span>ريال</span>
                        </div>
                        <div class="tax d-flex justify-content-between align-items-start mt-4 total w-100">

                            <div class="discount-inputs input-group">
                                <label class="col-sm-6 col-form-label text-right"> الخصم
                                    <select class="form-control discount-select bg-dark " data-bs-theme="dark">
                                        <option value="percent" selected>نسبة مئوية</option>
                                        <!--<option value="testing">كوبون</option>-->

                                        <option value="copoun">كوبون</option>
                                    </select>
                                </label>
                                <input class="discount-input form-control" lang="en" type="number"
                                    placeholder="قيمة الخصم" aria-label="default input example">
                                <button class="btn btn-primary discount-btn-js" type="button">تطبيق</button>
                            </div>
                        </div>
                        <div class="tax d-flex justify-content-between align-items-start mt-4 total w-100">
                            <div class="me-2 ms-auto">
                                <div class="fw-bold"> الأجمالى بعد الخصم</div>
                            </div>
                            <span class="pay-total-discount"> </span>
                            <span>ريال</span>
                        </div>
                        <div class="payment-method w-100">
                            <div class="row">
                                <div class="col-4">
                                    <div class="payment-icon d-flex justify-content-center align-items-center"
                                        id="cash">
                                        <i class="fa-solid fa-sack-dollar"></i>
                                    </div>
                                    <p class="text-center">كاش</p>
                                </div>
                                <div class="col-4">
                                    <div class="payment-icon d-flex justify-content-center align-items-center"
                                        id="credit-card">
                                        <i class="fa-solid fa-credit-card"></i>
                                    </div>
                                    <p class="text-center">بطاقة ائتمان</p>
                                </div>
                                <div class="col-4">
                                    <div class="payment-icon d-flex justify-content-center align-items-center"
                                        id="wallet">
                                        <i class="fa-solid fa-wallet"></i>
                                    </div>
                                    <p class="text-center">المحفظة</p>
                                </div>
                            </div>
                            <div class="payment-btn my-3 text-center">
                                <div class="row">
                                    <div class="col-md-6">
                                        <button class="btn btn-primary w-100" type="button" data-bs-toggle="modal"
                                            data-bs-target="#modalPay">
                                            تسجيل الطلب
                                        </button>
                                    </div>

                                    <div class="col-md-6">
                                        <button class="btn btn-primary w-100" type="button" disabled
                                            id="activate-reservation-btn">
                                            تفعيل الحجز
                                        </button>
                                    </div>



                                    <div class="col-md-6">
                                        <button class="btn btn-primary bill-print w-100" type="button" data-bs-toggle="modal"
                                            data-bs-target="#pill" disabled>

                                            طباعة الفاتورة
                                        </button>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-primary w-100" type="button" disabled>
                                            تغيير الصالة
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </li>
                </ol>
            </div>
            <div class="col-md-3"></div>
        </div>

    </div>
</div>
