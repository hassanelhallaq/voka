<div id="mainPage">
    <div class="col-md-12">
        <div class="reservation-tabs all-halls card card-nav-tabs card-plain ">
            <div class="card-header card-header-danger">
                <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                        <ul class="nav nav-tabs" data-tabs="tabs">
                            @foreach ($halles as $key => $item)
                                <li class="nav-item">
                                    <a class="nav-link {{ $key === 0 ? ' active' : '' }}" href="#hall{{ $item->id }}"
                                        data-toggle="tab">{{ $item->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body new">
                <div class="tab-content text-center">
                    @foreach ($halles as $e => $item)
                        <div class="tab-pane {{ $e === 0 ? ' active' : '' }}" id="hall{{ $item->id }}">
                            <div class="row new-reservation-tables">
                                <!--<h2 class="text-center text-light">{{ $item->name }}</h2>-->
                                <div class="col-md-12">
                                    <div class="row">
                                        @foreach ($item->tables as $i => $tables)
                                            <!--<div class="col-md-3 card-col  d-flex justify-content-center align-items-center "-->
                                            <!--    data-start="45" data-updatedTime="45">-->
                                            <!--    <div class="card @if ($tables->status == 'in_service') bg-info-->
                                            <!--     @elseif($tables->status == 'available')-->
                                            <!--    bg-success text-light-->
                                            <!--    @elseif ($tables->status == 'reserved')-->
                                            <!--       bg-danger  text-light @endif-->
                                            <!--     text-dark-->
                                            <!--        text-dark {{ $item === 0 ? 'active-card' : '' }}"-->
                                            <!--        data-id="table{{ $item->id }}" data-stat="serv">-->
                                            <!--        <div class="card-header primary-bg-color">-->
                                            <!--            <div class="top d-flex justify-content-between ">-->
                                            <!--                <h5 class="card-title"> طاولة {{ $tables->name }}</h5>-->
                                            <!--                <span class="start"> </span>-->
                                            <!--            </div>-->
                                            <!--        </div>-->
                                            <!--        <div class="card-body">-->
                                            <!--            <div class="mid d-flex justify-content-between">-->
                                            <!--                <p class="hall-name">{{ $item->name }}</p>-->
                                            <!--                <span class="sta">-->
                                            <!--                    @if ($tables->status == 'in_service')-->
                                            <!--                        فى الخدمة-->
                                            <!--                    @elseif($tables->status == 'available')-->
                                            <!--                        متاحة-->
                                            <!--                    @elseif ($tables->status == 'reserved')-->
                                            <!--                        محجوزة-->
                                            <!--                    @endif-->
                                            <!--                </span>-->
                                            <!--            </div>-->
                                            <!--            <div class="body-package d-flex justify-content-between">-->
                                            <!--                <p class="hall-name"> باقة ساعتين</p>-->
                                            <!--                <span class="sta"> 4 اشخاص</span>-->
                                            <!--            </div>-->
                                            <!--            <div class="body-time d-flex justify-content-between">-->
                                            <!--                <p class="hall-name"> 10/8/2012</p>-->
                                            <!--                <span class="sta"> 08:00 PM </span>-->
                                            <!--            </div>-->
                                            <!--        </div>-->
                                            <!--        <div class="card-footer">-->
                                            <!--            <p class="hall-name"> الرصيد : 500</p>-->
                                            <!--            <span class="sta"> الرصيد المتبقى : 300</span>-->
                                            <!--        </div>-->

                                            <!--    </div>-->
                                            <!--    <div class="table-side-bar" id="table{{ $item->id }}">-->
                                            <!--        <h2 class="text-center mb-4">طاولة رقم 1</h2>-->
                                            <!--        <div class="tab-nav-wraper">-->
                                            <!--            <ul-->
                                            <!--                class="nav c-nav-tabs d-flex justify-content-between home-tab">-->
                                            <!--                <li class="nav-item">-->
                                            <!--                    <a class="nav-link " data-tab="reservations"-->
                                            <!--                        href="#"> الحجوزات</a>-->
                                            <!--                </li>-->
                                            <!--                <li class="nav-item">-->
                                            <!--                    <a class="nav-link" data-tab="orders" href="#">-->
                                            <!--                        الطلبات</a>-->
                                            <!--                </li>-->
                                            <!--                <li class="nav-item">-->
                                            <!--                    <a class="nav-link active" data-tab="the-menu"-->
                                            <!--                        href="#"> القائمة</a>-->
                                            <!--                </li>-->
                                            <!--            </ul>-->
                                            <!--        </div>-->
                                                    <!-- عناصر التاب -->
                                            <!--        <div class="tab-content">-->
                                            <!--            <div id="the-menu" class="c-tab-pane active">-->
                                            <!--                <ol class="list-group list-group-numbered reversed">-->
                                            <!--                    <li-->
                                            <!--                        class="list-group-item d-flex justify-content-between align-items-start">-->
                                            <!--                        <div class="me-2 ms-auto">-->
                                            <!--                            <div class="fw-bold">لحم سيشوان</div>-->
                                            <!--                        </div>-->
                                            <!--                        <span>150 ريال</span>-->
                                            <!--                    </li>-->
                                            <!--                    <li-->
                                            <!--                        class="list-group-item d-flex justify-content-between align-items-start">-->
                                            <!--                        <div class="me-2 ms-auto">-->
                                            <!--                            <div class="fw-bold">سبرنج رولز</div>-->
                                            <!--                        </div>-->
                                            <!--                        <span> 50 ريال</span>-->
                                            <!--                    </li>-->
                                            <!--                    <li-->
                                            <!--                        class="list-group-item d-flex justify-content-between align-items-start">-->
                                            <!--                        <div class="me-2 ms-auto">-->
                                            <!--                            <div class="fw-bold">سلطة آسيوية</div>-->
                                            <!--                        </div>-->
                                            <!--                        <span>15 ريال</span>-->
                                            <!--                    </li>-->
                                            <!--                    <li-->
                                            <!--                        class="list-group-item d-flex justify-content-between align-items-start">-->
                                            <!--                        <div class="me-2 ms-auto">-->
                                            <!--                            <div class="fw-bold">سلطة آسيوية</div>-->
                                            <!--                        </div>-->
                                            <!--                        <span>15 ريال</span>-->
                                            <!--                    </li>-->
                                            <!--                    <li-->
                                            <!--                        class="list-group-item d-flex justify-content-between align-items-start">-->
                                            <!--                        <div class="me-2 ms-auto">-->
                                            <!--                            <div class="fw-bold">سلطة آسيوية</div>-->
                                            <!--                        </div>-->
                                            <!--                        <span>15 ريال</span>-->
                                            <!--                    </li>-->
                                            <!--                    <li-->
                                            <!--                        class="list-group-item d-flex justify-content-between align-items-start">-->
                                            <!--                        <div class="me-2 ms-auto">-->
                                            <!--                            <div class="fw-bold">سلطة آسيوية</div>-->
                                            <!--                        </div>-->
                                            <!--                        <span>15 ريال</span>-->
                                            <!--                    </li>-->
                                            <!--                    <li-->
                                            <!--                        class="new-menu-li list-group-item d-flex justify-content-center align-items-start">-->
                                            <!--                        <a href="menu.html" class="me-2">-->
                                            <!--                            <div class="fw-bold">اضف عنصر جديد</div>-->
                                            <!--                        </a>-->
                                            <!--                    </li>-->

                                            <!--                </ol>-->
                                            <!--                <ol class="list-group reversed none  mt-5">-->
                                            <!--                    <li class="list-group-item no-number  ">-->
                                            <!--                        <div-->
                                            <!--                            class="sub-total d-flex justify-content-between align-items-start">-->
                                            <!--                            <div class="me-2 ms-auto">-->
                                            <!--                                <div class="fw-bold"> حاصل الجمع</div>-->
                                            <!--                            </div>-->
                                            <!--                            <span>260 ريال</span>-->
                                            <!--                        </div>-->

                                            <!--                        <div-->
                                            <!--                            class="tax d-flex justify-content-between align-items-start mt-4">-->
                                            <!--                            <div class="me-2 ms-auto">-->
                                            <!--                                <div class="fw-bold"> ضريبة</div>-->
                                            <!--                            </div>-->
                                            <!--                            <span>10%</span>-->
                                            <!--                        </div>-->
                                            <!--                        <div-->
                                            <!--                            class="tax d-flex justify-content-between align-items-start mt-4 total">-->
                                            <!--                            <div class="me-2 ms-auto">-->
                                            <!--                                <div class="fw-bold"> الإجمالى</div>-->
                                            <!--                            </div>-->
                                            <!--                            <span>286 ريال</span>-->
                                            <!--                        </div>-->
                                            <!--                        <div class="payment-method">-->
                                            <!--                            <div class="row">-->
                                            <!--                                <div class="col-4">-->
                                            <!--                                    <div-->
                                            <!--                                        class="payment-icon d-flex justify-content-center align-items-center">-->
                                            <!--                                        <i-->
                                            <!--                                            class="fa-solid fa-sack-dollar"></i>-->
                                            <!--                                    </div>-->
                                            <!--                                    <p class="text-center">كاش</p>-->
                                            <!--                                </div>-->
                                            <!--                                <div class="col-4">-->
                                            <!--                                    <div-->
                                            <!--                                        class="payment-icon d-flex justify-content-center align-items-center">-->
                                            <!--                                        <i-->
                                            <!--                                            class="fa-solid fa-credit-card"></i>-->
                                            <!--                                    </div>-->
                                            <!--                                    <p class="text-center">بطاقة ائتمان</p>-->
                                            <!--                                </div>-->
                                            <!--                                <div class="col-4">-->
                                            <!--                                    <div-->
                                            <!--                                        class="payment-icon d-flex justify-content-center align-items-center">-->
                                            <!--                                        <i class="fa-solid fa-wallet"></i>-->
                                            <!--                                    </div>-->
                                            <!--                                    <p class="text-center">المحفظة</p>-->
                                            <!--                                </div>-->
                                            <!--                            </div>-->
                                            <!--                            <div class="payment-btn my-3 text-center">-->
                                            <!--                                <div class="btn btn-primary btn-lg w-100"-->
                                            <!--                                    data-bs-toggle="modal"-->
                                            <!--                                    data-bs-target="#exampleModal6">ادفع-->
                                            <!--                                    الآن</div>-->
                                                                            <!-- Modal -->
                                            <!--                                <div class="modal fade" id="exampleModal6"-->
                                            <!--                                    tabindex="-1"-->
                                            <!--                                    aria-labelledby="exampleModalLabel6"-->
                                            <!--                                    aria-hidden="true">-->
                                            <!--                                    <div class="modal-dialog">-->
                                            <!--                                        <div class="modal-content">-->
                                            <!--                                            <div class="modal-header">-->
                                            <!--                                                <h5 class="modal-title"-->
                                            <!--                                                    id="exampleModalLabel">-->
                                            <!--                                                    تأكيد الدفع</h5>-->
                                            <!--                                                <button type="button"-->
                                            <!--                                                    class="btn-close"-->
                                            <!--                                                    data-bs-dismiss="modal"-->
                                            <!--                                                    aria-label="Close"></button>-->
                                            <!--                                            </div>-->
                                            <!--                                            <div class="modal-body">-->
                                            <!--                                                <p class="consfirm-text">هل-->
                                            <!--                                                    تريد تأكيد الدفع</p>-->
                                            <!--                                            </div>-->
                                            <!--                                            <div class="modal-footer">-->
                                            <!--                                                <button type="button"-->
                                            <!--                                                    class="btn btn-primary">تأكيد</button>-->
                                            <!--                                                <button type="button"-->
                                            <!--                                                    class="btn btn-secondary"-->
                                            <!--                                                    data-bs-dismiss="modal">لا-->
                                            <!--                                                </button>-->
                                            <!--                                            </div>-->
                                            <!--                                        </div>-->
                                            <!--                                    </div>-->
                                            <!--                                </div>-->
                                            <!--                            </div>-->
                                            <!--                        </div>-->
                                            <!--                    </li>-->



                                            <!--                </ol>-->

                                            <!--            </div>-->
                                            <!--            <div id="orders" class="c-tab-pane ">-->
                                            <!--                <ol-->
                                            <!--                    class="list-group list-group-numbered reversed bill-info">-->
                                            <!--                    <li-->
                                            <!--                        class="list-group-item d-flex justify-content-between align-items-start">-->
                                            <!--                        <div class="me-2 ms-auto">-->
                                            <!--                            <div class="fw-bold"> طلب باسم</div>-->
                                            <!--                        </div>-->
                                            <!--                        <span>على محمد احمد </span>-->
                                            <!--                    </li>-->
                                            <!--                    <li-->
                                            <!--                        class="list-group-item d-flex justify-content-between align-items-start">-->
                                            <!--                        <div class="me-2 ms-auto">-->
                                            <!--                            <div class="fw-bold">اسم الباقة</div>-->
                                            <!--                        </div>-->
                                            <!--                        <span> باقة 3 ساعات </span>-->
                                            <!--                    </li>-->
                                            <!--                    <li-->
                                            <!--                        class="list-group-item d-flex justify-content-between align-items-start">-->
                                            <!--                        <div class="me-2 ms-auto">-->
                                            <!--                            <div class="fw-bold"> الرصيد</div>-->
                                            <!--                        </div>-->
                                            <!--                        <span>1500 </span>-->
                                            <!--                    </li>-->
                                            <!--                    <li-->
                                            <!--                        class="list-group-item d-flex justify-content-between align-items-start">-->
                                            <!--                        <div class="me-2 ms-auto">-->
                                            <!--                            <div class="fw-bold"> الحالة</div>-->
                                            <!--                        </div>-->
                                            <!--                        <span class="badge bg-info">تم الدفع </span>-->
                                            <!--                    </li>-->
                                            <!--                    <li-->
                                            <!--                        class="new-menu-li list-group-item d-flex justify-content-center align-items-start">-->
                                            <!--                        <div class="me-2">-->
                                            <!--                            <div class="fw-bold"> طباعة الطلب</div>-->
                                            <!--                        </div>-->
                                            <!--                    </li>-->
                                            <!--                </ol>-->
                                            <!--                <ol-->
                                            <!--                    class="list-group list-group-numbered reversed bill-info">-->
                                            <!--                    <li-->
                                            <!--                        class="list-group-item d-flex justify-content-between align-items-start">-->
                                            <!--                        <div class="me-2 ms-auto">-->
                                            <!--                            <div class="fw-bold"> طلب باسم</div>-->
                                            <!--                        </div>-->
                                            <!--                        <span>على محمد احمد </span>-->
                                            <!--                    </li>-->
                                            <!--                    <li-->
                                            <!--                        class="list-group-item d-flex justify-content-between align-items-start">-->
                                            <!--                        <div class="me-2 ms-auto">-->
                                            <!--                            <div class="fw-bold">اسم الباقة</div>-->
                                            <!--                        </div>-->
                                            <!--                        <span> باقة 3 ساعات </span>-->
                                            <!--                    </li>-->
                                            <!--                    <li-->
                                            <!--                        class="list-group-item d-flex justify-content-between align-items-start">-->
                                            <!--                        <div class="me-2 ms-auto">-->
                                            <!--                            <div class="fw-bold"> الرصيد</div>-->
                                            <!--                        </div>-->
                                            <!--                        <span>1500 </span>-->
                                            <!--                    </li>-->
                                            <!--                    <li-->
                                            <!--                        class="list-group-item d-flex justify-content-between align-items-start">-->
                                            <!--                        <div class="me-2 ms-auto">-->
                                            <!--                            <div class="fw-bold"> الحالة</div>-->
                                            <!--                        </div>-->
                                            <!--                        <span class="badge bg-info">تم الدفع </span>-->
                                            <!--                    </li>-->
                                            <!--                    <li-->
                                            <!--                        class="new-menu-li list-group-item d-flex justify-content-center align-items-start">-->
                                            <!--                        <div class="me-2">-->
                                            <!--                            <div class="fw-bold"> طباعة الطلب</div>-->
                                            <!--                        </div>-->
                                            <!--                    </li>-->
                                            <!--                </ol>-->
                                            <!--                <ol-->
                                            <!--                    class="list-group list-group-numbered reversed bill-info">-->
                                            <!--                    <li-->
                                            <!--                        class="list-group-item d-flex justify-content-between align-items-start">-->
                                            <!--                        <div class="me-2 ms-auto">-->
                                            <!--                            <div class="fw-bold"> طلب باسم</div>-->
                                            <!--                        </div>-->
                                            <!--                        <span>على محمد احمد </span>-->
                                            <!--                    </li>-->
                                            <!--                    <li-->
                                            <!--                        class="list-group-item d-flex justify-content-between align-items-start">-->
                                            <!--                        <div class="me-2 ms-auto">-->
                                            <!--                            <div class="fw-bold">اسم الباقة</div>-->
                                            <!--                        </div>-->
                                            <!--                        <span> باقة 3 ساعات </span>-->
                                            <!--                    </li>-->
                                            <!--                    <li-->
                                            <!--                        class="list-group-item d-flex justify-content-between align-items-start">-->
                                            <!--                        <div class="me-2 ms-auto">-->
                                            <!--                            <div class="fw-bold"> الرصيد</div>-->
                                            <!--                        </div>-->
                                            <!--                        <span>1500 </span>-->
                                            <!--                    </li>-->
                                            <!--                    <li-->
                                            <!--                        class="list-group-item d-flex justify-content-between align-items-start">-->
                                            <!--                        <div class="me-2 ms-auto">-->
                                            <!--                            <div class="fw-bold"> الحالة</div>-->
                                            <!--                        </div>-->
                                            <!--                        <span class="badge bg-info">تم الدفع </span>-->
                                            <!--                    </li>-->
                                            <!--                    <li-->
                                            <!--                        class="new-menu-li list-group-item d-flex justify-content-center align-items-start">-->
                                            <!--                        <div class="me-2">-->
                                            <!--                            <div class="fw-bold"> طباعة الطلب</div>-->
                                            <!--                        </div>-->
                                            <!--                    </li>-->
                                            <!--                </ol>-->
                                            <!--            </div>-->
                                            <!--            <div id="reservations" class="c-tab-pane ">-->
                                            <!--                <div class="hour-col">-->
                                            <!--                    <div class="body-hour-cel">-->
                                            <!--                        <div class="row gx-0 p-2 text-center">-->
                                            <!--                            <div class="col-md-2">-->
                                            <!--                                <p class="hour mb-0">05:00 AM</p>-->
                                            <!--                            </div>-->
                                            <!--                            <div class="col-md-10">-->
                                            <!--                                <div class="row gx-0">-->
                                            <!--                                    <div class="col-md-9">-->
                                            <!--                                        <div-->
                                            <!--                                            class="d-flex h-100 justify-content-around align-items-center">-->
                                            <!--                                            <div class="gusts">-->
                                            <!--                                                <span-->
                                            <!--                                                    class="table-gusts px-2">-->
                                            <!--                                                    4</span>-->
                                            <!--                                                <span> <i-->
                                            <!--                                                        class="fa-solid fa-users"></i></span>-->
                                            <!--                                            </div>-->
                                            <!--                                            <div class="table-res">-->
                                            <!--                                                طاولة 1-->
                                            <!--                                            </div>-->
                                            <!--                                            <span-->
                                            <!--                                                class="badge bg-secondary">مؤكد</span>-->
                                            <!--                                        </div>-->
                                            <!--                                    </div>-->
                                            <!--                                    <div class="col-md-3">-->
                                            <!--                                        <span>رصيد متبقى 600</span>-->
                                            <!--                                    </div>-->
                                            <!--                                </div>-->

                                            <!--                            </div>-->
                                            <!--                        </div>-->
                                            <!--                    </div>-->
                                            <!--                    <div class="body-hour-cel">-->
                                            <!--                        <div class="row gx-0 p-2 text-center">-->
                                            <!--                            <div class="col-md-2">-->
                                            <!--                                05:15 AM-->
                                            <!--                            </div>-->
                                            <!--                            <div class="col-md-10">-->
                                            <!--                                <div class="row gx-0">-->
                                            <!--                                    <div class="col-md-9">-->
                                            <!--                                        <div-->
                                            <!--                                            class="d-flex justify-content-center align-items-center">-->
                                            <!--                                            <span>لا يوجد حجز</span>-->
                                            <!--                                        </div>-->
                                            <!--                                    </div>-->
                                            <!--                                    <div class="col-md-3">-->
                                            <!--                                        <span>لا يوجد رصيد</span>-->
                                            <!--                                    </div>-->
                                            <!--                                </div>-->

                                            <!--                            </div>-->
                                            <!--                        </div>-->
                                            <!--                    </div>-->
                                            <!--                    <div class="body-hour-cel">-->
                                            <!--                        <div class="row gx-0 p-2 text-center">-->
                                            <!--                            <div class="col-md-2">-->
                                            <!--                                05:30 AM-->
                                            <!--                            </div>-->
                                            <!--                            <div class="col-md-10">-->
                                            <!--                                <div class="row gx-0">-->
                                            <!--                                    <div class="col-md-9">-->
                                            <!--                                        <div-->
                                            <!--                                            class="d-flex justify-content-center align-items-center">-->
                                            <!--                                            <span>لا يوجد حجز</span>-->
                                            <!--                                        </div>-->
                                            <!--                                    </div>-->
                                            <!--                                    <div class="col-md-3">-->
                                            <!--                                        <span>لا يوجد رصيد</span>-->
                                            <!--                                    </div>-->
                                            <!--                                </div>-->

                                            <!--                            </div>-->
                                            <!--                        </div>-->
                                            <!--                    </div>-->
                                            <!--                    <div class="body-hour-cel">-->
                                            <!--                        <div class="row gx-0 p-2 text-center">-->
                                            <!--                            <div class="col-md-2">-->
                                            <!--                                05:45 AM-->
                                            <!--                            </div>-->
                                            <!--                            <div class="col-md-10">-->
                                            <!--                                <div class="row gx-0">-->
                                            <!--                                    <div class="col-md-9">-->
                                            <!--                                        <div-->
                                            <!--                                            class="d-flex justify-content-center align-items-center">-->
                                            <!--                                            <span>لا يوجد حجز</span>-->
                                            <!--                                        </div>-->
                                            <!--                                    </div>-->
                                            <!--                                    <div class="col-md-3">-->
                                            <!--                                        <span>لا يوجد رصيد</span>-->
                                            <!--                                    </div>-->
                                            <!--                                </div>-->

                                            <!--                            </div>-->
                                            <!--                        </div>-->
                                            <!--                    </div>-->
                                            <!--                </div>-->

                                            <!--            </div>-->
                                            <!--        </div>-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                             <!--new table -->
                                            <div class="col-md-4 card-col  d-flex justify-content-center align-items-center " data-tableNumber="1" data-start="45" data-updatedTime="45"   data-h="hall2" data-pstat ="serv">
                                                  <div  class="card @if ($tables->status == 'in_service') bg-info
                                                 @elseif($tables->status == 'available')
                                                bg-success text-light
                                                @elseif ($tables->status == 'reserved')
                                                   bg-danger  text-light @endif
                                                 text-dark
                                                    text-dark {{ $item === 0 ? 'active-card' : '' }}" 
                                                    data-id="table{{ $item->id }}" 
                                                    data-stat="serv">
                                                    <div class="card-header primary-bg-color">
                                                      <div class="top d-flex justify-content-between ">
                                                        <h5 class="card-title"> طاولة {{ $tables->name }}</h5>
                                                            <span class="tableid" > #37856 </span>
                                                          </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="items-group">
                                                              <div class="card-item mid d-flex justify-content-between align-items-center">
                                                                <p class="hall-name"> الباقة</p>
                                                                <span class="sta">عشاء فاخر </span>
                                                              </div>
                                                              <div class="card-item body-package d-flex justify-content-between align-items-center">
                                                                <p class="hall-name">  المقاعد</p>
                                                                <span class="sta"> 4 اشخاص</span>
                                                              </div>
                                                              <div class="card-item body-time d-flex justify-content-between align-items-center">
                                                                <p class="hall-name"> الحجز</p>
                                                                <span class="sta"> 500 ريال</span>
                                                              </div>
                                                              <div class="card-item body-time d-flex justify-content-between align-items-center">
                                                                <p class="hall-name"> المدة</p>
                                                                <span class="sta"> 2 ساعة </span>
                                                              </div>
                                                          </div>
                                                          <div class="items-group">
                                                              <div class="card-item body-time d-flex justify-content-between align-items-center">
                                                                <p class="hall-name"> الحالة</p>
                                                                <span class="sta">  على الطاولة</span>
                                                              </div>
                                                          </div>
                                                          <div class="items-group">
                                                              <div class="card-item body-time d-flex justify-content-between align-items-center">
                                                                <p class="hall-name"> الرصيد الحالى</p>
                                                                <span class="sta"> 300 ريال </span>
                                                              </div>
                                                              <div class="card-item body-time d-flex justify-content-between align-items-center">
                                                                <p class="hall-name"> الوقت المنقضى</p>
                                                                <span class="sta"> 01:25:00 </span>
                                                              </div>
                                                          </div>
                                                        </div>
                                                        <div class="card-footer">
                                                          <div class="table-btn my-3 text-center">
                                                            <div class="row">
                                                                <div class="col-md-6 mb-2">
                                                                    <button class="btn btn-primary w-100" type="button">
                                                                          الطلبات
                                                                    </button>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <button class="btn btn-primary w-100" type="button" >
                                                                         استعراض 
                                                                    </button>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <button class="btn btn-primary w-100" type="button"
                                                                        disabled>
                                                                           تفعيل الحجز
                                                                    </button>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <button class="btn btn-primary w-100" type="button" >
                                                                          انهاء الحجز 
                                                                    </button>
                                                                </div>
                                                            </div>
                
                                                        </div>
                                                        </div>
                
                                                      </div>
                                                  <div class="table-side-bar" id="table{{ $item->id }}">
                                                    <h2 class="text-center mb-4"> {{ $tables->name}} </h2>
                                                    <div class="tab-nav-wraper">
                                                      <ul class="nav c-nav-tabs d-flex justify-content-between home-tab">
                                                          <li class="nav-item">
                                                            <a class="nav-link "  data-tab="reservations" href="#"> الحجوزات</a>
                                                          </li>
                                                          <li class="nav-item">
                                                            <a class="nav-link"  data-tab="orders" href="#"> الطلبات</a>
                                                          </li>
                                                          <li class="nav-item">
                                                            <a class="nav-link active"  data-tab="the-menu" href="#"> القائمة</a>
                                                          </li>
                                                        </ul>
                                                      </div>
                                                        <!-- عناصر التاب -->
                                                        <div class="tab-content">
                                                          <div id="the-menu" class="c-tab-pane active">
                                                              <ol class="list-group list-group-numbered reversed">
                                                                  <li class="list-group-item d-flex justify-content-between align-items-start">
                                                                    <div class="me-2 ms-auto">
                                                                      <div class="fw-bold">لحم سيشوان</div>
                                                                    </div>
                                                                    <span>150 ريال</span>
                                                                  </li>
                                                                  <li class="list-group-item d-flex justify-content-between align-items-start">
                                                                    <div class="me-2 ms-auto">
                                                                      <div class="fw-bold">سبرنج رولز</div>
                                                                    </div>
                                                                    <span> 50 ريال</span>
                                                                  </li>
                                                                  <li class="list-group-item d-flex justify-content-between align-items-start">
                                                                    <div class="me-2 ms-auto">
                                                                      <div class="fw-bold">سلطة آسيوية</div>
                                                                    </div>
                                                                    <span >15 ريال</span>
                                                                  </li>
                                                                  <li class="list-group-item d-flex justify-content-between align-items-start">
                                                                      <div class="me-2 ms-auto">
                                                                        <div class="fw-bold">سلطة آسيوية</div>
                                                                      </div>
                                                                      <span>15 ريال</span>
                                                                    </li>
                                                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                                                      <div class="me-2 ms-auto">
                                                                        <div class="fw-bold">سلطة آسيوية</div>
                                                                      </div>
                                                                      <span >15 ريال</span>
                                                                    </li>
                                                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                                                      <div class="me-2 ms-auto">
                                                                        <div class="fw-bold">سلطة آسيوية</div>
                                                                      </div>
                                                                      <span >15 ريال</span>
                                                                    </li>
                                                                    <li class="new-menu-li list-group-item d-flex justify-content-center align-items-start">
                                                                      <a href="menu.html" class="me-2">
                                                                        <div class="fw-bold">اضف عنصر جديد</div>
                                                                      </a>
                                                                    </li>
            
                                                                </ol>
                                                                <ol class="list-group reversed  mt-5">
                                                                  <li class="list-group-item no-number  ">
                                                                      <div class="sub-total d-flex justify-content-between align-items-start">
                                                                          <div class="me-2 ms-auto">
                                                                              <div class="fw-bold"> حاصل الجمع</div>
                                                                            </div>
                                                                            <span>260 ريال</span>
                                                                      </div>
            
                                                                      <div class="tax d-flex justify-content-between align-items-start mt-4">
                                                                          <div class="me-2 ms-auto">
                                                                              <div class="fw-bold"> ضريبة</div>
                                                                            </div>
                                                                            <span>10%</span>
                                                                      </div>
                                                                      <div class="tax d-flex justify-content-between align-items-start mt-4 total">
                                                                          <div class="me-2 ms-auto">
                                                                              <div class="fw-bold"> الإجمالى</div>
                                                                            </div>
                                                                            <span>286 ريال</span>
                                                                      </div>
                                                                      <div class="payment-method">
                                                                          <div class="row">
                                                                              <div class="col-4">
                                                                                  <div class="payment-icon d-flex justify-content-center align-items-center">
                                                                                      <i class="fa-solid fa-sack-dollar"></i>
                                                                                  </div>
                                                                                  <p class="text-center">كاش</p>
                                                                              </div>
                                                                              <div class="col-4">
                                                                                <div class="payment-icon d-flex justify-content-center align-items-center">
                                                                                  <i class="fa-solid fa-credit-card"></i>
                                                                                </div>
                                                                                <p class="text-center">بطاقة  ائتمان</p>
                                                                            </div>
                                                                            <div class="col-4">
                                                                              <div class="payment-icon d-flex justify-content-center align-items-center">
                                                                                <i class="fa-solid fa-wallet"></i>
                                                                              </div>
                                                                              <p class="text-center">المحفظة</p>
                                                                          </div>
                                                                          </div>
                                                                          <div class="payment-btn my-3 text-center">
                                                                            <div class="btn btn-primary btn-lg w-100" data-bs-toggle="modal" data-bs-target="#exampleModal6">ادفع الآن</div>
                                                          <!-- Modal -->
                                                          <div class="modal fade" id="exampleModal6" tabindex="-1" aria-labelledby="exampleModalLabel6" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                              <div class="modal-content">
                                                                <div class="modal-header">
                                                                  <h5 class="modal-title" id="exampleModalLabel">تأكيد الدفع</h5>
                                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                  <p class="consfirm-text">هل تريد تأكيد الدفع</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                  <button type="button" class="btn btn-primary">تأكيد</button>
                                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لا </button>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                                          </div>
                                                                      </div>
                                                                    </li>
            
            
            
                                                                </ol>
            
                                                          </div>
                                                          <div id="orders" class="c-tab-pane ">
                                                            <ol class="list-group list-group-numbered reversed bill-info">
                                                              <li class="list-group-item d-flex justify-content-between align-items-start">
                                                                <div class="me-2 ms-auto">
                                                                  <div class="fw-bold"> طلب باسم</div>
                                                                </div>
                                                                <span>على محمد احمد </span>
                                                              </li>
                                                              <li class="list-group-item d-flex justify-content-between align-items-start">
                                                                <div class="me-2 ms-auto">
                                                                  <div class="fw-bold">اسم الباقة</div>
                                                                </div>
                                                                <span> باقة 3 ساعات </span>
                                                              </li>
                                                              <li class="list-group-item d-flex justify-content-between align-items-start">
                                                                <div class="me-2 ms-auto">
                                                                  <div class="fw-bold"> الرصيد</div>
                                                                </div>
                                                                <span >1500 </span>
                                                              </li>
                                                              <li class="list-group-item d-flex justify-content-between align-items-start">
                                                                  <div class="me-2 ms-auto">
                                                                    <div class="fw-bold"> الحالة</div>
                                                                  </div>
                                                                  <span class="badge bg-info">تم الدفع </span>
                                                                </li>
                                                                <li class="new-menu-li list-group-item d-flex justify-content-center align-items-start">
                                                                  <div  class="me-2">
                                                                    <div class="fw-bold">  طباعة الطلب</div>
                                                                  </div>
                                                                </li>
                                                            </ol>
                                                            <ol class="list-group list-group-numbered reversed bill-info">
                                                              <li class="list-group-item d-flex justify-content-between align-items-start">
                                                                <div class="me-2 ms-auto">
                                                                  <div class="fw-bold"> طلب باسم</div>
                                                                </div>
                                                                <span>على محمد احمد </span>
                                                              </li>
                                                              <li class="list-group-item d-flex justify-content-between align-items-start">
                                                                <div class="me-2 ms-auto">
                                                                  <div class="fw-bold">اسم الباقة</div>
                                                                </div>
                                                                <span> باقة 3 ساعات </span>
                                                              </li>
                                                              <li class="list-group-item d-flex justify-content-between align-items-start">
                                                                <div class="me-2 ms-auto">
                                                                  <div class="fw-bold"> الرصيد</div>
                                                                </div>
                                                                <span >1500 </span>
                                                              </li>
                                                              <li class="list-group-item d-flex justify-content-between align-items-start">
                                                                  <div class="me-2 ms-auto">
                                                                    <div class="fw-bold"> الحالة</div>
                                                                  </div>
                                                                  <span class="badge bg-info">تم الدفع </span>
                                                                </li>
                                                                <li class="new-menu-li list-group-item d-flex justify-content-center align-items-start">
                                                                  <div  class="me-2">
                                                                    <div class="fw-bold">  طباعة الطلب</div>
                                                                  </div>
                                                                </li>
                                                            </ol>
                                                            <ol class="list-group list-group-numbered reversed bill-info">
                                                              <li class="list-group-item d-flex justify-content-between align-items-start">
                                                                <div class="me-2 ms-auto">
                                                                  <div class="fw-bold"> طلب باسم</div>
                                                                </div>
                                                                <span>على محمد احمد </span>
                                                              </li>
                                                              <li class="list-group-item d-flex justify-content-between align-items-start">
                                                                <div class="me-2 ms-auto">
                                                                  <div class="fw-bold">اسم الباقة</div>
                                                                </div>
                                                                <span> باقة 3 ساعات </span>
                                                              </li>
                                                              <li class="list-group-item d-flex justify-content-between align-items-start">
                                                                <div class="me-2 ms-auto">
                                                                  <div class="fw-bold"> الرصيد</div>
                                                                </div>
                                                                <span >1500 </span>
                                                              </li>
                                                              <li class="list-group-item d-flex justify-content-between align-items-start">
                                                                  <div class="me-2 ms-auto">
                                                                    <div class="fw-bold"> الحالة</div>
                                                                  </div>
                                                                  <span class="badge bg-info">تم الدفع </span>
                                                                </li>
                                                                <li class="new-menu-li list-group-item d-flex justify-content-center align-items-start">
                                                                  <div  class="me-2">
                                                                    <div class="fw-bold">  طباعة الطلب</div>
                                                                  </div>
                                                                </li>
                                                            </ol>
                                                          </div>
                                                          <div id="reservations" class="c-tab-pane ">
                                                            <div class="hour-col">
                                                              <div class="body-hour-cel">
                                                                  <div class="row gx-0 p-2 text-center">
                                                                      <div class="col-md-2">
                                                                          <p class="hour mb-0">05:00 AM</p>
                                                                      </div>
                                                                      <div class="col-md-10">
                                                                          <div class="row gx-0">
                                                                              <div class="col-md-9">
                                                                                  <div class="d-flex h-100 justify-content-around align-items-center">
                                                                                      <div class="gusts">
                                                                                          <span class="table-gusts px-2"> 4</span>
                                                                                          <span> <i class="fa-solid fa-users"></i></span>
                                                                                      </div>
                                                                                      <div class="table-res">
                                                                                          طاولة 1
                                                                                      </div>
                                                                                      <span class="badge bg-secondary">مؤكد</span>
                                                                                  </div>
                                                                              </div>
                                                                              <div class="col-md-3">
                                                                                  <span>رصيد متبقى 600</span>
                                                                              </div>
                                                                          </div>
            
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                              <div class="body-hour-cel">
                                                                  <div class="row gx-0 p-2 text-center">
                                                                      <div class="col-md-2">
                                                                          05:15 AM
                                                                      </div>
                                                                      <div class="col-md-10">
                                                                          <div class="row gx-0">
                                                                              <div class="col-md-9">
                                                                                  <div class="d-flex justify-content-center align-items-center">
                                                                                      <span>لا يوجد حجز</span>
                                                                                  </div>
                                                                              </div>
                                                                              <div class="col-md-3">
                                                                                  <span>لا يوجد رصيد</span>
                                                                              </div>
                                                                          </div>
            
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                              <div class="body-hour-cel">
                                                                  <div class="row gx-0 p-2 text-center">
                                                                      <div class="col-md-2">
                                                                          05:30 AM
                                                                      </div>
                                                                      <div class="col-md-10">
                                                                          <div class="row gx-0">
                                                                              <div class="col-md-9">
                                                                                  <div class="d-flex justify-content-center align-items-center">
                                                                                      <span>لا يوجد حجز</span>
                                                                                  </div>
                                                                              </div>
                                                                              <div class="col-md-3">
                                                                                  <span>لا يوجد رصيد</span>
                                                                              </div>
                                                                          </div>
            
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                              <div class="body-hour-cel">
                                                                  <div class="row gx-0 p-2 text-center">
                                                                      <div class="col-md-2">
                                                                          05:45 AM
                                                                      </div>
                                                                      <div class="col-md-10">
                                                                          <div class="row gx-0">
                                                                              <div class="col-md-9">
                                                                                  <div class="d-flex justify-content-center align-items-center">
                                                                                      <span>لا يوجد حجز</span>
                                                                                  </div>
                                                                              </div>
                                                                              <div class="col-md-3">
                                                                                  <span>لا يوجد رصيد</span>
                                                                              </div>
                                                                          </div>
            
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
            
                                                          </div>
                                                        </div>
                                                  </div>
                                                </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
