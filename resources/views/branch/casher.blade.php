  @extends('branch.parent')
  @section('contentFront')
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

          .radios label {
              margin-bottom: 0 !important;
              color: var(--orange);
          }

          .radios input[type="checkbox"],
          input[type="radio"] {
              box-sizing: border-box;
              padding: 0;
              opacity: 1;
          }
      </style>
      <div class='col-md-11'>
          <div class="inventory-table">
              <div class="row pt-2">
                  <div class="col-md-1"></div>
                  <div class="col-md-4">
                      <h1>عمليات الجرد </h1>
                  </div>
                  <div class="col-md-2"></div>
                  <div class="col-md-4">
                      <div class="d-flex justify-content-around">
                          <button class="view-cashe-content btn btn-primary">اضافة جرد </button>
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
                                  <th scope="col">الوقت</th>
                                  <th scope="col">الشفت</th>
                                  <th scope="col">الكاش(نقدى)</th>
                                  <th scope="col">ماكينة الدفع</th>
                                  <th scope="col">دفع اليكترونى</th>
                                  <th scope="col">الرصيد والمحفظة</th>
                                  <th scope="col">الحالة</th>
                              </tr>
                          </thead>
                          <tbody>

                              <tr>
                                  @foreach ($cashers as $i => $casher)
                              <tr>
                                  <td>
                                      {{ $i + 1 }}
                                  </td>
                                  <td>
                                      {{ $casher->branch->name }}
                                  </td>
                                  <td>
                                      {{ $casher->date }}
                                  </td>

                                  <td>
                                      {{ $casher->shift_type }}
                                  </td>
                                  <td>
                                      {{ $casher->cash }}
                                  </td>
                                  <td>
                                      {{ $casher->credit }}
                                  </td>
                                  <td>
                                      {{ $casher->online }}
                                  </td>
                                  <td>
                                      {{ $casher->point }}
                                  </td>
                                  <td>
                                      @if ($casher->status == 'underreview')
                                          قيد المراجعه
                                      @else
                                          تم المراجعة
                                      @endif
                                  </td>
                                  <td>
                                      <!--<button type="button" class="view-cashe-content btn btn-primary">استلام الجرد-->
                                      <!--</button>-->
                                      <!--<button type="button" class="btn btn-secondary"-->
                                      <!--    data-bs-dismiss="modal">اغلاق</button>-->
                                      <div class="modal fade" id="inventory-modal" tabindex="-1"
                                          aria-labelledby="inventory-modalLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <h1 class="modal-title fs-5" id="inventory-modalLabel">الجرد </h1>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                          aria-label="Close"></button>
                                                  </div>
                                                  <div class="modal-body">
                                                      عرض حالة الجرد
                                                  </div>
                                                  <div class="modal-footer">
                                                      <button type="button" class="view-cashe-content btn btn-primary">عرض
                                                          السجل </button>
                                                      <button type="button"
                                                          class="view-cashe-content btn btn-primary">استلام الجرد </button>
                                                      <button type="button" class="btn btn-secondary"
                                                          data-bs-dismiss="modal">اغلاق</button>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>

                                  </td>
                              </tr>
                              @endforeach
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
                                              @php
                                                  $today = Carbon\Carbon::today();
                                                  $today = $today->toDateString();
                                                  
                                              @endphp
                                              <input type="date" id="date" value="{{ $today }}" disabled
                                                  readonly class="form-control form-control-solid" placeholder="date" />

                                          </div>
                                          <div class="col-md-5 pt-5">
                                              <div class="radios d-flex d-flex justify-content-around">
                                                  <input type="radio" id="morning" name="shift_type" value="morning">
                                                  <label for="morning">شفت صباحى</label>
                                                  <input type="radio" id="evening" name="shift_type" value="evening">
                                                  <label for="evening">شفت مسائى</label>
                                                  <input type="radio" id="allDay" name="shift_type" value="allDay">
                                                  <label for="allDay">دوام كامل</label>
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

                                      <label> اجمالي مبيعات الدفع الالكتروني
                                          :</label>

                                      <input type="number" id="online" value="{{ $online }}" readonly
                                          class="form-control form-control-solid" />

                                  </div>
                                  <div class="form-group col-md-3">

                                      <label> ادخل قيمة اجمالي المدفوعات:</label>

                                      <input type="number" onInput="creditTrans()" value="{{ $online }}" readonly
                                          id="online_trans" class="form-control form-control-solid"
                                          onInput="creditTrans()" />

                                  </div>
                                  <div class="form-group col-md-3">

                                      <label> صافي الجرد:</label>

                                      <input type="number" onInput="creditTrans()" value="{{ $online - $online }}"
                                          readonly id="online_sum" class="form-control form-control-solid"
                                          onInput="creditTrans()" />

                                  </div>

                                  <div class="form-group col-md-3">

                                      <label> حالة الجرد:</label>

                                      <input type="text" id="online_status" value="{{ 'لا يوجد نقص' }}"
                                          onInput="creditTrans()" readonly class="form-control form-control-solid" />

                                  </div>
                              </div>
                              <div class="row my-4">
                                  <h1 class="mb-4">استخدامات الرصيد والمحفظة
                                  </h1>
                                  <div class="form-group col-md-3">

                                      <label> اجمالي الرصيد المسجل
                                          :</label>

                                      <input type="number" id="point" value="{{ $point }}" readonly
                                          class="form-control form-control-solid" />

                                  </div>
                                  <div class="form-group col-md-3">

                                      <label> اجمالي الرصيد المستخدم:</label>

                                      <input type="number" value="{{ $order }}" readonly onInput="pointTrans()"
                                          id="point_trans" class="form-control form-control-solid"
                                          onInput="creditTrans()" />

                                  </div>
                                  <div class="form-group col-md-3">

                                      <label> صافي الجرد:</label>

                                      <input type="number" onInput="pointTrans()" value="{{ $point - $order }}"
                                          id="point_sum" class="form-control form-control-solid" readonly
                                          onInput="creditTrans()" />

                                  </div>

                                  <div class="form-group col-md-3">

                                      <label> حالة الجرد:</label>

                                      <input type="text" id="point_status"
                                          value="{{ $point - $order == 0 ? 'لا يوجد نقص' : 'يوجد زياده' }}"
                                          onInput="pointTrans()" readonly class="form-control form-control-solid" />

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
  @endsection
  @section('js')
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

              var total = credit_trans - credit;
              credit_sum.value = total;
              if (total >= 0) {
                  credit_status.value = 'لا يوجد نقص';
              }
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



          let selectedValue = ''; // Variable to store the selected value

          // Event listener for radio buttons
          const radioButtons = document.querySelectorAll('input[name="shift_type"]');
          radioButtons.forEach(button => {
              button.addEventListener('change', function() {
                  selectedValue = this.value; // Update the selected value
              });
          });

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
              storepart('/branch/casher/store', formData, '/branch/casher/create')
          }
      </script>
      <script>
          $(document).ready(function() {
              $('.view-cashe-content').on('click', function() {
                  $('.cashe-content').removeClass('cashe-content-none').addClass('cashe-content-active');
                  $('.inventory-table').addClass('cashe-content-none');
                  $('.modal-backdrop.show').addClass('cashe-content-none');
              });

              $('.new-inventory-btn').on('click', function() {
                  $('.new-inventory-content').addClass('cashe-content-active');
                  $('.cashe-content').removeClass('cashe-content-active');
                  $('.inventory-table').addClass('cashe-content-none');

              });
          });
      </script>
  @endsection
