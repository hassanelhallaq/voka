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




</head>

<body>

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
                <div class="col-md-3">
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
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                English
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="#">عربى</a></li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-md-1">
                    <div class="lock">
                        <i class="fa-solid fa-unlock-keyhole"></i>
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
                                        <a class="nav-link d-flex flex-column justify-content-center align-items-center active"
                                            aria-current="page" onclick="home()">
                                            <i class="fa-solid fa-house"></i>
                                            <span>الرئيسية</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('branch_tables')
                                    <li class="nav-item halls dropdown">
                                        <a class="nav-link d-flex flex-column justify-content-center align-items-center"
                                            onclick="halls()" role="button">
                                            <i class="fa-solid fa-table-cells-large"></i>
                                            <span>الطاولات</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('branch_reservations')
                                    <li class="nav-item resver">
                                        <a class="nav-link d-flex flex-column justify-content-center align-items-center"
                                            onclick="resver()">
                                            <i class="fa-solid fa-utensils"></i>
                                            <span>الحجوزات</span>
                                        </a>
                                    </li>
                                @endcan
                                {{-- <li class="nav-item package">
                                    <a class="nav-link d-flex flex-column justify-content-center align-items-center"
                                        onclick="packages()">
                                        <i class="fa-solid fa-box-open"></i>
                                        <span>الباقات</span>
                                    </a>
                                </li> --}}
                                {{-- <li class="nav-item">
                                    <a class="nav-link d-flex flex-column justify-content-center align-items-center"
                                        href="waitingList.html">
                                        <i class="fa-regular fa-clock"></i>
                                        <span>الأنتظار</span>
                                    </a>
                                </li> --}}
                                @can('branch_menu')
                                    <li class="nav-item product">
                                        <a class="nav-link d-flex flex-column justify-content-center align-items-center"
                                            onclick="products()">
                                            <i class="fa-solid fa-clipboard-list "></i>
                                            <span>القائمة</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('branch_casher')
                                    <li class="nav-item  casher">
                                        <a onclick="casher()"
                                            class="nav-link d-flex flex-column justify-content-center align-items-center">
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
    <script src="{{ asset('front/js/jquery.js') }}"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>

    <!--<script src="{{ asset('front/js/main.js') }}"></script>-->
</body>

</html>
<script>
    $(document).ready(function() {
        // Load 'branch.reservSide' view using jQuery's $.get() method
        $.get('/branch/path/to/branch.reservSide', function(data) {
            // Once the view is loaded, place its content inside the container
            // $('#reservSideContainer').html(data);
            // Hide the container after loading the view
            $('#reservSideContainer').hide();
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

    function resver() {
        $('.nav-item.active').removeClass('active');

        // Add active class to "الحجوزات" link
        $('.resver').addClass('active');
        $('#mainPage').empty(); // Clear the previous page content
        $.get('/branch/resver/ajax', {}).done(function(data) {
            $('#mainPage').html(data); // Show the new content
        }).done(function() {
            $('#casher-section').hide(); // Hide the casher section
            $('#reservSideContainer').show();
            // $('#reserv-main-section').show(); // Show the reserv main section
        });
    }

    function casher() {
        $('.nav-item.active').removeClass('active');

        // Add active class to "الحجوزات" link
        $('.casher').addClass('active');
        $('#mainPage').empty(); // Clear the previous page content
        $.get('/branch/casher/create', {}).done(function(data) {
            $('#mainPage').html(data); // Show the new content
        }).done(function() {
            $('#casher-section').hide(); // Hide the casher section
            $('#reservSideContainer').hide();
            // $('#reserv-main-section').show(); // Show the reserv main section
        });
    }
</script>
