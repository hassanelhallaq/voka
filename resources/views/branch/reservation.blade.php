<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Reservation</title>
    <link href='https://fonts.googleapis.com/css?family=Cairo' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css"
        integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap-clockpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/main.css') }}">
    <style>
        tbody td:hover,
        .selected {
            color: #e5772a;
        }
    </style>
</head>

<body>

    <section class="main">
        <div class="top-bar">
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4 text-center">
                    <span class="top-title">حجز جديد</span>
                </div>
                <div class="col-4 text-left px-5">
                    <a href="{{ route('branch.home') }}" class="close-icon">
                        الإغلاق والذهاب الى الرئيسية
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="reservation">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <ul class="side-nav side-items">
                            <li class="nav-item py-3 show-content active-list" data-id="#all-packages" data-v="0">
                                <a class="nav-link" href="#">
                                    <div class="d-flex w-100">
                                        <div class="icon text-right">
                                            <i class="fa-solid fa-box-open"></i> الباقات
                                        </div>
                                        <div class="guests package-name text-center">
                                            اختار الباقة
                                        </div>
                                        <div class="chevro text-left">
                                            <i class="fas fa-chevron-left"></i>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item py-3 show-content" data-id="#all-tables" data-v="0">
                                <a class="nav-link" href="#">
                                    <div class="d-flex w-100 ">
                                        <div class="icon text-right">
                                            <i class="fa-solid fa-border-top-left"></i> الطاولة
                                        </div>
                                        <div class="table-name guests text-center">
                                            اختار الطاولة
                                        </div>
                                        <div class="chevro text-left">
                                            <i class="fas fa-chevron-left"></i>
                                        </div>
                                    </div>

                                </a>
                            </li>
                            <li class="nav-item py-3 show-content" data-id="#allguests" data-v="0">
                                <a class="nav-link" href="#">
                                    <div class="d-flex w-100">
                                        <div class="icon text-right">
                                            <i class="fa-solid fa-users"></i> الضيوف
                                        </div>
                                        <div class="guests guest-name text-center">
                                            اختار الضيوف
                                        </div>
                                        <div class="chevro text-left">
                                            <i class="fas fa-chevron-left"></i>
                                        </div>
                                    </div>

                                </a>
                            </li>
                            <li class="nav-item py-3 show-content" data-id="#date-content" data-v="0">
                                <a class="nav-link" href="#">
                                    <div class="d-flex w-100">
                                        <div class="icon text-right">
                                            <i class="fa-solid fa-calendar-days"></i> التاريخ
                                        </div>
                                        <div class="guests reserv-date text-center">

                                        </div>
                                        <div class="chevro text-left">
                                            <i class="fas fa-chevron-left"></i>
                                        </div>
                                    </div>

                                </a>
                            </li>
                            <li class="nav-item py-3 show-content" data-id="#alltime" data-v="0">
                                <a class="nav-link" href="#">
                                    <div class="d-flex w-100 align-items-center">
                                        <div class="icon text-right">
                                            <i class="fa-solid fa-clock"></i> الوقت
                                        </div>
                                        <div class="guests reserv-time text-center">

                                        </div>
                                        <div class="chevro text-left">
                                            <i class="fas fa-chevron-left"></i>
                                        </div>
                                    </div>

                                </a>
                            </li>
                            <!-- <li class="nav-item py-3 show-content">
                      <a class="nav-link" href="#">
                        <div class="d-flex w-100 ">
                          <div class="icon text-right">
                            <i class="fa-solid fa-timeline"></i> التوقيت
                          </div>
                          <div class="guests  text-center">
                            <span class="hour">1</span>
                            ساعة
                            <span class="minuts">30</span>
                            دقيقة
                          </div>
                          <div class="chevro text-left">
                            <div class="btn-group icon-btn-group" role="group" aria-label="Basic example">
                              <button type="button" class="btn btn-dark text-light ml-2 hour-mins rounded"><i class="fa-solid fa-minus"></i></button>
                              <button type="button" class="btn btn-dark text-light hour-push rounded"><i class="fa-solid fa-plus"></i></button>
                            </div>
                          </div>
                        </div>

                      </a>
                    </li> -->
                            <li class="nav-item py-3 show-content" data-id="#status" data-v="0">
                                <a class="nav-link" href="#">
                                    <div class="d-flex w-100 ">
                                        <div class="icon text-right">
                                            <i class="fa-solid fa-calendar-check"></i> الحالة
                                        </div>
                                        <div class="guests nav-statues text-center">
                                            مؤكد
                                        </div>
                                        <div class="chevro text-left">
                                            <i class="fas fa-chevron-left"></i>
                                        </div>
                                    </div>

                                </a>
                            </li>

                            <li class="nav-item py-3 show-content no-border" data-id="#notes" data-v="0">
                                <a class="nav-link" href="#">
                                    <div class="d-flex w-100">
                                        <div class="icon text-right">
                                            <i class="fa-solid fa-book-open-reader"></i> ملحوظة
                                        </div>
                                        <div class="guests text-center booking-note" data-v="0">
                                            الملحوظات
                                        </div>
                                        <div class="chevro text-left">
                                            <i class="fas fa-chevron-left"></i>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item py-3 show-content no-border" data-id="#pay" data-v="0">
                                <div class="btn to-pay btn-lg w-100">الدفع </div>
                            </li>
                            <!--<li class="nav-item py-3">-->
                            <!--    <ol class="list-group reversed paing-wrp">-->
                            <!--        <li class="list-group-item no-number  ">-->
                            <!--            <div class="sub-total d-flex justify-content-between align-items-start w-100">-->
                            <!--                <div class="me-2 ms-auto">-->
                            <!--                    <div class="fw-bold"> حاصل الجمع</div>-->
                            <!--                </div>-->
                            <!--                <span>260 ريال</span>-->
                            <!--            </div>-->
                            <!--            <div class="tax d-flex justify-content-between align-items-start mt-4 w-100">-->
                            <!--                <div class="me-2 ms-auto">-->
                            <!--                    <div class="fw-bold"> ضريبة</div>-->
                            <!--                </div>-->
                            <!--                <span>10%</span>-->
                            <!--            </div>-->
                            <!--            <div class="tax d-flex justify-content-between align-items-start mt-4 total w-100">-->
                            <!--                <div class="me-2 ms-auto">-->
                            <!--                    <div class="fw-bold"> الإجمالى</div>-->
                            <!--                </div>-->
                            <!--                <span>286 ريال</span>-->
                            <!--            </div>-->
                            <!--            <div class="payment-method w-100">-->
                            <!--                <div class="row">-->
                            <!--                    <div class="col-4">-->
                            <!--                        <div-->
                            <!--                            class="payment-icon d-flex justify-content-center align-items-center">-->
                            <!--                            <i class="fa-solid fa-sack-dollar"></i>-->
                            <!--                        </div>-->
                            <!--                        <p class="text-center">كاش</p>-->
                            <!--                    </div>-->
                            <!--                    <div class="col-4">-->
                            <!--                        <div-->
                            <!--                            class="payment-icon d-flex justify-content-center align-items-center">-->
                            <!--                            <i class="fa-solid fa-credit-card"></i>-->
                            <!--                        </div>-->
                            <!--                        <p class="text-center">بطاقة ائتمان</p>-->
                            <!--                    </div>-->
                            <!--                    <div class="col-4">-->
                            <!--                        <div-->
                            <!--                            class="payment-icon d-flex justify-content-center align-items-center">-->
                            <!--                            <i class="fa-solid fa-wallet"></i>-->
                            <!--                        </div>-->
                            <!--                        <p class="text-center">المحفظة</p>-->
                            <!--                    </div>-->
                            <!--                </div>-->
                            <!--                <div class="payment-btn my-3 text-center">-->
                            <!--                    <div class="btn btn-primary btn-lg w-100" data-bs-toggle="modal"-->
                            <!--                        data-bs-target="#exampleModal1">ادفع الآن</div>-->
                            <!-- Modal -->
                            <!--                    <div class="modal fade" id="exampleModal1" tabindex="-1"-->
                            <!--                        aria-labelledby="exampleModalLabel1" aria-hidden="true">-->
                            <!--                        <div class="modal-dialog">-->
                            <!--                            <div class="modal-content">-->
                            <!--                                <div class="modal-header">-->
                            <!--                                    <h5 class="modal-title" id="exampleModalLabel">تأكيد الدفع-->
                            <!--                                    </h5>-->
                            <!--                                    <button type="button" class="btn-close"-->
                            <!--                                        data-bs-dismiss="modal" aria-label="Close"></button>-->
                            <!--                                </div>-->
                            <!--                                <div class="modal-body">-->
                            <!--                                    <p class="consfirm-text">هل تريد تأكيد الدفع</p>-->
                            <!--                                </div>-->
                            <!--                                <div class="modal-footer">-->
                            <!--                                    <button type="button"-->
                            <!--                                        class="btn btn-primary">تأكيد</button>-->
                            <!--                                    <button type="button" class="btn btn-secondary"-->
                            <!--                                        data-bs-dismiss="modal">لا </button>-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                            <!--                        </div>-->
                            <!--                    </div>-->

                            <!--                </div>-->
                            <!--            </div>-->
                            <!--        </li>-->
                            <!--    </ol>-->
                            <!--</li>-->
                            <!-- إضافة المزيد من العناصر هنا -->
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <div class="reservation-tabs  py-5" id="all-packages">
                            <div class="container  py-5">
                                <div class="row py-5">
                                    <!--<div class="col-md-2"></div>-->
                                    @foreach ($packages as $package)
                                        <div class="col-md-4">
                                            <div class="card catch-id  btn-dark  text-center" id="package-input"
                                                data-choosen="{{ $package->id }}">
                                                <div class="card-body">
                                                    <h2 class="card-title">{{ $package->name }}</h2>
                                                    <p class="card-text package-text mt-2">باقة {{ $package->time }}
                                                        ساعة مع
                                                        {{ $package->price }} نقطة رصيد</p>

                                                    <label data-id="#all-tables"
                                                        class="choos-btn btn change-content btn-primary mt-4 pr-4"
                                                        for="package_id" onclick="pack({{ $package->id }})">
                                                        <input type="radio" value="{{ $package->id }}"
                                                            id="package_{{ $package->id }}" style="display: none;">
                                                        <input type="hidden" id="packageprice" name="packageprice"
                                                            value="{{ $package->price }}">
                                                        اختر الباقة
                                                    </label>

                                                </div>
                                                <div
                                                    class="card-footer btn-dark text-light text-body-secondary package-price">
                                                    الباقة الأولى
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!--<div class="col-md-2"></div>-->
                                </div>
                                <!--<div class="row">-->
                                <!--    <div class="col-md-10"></div>-->
                                <!--    <div class="col-md-2">-->
                                <!--        <div class="change-content btn btn-primary" data-id="#all-tables">التالى</div>-->
                                <!--    </div>-->
                                <!--</div>-->
                            </div>
                        </div>
                        <div class="reservation-tabs halls-tab card card-nav-tabs card-plain " id="all-tables">
                            <div id="app"></div>
                            <!--@include('branch._halles_branch')-->
                        </div>
                        <div class="reservation-tabs" id="allguests">
                            <div class="container">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="seacr-bar mb-5">
                                            <form class="d-flex search w-100 " role="search">
                                                <input class="form-control" oninput="clients()" id="search"
                                                    type="search" aria-label="Search">
                                                <button class="btn search-btn"><i
                                                        class="fa-solid fa-magnifying-glass"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-1">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                            data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel"> نموذج اضافة
                                                            ضيف جديد
                                                        </h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-right">
                                                        <form>
                                                            <div class="mb-3">
                                                                <label for="name" class="form-label">أسم
                                                                    الضيف</label>
                                                                <input type="text" class="form-control"
                                                                    id="name" aria-describedby="name">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="phone" class="form-label">رقم
                                                                    الهاتف</label>
                                                                <input type="text" class="form-control"
                                                                    id="phone">
                                                            </div>


                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">اغلاق</button>
                                                                <button type="button" data-bs-dismiss="modal"
                                                                    onclick="performStore()"
                                                                    class="btn btn-primary add-gust">تسجيل</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <h3>
                                            أضف ضيف جديد</h3>

                                    </div>
                                </div>
                                <div class="row gust-cards" id="clients">
                                    @include('branch._clients')
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="change-content btn btn-primary" data-id="#all-tables">السابق</div>
                                    </div>
                                    <div class="col-md-8"></div>
                                    <!--<div class="col-md-2">-->
                                    <!--    <button class="change-content btn btn-primary"-->
                                    <!--        data-id="#date-content">التالى</button>-->
                                    <!--</div>-->
                                </div>
                            </div>
                        </div>
                        <div class="ftco-section reservation-tabs" id="date-content">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-6 text-center mb-5">
                                        <h2 class="heading-section">Calendar #02</h2>
                                    </div>
                                    <div class="elegant-calencar d-md-flex mb-5">
                                        <div class="wrap-header d-flex align-items-center">
                                            <p id="reset">reset</p>
                                            <div id="header" class="p-0">
                                                <div
                                                    class="pre-button d-flex align-items-center justify-content-center">
                                                    <i class="fa fa-chevron-left"></i>
                                                </div>
                                                <div class="head-info">
                                                    <div class="head-day"></div>
                                                    <div class="head-month"></div>
                                                </div>
                                                <div
                                                    class="next-button d-flex align-items-center justify-content-center">
                                                    <i class="fa fa-chevron-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="calendar-wrap">
                                            <table id="calendar">
                                                <thead>
                                                    <tr>
                                                        <th>Sun</th>
                                                        <th>Mon</th>
                                                        <th>Tue</th>
                                                        <th>Wed</th>
                                                        <th>Thu</th>
                                                        <th>Fri</th>
                                                        <th>Sat</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td data-id="#alltime" class=""></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="change-content btn btn-primary" data-id="#allguests">السابق</div>
                                    </div>
                                    <div class="col-md-8"></div>
                                    <div class="col-md-2">
                                        <button class="change-content btn btn-primary"
                                            data-id="#alltime">التالى</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="reservation-tabs alltime" id="alltime">
                            <!-- Input group, just add class 'clockpicker', and optional data-* -->
                            <div class="row justify-content-center h-100">
                                <div class="col-12 col-md-4"></div>
                                <div class="col-12 col-md-4 text-center d-flex align-items-center">
                                    <!-- Input group, just add class 'clockpicker', and optional data-* -->
                                    <div class="input-group clockpicker" data-placement="right" data-align="top"
                                        data-autoclose="true">
                                        <input id="date-time" type="text" class="form-control clock"
                                            value="09:32">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4"></div>


                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="change-content btn btn-primary" data-id="#date-content">السابق</div>
                                </div>
                                <div class="col-md-8"></div>
                                <div class="col-md-2">
                                    <button class="change-content btn btn-primary" data-id="#status">التالى</button>
                                </div>
                            </div>
                        </div>
                        <div class="reservation-tabs allstatus" id="status">
                            <div class="container">
                                <div class="row">
                                    <div class="col-2"></div>
                                    <div class="col-8 d-flex justify-content-center">
                                        <form class="text-center" action="">
                                            <div class="row">
                                                <input data-id="#notes" type="checkbox"
                                                    class="btn-check change-content" id="confirmed" checked
                                                    autocomplete="off">
                                                <label class="btn btn-secondary" for="confirmed">مؤكد</label>
                                                <input data-id="#notes" type="radio"
                                                    class="btn-check change-content" name="options-outlined"
                                                    id="finished" autocomplete="off">
                                                <label class="btn btn-secondary" for="finished">منتهى</label>
                                                <input data-id="#notes" type="radio"
                                                    class="btn-check change-content" name="options-outlined"
                                                    id="canceld" autocomplete="off">
                                                <label class="btn btn-secondary" for="canceld">ملغى</label>
                                                <input data-id="#notes" type="radio"
                                                    class="btn-check change-content" name="options-outlined"
                                                    id="not-confirm" autocomplete="off">
                                                <label class="btn btn-secondary" for="not-confirm">لم يتم
                                                    التأكيد</label>
                                            </div>
                                            <div class="row">
                                                <input data-id="#notes" type="radio"
                                                    class="btn-check change-content" name="options-outlined"
                                                    id="no-answer" autocomplete="off">
                                                <label class="btn btn-secondary" for="no-answer">لم يتم
                                                    الإجابة</label>
                                                <input data-id="#notes" type="radio"
                                                    class="btn-check change-content" name="options-outlined"
                                                    id="late" autocomplete="off">
                                                <label class="btn btn-secondary" for="late">متأخر</label>
                                                <input data-id="#notes" type="radio"
                                                    class="btn-check change-content" name="options-outlined"
                                                    id="arrived" autocomplete="off">
                                                <label class="btn btn-secondary" for="arrived">تم الوصول</label>
                                            </div>


                                        </form>

                                    </div>
                                    <div class="col-2"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="change-content btn btn-primary" data-id="#alltime">السابق</div>
                                    </div>
                                    <div class="col-md-8"></div>
                                    <!--<div class="col-md-2">-->
                                    <!--    <button class="change-content btn btn-primary"-->
                                    <!--        data-id="#notes">التالى</button>-->
                                    <!--</div>-->
                                </div>
                            </div>

                        </div>
                        <div class="reservation-tabs notes pt-5 mt-5" id="notes">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <form class="text-right" action="">
                                            <div class="mb-3">
                                                <p class="">الرجاء تدوين الملاحظة بالأسفل</p>
                                            </div>
                                            <div class="mb-3">
                                                <textarea class="form-control note-input" id="exampleFormControlTextarea1" rows="3"></textarea>
                                            </div>
                                            <div class="col-auto">
                                                <button type="submit" class="btn btn-primary  note-save mb-3">تسجيل
                                                    الملحوظة</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <ol class="list-group note-lists list-group-numbered reversed">
                                            <li
                                                class="list-group-item note-list no-notes d-flex justify-content-between align-items-start">
                                                <div class="me-2 ms-auto">
                                                    <div class="fw-bold"> لا يوجد اى ملاحظات</div>
                                                </div>
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2  text-right">
                                        <div class="change-content btn btn-primary" data-id="#status">السابق</div>
                                    </div>
                                    <div class="col-md-7"></div>
                                    <div class="col-md-3">
                                        <div class="save-all btn btn-lg btn-primary" data-id="#pay">
                                            تقدم للدفع
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="reservation-tabs notes pt-5 mt-5" id="pay">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <ol class="list-group reversed paing-wrp">
                                            <li class="list-group-item no-number  ">
                                                <div
                                                    class="sub-total d-flex justify-content-between align-items-start w-100">
                                                    <div class="me-2 ms-auto">
                                                        <div class="fw-bold"> حاصل الجمع</div>
                                                    </div>
                                                    <span>260 ريال</span>
                                                </div>
                                                <div
                                                    class="tax d-flex justify-content-between align-items-start mt-4 w-100">
                                                    <div class="me-2 ms-auto">
                                                        <div class="fw-bold"> ضريبة</div>
                                                    </div>
                                                    <span>10%</span>
                                                </div>
                                                <div
                                                    class="tax d-flex justify-content-between align-items-start mt-4 total w-100">
                                                    <div class="me-2 ms-auto">
                                                        <div class="fw-bold"> الإجمالى</div>
                                                    </div>
                                                    <span>286 ريال</span>
                                                </div>
                                                <div class="payment-method w-100">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div
                                                                class="payment-icon d-flex justify-content-center align-items-center">
                                                                <i class="fa-solid fa-sack-dollar"></i>
                                                            </div>
                                                            <p class="text-center">كاش</p>
                                                        </div>
                                                        <div class="col-4">
                                                            <div
                                                                class="payment-icon d-flex justify-content-center align-items-center">
                                                                <i class="fa-solid fa-credit-card"></i>
                                                            </div>
                                                            <p class="text-center">بطاقة ائتمان</p>
                                                        </div>
                                                        <div class="col-4">
                                                            <div
                                                                class="payment-icon d-flex justify-content-center align-items-center">
                                                                <i class="fa-solid fa-wallet"></i>
                                                            </div>
                                                            <p class="text-center">المحفظة</p>
                                                        </div>
                                                    </div>
                                                    <div class="payment-btn my-3 text-center">
                                                        <div class="btn btn-primary btn-lg w-100"
                                                            data-bs-toggle="modal" data-bs-target="#exampleModal1">
                                                            ادفع الآن</div>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal1" tabindex="-1"
                                                            aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="exampleModalLabel">تأكيد الدفع
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p class="consfirm-text">هل تريد تأكيد الدفع
                                                                        </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-primary"
                                                                            onclick="storeReaervation()">تأكيد</button>
                                                                        <button type="button"
                                                                            class="btn btn-secondary"
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
                                    <div class="col-md-3"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- js files  -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js"
        integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('crudjs/crud.js') }}"></script>
    <script>
    
      
   

     
        function pack(id) {

            $.get('/branch/branch/halls/ajax', {
                id: id,
            }).done(function(data) {
                $('#all-tables').html(data); // Show the new content
            });
        }
        
         // استهداف العنصر .table-pick وتعيين الحدث النقر عليه
        document.querySelectorAll('.table-pick').forEach(function(element) {
            element.addEventListener('click', function() {
                // إزالة الفئة active-card من جميع عناصر .card داخل .new-reservation-tables
                var cardElements = document.querySelectorAll('.new-reservation-tables .card');
                cardElements.forEach(function(card) {
                    card.classList.remove('active-card');
                });
                
                // إضافة الفئة active-card إلى العنصر الذي تم النقر عليه
                this.classList.add('active-card');
                
                // الحصول على نص عنوان البطاقة
                var cardTitle = this.querySelector('.card-title').textContent;
                
                // تحديث نص العنصر .table-name بالعنوان الجديد
                var tableNames = document.querySelectorAll('.table-name');
                tableNames.forEach(function(tableName) {
                    tableName.textContent = cardTitle;
                });
                
                // الحصول على القيمة المخزنة في الخاصية data-choosen وتعيينها في الخاصية data-choos للعنصر .table-name
                var itemId = this.getAttribute('data-choosen');
                tableNames.forEach(function(tableName) {
                    tableName.setAttribute('data-choos', itemId);
                });
            });
        });
        
        
        function clients() {
            var phone = $("#search").val();

            $.get('/branch/clients/ajax', {
                phone: phone,
            }).done(function(data) {
                $('#clients').html(data); // Show the new content
            });
        }

        function performStore() {
            let formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('phone', document.getElementById('phone').value);
            store('/branch/clients', formData)
            this.clients()
        }
        // $('.table-pick').on('click', function() {
        //     $('.new-reservation-tables .card').removeClass('active-card');
        //     $(this).addClass('active-card');
        //     var cardTitle = $(this).find('.card-title').text();
        //     $('.table-name').text(cardTitle);

        //     var itemId = $(this).data('choosen');
        //     $('.table-name').attr('data-choos', itemId);
        // });

        // Function for guest click event
        $('.gust-cards .card').on('click', function(event) {
            event.stopPropagation();

            var personeName = $(this).find('.card-title');
            $('.guest-name').text(personeName.text());
            console.log($(this));

            var itemId = $(this).data('choosen');
            $('.guest-name').attr('data-choos', itemId);
        });

        // Function to handle form submission
        function storeReaervation() {
            var packageId = $('.package-name').attr('data-choos');
            var tableId = $('.table-name').attr('data-choos');
            var guestId = $('.guest-name').attr('data-choos');
            var date = $('.reserv-date').text();
            var time = $('.reserv-time').text();
            var status = $('.nav-statues').text();

            let formData = new FormData();
            formData.append('client_id', guestId);
            formData.append('package_id', packageId);
            formData.append('table_id', tableId);
            formData.append('date', date);
            formData.append('time', time);
            formData.append('status', status);

            // Call the 'store' function to handle the form data submission
            store('/branch/reservations', formData);
        }

        // Add event listener to form submission
        $('#reservation-form').on('submit', function(event) {
            event.preventDefault();
            handleFormSubmission();
        });

    </script>
    <script>
        var dt = new Date().toLocaleTimeString();
        document.getElementById('date-time').value = dt;
    </script>
</body>

</html>
