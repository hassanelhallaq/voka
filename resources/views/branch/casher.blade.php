  <link href='https://fonts.googleapis.com/css?family=Cairo' rel='stylesheet'>
  <style>
      #mainPage {
          font-family: "cairo";
      }
      .cashe-content-none {
          display: none;
      }
      .cashe-content-active {
          display: block;
      }
  </style>
  <div id="mainPage">
      <div class="inventory-table">
          <div class="row pt-2">
              <div class="col-md-1"></div>
              <div class="col-md-4">
                  <h1>عمليات الجرد   </h1>
              </div>
              <div class="col-md-2"></div>
              <div class="col-md-4">
                  <div class="d-flex justify-content-around">
                      <button class="new-inventory-btn btn btn-primary">اضافة جرد </button>
                  </div>
              </div>
              <div class="col-md-1"></div>
          </div>
          <div class="row">
              <div class="col-md-1"></div>
              <div class="col-md-10">
                  <table class="table table-dark table-striped mt-3">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">الفرع</th>
                          <th scope="col">التاريخ</th>
                          <th scope="col">الوقت</th>
                          <th scope="col">الشفت</th>
                          <th scope="col">الكاش(نقدى)</th>
                          <th scope="col">ماكينة الدفع</th>
                          <th scope="col">دفع اليكترونى</th>
                          <th scope="col">الرصيد والمحفظة</th>
                          <th scope="col">الحالة</th>
                          <th scope="col">الحالة</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td>التحلية</td>
                          <td>7/8/23</td>
                          <td>02:30 PM</td>
                          <td>صباحى</td>
                          <td>8,800</td>
                          <td>1,200</td>
                          <td>33,470</td>
                          <td>4,700</td>
                          <td>قيد المراجعة</td>
                          <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#inventory-modal">
                                  عرض
                                </button>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="inventory-modal" tabindex="-1" aria-labelledby="inventory-modalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="inventory-modalLabel">الجرد </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        عرض حالة الجرد
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="view-cashe-content btn btn-primary">عرض السجل </button>
                                        <button type="button" class="view-cashe-content btn btn-primary">استلام الجرد </button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">1</th>
                          <td>التحلية</td>
                          <td>7/8/23</td>
                          <td>02:30 PM</td>
                          <td>صباحى</td>
                          <td>8,800</td>
                          <td>1,200</td>
                          <td>33,470</td>
                          <td>4,700</td>
                          <td>قيد المراجعة</td>
                          <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#inventory-modal">
                                  عرض
                                </button>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="inventory-modal" tabindex="-1" aria-labelledby="inventory-modalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="inventory-modalLabel">الجرد </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        عرض حالة الجرد
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="view-cashe-content btn btn-primary">عرض السجل </button>
                                        <button type="button" class="deliver-inventory btn btn-primary">استلام الجرد </button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
              </div>
              <div class="col-md-1"></div>
          </div>
      </div>
        <div class="cashe-content cashe-content-none">
             <div class="row pt-2">
          <div class="col-md-1"></div>
          <div class="col-md-4">
              <h1>اضافة عملية جرد جديدة</h1>
          </div>
          <div class="col-md-2"></div>
          <div class="col-md-4">
              <div class="d-flex justify-content-around">
                  <button class="btn btn-primary">الغاء الجرد</button>
                  <button class="btn btn-primary">حفظ مسودة</button>
                  <button class="btn btn-primary">أرسل الجرد</button>
              </div>
          </div>
          <div class="col-md-1"></div>
      </div>
          <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-8">
              <form class="form" method="post" id='create_form'>
                  @csrf
                  <div class="card-body">
                      <div class="row">
                          <div class="col-md-12 my-5">
                              <div class="row">
                                  <div class="form-group  col-md-3">
                                      <label><strong>التاريخ</strong></label>
    
                                      <input type="date" id="date" class="form-control form-control-solid"
                                          placeholder="date" />
    
                                  </div>
                                  <div class="col-md-5 pt-5">
                                      <div class="d-flex d-flex justify-content-around">
                                          <div class="checkbox-wrapper-33">
                                              <label class="checkbox">
                                                  <input type="checkbox" id="checkbox1" value="شفت صباحى"
                                                      class="checkbox__trigger visuallyhidden">
                                                  <span class="checkbox__symbol">
                                                      <svg xmlns="http://www.w3.org/2000/svg" version="1"
                                                          viewBox="0 0 28 28" height="28px" width="28px"
                                                          class="icon-checkbox" aria-hidden="true">
                                                          <path d="M4 14l8 7L24 7"></path>
                                                      </svg>
                                                  </span>
                                                  <p class="checkbox__textwrapper">شفت صباحى</p>
                                              </label>
                                          </div>
                                          <div class="checkbox-wrapper-33">
                                              <label class="checkbox">
                                                  <input type="checkbox" id="checkbox2" value="شفت مسائي"
                                                      class="checkbox__trigger visuallyhidden">
                                                  <span class="checkbox__symbol">
                                                      <svg xmlns="http://www.w3.org/2000/svg" version="1"
                                                          viewBox="0 0 28 28" height="28px" width="28px"
                                                          class="icon-checkbox" aria-hidden="true">
                                                          <path d="M4 14l8 7L24 7"></path>
                                                      </svg>
                                                  </span>
                                                  <p class="checkbox__textwrapper">شفت مسائي</p>
                                              </label>
                                          </div>
                                          <div class="checkbox-wrapper-33">
                                              <label class="checkbox">
                                                  <input type="checkbox" id="checkbox3" value="دوام كامل"
                                                      class="checkbox__trigger visuallyhidden">
                                                  <span class="checkbox__symbol">
                                                      <svg xmlns="http://www.w3.org/2000/svg" version="1"
                                                          viewBox="0 0 28 28" height="28px" width="28px"
                                                          class="icon-checkbox" aria-hidden="true">
                                                          <path d="M4 14l8 7L24 7"></path>
                                                      </svg>
                                                  </span>
                                                  <p class="checkbox__textwrapper">دوام كامل </p>
                                              </label>
                                          </div>
                                      </div>
    
    
                                  </div>
                                  <div class="col-md-9"></div>
                              </div>
                          </div>
    
                          <div class="row">
                              <h1 class="mb-4"> قسم جرد الكاش </h1>
                              <div class="form-group col-md-3">
                                  <label>اجمالي مبيعات الكاش المسجلة :</label>
    
                                  <input type="number" id="cash" value="{{ $cash }}" readonly
                                      onInput="expensesSum()" class="form-control form-control-solid invalid" />
    
                              </div>
                              <div class="form-group col-md-3">
    
                                  <label> ادخل قيمة الكاش داخل الصندوق:</label>
    
                                  <input type="number" id="cash_found" onInput="expensesSum()"
                                      class="form-control form-control-solid" />
    
                              </div>
                              <div class="form-group col-md-3">
    
                                  <label> صافي الجرد:</label>
    
                                  <input type="number" id="expenses_sum" onInput="expensesSum()" readonly
                                      class="form-control form-control-solid" />
    
                              </div>
                              <div class="form-group col-md-3">
    
                                  <label> حالة الجرد:</label>
    
                                  <input type="text" id="status_cash" onInput="expensesSum()"readonly
                                      class="form-control form-control-solid" />
    
                              </div>
                          </div>
                      </div>
    
                      <div class="row my-4">
                          <h1 class="mb-4">قسم جرد ماكينة الدفع</h1>
                          <div class="form-group col-md-3">
    
                              <label> اجمالي مبيعات ماكينة الدفع :</label>
    
                              <input type="number" id="credit" value="{{ $visa }}" readonly
                                  class="form-control form-control-solid" />
    
                          </div>
                          <div class="form-group col-md-3">
    
                              <label> ادخل قيمة اجمالي المدفوعات:</label>
    
                              <input type="number" onInput="vouchersIn()" id="credit_trans"
                                  class="form-control form-control-solid" onInput="vouchersIn()" />
    
                          </div>
                          <div class="form-group col-md-3">
    
                              <label> صافي الجرد:</label>
    
                              <input type="number" id="credit_sum" onInput="vouchersIn()"
                                  class="form-control form-control-solid" readonly />
    
                          </div>
    
                          <div class="form-group col-md-3">
    
                              <label> حالة الجرد:</label>
    
                              <input type="text" id="credit_status" onInput="vouchersIn()" readonly
                                  class="form-control form-control-solid" />
    
                          </div>
                      </div>
    
                      <div class="row my-4">
                          <h1 class="mb-4">قسم جرد الدفع الالكتروني</h1>
                          <div class="form-group col-md-3">
    
                              <label> اجمالي مبيعات ماكينة الدفع
                                  :</label>
    
                              <input type="number" id="online" value="{{ $online }}" readonly
                                  class="form-control form-control-solid" />
    
                          </div>
                          <div class="form-group col-md-3">
    
                              <label> ادخل قيمة اجمالي المدفوعات:</label>
    
                              <input type="number" onInput="creditTrans()" id="online_trans"
                                  class="form-control form-control-solid" onInput="creditTrans()" />
    
                          </div>
                          <div class="form-group col-md-3">
    
                              <label> صافي الجرد:</label>
    
                              <input type="number" onInput="creditTrans()" id="online_sum"
                                  class="form-control form-control-solid" onInput="creditTrans()" />
    
                          </div>
    
                          <div class="form-group col-md-3">
    
                              <label> حالة الجرد:</label>
    
                              <input type="text" id="online_status" onInput="creditTrans()" readonly
                                  class="form-control form-control-solid" />
    
                          </div>
                      </div>
                      <div class="row my-4">
                          <h1 class="mb-4">استخدامات الرصيد والمحفظة
                          </h1>
                          <div class="form-group col-md-3">
    
                              <label> اجمالي الرصيد المسجل
                                  :</label>
    
                              <input type="number" id="point" value="{{ $online }}" readonly
                                  class="form-control form-control-solid" />
    
                          </div>
                          <div class="form-group col-md-3">
    
                              <label> اجمالي الرصيد المستخدم:</label>
    
                              <input type="number" onInput="pointTrans()" id="point_trans"
                                  class="form-control form-control-solid" onInput="creditTrans()" />
    
                          </div>
                          <div class="form-group col-md-3">
    
                              <label> صافي الجرد:</label>
    
                              <input type="number" onInput="pointTrans()" id="point_sum"
                                  class="form-control form-control-solid" readonly onInput="creditTrans()" />
    
                          </div>
    
                          <div class="form-group col-md-3">
    
                              <label> حالة الجرد:</label>
    
                              <input type="text" id="point_status" onInput="pointTrans()" readonly
                                  class="form-control form-control-solid" />
    
                          </div>
                      </div>
                      <hr>
    
    
                  </div>
                  <div class="row align-items-end">
                      <div class="form-group col-md-9">
    
                          <label>ادخل مالحظة إدارية
                          </label>
    
                          <textarea type="text" id="remarks" class="form-control form-control-solid" placeholder="remarks"></textarea>
    
                      </div>
                      <div class="col-md-3">
    
                          <button type="button" onclick="performStore()" id="save"
                              class="btn btn-primary mr-2 w-100">{{ __('Submit') }}</button>
    
    
    
                      </div>
                  </div>
    
              </form>
          </div>
          <div class="col-md-3"></div>
          </div>
      </div>
       <div class="new-inventory-content cashe-content-none">
            <div class="row pt-2">
          <div class="col-md-1"></div>
          <div class="col-md-4">
              <h1>اضافة عملية جرد جديدة</h1>
          </div>
          <div class="col-md-2"></div>
          <div class="col-md-4">
              <div class="d-flex justify-content-around">
                  <button class="btn btn-primary">الغاء الجرد</button>
                  <button class="btn btn-primary">حفظ مسودة</button>
                  <button class="btn btn-primary">أرسل الجرد</button>
              </div>
          </div>
          <div class="col-md-1"></div>
      </div>
          <div class="row">
          <div class="col-md-9">
              <form class="form" method="post" id='create_form'>
                  @csrf
                  <div class="card-body">
                      <div class="row">
                          <div class="col-md-12 my-5">
                              <div class="row">
                                  <div class="form-group  col-md-3">
                                      <label><strong>التاريخ</strong></label>
    
                                      <input type="date" id="date" class="form-control form-control-solid"
                                          placeholder="date" />
    
                                  </div>
                                  <div class="col-md-5 pt-5">
                                      <div class="d-flex d-flex justify-content-around">
                                          <div class="checkbox-wrapper-33">
                                              <label class="checkbox">
                                                  <input type="checkbox" id="checkbox1" value="شفت صباحى"
                                                      class="checkbox__trigger visuallyhidden">
                                                  <span class="checkbox__symbol">
                                                      <svg xmlns="http://www.w3.org/2000/svg" version="1"
                                                          viewBox="0 0 28 28" height="28px" width="28px"
                                                          class="icon-checkbox" aria-hidden="true">
                                                          <path d="M4 14l8 7L24 7"></path>
                                                      </svg>
                                                  </span>
                                                  <p class="checkbox__textwrapper">شفت صباحى</p>
                                              </label>
                                          </div>
                                          <div class="checkbox-wrapper-33">
                                              <label class="checkbox">
                                                  <input type="checkbox" id="checkbox2" value="شفت مسائي"
                                                      class="checkbox__trigger visuallyhidden">
                                                  <span class="checkbox__symbol">
                                                      <svg xmlns="http://www.w3.org/2000/svg" version="1"
                                                          viewBox="0 0 28 28" height="28px" width="28px"
                                                          class="icon-checkbox" aria-hidden="true">
                                                          <path d="M4 14l8 7L24 7"></path>
                                                      </svg>
                                                  </span>
                                                  <p class="checkbox__textwrapper">شفت مسائي</p>
                                              </label>
                                          </div>
                                          <div class="checkbox-wrapper-33">
                                              <label class="checkbox">
                                                  <input type="checkbox" id="checkbox3" value="دوام كامل"
                                                      class="checkbox__trigger visuallyhidden">
                                                  <span class="checkbox__symbol">
                                                      <svg xmlns="http://www.w3.org/2000/svg" version="1"
                                                          viewBox="0 0 28 28" height="28px" width="28px"
                                                          class="icon-checkbox" aria-hidden="true">
                                                          <path d="M4 14l8 7L24 7"></path>
                                                      </svg>
                                                  </span>
                                                  <p class="checkbox__textwrapper">دوام كامل </p>
                                              </label>
                                          </div>
                                      </div>
    
    
                                  </div>
                                  <div class="col-md-9"></div>
                              </div>
                          </div>
    
                          <div class="row">
                              <h1 class="mb-4"> قسم جرد الكاش </h1>
                              <div class="form-group col-md-3">
                                  <label>اجمالي مبيعات الكاش المسجلة :</label>
    
                                  <input type="number" id="cash" value="{{ $cash }}" readonly
                                      onInput="expensesSum()" class="form-control form-control-solid invalid" />
    
                              </div>
                              <div class="form-group col-md-3">
    
                                  <label> ادخل قيمة الكاش داخل الصندوق:</label>
    
                                  <input type="number" id="cash_found" onInput="expensesSum()"
                                      class="form-control form-control-solid" />
    
                              </div>
                              <div class="form-group col-md-3">
    
                                  <label> صافي الجرد:</label>
    
                                  <input type="number" id="expenses_sum" onInput="expensesSum()" readonly
                                      class="form-control form-control-solid" />
    
                              </div>
                              <div class="form-group col-md-3">
    
                                  <label> حالة الجرد:</label>
    
                                  <input type="text" id="status_cash" onInput="expensesSum()"readonly
                                      class="form-control form-control-solid" />
    
                              </div>
                          </div>
                      </div>
    
                      <div class="row my-4">
                          <h1 class="mb-4">قسم جرد ماكينة الدفع</h1>
                          <div class="form-group col-md-3">
    
                              <label> اجمالي مبيعات ماكينة الدفع :</label>
    
                              <input type="number" id="credit" value="{{ $visa }}" readonly
                                  class="form-control form-control-solid" />
    
                          </div>
                          <div class="form-group col-md-3">
    
                              <label> ادخل قيمة اجمالي المدفوعات:</label>
    
                              <input type="number" onInput="vouchersIn()" id="credit_trans"
                                  class="form-control form-control-solid" onInput="vouchersIn()" />
    
                          </div>
                          <div class="form-group col-md-3">
    
                              <label> صافي الجرد:</label>
    
                              <input type="number" id="credit_sum" onInput="vouchersIn()"
                                  class="form-control form-control-solid" readonly />
    
                          </div>
    
                          <div class="form-group col-md-3">
    
                              <label> حالة الجرد:</label>
    
                              <input type="text" id="credit_status" onInput="vouchersIn()" readonly
                                  class="form-control form-control-solid" />
    
                          </div>
                      </div>
    
                      <div class="row my-4">
                          <h1 class="mb-4">قسم جرد الدفع الالكتروني</h1>
                          <div class="form-group col-md-3">
    
                              <label> اجمالي مبيعات ماكينة الدفع
                                  :</label>
    
                              <input type="number" id="online" value="{{ $online }}" readonly
                                  class="form-control form-control-solid" />
    
                          </div>
                          <div class="form-group col-md-3">
    
                              <label> ادخل قيمة اجمالي المدفوعات:</label>
    
                              <input type="number" onInput="creditTrans()" id="online_trans"
                                  class="form-control form-control-solid" onInput="creditTrans()" />
    
                          </div>
                          <div class="form-group col-md-3">
    
                              <label> صافي الجرد:</label>
    
                              <input type="number" onInput="creditTrans()" id="online_sum"
                                  class="form-control form-control-solid" onInput="creditTrans()" />
    
                          </div>
    
                          <div class="form-group col-md-3">
    
                              <label> حالة الجرد:</label>
    
                              <input type="text" id="online_status" onInput="creditTrans()" readonly
                                  class="form-control form-control-solid" />
    
                          </div>
                      </div>
                      <div class="row my-4">
                          <h1 class="mb-4">استخدامات الرصيد والمحفظة
                          </h1>
                          <div class="form-group col-md-3">
    
                              <label> اجمالي الرصيد المسجل
                                  :</label>
    
                              <input type="number" id="point" value="{{ $online }}" readonly
                                  class="form-control form-control-solid" />
    
                          </div>
                          <div class="form-group col-md-3">
    
                              <label> اجمالي الرصيد المستخدم:</label>
    
                              <input type="number" onInput="pointTrans()" id="point_trans"
                                  class="form-control form-control-solid" onInput="creditTrans()" />
    
                          </div>
                          <div class="form-group col-md-3">
    
                              <label> صافي الجرد:</label>
    
                              <input type="number" onInput="pointTrans()" id="point_sum"
                                  class="form-control form-control-solid" readonly onInput="creditTrans()" />
    
                          </div>
    
                          <div class="form-group col-md-3">
    
                              <label> حالة الجرد:</label>
    
                              <input type="text" id="point_status" onInput="pointTrans()" readonly
                                  class="form-control form-control-solid" />
    
                          </div>
                      </div>
                      <hr>
    
    
                  </div>
                  <div class="row align-items-end">
                      <div class="form-group col-md-9">
    
                          <label>ادخل مالحظة إدارية
                          </label>
    
                          <textarea type="text" id="remarks" class="form-control form-control-solid" placeholder="remarks"></textarea>
    
                      </div>
                      <div class="col-md-3">
    
                          <button type="button" onclick="performStore()" id="save"
                              class="btn btn-primary mr-2 w-100">{{ __('Submit') }}</button>
    
    
    
                      </div>
                  </div>
    
              </form>
          </div>
          <div class="col-md-3"></div>
          </div>
      </div>
 </div>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
      <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
      <script src="{{ asset('crudjs/crud.js') }}"></script>
      <script>
          function expensesSum() {
              var cash_found = parseFloat(document.getElementById("cash_found").value);
              var expenses_sum = parseFloat(document.getElementById("expenses_sum").value);
              var cash = document.getElementById('cash').value;
              var cash_foundInput = document.getElementById('cash_found');
              var expenses_sumInput = document.getElementById('expenses_sum');
              var total = cash - cash_found;
              expenses_sumInput.value = total;
              var statusCash = document.getElementById('status_cash');
              if (total == 0) {
                  statusCash.value = 'لا يوجد نقص';
              } else {
                  statusCash.value = ' يوجد نقص';
              }
          }

          function vouchersIn() {





              var credit_trans = parseFloat(document.getElementById("credit_trans").value);
              var credit_sum = document.getElementById('credit_sum');
              var credit = document.getElementById('credit').value;
              var credit_status = document.getElementById('credit_status');


              var expenses_sumInput = document.getElementById('expenses_sum');

              var total = credit - credit_trans;
              credit_sum.value = total;
              if (total == 0) {
                  credit_status.value = 'لا يوجد نقص';
              } else {
                  credit_status.value = ' يوجد نقص';
              }
          }

          function creditTrans() {





              var online = parseFloat(document.getElementById("online").value);
              var online_trans = parseFloat(document.getElementById("online_trans").value);

              var online_sum = document.getElementById('online_sum');
              var online_status = document.getElementById('online_status');

              var total = online - online_trans;
              online_sum.value = total;
              if (total == 0) {
                  online_status.value = 'لا يوجد نقص';
              } else {
                  online_status.value = ' يوجد نقص';
              }

          }

          function pointTrans() {
              var online = parseFloat(document.getElementById("point").value);
              var online_trans = parseFloat(document.getElementById("point_trans").value);
              var online_sum = document.getElementById('point_sum');
              var online_status = document.getElementById('point_status');
              var total = online - online_trans;
              online_sum.value = total;
              if (total == 0) {
                  online_status.value = 'لا يوجد نقص';
              } else {
                  online_status.value = ' يوجد نقص';
              }

          }


          const checkboxes = document.querySelectorAll('.checkbox__trigger');
          let selectedValue = ''; // Initialize the selectedValue variable

          // Function to handle the selected value
          function handleSelectedValue(value) {
              selectedValue = value; // Update the selectedValue variable with the selected value
          }

          // Attach a click event listener to each checkbox
          checkboxes.forEach(checkbox => {
              checkbox.addEventListener('click', function() {
                  if (this.checked) {
                      const value = this.value; // Get the selected value
                      handleSelectedValue(value); // Call the function to update selectedValue
                  }
              });
          });
          var avatar1 = new KTImageInput('kt_image_1');

          function performStore() {

              let formData = new FormData();
              formData.append('cash', document.getElementById('cash').value);
              formData.append('cash_found', document.getElementById('cash_found').value);
              formData.append('expenses_sum', document.getElementById('expenses_sum').value);
              formData.append('status_cash', document.getElementById('status_cash').value);
              formData.append('credit', document.getElementById('credit').value);
              formData.append('credit_trans', document.getElementById('credit_trans').value);
              formData.append('credit_sum', document.getElementById('credit_sum').value);
              formData.append('credit_status', document.getElementById('credit_status').value);
              formData.append('online', document.getElementById('online').value);
              formData.append('online_trans', document.getElementById('online_trans').value);
              formData.append('online_sum', document.getElementById('online_sum').value);
              formData.append('online_status', document.getElementById('online_status').value);
              formData.append('point', document.getElementById('point').value);
              formData.append('point_trans', document.getElementById('point_trans').value);
              formData.append('point_sum', document.getElementById('point_sum').value);
              formData.append('point_status', document.getElementById('point_status').value);
              formData.append('date', document.getElementById('date').value);
              formData.append('remarks', document.getElementById('remarks').value);
              formData.append('shift_type', selectedValue); // Use the selectedValue here
              store('/branch/casher/store', formData, '/branch/casher/create')
          }
      </script>
      <script>
          $(document).ready(function () {
             $('.view-cashe-content').on('click', function(){
                   $('.cashe-content').removeClass('cashe-content-none').addClass('cashe-content-active');
                   $('.inventory-table').addClass('cashe-content-none');
               });
               
                $('.new-inventory-btn').on('click', function(){
                   $('.new-inventory-content').addClass('cashe-content-active');
                   $('.cashe-content').removeClass('cashe-content-active');
                   $('.inventory-table').addClass('cashe-content-none');
                   
               });
          });
      </script>
