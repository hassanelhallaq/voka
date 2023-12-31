<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/main.css') }}">


    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <style>
        .new-reversation .fa-plus {
            margin-left: 6px;
        }

        .calc {
            font-size: 30px;
            cursor: pointer;
        }

        /*--------------------------------------------- css for the lock screen ----------------------------------------*/
        .closed-screen {
            width: 100%;
            height: 100vh;
            background-color: rgb(27, 27, 27);
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            z-index: 9999;
            display: none;
        }

        .opened-screen {
            display: block;
        }

        .lock-screen {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
            direction: ltr;
        }

        #waiter-notification {
            display: none;
            /* Other modal styles */
        }

        .pin-container {
            text-align: center;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: white;
            border-radius: 8px;
        }

        .pin-input {
            width: 60px;
            padding: 8px;
            text-align: center;
            font-size: 18px;
        }

        .pin-submit {
            margin-top: 10px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .numeric-keypad {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 10px;
            margin-top: 10px;
        }

        .numeric-key {
            width: 60px;
            height: 60px;
            font-size: 24px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .numeric-key:hover {
            background-color: #ccc;
        }

        /*----------------------------------------------end of the lock screen css code ----------------------------------------*/
        /*--------------------------------- the calculater css -----------------------------------------------------------------*/
        .the-calc {
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
            background-color: #202020;
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            height: 100vh;
            width: 100%;
            direction: ltr;
        }

        .calc-container {
            position: relative;
            min-width: 300px;
            min-height: 400px;
            padding: 40px 30px 30px;
            border-radius: 20px;
            box-shadow: 25px 25px 75px rgba(0, 0, 0, 0.25),
                10px 10px 70px rgba(0, 0, 0, 0.25), inset -5px -5px 15px rgba(0, 0, 0, 0.25),
                inset 5px 5px 15px rgba(0, 0, 0, 0.25);
            width: 500px;
        }

        .calc-container span {
            color: #fff;
            position: relative;
            display: grid;
            width: 80px;
            place-items: center;
            margin: 8px;
            height: 80px;
            background: linear-gradient(180deg, #2f2f2f, #3f3f3f);
            box-shadow: inset -8px 0 8px rgba(0, 0, 0, 0.15),
                inset 0 -8px 8px rgba(0, 0, 0, 0.25), 0 0 0 2px rgba(0, 0, 0, 0.75),
                10px 20px 25px rgba(0, 0, 0, 0.4);
            user-select: none;
            cursor: pointer;
            font-weight: 400;
            border-radius: 10px;
        }

        .calculator span:active {
            filter: brightness(1.5);
        }

        .calculator span::before {
            content: "";
            position: absolute;
            top: 3px;
            left: 4px;
            bottom: 14px;
            right: 12px;
            border-radius: 10px;
            background: linear-gradient(90deg, #2d2d2d, #4d4d4d);
            box-shadow: -5px -5px 15px rgba(0, 0, 0, 0.1),
                10px 5px 10px rgba(0, 0, 0, 0.15);
            border-left: 1px solid #0004;
            border-bottom: 1px solid #0004;
            border-top: 1px solid #0009;
        }

        .calculator span i {
            position: relative;
            font-style: normal;
            font-size: 1.5em;
            text-transform: uppercase;
        }

        .calculator {
            position: relative;
            display: grid;
        }

        .calculator .value {
            position: relative;
            grid-column: span 4;
            height: 100px;
            width: calc(100% - 20px);
            left: 10px;
            border: none;
            outline: none;
            background-color: #a7af7c;
            margin-bottom: 10px;
            border-radius: 10px;
            box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.75);
            text-align: right;
            padding: 10px;
            font-size: 2em;
        }

        .calculator .clear {
            grid-column: span 2;
            width: 180px;
            background: #f00;
        }

        .calculator .clear::before {
            background: linear-gradient(90deg, #d20000, #ffffff5c);
            border-left: 1px solid #fff4;
            border-bottom: 1px solid #fff4;
            border-top: 1px solid #fff4;
        }

        .calculator .plus {
            grid-row: span 2;
            height: 180px;
        }

        .calculator .equal {
            background: #2196f3;
        }

        .calculator .equal::before {
            background: linear-gradient(90deg, #1479c9, #ffffff5c);
            border-left: 1px solid #fff4;
            border-bottom: 1px solid #fff4;
            border-top: 1px solid #fff4;
        }

        .active-calc {
            display: flex;
            z-index: 9999;
        }

        .inactive-calc {
            display: none;
        }

        /*-------------------------------- loading css ----------------------------------------*/
        .loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            display: none;
            /* Start hidden */
        }

        .loading-screen .lds-ellipsis {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
        }

        .lds-ellipsis div {
            position: absolute;
            top: 33px;
            width: 13px;
            height: 13px;
            border-radius: 50%;
            background: #fff;
            animation-timing-function: cubic-bezier(0, 1, 1, 0);
        }

        .lds-ellipsis div:nth-child(1) {
            left: 8px;
            animation: lds-ellipsis1 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(2) {
            left: 8px;
            animation: lds-ellipsis2 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(3) {
            left: 32px;
            animation: lds-ellipsis2 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(4) {
            left: 56px;
            animation: lds-ellipsis3 0.6s infinite;
        }

        @keyframes lds-ellipsis1 {
            0% {
                transform: scale(0);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes lds-ellipsis3 {
            0% {
                transform: scale(1);
            }

            100% {
                transform: scale(0);
            }
        }

        @keyframes lds-ellipsis2 {
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(24px, 0);
            }
        }

        /*--------------- the notifcation card css style -------------------*/
        .active-notification {
            display: block;
        }

        .noitification-card {
            /*position: fixed;*/
            /*bottom: 50px;*/
            /*right: 50px;*/
            background-color: var(--accentDark);
            padding-top: 30px;
            padding-bottom: 30px;
            /*z-index: 9999;*/
        }

        .icon {
            display: flex;
            /* padding: 32px; */
            font-size: 32px;
            background-color: #e5772a;
            color: #fff;
            border-radius: 50%;
            height: 80px;
            width: 80px;
            justify-content: center;
            align-items: center;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 20px;
        }

        .noitification-card .card-subtitle {
            font-size: 27px;

        }

        /*--------------- end of  notifcation card css style -------------------*/
    </style>





</head>

<body>

    <!-- Button trigger modal -->
    <!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#waiter-notification">-->
    <!--  Notification-->
    <!--</button>-->

    <!-- Modal -->
    <div class="modal fade notification-modal active-notification " id="waiter-notification" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!--notification card for waiter -->
                <div class="noitification-card card">
                    <div class="card-body text-center">
                        <div class="icon">
                            <i class="fa-solid fa-bell"></i>
                        </div>
                        <h5 class="card-title"> استدعاء ويتر لطاولة </h5>
                        <h6 class="card-subtitle my-3 text-light"> </h6>
                        <!--<a href="#" class="noitification-card-close btn btn-primary mt-3">اغلاق </a>-->
                        <button type="button" class="noitification-modal-close btn btn-primary mt-3"
                            data-bs-dismiss="modal">اغلاق</button>
                    </div>
                </div>
                <!-- end of notification card for waiter -->
            </div>
        </div>
    </div>

    <!--loading effects -->
    <div class="loading-screen" id="loadingScreen">
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!--end of loading effects -->


    <section class="main">
        <div class="container-fluid text-light">
            <div class="row top-actions">
                <div class="col-md-1">
                    <div class="logo mb-5">
                        <a class="navbar-brand d-flex flex-column  justify-content-center align-items-center"
                            href="#">
                            <i class="fas fa-hamburger"></i>
                            <span>فوكا لاونج</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="notifications-wrap">
                        <div class="logout mb-5">
                            <div class="card mb-3">
                                <div class="row g-0">
                                    <div class="col-md-2">
                                        <i class="top-icon fa-solid fa-user-tie"></i>
                                    </div>
                                    <div class="col-md-10 pr-2">
                                        <div class="card-body  p-0">
                                            <h5 class="card-title">محمد أحمد</h5>
                                            <a href="#" class="card-text">تسجيل خروج</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="notifications mb-5">
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-2">
                                    <i class="top-icon fa-solid fa-bell"></i>
                                </div>
                                <div class="col-md-10 pr-2">
                                    <div class="card-body  p-0">
                                        <h5 class="card-title"> استدعاء ويتر</h5>
                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                عرض الأستدعاء
                                            </button>
                                            <ul class="dropdown-menu w-100 text-right">
                                                <li>
                                                    <a href="#" class="top-text-block">
                                                        <div class="top-text-heading">
                                                            <span class="noti-text">استدعاء طاولة: </span>
                                                            <span class="table-number">VVIP2</span>
                                                        </div>
                                                        <div class="top-text-light">
                                                            منذ <span class="noti-time"> 30 ثانية</span>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="top-text-block">
                                                        <div class="top-text-heading">
                                                            <span class="noti-text">استدعاء طاولة: </span>
                                                            <span class="table-number">VVIP2</span>
                                                        </div>
                                                        <div class="top-text-light">
                                                            منذ <span class="noti-time"> 30 ثانية</span>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="top-text-block">
                                                        <div class="top-text-heading">
                                                            <span class="noti-text">استدعاء طاولة: </span>
                                                            <span class="table-number">VVIP2</span>
                                                        </div>
                                                        <div class="top-text-light">
                                                            منذ <span class="noti-time"> 30 ثانية</span>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="text-center">
                                                    <a href="#" class="btn btn-link text-center mt-3">كل
                                                        الأستدعاءات</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-1">
                    <div class="languages">
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                English
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="#">عربى</a></li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-md-1">
                    <div class="calc">
                        <i class="fa-solid fa-calculator"></i>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="lock close-the-screen">
                        <i class="fa-solid fa-unlock-keyhole"></i>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class=" new-reversation">
                        <a href="{{ route('branch.reservation') }}" class="btn btn-primary"> <i
                                class="fa-solid fa-plus"></i> حجز جديد</a>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-1">
                    <div class="sidenav d-flex flex-column">
                        <!--<div class="logo mb-5">-->
                        <!--    <a class="navbar-brand d-flex flex-column  justify-content-center align-items-center"-->
                        <!--        href="#">-->
                        <!--        <i class="fas fa-hamburger"></i>-->
                        <!--        <span>فوكا لاونج</span>-->
                        <!--    </a>-->
                        <!--</div>-->
                        <div class="nav-body">
                            <ul class="navbar-nav justify-content-center flex-grow-1">
                                @can('branch_home')
                                    <li class="nav-item home active">
                                        <a class="nav-link d-flex flex-column justify-content-center align-items-center  home-link active"
                                            aria-current="page" href="{{ route('branch.home') }}">
                                            <i class="fa-solid fa-house"></i>
                                            <span>الرئيسية</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('branch_tables')
                                    <li class="nav-item halls dropdown">
                                        <a class="nav-link d-flex flex-column justify-content-center align-items-center "
                                            href="{{ route('branch.halls') }}" role="button">
                                            <i class="fa-solid fa-table-cells-large"></i>
                                            <span>الطاولات</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('branch_reservations')
                                    <li class="nav-item resver">
                                        <a href="{{ route('ajaxCalender') }}"
                                            class="nav-link d-flex flex-column justify-content-center align-items-center ">
                                            <i class="fa-solid fa-utensils"></i>
                                            <span>الحجوزات</span>
                                        </a>
                                    </li>
                                @endcan
                                {{-- <li class="nav-item package">
                                    <a class="nav-link d-flex flex-column justify-content-center align-items-center menu-nav-link"
                                        onclick="packages()">
                                        <i class="fa-solid fa-box-open"></i>
                                        <span>الباقات</span>
                                    </a>
                                </li> --}}
                                {{-- <li class="nav-item">
                                    <a class="nav-link d-flex flex-column justify-content-center align-items-center menu-nav-link"
                                        href="waitingList.html">
                                        <i class="fa-regular fa-clock"></i>
                                        <span>الأنتظار</span>
                                    </a>
                                </li> --}}
                                @can('branch_menu')
                                    <li class="nav-item product">
                                        <a class="nav-link d-flex flex-column justify-content-center align-items-center "
                                            onclick="products()">
                                            <i class="fa-solid fa-clipboard-list "></i>
                                            <span>القائمة</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('branch_casher')
                                    <li class="nav-item  casher">
                                        <a  href="{{ route('casher.create') }}"
                                            class="nav-link d-flex flex-column justify-content-center align-items-center ">
                                            <i class="fa-solid fa-clipboard-list "></i>
                                            <span>الجرد</span>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </div>
                </div>
                @yield('contentFront')


                @include('branch.reservSide')

            </div>
        </div>
    </section>
    @yield('js')
    <!--<script src="{{ asset('front/js/jquery.js') }}"></script>-->
    <!--<script src="https://unpkg.com/@popperjs/core@2"></script>-->
    <!--<script src="{{ asset('front/js/bootstrap.min.js') }}"></script>-->

    <!--<script src="{{ asset('front/js/main.js') }}"></script>-->
    <script>
        $(document).ready(function() {
            // Load 'branch.reservSide' view using jQuery's $.get() method
            $.get('/branch/path/to/branch.reservSide', function(data) {
                // Once the view is loaded, place its content inside the container
                // $('#reservSideContainer').html(data);
                // Hide the container after loading the view
                $('#reservSideContainer').hide();
            });

            $('.noitification-card-close').on('click', function() {
                var notificationCard = $('.noitification-card');

                // استخدام animate() لتحريك العنصر إلى اليمين ثم إخفائه
                notificationCard.animate({
                        left: '100%'
                    }, // يمكنك ضبط القيمة حسب الحاجة
                    {
                        duration: 500, // مدة الانزلاق بالميلي ثانية
                        complete: function() {
                            notificationCard.hide(); // بعد اكتمال الانزلاق، قم بإخفاء العنصر
                        }
                    }
                );
            });

            $('.noitification-modal-close').on('click', function() {
                $('.notification-modal').removeClass('active-notification show');
            });
            
            
            $('.sidenav .nav-item').on('click', function(){
                $('.sidenav .nav-item').removeClass('active');
                $(this).addClass('active');
            });
        });

        function products() {
            // Remove active class from "الرئيسية" link
            $('.nav-item.active').removeClass('active');

            // Add active class to "القائمة" link
            $('.product').addClass('active');

            $('#mainPage').empty(); // Clear the previous page content
            $.get('/branch/branch/products', {

            }).done(function(data) {
                $('#mainPage').html(data); // Show the new content
            }).done(function() {
                $('#casher-section').show(); // Hide the casher section
                $('#reserv-main-section').hide();
                $('#reservSideContainer').hide(); // Show the reserv main section
            });
        }

        function halls() {
            // Remove active class from "الرئيسية" link
            $('.nav-item.active').removeClass('active');

            // Add active class to "القائمة" link
            $('.halls').addClass('active');

            $('#mainPage').empty(); // Clear the previous page content
            $.get('/branch/branch/halls', {}).done(function(data) {
                $('#mainPage').html(data); // Show the new content
            }).done(function() {
                $('#casher-section').show(); // Hide the casher section
                $('#reserv-main-section').hide();
                $('#reservSideContainer').hide(); // Show the reserv main section
            });
        }

        function isPageReloaded() {
            return performance.navigation.type === 1; // 1 represents PAGE_RELOAD
        }

        function packages() {
            // Remove active class from "الرئيسية" link
            $('.nav-item.active').removeClass('active');

            // Add active class to "القائمة" link
            $('.package').addClass('active');

            $('#mainPage').empty(); // Clear the previous page content
            $.get('/branch/packages/ajax', {}).done(function(data) {
                $('#mainPage').html(data); // Show the new content
            }).done(function() {
                $('#casher-section').show(); // Hide the casher section
                $('#reserv-main-section').hide(); // Show the reserv main section
            });
        }

        function home() {
            $('.nav-item.active').removeClass('active');

            // Add active class to "القائمة" link
            $('.home').addClass('active');
            $('#mainPage').empty(); // Clear the previous page content
            $.get('/branch/branch/_home', {}).done(function(data) {
                $('#mainPage').html(data); // Show the new content
            }).done(function() {
                $('#casher-section').show(); // Hide the casher section
                $('#reserv-main-section').hide();
                $('#reservSideContainer').hide(); // Show the reserv main section
            });
        }

        // function resver() {
        //     $('.nav-item.active').removeClass('active');

        //     // Add active class to "الحجوزات" link
        //     $('.resver').addClass('active');
        //     $('#mainPage').empty(); // Clear the previous page content
        //     $.get('/branch/resver/ajax', {}).done(function(data) {
        //         $('#mainPage').html(data); // Show the new content
        //     }).done(function() {
        //         $('#casher-section').hide(); // Hide the casher section
        //         $('#reservSideContainer').show();
        //         // $('#reserv-main-section').show(); // Show the reserv main section
        //     });
        // }

        // function casher() {
        //     $('.nav-item.active').removeClass('active');

        //     // Add active class to "الحجوزات" link
        //     $('.casher').addClass('active');
        //     $('#mainPage').empty(); // Clear the previous page content
        //     $.get('/branch/casher/create', {}).done(function(data) {
        //         $('#mainPage').html(data); // Show the new content
        //     }).done(function() {
        //         $('#casher-section').hide(); // Hide the casher section
        //         $('#reservSideContainer').hide();
        //         // $('#reserv-main-section').show(); // Show the reserv main section
        //     });
        // }
    </script>

    <div class="closed-screen">
        <div class="lock-screen">
            <div class="pin-container">
                <h2>أدخل رمز PIN</h2>
                <input type="password" class="pin-input" id="pinInput" maxlength="4">
                <div class="numeric-keypad">
                    <button class="numeric-key">1</button>
                    <button class="numeric-key">2</button>
                    <button class="numeric-key">3</button>
                    <button class="numeric-key">4</button>
                    <button class="numeric-key">5</button>
                    <button class="numeric-key">6</button>
                    <button class="numeric-key">7</button>
                    <button class="numeric-key">8</button>
                    <button class="numeric-key">9</button>
                    <button class="numeric-key">0</button>
                </div>
                <button class="pin-submit" id="pinSubmit">فتح</button>
            </div>
        </div>

    </div>




    <div class="the-calc inactive-calc flex-column">
        <button class="calc-close btn btn-primary my-3">اغلاق</button>
        <div class="calc calc-container">
            <form action="" name="calc" class="calculator">
                <input type="text" class="value" readonly name="txt" />
                <span class="num clear" onclick="calc.txt.value=''"><i>C</i></span>
                <span class="num" onclick="calc.txt.value+='/'"><i>/</i></span>
                <span class="num" onclick="calc.txt.value+='*'"><i>*</i></span>
                <span class="num" onclick="calc.txt.value+='7'"><i>7</i></span>
                <span class="num" onclick="calc.txt.value+='8'"><i>8</i></span>
                <span class="num" onclick="calc.txt.value+='9'"><i>9</i></span>
                <span class="num" onclick="calc.txt.value+='-'"><i>-</i></span>
                <span class="num" onclick="calc.txt.value+='4'"><i>4</i></span>
                <span class="num" onclick="calc.txt.value+='5'"><i>5</i></span>
                <span class="num" onclick="calc.txt.value+='6'"><i>6</i></span>
                <span class="num plus" onclick="calc.txt.value+='+'"><i>+</i></span>
                <span class="num" onclick="calc.txt.value+='1'"><i>1</i></span>
                <span class="num" onclick="calc.txt.value+='2'"><i>2</i></span>
                <span class="num" onclick="calc.txt.value+='3'"><i>3</i></span>
                <span class="num" onclick="calc.txt.value+='0'"><i>0</i></span>
                <span class="num" onclick="calc.txt.value+='00'"><i>00</i></span>
                <span class="num" onclick="calc.txt.value+='.'"><i>.</i></span>

                <span class="num equal" onclick="document.calc.txt.value=eval(calc.txt.value)"><i>=</i></span>
            </form>
        </div>
    </div>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.close-the-screen').on('click', function() {
                $('.closed-screen').addClass('opened-screen');
                $('.lock-screen').fadeIn();
                $('#pinInput').val('');
            });

            const correctPin = "1234"; // رمز PIN الصحيح
            const $pinInput = $('#pinInput');
            const $pinSubmit = $('#pinSubmit');

            $pinSubmit.on('click', function() {
                const enteredPin = $pinInput.val();

                if (enteredPin === correctPin) {
                    $('.lock-screen').fadeOut();
                    $('.closed-screen').removeClass('opened-screen');
                } else {
                    alert('رمز PIN غير صحيح');
                }
            });

            $('.numeric-key').on('click', function() {
                const key = $(this).text();
                const currentPin = $pinInput.val();
                if (currentPin.length < 4) {
                    $pinInput.val(currentPin + key);
                }
            });

            $('.calc').on('click', function() {
                $('.the-calc').removeClass('inactive-calc').addClass('active-calc');
            });
            $('.calc-close').on('click', function() {
                $('.the-calc').removeClass('active-calc').addClass('inactive-calc');
            });


            $(document).ready(function() {
                $(".menu-nav-link").on("click", function(event) {
                    event.preventDefault(); // منع سلوك الرابط الافتراضي

                    var loadingScreen = $("#loadingScreen");

                    loadingScreen.css("display", "flex"); // عرض شاشة التحميل

                    // محاكاة تأخير التحميل باستخدام setTimeout
                    setTimeout(function() {
                        var clickedLink = $(event.target).closest("a");

                        if (clickedLink.hasClass("home")) {
                            home();
                        } else if (clickedLink.hasClass("halls")) {
                            halls();
                        } else if (clickedLink.hasClass("resver")) {
                            resver();
                        }
                        // وهكذا يمكنك إضافة الصفحات الأخرى هنا

                        // إخفاء شاشة التحميل بعد اكتمال الإجراءات
                        loadingScreen.css("display", "none");

                    }, 3000); // محاكاة توقيت التحميل
                });
            });

            $('.home-link').on('click', function() {
                $('.main-from-home').removeClass('col-md-8').addClass('col-md-11');
                console.log('hhhhhhhhhhhhhhhhhh');
            });


        });
    </script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.close-the-screen').on('click', function() {
                $('.closed-screen').addClass('opened-screen');
                $('.lock-screen').fadeIn();
                $('#pinInput').val('');
            });

            const correctPin = "1234"; // رمز PIN الصحيح
            const $pinInput = $('#pinInput');
            const $pinSubmit = $('#pinSubmit');

            $pinSubmit.on('click', function() {
                const enteredPin = $pinInput.val();

                if (enteredPin === correctPin) {
                    $('.lock-screen').fadeOut();
                    $('.closed-screen').removeClass('opened-screen');
                } else {
                    alert('رمز PIN غير صحيح');
                }
            });

            $('.numeric-key').on('click', function() {
                const key = $(this).text();
                const currentPin = $pinInput.val();
                if (currentPin.length < 4) {
                    $pinInput.val(currentPin + key);
                }
            });

            $('.calc').on('click', function() {
                $('.the-calc').removeClass('inactive-calc').addClass('active-calc');
            });
            $('.calc-close').on('click', function() {
                $('.the-calc').removeClass('active-calc').addClass('inactive-calc');
            });


            // $(document).ready(function() {
            //     $(".menu-nav-link").on("click", function(event) {
            //         event.preventDefault(); // منع سلوك الرابط الافتراضي

            //         var loadingScreen = $("#loadingScreen");

            //         loadingScreen.css("display", "flex"); // عرض شاشة التحميل

            //         // محاكاة تأخير التحميل باستخدام setTimeout
            //         setTimeout(function() {
            //             var clickedLink = $(event.target).closest("a");

            //             if (clickedLink.hasClass("home")) {
            //                 home();
            //             } else if (clickedLink.hasClass("halls")) {
            //                 halls();
            //             } else if (clickedLink.hasClass("resver")) {
            //                 resver();
            //             }
            //             // وهكذا يمكنك إضافة الصفحات الأخرى هنا

            //             // إخفاء شاشة التحميل بعد اكتمال الإجراءات
            //             loadingScreen.css("display", "none");

            //         }, 3000); // محاكاة توقيت التحميل
            //     });
            // });

            // $('.home-link').on('click', function() {
            //     $('.main-from-home').removeClass('col-md-8'));
            //     console.log('hhhhhhhhhhhhhhhhhh');
            // });


        });
    </script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('0de470f391dd841845ff', {
            cluster: 'eu'
        });
        var channel = pusher.subscribe('newOrdersDigitalMenu');
        channel.bind('realtimeBranchID_' + {{ Auth::user()->branch_id }}, function(data) {
            var orderData = JSON.parse(JSON.stringify(data));

            var table = data.config.table_id;
            console.log(table);
            $('#waiter-notification .card-subtitle').text(table); // Update the subtitle text
            $('#waiter-notification').modal('show'); // Use .modal('show') to open the modal
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.home-link').on('click', function() {
                console.log("ready!");
                $('.main-from-home').removeClass('col-md-8');

            });

        });
    </script>
</body>

</html>
