<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فوكا لاونج</title>

    <!-- Vendor Stylesheets -->
    <link rel="stylesheet" href="{{ asset('/menu/assets/css/plugins/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/menu/assets/css/plugins/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/menu/assets/css/plugins/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('/menu/assets/css/plugins/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('/menu/assets/css/plugins/slick-theme.css') }}">
    <!-- Icon Fonts -->
    <link rel="stylesheet" href="{{ asset('/menu/assets/fonts/flaticon/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('/menu/assets/fonts/font-awesome/css/all.min.css') }}">
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet">
    <!-- Slices Style sheet -->
    <link rel="stylesheet" href="{{ asset('/menu/assets/css/style.css') }}">
    <!-- Style Arabic -->
    <link rel="stylesheet" href="{{ asset('/menu/assets/css/styleArabic.css') }}">
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="favicon.ico">

</head>

<body>

    <!-- Preloader Start -->
    <div class="ct-preloader">
        <div class="ct-preloader-inner">
            <div class="lds-ripple">
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <!-- Preloader End -->

    <!-- Search Form Start-->
    <div class="search-form-wrapper">
        <div class="search-trigger close-btn">
            <span></span>
            <span></span>
        </div>
        <form class="search-form" method="post">
            <input type="text" placeholder="Search..." value="">
            <button type="submit" class="search-btn">
                <i class="flaticon-magnifying-glass"></i>
            </button>
        </form>
    </div>
    <!-- Search Form End-->
    <div class="aside-overlay aside-trigger"></div>

    <!-- Header Start -->
    <header class="main-header header-1 header-absolute header-light">

        <div class="top-header">
            <div class="container">
                <div class="top-header-inner">
                    <ul class="top-header-nav header-cta">
                        <li> <a href="menu-v1.html">استدعي الويتر</a> </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container">
            <nav class="navbar">
                <!-- Logo -->
                <a class="navbar-brand"
                    href="{{ route('menu.home', ['table_id' => $table->id, 'branch_id' => $branch->id]) }}"> <img
                        src="https://via.placeholder.com/135x73" alt="logo">
                </a>
                <!-- Menu -->


                <div class="header-controls">
                    <ul class="navbar-nav">
                        <li class="menu-item menu-item-has-children">
                            <a
                                href="{{ route('menu.home', ['table_id' => $table->id, 'branch_id' => $branch->id]) }}">الرئيسية</a>
                        </li>
                    </ul>
                    <ul class="header-controls-inner">
                        <a href="{{ route('menu.cart', ['table_id' => $table->id, 'branch_id' => $branch->id]) }}">
                            <li class="cart-dropdown-wrapper cart-trigger">
                                <span class="cart-item-count" id="cart-item-count">0</span>
                                <i class="flaticon-shopping-bag"></i>
                            </li>
                        </a>
                        <li class="search-dropdown-wrapper search-trigger">
                            <i class="flaticon-search"></i>
                        </li>
                    </ul>
                </div>

            </nav>
        </div>

    </header>
    @yield('content')
    <footer class="ct-footer footer-dark">
        <!-- Top Footer -->
        <div class="container">
            <div class="footer-top">
                <div class="footer-logo">
                    <img src="https://via.placeholder.com/135x73" alt="logo">
                </div>
            </div>
        </div>

        <!-- Middle Footer -->
        <div class="footer-middle">
            <div class="container">
                <div class="row" style="justify-content: center; align-items: center;">
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 footer-widget">
                        <h5 class="widget-title">ابقى على تواصل معنا</h5>
                        <ul class="social-media">
                            <li> <a href="#" class="facebook"> <i class="fab fa-facebook-f"></i> </a> </li>
                            <li> <a href="#" class="pinterest"> <i class="fab fa-pinterest-p"></i> </a> </li>
                            <li> <a href="#" class="google"> <i class="fab fa-google"></i> </a> </li>
                            <li> <a href="#" class="twitter"> <i class="fab fa-twitter"></i> </a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-copyright">
                    <p> جميع الحقوق محفوظة © </p>
                    <a href="#" class="back-to-top">الرجوع للأعلى <i class="fas fa-chevron-up"></i> </a>
                </div>
            </div>
        </div>

    </footer>
    @yield('js')
    <script src="{{ asset('menu/assets/js/plugins/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('menu/assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('menu/assets/js/plugins/waypoint.js') }}"></script>
    <script src="{{ asset('menu/assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('menu/assets/js/plugins/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('menu/assets/js/plugins/jquery.slimScroll.min.js') }}"></script>
    <script src="{{ asset('menu/assets/js/plugins/imagesloaded.min.js') }}"></script>
    <script src="{{ asset('menu/assets/js/plugins/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('menu/assets/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('menu/assets/js/plugins/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('menu/assets/js/plugins/slick.min.js') }}"></script>

    <!-- Slices Scripts -->
    <script src="{{ asset('menu/assets/js/main.js') }}"></script>


</body>

</html>
