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
            <div class="row">
                <div class="col-md-1">
                    <div class="sidenav d-flex flex-column">
                        <div class="logo mb-5">
                            <a class="navbar-brand d-flex flex-column  justify-content-center align-items-center"
                                href="#">
                                <i class="fas fa-hamburger"></i>
                                <span>فوكا لاونج</span>
                            </a>
                        </div>
                        <div class="nav-body">
                            <ul class="navbar-nav justify-content-center flex-grow-1">
                                <li class="nav-item home active">
                                    <a class="nav-link d-flex flex-column justify-content-center align-items-center active"
                                        aria-current="page" onclick="home()">
                                        <i class="fa-solid fa-house"></i>
                                        <span>الرئيسية</span>
                                    </a>
                                </li>
                                <li class="nav-item halls dropdown">
                                    <a class="nav-link d-flex flex-column justify-content-center align-items-center"
                                        onclick="halls()" role="button">
                                        <i class="fa-solid fa-table-cells-large"></i>
                                        <span>الصالات</span>
                                    </a>
                                </li>
                                <li class="nav-item resver">
                                    <a class="nav-link d-flex flex-column justify-content-center align-items-center"
                                        onclick="resver()">
                                        <i class="fa-solid fa-utensils"></i>
                                        <span>الحجوزات</span>
                                    </a>
                                </li>
                                {{-- <li class="nav-item package">
                                    <a class="nav-link d-flex flex-column justify-content-center align-items-center"
                                        onclick="packages()">
                                        <i class="fa-solid fa-box-open"></i>
                                        <span>الباقات</span>
                                    </a>
                                </li> --}}
                                <li class="nav-item">
                                    <a class="nav-link d-flex flex-column justify-content-center align-items-center"
                                        href="waitingList.html">
                                        <i class="fa-regular fa-clock"></i>
                                        <span>الأنتظار</span>
                                    </a>
                                </li>
                                <li class="nav-item product">
                                    <a class="nav-link d-flex flex-column justify-content-center align-items-center"
                                        onclick="products()">
                                        <i class="fa-solid fa-clipboard-list "></i>
                                        <span>القائمة</span>
                                    </a>
                                </li>
                                <li class="nav-item  casher">
                                    <a onclick="casher()"
                                        class="nav-link d-flex flex-column justify-content-center align-items-center">
                                        <i class="fa-solid fa-clipboard-list "></i>
                                        <span>الجرد</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                @yield('contentFront')

                @include('branch._casher')
                @include('branch.reservSide')

            </div>
        </div>
    </section>
    @yield('js')
    <script src="{{ asset('front/js/jquery.js') }}"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('front/js/main.js') }}"></script>
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
