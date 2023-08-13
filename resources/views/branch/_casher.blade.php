    <div class="col-md-3" id="casher-section">
        <div class="side-place">
            <div id="tab-place" class="c-tab-pane fade show active">
                <ol class="table-list list-group list-group-numbered reversed">
                    <li
                        class="menu-info-list list-group-item d-flex  flex-column justify-content-center align-items-center text-center p-0">
                        <a class="new-reserv-btn btn btn-link w-100" href="{{ route('branch.reservation') }}">
                            <i class="fa-solid fa-plus"></i>
                            <p>انشاء حجز جديد </p>
                        </a>
                    </li>

                </ol>
                <ol class="list-group reversed casher-box mt-5 none">
                    <li class="list-group-item no-number  ">
                         <div class="tax d-flex justify-content-between align-items-start my-4 total w-100">
                                <div class="discount-inputs input-group">
                                    <label  class="col-sm-2 col-form-label"> %</label>
                                  <input class="discount-input form-control bg-dark text-light" lang="en" type="number" placeholder="قيمة الخصم" aria-label="default input example">
                                  <button class="btn btn-dark menu-btn" type="button">تطبيق</button>
                                </div>
                            </div>
                        <div class="sub-total d-flex justify-content-between align-items-start">
                            <div class="me-2 ms-auto">
                                <div class="fw-bold"> حاصل الجمع</div>
                            </div>
                            <span class="sub-total-number"> 260 </span>
                            <span> ريال</span>
                        </div>

                        <div class="tax d-flex justify-content-between align-items-start mt-4">
                            <div class="me-2 ms-auto">
                                <div class="fw-bold"> ضريبة</div>
                            </div>
                            <span class="taxes">10%</span>
                        </div>
                        <div class="tax d-flex justify-content-between align-items-start mt-4 total">
                            <div class="me-2 ms-auto">
                                <div class="fw-bold"> الإجمالى</div>
                            </div>
                            <span class="table-total">286 </span>
                            <span> ريال</span>
                        </div>
                        <div class="payment-method">
                            <div class="row">
                                <div class="col-4">
                                    <div class="payment-icon active d-flex justify-content-center align-items-center">
                                        <i class="fa-solid fa-sack-dollar"></i>
                                    </div>
                                    <p class="text-center">كاش</p>
                                </div>
                                <div class="col-4">
                                    <div class="payment-icon d-flex justify-content-center align-items-center">
                                        <i class="fa-solid fa-credit-card"></i>
                                    </div>
                                    <p class="text-center">بطاقة ائتمان</p>
                                </div>
                                <div class="col-4">
                                    <div class="payment-icon d-flex justify-content-center align-items-center">
                                        <i class="fa-solid fa-wallet"></i>
                                    </div>
                                    <p class="text-center">المحفظة</p>
                                </div>
                            </div>
                            <div class="payment-btn my-3 text-center">
                                <div class="btn btn-primary btn-lg w-100" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">ادفع الآن</div>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">تأكيد الدفع</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="consfirm-text">هل تريد تأكيد الدفع</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary">تأكيد</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">لا </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ol>
            </div>
        </div>
    </div>
