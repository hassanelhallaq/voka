<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href='https://fonts.googleapis.com/css?family=Cairo' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/main.css">
    <style>
        /*----------------------------------- new design --------------------------------------------*/
        .home-card {
            display: none;
        }

        .active-salon {
            display: flex;
        }

        .top {
            gap: 20px
        }

        .other {
            -webkit-align-content: space-between;
            align-content: space-between;
            gap: 57px;
        }

        .middel {
            position: relative;
        }

        .middel .dine-set {
            position: absolute;
            font-size: 172px;
            color: #1e1e1e;
            font-weight: 900;
            top: 0;
            bottom: 0;
            text-align: center;
            left: 4%;
        }

        .sofa {
            text-align: center;
        }

        .sofa path {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .sofa.active-table .fill {
            fill: var(--orange);
        }

        .sofa.active-table .line {
            fill: var(--white);
        }

        /* .sofa:hover .fill {
        fill: var(--orange);
        }
        .sofa:hover .line {
        fill: var(--white);
        } */

        .sofa svg {
            filter: brightness(1);
            /* تعتيم افتراضي */
            transition: filter 0.3s ease-in-out;
            /* تحويل بسلاسة */
        }

        .sofa:hover svg {
            filter: brightness(1.5);
            /* تعتيم عند التحويم */
        }

        .sofa:hover .text-fill {
            fill: var(--orange);
        }

        /*------ table status ------------*/
        .sofa-serv .fill {
            fill: #0dcaf0;
        }

        .sofa-serv .line {
            fill: #333;
        }

        .sofa-reserved .fill {
            fill: #dc3545;
        }

        .sofa-reserved .line {
            fill: #fff;
        }

        .sofa-available .fill {
            fill: #198754;
        }

        .sofa-available .line {
            fill: #fff;
        }

        .not-selected .fill {
            fill: #222;
        }

        .not-selected .line {
            fill: #3E3F41;
        }
    </style>
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
                                <li class="nav-item active">
                                    <a class="nav-link d-flex flex-column  justify-content-center align-items-center active"
                                        aria-current="page" href="index.html">
                                        <i class="fa-solid fa-house"></i>
                                        <span>الرئيسية</span>
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link d-flex flex-column  justify-content-center align-items-center"
                                        href="halls.html" role="button">
                                        <i class="fa-solid fa-table-cells-large"></i>
                                        <span>الصالات</span>
                                    </a>

                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex flex-column  justify-content-center align-items-center"
                                        href="reservations.html">
                                        <i class="fa-solid fa-utensils"></i>
                                        <span>الحجوزات</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex flex-column  justify-content-center align-items-center"
                                        href="packages.html">
                                        <i class="fa-solid fa-box-open"></i>
                                        <span>الباقات</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex flex-column  justify-content-center align-items-center"
                                        href="waitingList.html">
                                        <i class="fa-regular fa-clock"></i>
                                        <span>الأنتظار</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex flex-column  justify-content-center align-items-center"
                                        href="menu.html">
                                        <i class="fa-solid fa-clipboard-list "></i>
                                        <span>القائمة</span>
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="seacr-bar mb-5">
                        <form class="d-flex search  justify-content-between" role="search">
                            <p>اكتب رقم الطاولة</p>
                            <input class="search-input form-control" type="search" aria-label="Search"
                                placeholder="12">
                            <button class="btn search-btn">
                                بحث
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </div>
                    <div class="container">
                        <div class="filter-btns d-flex mb-2">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                @foreach ($halles as $key => $item)
                                    <button type="button" class="h-filter btn btn-dark"
                                        data-salon="#salon{{ $item->id }}">{{ $item->name }}</button>
                                @endforeach
                            </div>
                            <div class="btn-group mx-3" role="group" aria-label="Basic example">
                                <button type="button" class="s-filter btn btn-dark" data-st="all">كل الحالات</button>
                                <button type="button" class="s-filter btn btn-dark" data-st="reserved">
                                    المحجوزة</button>
                                <button type="button" class="s-filter btn btn-dark" data-st="available">
                                    المتاحة</button>
                                <button type="button" class="s-filter btn btn-dark" data-st="serv"> فى الخدمة</button>
                            </div>
                            <div class="time-filter">
                                <form action="">
                                    <div class="d-flex">
                                        <p> متبقى دقائق اقل من </p>
                                        <input class="time-input form-control form-control-sm" type="text"
                                            placeholder="30" aria-label=".form-control-sm example">
                                        <button type="submit" class="apply-time btn btn-dark">تطبيق </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- salone table  -->
                        @foreach ($halles as $key => $item)
                            <div class="row home-card mt-5 active-salon" id="salon{{ $item->id }}">
                                <div class="col-md-9">
                                    <div class="other d-flex flex-column">
                                        <div class="right">
                                            <div class="row">
                                                @foreach ($item->tables as $table)
                                                    <div class="col-md-2">
                                                        <div class="sofa sofa-serv not-selected" data-id="table{{ $table->id }}"
                                                            data-stat="serv" data-h="hall2" data-pstat="serv">
                                                            <svg width="93" height="57" viewBox="0 0 93 57"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path class="fill" fill-rule="evenodd"
                                                                    clip-rule="evenodd"
                                                                    d="M68.6647 26.5813L81.6371 26.5813C83.434 26.5813 84.8951 25.1208 84.8951 23.3236L84.8951 5.39102C84.8951 3.59383 83.4337 2.1333 81.6371 2.1333L68.6647 2.1333C66.8657 2.1333 65.4064 3.59383 65.4064 5.39102L65.4064 23.3233C65.4064 25.1208 66.8657 26.5813 68.6647 26.5813Z"
                                                                    fill="#212325" />
                                                                <path class="fill" fill-rule="evenodd"
                                                                    clip-rule="evenodd"
                                                                    d="M27.7693 24.1661L27.7693 11.1884C27.7693 9.39123 26.3075 7.93164 24.5106 7.93164L6.579 7.93164C4.78024 7.93164 3.32095 9.39123 3.32095 11.1884L3.32095 24.1661C3.32095 25.9633 4.78055 27.4229 6.579 27.4229L24.5106 27.4229C26.3075 27.4229 27.7693 25.9636 27.7693 24.1661Z"
                                                                    fill="#212325" />
                                                                <path class="fill" fill-rule="evenodd"
                                                                    clip-rule="evenodd"
                                                                    d="M6.57907 7.60449L24.5129 7.60449C26.4907 7.60449 28.0981 9.21133 28.0981 11.1894L28.0981 24.1671C28.0981 26.1462 26.491 27.7533 24.5129 27.7533L6.57907 27.7533C4.59908 27.7533 2.99411 26.1462 2.99411 24.1671L2.99411 11.1894C2.9938 9.21133 4.59908 7.60449 6.57907 7.60449ZM6.57907 27.0954L24.5129 27.0954C26.1285 27.0954 27.4402 25.7834 27.4402 24.1671L27.4402 11.1894C27.4402 9.57347 26.1285 8.26113 24.5129 8.26113L6.57907 8.26113C4.96342 8.26113 3.65171 9.57316 3.65171 11.1894L3.65171 24.1671C3.65171 25.7834 4.96342 27.0954 6.57907 27.0954Z"
                                                                    fill="#3E3F41" />
                                                                <path class="fill" fill-rule="evenodd"
                                                                    clip-rule="evenodd"
                                                                    d="M49.2177 26.5815L62.1922 26.5815C63.9888 26.5815 65.4484 25.1222 65.4484 23.3247L65.4484 5.39056C65.4484 3.59338 63.9888 2.13379 62.1922 2.13379L49.2177 2.13379C47.4186 2.13379 45.9612 3.59337 45.9612 5.39056L45.9612 23.3247C45.9612 25.1219 47.4186 26.5815 49.2177 26.5815Z"
                                                                    fill="#212325" />
                                                                <path class="line" fill-rule="evenodd"
                                                                    clip-rule="evenodd"
                                                                    d="M49.2176 1.80713L62.194 1.80713C64.1718 1.80713 65.7793 3.41302 65.7793 5.39238L65.7793 23.3272C65.7793 25.3046 64.1721 26.9108 62.194 26.9108L49.2176 26.9108C47.2376 26.9108 45.6323 25.3046 45.6323 23.3272L45.6323 5.39207C45.6323 3.4127 47.2376 1.80713 49.2176 1.80713ZM49.2176 26.2539L62.194 26.2539C63.8097 26.2539 65.1214 24.9419 65.1214 23.3272L65.1214 5.39207C65.1214 3.77611 63.8097 2.46503 62.194 2.46503L49.2176 2.46503C47.5997 2.46503 46.2883 3.77611 46.2883 5.39207L46.2883 23.3268C46.288 24.9419 47.5997 26.2539 49.2176 26.2539Z"
                                                                    fill="#3E3F41" />
                                                                <path class="fill" fill-rule="evenodd"
                                                                    clip-rule="evenodd"
                                                                    d="M30.1569 26.5813L43.1314 26.5813C44.928 26.5813 46.3876 25.1208 46.3876 23.3236L46.3876 5.39102C46.3876 3.59383 44.928 2.1333 43.1314 2.1333L30.1569 2.1333C28.3578 2.1333 26.8985 3.59383 26.8985 5.39102L26.8985 23.3233C26.8985 25.1208 28.3581 26.5813 30.1569 26.5813Z"
                                                                    fill="#212325" />
                                                                <path class="fill" fill-rule="evenodd"
                                                                    clip-rule="evenodd"
                                                                    d="M68.6647 1.80713L81.6371 1.80713C83.6171 1.80713 85.2242 3.41491 85.2242 5.39238L85.2242 23.3246C85.2242 25.3046 83.6171 26.9108 81.6371 26.9108L68.6647 26.9108C66.6847 26.9108 65.0776 25.3046 65.0776 23.3246L65.0776 5.39207C65.0776 3.41491 66.6847 1.80713 68.6647 1.80713ZM68.6647 26.2539L81.6371 26.2539C83.2527 26.2539 84.5682 24.9406 84.5682 23.3243L84.5682 5.39207C84.5682 3.77705 83.2524 2.46503 81.6371 2.46503L68.6647 2.46503C67.0469 2.46503 65.7352 3.77705 65.7352 5.39207L65.7352 23.3243C65.7352 24.9406 67.0469 26.2539 68.6647 26.2539Z"
                                                                    fill="#3E3F41" />
                                                                <path class="line" fill-rule="evenodd"
                                                                    clip-rule="evenodd"
                                                                    d="M30.1569 1.80859L43.1314 1.80859C45.1092 1.80859 46.7183 3.4148 46.7183 5.39322L46.7183 23.327C46.7183 25.3045 45.1092 26.9117 43.1314 26.9117L30.1569 26.9117C28.1769 26.9117 26.5697 25.3045 26.5697 23.327L26.5697 5.39322C26.5697 3.4148 28.1772 1.80859 30.1569 1.80859ZM30.1569 26.2547L43.1314 26.2547C44.7449 26.2547 46.0588 24.9417 46.0588 23.327L46.0588 5.39322C46.0588 3.77726 44.7449 2.46492 43.1314 2.46492L30.1569 2.46492C28.5412 2.46492 27.2276 3.77694 27.2276 5.39322L27.2276 23.327C27.2276 24.9417 28.5415 26.2547 30.1569 26.2547Z"
                                                                    fill="#3E3F41" />
                                                                <path class="fill" fill-rule="evenodd"
                                                                    clip-rule="evenodd"
                                                                    d="M27.7693 43.2271L27.7693 30.2532C27.7693 28.4563 26.3097 26.9961 24.5128 26.9961L6.579 26.9961C4.78244 26.9961 3.32285 28.4566 3.32285 30.2532L3.32285 43.2271C3.32285 45.0256 4.78244 46.4842 6.579 46.4842L24.5128 46.4842C26.3097 46.4842 27.7693 45.0256 27.7693 43.2271Z"
                                                                    fill="#212325" />
                                                                <path class="line" fill-rule="evenodd"
                                                                    clip-rule="evenodd"
                                                                    d="M6.58089 26.667L24.5125 26.667C26.4903 26.667 28.0978 28.2732 28.0978 30.2535L28.0978 43.2287C28.0978 45.2071 26.4906 46.8133 24.5125 46.8133L6.58089 46.8133C4.6009 46.8133 2.99375 45.2071 2.99375 43.2287L2.99375 30.2535C2.99343 28.2732 4.6009 26.667 6.58089 26.667ZM6.58089 46.157L24.5125 46.157C26.1282 46.157 27.4421 44.8434 27.4421 43.2287L27.4421 30.2535C27.4421 28.6369 26.1282 27.3236 24.5125 27.3236L6.58089 27.3236C4.96525 27.3236 3.65134 28.6366 3.65134 30.2535L3.65134 43.2287C3.65134 44.8434 4.96524 46.157 6.58089 46.157Z"
                                                                    fill="#3E3F41" />
                                                                <path class="fill" fill-rule="evenodd"
                                                                    clip-rule="evenodd"
                                                                    d="M9.54352 56.0703L24.4732 56.0703C26.2742 56.0703 27.7354 54.6066 27.7354 52.8051L27.7354 49.5281C27.7354 47.7265 26.2739 46.2632 24.4732 46.2632L9.54352 46.2632C7.74255 46.2632 6.27888 47.7269 6.27888 49.5281L6.27888 52.8051C6.27888 54.6066 7.74255 56.0703 9.54352 56.0703Z"
                                                                    fill="#212325" />
                                                                <path class="line" fill-rule="evenodd"
                                                                    clip-rule="evenodd"
                                                                    d="M9.54591 45.938L24.4734 45.938C26.4553 45.938 28.0687 47.5473 28.0687 49.5299L28.0687 52.8068C28.0687 54.7902 26.4553 56.4002 24.4734 56.4002L9.54591 56.4002C7.56152 56.4002 5.95247 54.7902 5.95247 52.8068L5.95247 49.5298C5.95247 47.547 7.56152 45.938 9.54591 45.938ZM9.54591 55.7432L24.4734 55.7432C26.0928 55.7432 27.4086 54.4259 27.4086 52.8068L27.4086 49.5299C27.4086 47.9111 26.0928 46.5943 24.4734 46.5943L9.54591 46.5943C7.92618 46.5943 6.61037 47.9111 6.61037 49.5298L6.61037 52.8068C6.61037 54.4259 7.92586 55.7432 9.54591 55.7432Z"
                                                                    fill="#3E3F41" />
                                                                <path class="fill" fill-rule="evenodd"
                                                                    clip-rule="evenodd"
                                                                    d="M65.6447 43.2271L65.6447 30.2532C65.6447 28.4563 67.1043 26.9961 68.9011 26.9961L86.8349 26.9961C88.6315 26.9961 90.0911 28.4566 90.0911 30.2532L90.0911 43.2271C90.0911 45.0256 88.6315 46.4842 86.8349 46.4842L68.9011 46.4842C67.1043 46.4842 65.6447 45.0256 65.6447 43.2271Z"
                                                                    fill="#212325" />
                                                                <path class="line" fill-rule="evenodd"
                                                                    clip-rule="evenodd"
                                                                    d="M86.8329 26.667L68.9013 26.667C66.9235 26.667 65.316 28.2732 65.316 30.2535L65.316 43.2287C65.316 45.2071 66.9232 46.8133 68.9013 46.8133L86.8329 46.8133C88.8129 46.8133 90.4201 45.2071 90.4201 43.2287L90.4201 30.2535C90.4204 28.2732 88.8129 26.667 86.8329 26.667ZM86.8329 46.157L68.9013 46.157C67.2857 46.157 65.9717 44.8434 65.9717 43.2287L65.9717 30.2535C65.9717 28.6369 67.2857 27.3236 68.9013 27.3236L86.8329 27.3236C88.4486 27.3236 89.7625 28.6366 89.7625 30.2535L89.7625 43.2287C89.7625 44.8434 88.4486 46.157 86.8329 46.157Z"
                                                                    fill="#3E3F41" />
                                                                <path class="fill" fill-rule="evenodd"
                                                                    clip-rule="evenodd"
                                                                    d="M83.8701 56.0703L68.9404 56.0703C67.1394 56.0703 65.6782 54.6066 65.6782 52.8051L65.6782 49.5281C65.6782 47.7265 67.1397 46.2632 68.9404 46.2632L83.8701 46.2632C85.671 46.2632 87.1347 47.7269 87.1347 49.5281L87.1347 52.8051C87.1347 54.6066 85.671 56.0703 83.8701 56.0703Z"
                                                                    fill="#212325" />
                                                                <path class="line" fill-rule="evenodd"
                                                                    clip-rule="evenodd"
                                                                    d="M83.8679 45.938L68.9404 45.938C66.9585 45.938 65.3451 47.5473 65.3451 49.5299L65.3451 52.8068C65.3451 54.7902 66.9585 56.4002 68.9404 56.4002L83.8679 56.4002C85.8523 56.4002 87.4613 54.7902 87.4613 52.8068L87.4613 49.5299C87.4613 47.547 85.8523 45.938 83.8679 45.938ZM83.8679 55.7432L68.9404 55.7432C67.321 55.7432 66.0052 54.4259 66.0052 52.8068L66.0052 49.5299C66.0052 47.9111 67.321 46.5943 68.9404 46.5943L83.8679 46.5943C85.4876 46.5943 86.8034 47.9111 86.8034 49.5299L86.8034 52.8068C86.8034 54.4259 85.488 55.7432 83.8679 55.7432Z"
                                                                    fill="#3E3F41" />
                                                                <path class="fill" fill-rule="evenodd"
                                                                    clip-rule="evenodd"
                                                                    d="M5.0385 0.26318L87.7375 0.26633C90.2276 0.26633 92.2554 2.28943 92.2554 4.78259L92.2554 5.06639C92.2554 7.56112 90.2276 9.58422 87.7375 9.58422L9.83949 9.58421L9.83949 50.5297C9.83949 53.0238 7.81798 55.0482 5.32356 55.0482L5.0385 55.0482C2.54628 55.0482 0.520665 53.0238 0.520665 50.5297L0.520667 4.78195C0.520352 2.28848 2.54628 0.26318 5.0385 0.26318Z"
                                                                    fill="#212325" />
                                                                <path class="line" fill-rule="evenodd"
                                                                    clip-rule="evenodd"
                                                                    d="M5.03856 -3.82384e-06L87.7376 0.0031462C90.3755 0.00314632 92.5178 2.14297 92.5178 4.78275L92.5178 5.06655C92.5178 7.70696 90.3752 9.84993 87.7376 9.84993L10.1042 9.84993L10.1042 50.5299C10.1042 53.1687 7.9615 55.3117 5.32392 55.3117L5.03886 55.3117C2.40097 55.3117 0.258939 53.1687 0.258939 50.5299L0.258941 4.78212C0.258312 2.14171 2.40067 -3.93915e-06 5.03856 -3.82384e-06ZM5.03856 54.785L5.32362 54.785C7.67016 54.785 9.57715 52.8768 9.57715 50.5299L9.57715 9.32103L87.7373 9.32103C90.0816 9.32103 91.9886 7.41372 91.9886 5.06655L91.9886 4.78275C91.9886 2.4359 90.0816 0.529844 87.7351 0.529843L5.03823 0.527637C2.69201 0.527637 0.784701 2.43369 0.784701 4.78212L0.784699 50.5296C0.785014 52.8768 2.69202 54.785 5.03856 54.785Z"
                                                                    fill="#3E3F41" />
                                                                <path class="fill" fill-rule="evenodd"
                                                                    clip-rule="evenodd"
                                                                    d="M87.7382 0.263187L5.0392 0.26633C2.54918 0.26633 0.521362 2.28943 0.521362 4.78259L0.521362 5.06639C0.521362 7.56112 2.54918 9.58422 5.0392 9.58422L82.9372 9.58422L82.9372 50.5298C82.9372 53.0239 84.9588 55.0482 87.4532 55.0482L87.7382 55.0482C90.2304 55.0482 92.2561 53.0239 92.2561 50.5298L92.2561 4.78196C92.2564 2.28849 90.2304 0.263188 87.7382 0.263187Z"
                                                                    fill="#212325" />
                                                                <path class="line" fill-rule="evenodd"
                                                                    clip-rule="evenodd"
                                                                    d="M87.7382 3.82384e-06L5.03914 0.00314662C2.40125 0.00314651 0.258911 2.14297 0.258911 4.78275L0.258911 5.06655C0.258911 7.70696 2.40157 9.84993 5.03914 9.84993L82.6726 9.84994L82.6726 50.5299C82.6726 53.1687 84.8152 55.3117 87.4528 55.3117L87.7379 55.3117C90.3758 55.3117 92.5178 53.1687 92.5178 50.5299L92.5178 4.78213C92.5184 2.14172 90.3761 3.93915e-06 87.7382 3.82384e-06ZM87.7382 54.785L87.4531 54.785C85.1066 54.785 83.1996 52.8768 83.1996 50.5299L83.1996 9.32104L5.03946 9.32103C2.69512 9.32103 0.788118 7.41372 0.788118 5.06655L0.788118 4.78275C0.788118 2.4359 2.69512 0.529844 5.04166 0.529844L87.7385 0.527645C90.0847 0.527645 91.992 2.4337 91.992 4.78213L91.992 50.5296C91.9917 52.8768 90.0847 54.785 87.7382 54.785Z"
                                                                    fill="#3E3F41" />
                                                                <path class="text-fill"
                                                                    d="M34.1222 33.9091L38.0085 44.929H38.1619L42.0483 33.9091H43.7102L38.9034 47H37.267L32.4602 33.9091H34.1222ZM47.3345 33.9091V47H45.7493V33.9091H47.3345ZM50.513 47V33.9091H54.9363C55.9632 33.9091 56.8027 34.0945 57.4547 34.4652C58.111 34.8317 58.5968 35.3281 58.9121 35.9545C59.2275 36.581 59.3851 37.2798 59.3851 38.0511C59.3851 38.8224 59.2275 39.5234 58.9121 40.1541C58.601 40.7848 58.1195 41.2876 57.4675 41.6626C56.8155 42.0334 55.9803 42.2188 54.9618 42.2188H51.7914V40.8125H54.9107C55.6138 40.8125 56.1784 40.6911 56.6046 40.4482C57.0307 40.2053 57.3397 39.8771 57.5314 39.4638C57.7275 39.0462 57.8255 38.5753 57.8255 38.0511C57.8255 37.527 57.7275 37.0582 57.5314 36.6449C57.3397 36.2315 57.0286 35.9077 56.5982 35.6733C56.1678 35.4347 55.5968 35.3153 54.8851 35.3153H52.0982V47H50.513Z"
                                                                    fill="white" />
                                                            </svg>
                                                            <div class="table-side-bar" id="table{{ $table->id }}">
                                                                <!-- <h2 class="text-center mb-4">طاولة رقم 1</h2> -->
                                                                <div class="tab-nav-wraper">
                                                                    <ul
                                                                        class="nav c-nav-tabs d-flex justify-content-between home-tab">
                                                                        <li class="nav-item">
                                                                            <a class="nav-link "
                                                                                data-tab="reservations"
                                                                                href="#"> الحجوزات</a>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <a class="nav-link" data-tab="orders"
                                                                                href="#"> الطلبات</a>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <a class="nav-link active"
                                                                                data-tab="the-menu" href="#">
                                                                                القائمة</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <!-- عناصر التاب -->
                                                                <div class="tab-content">
                                                                    <div id="the-menu" class="c-tab-pane active">
                                                                        <ol
                                                                            class="list-group list-group-numbered reversed">
                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                                <div class="me-2 ms-auto">
                                                                                    <div class="fw-bold">لحم سيشوان
                                                                                    </div>
                                                                                </div>
                                                                                <span>150 ريال</span>
                                                                            </li>
                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                                <div class="me-2 ms-auto">
                                                                                    <div class="fw-bold">سبرنج رولز
                                                                                    </div>
                                                                                </div>
                                                                                <span> 50 ريال</span>
                                                                            </li>
                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                                <div class="me-2 ms-auto">
                                                                                    <div class="fw-bold">سلطة آسيوية
                                                                                    </div>
                                                                                </div>
                                                                                <span>15 ريال</span>
                                                                            </li>
                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                                <div class="me-2 ms-auto">
                                                                                    <div class="fw-bold">سلطة آسيوية
                                                                                    </div>
                                                                                </div>
                                                                                <span>15 ريال</span>
                                                                            </li>
                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                                <div class="me-2 ms-auto">
                                                                                    <div class="fw-bold">سلطة آسيوية
                                                                                    </div>
                                                                                </div>
                                                                                <span>15 ريال</span>
                                                                            </li>
                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                                <div class="me-2 ms-auto">
                                                                                    <div class="fw-bold">سلطة آسيوية
                                                                                    </div>
                                                                                </div>
                                                                                <span>15 ريال</span>
                                                                            </li>
                                                                            <li
                                                                                class="new-menu-li list-group-item d-flex justify-content-center align-items-start">
                                                                                <a href="menu.html" class="me-2">
                                                                                    <div class="fw-bold">اضف عنصر جديد
                                                                                    </div>
                                                                                </a>
                                                                            </li>

                                                                        </ol>
                                                                        <ol class="list-group reversed  mt-5">
                                                                            <li class="list-group-item no-number  ">
                                                                                <div
                                                                                    class="sub-total d-flex justify-content-between align-items-start">
                                                                                    <div class="me-2 ms-auto">
                                                                                        <div class="fw-bold"> حاصل
                                                                                            الجمع</div>
                                                                                    </div>
                                                                                    <span>260 ريال</span>
                                                                                </div>

                                                                                <div
                                                                                    class="tax d-flex justify-content-between align-items-start mt-4">
                                                                                    <div class="me-2 ms-auto">
                                                                                        <div class="fw-bold"> ضريبة
                                                                                        </div>
                                                                                    </div>
                                                                                    <span>10%</span>
                                                                                </div>
                                                                                <div
                                                                                    class="tax d-flex justify-content-between align-items-start mt-4 total">
                                                                                    <div class="me-2 ms-auto">
                                                                                        <div class="fw-bold"> الإجمالى
                                                                                        </div>
                                                                                    </div>
                                                                                    <span>286 ريال</span>
                                                                                </div>
                                                                                <div class="payment-method">
                                                                                    <div class="row">
                                                                                        <div class="col-4">
                                                                                            <div
                                                                                                class="payment-icon d-flex justify-content-center align-items-center">
                                                                                                <i
                                                                                                    class="fa-solid fa-sack-dollar"></i>
                                                                                            </div>
                                                                                            <p class="text-center">كاش
                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="col-4">
                                                                                            <div
                                                                                                class="payment-icon d-flex justify-content-center align-items-center">
                                                                                                <i
                                                                                                    class="fa-solid fa-credit-card"></i>
                                                                                            </div>
                                                                                            <p class="text-center">
                                                                                                بطاقة ائتمان</p>
                                                                                        </div>
                                                                                        <div class="col-4">
                                                                                            <div
                                                                                                class="payment-icon d-flex justify-content-center align-items-center">
                                                                                                <i
                                                                                                    class="fa-solid fa-wallet"></i>
                                                                                            </div>
                                                                                            <p class="text-center">
                                                                                                المحفظة</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div
                                                                                        class="payment-btn my-3 text-center">
                                                                                        <div class="btn btn-primary btn-lg w-100"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target="#exampleModal6">
                                                                                            ادفع الآن</div>
                                                                                        <!-- Modal -->
                                                                                        <div class="modal fade"
                                                                                            id="exampleModal6"
                                                                                            tabindex="-1"
                                                                                            aria-labelledby="exampleModalLabel6"
                                                                                            aria-hidden="true">
                                                                                            <div class="modal-dialog">
                                                                                                <div
                                                                                                    class="modal-content">
                                                                                                    <div
                                                                                                        class="modal-header">
                                                                                                        <h5 class="modal-title"
                                                                                                            id="exampleModalLabel">
                                                                                                            تأكيد الدفع
                                                                                                        </h5>
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="btn-close"
                                                                                                            data-bs-dismiss="modal"
                                                                                                            aria-label="Close"></button>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="modal-body">
                                                                                                        <p
                                                                                                            class="consfirm-text">
                                                                                                            هل تريد
                                                                                                            تأكيد الدفع
                                                                                                        </p>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="modal-footer">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="btn btn-primary">تأكيد</button>
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="btn btn-secondary"
                                                                                                            data-bs-dismiss="modal">لا
                                                                                                        </button>
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
                                                                        <ol
                                                                            class="list-group list-group-numbered reversed bill-info">
                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                                <div class="me-2 ms-auto">
                                                                                    <div class="fw-bold"> طلب باسم
                                                                                    </div>
                                                                                </div>
                                                                                <span>على محمد احمد </span>
                                                                            </li>
                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                                <div class="me-2 ms-auto">
                                                                                    <div class="fw-bold">اسم الباقة
                                                                                    </div>
                                                                                </div>
                                                                                <span> باقة 3 ساعات </span>
                                                                            </li>
                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                                <div class="me-2 ms-auto">
                                                                                    <div class="fw-bold"> الرصيد</div>
                                                                                </div>
                                                                                <span>1500 </span>
                                                                            </li>
                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                                <div class="me-2 ms-auto">
                                                                                    <div class="fw-bold"> الحالة</div>
                                                                                </div>
                                                                                <span class="badge bg-info">تم الدفع
                                                                                </span>
                                                                            </li>
                                                                            <li
                                                                                class="new-menu-li list-group-item d-flex justify-content-center align-items-start">
                                                                                <div class="me-2">
                                                                                    <div class="fw-bold"> طباعة الطلب
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                        </ol>
                                                                        <ol
                                                                            class="list-group list-group-numbered reversed bill-info">
                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                                <div class="me-2 ms-auto">
                                                                                    <div class="fw-bold"> طلب باسم
                                                                                    </div>
                                                                                </div>
                                                                                <span>على محمد احمد </span>
                                                                            </li>
                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                                <div class="me-2 ms-auto">
                                                                                    <div class="fw-bold">اسم الباقة
                                                                                    </div>
                                                                                </div>
                                                                                <span> باقة 3 ساعات </span>
                                                                            </li>
                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                                <div class="me-2 ms-auto">
                                                                                    <div class="fw-bold"> الرصيد</div>
                                                                                </div>
                                                                                <span>1500 </span>
                                                                            </li>
                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                                <div class="me-2 ms-auto">
                                                                                    <div class="fw-bold"> الحالة</div>
                                                                                </div>
                                                                                <span class="badge bg-info">تم الدفع
                                                                                </span>
                                                                            </li>
                                                                            <li
                                                                                class="new-menu-li list-group-item d-flex justify-content-center align-items-start">
                                                                                <div class="me-2">
                                                                                    <div class="fw-bold"> طباعة الطلب
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                        </ol>
                                                                        <ol
                                                                            class="list-group list-group-numbered reversed bill-info">
                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                                <div class="me-2 ms-auto">
                                                                                    <div class="fw-bold"> طلب باسم
                                                                                    </div>
                                                                                </div>
                                                                                <span>على محمد احمد </span>
                                                                            </li>
                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                                <div class="me-2 ms-auto">
                                                                                    <div class="fw-bold">اسم الباقة
                                                                                    </div>
                                                                                </div>
                                                                                <span> باقة 3 ساعات </span>
                                                                            </li>
                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                                <div class="me-2 ms-auto">
                                                                                    <div class="fw-bold"> الرصيد</div>
                                                                                </div>
                                                                                <span>1500 </span>
                                                                            </li>
                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                                <div class="me-2 ms-auto">
                                                                                    <div class="fw-bold"> الحالة</div>
                                                                                </div>
                                                                                <span class="badge bg-info">تم الدفع
                                                                                </span>
                                                                            </li>
                                                                            <li
                                                                                class="new-menu-li list-group-item d-flex justify-content-center align-items-start">
                                                                                <div class="me-2">
                                                                                    <div class="fw-bold"> طباعة الطلب
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                        </ol>
                                                                    </div>
                                                                    <div id="reservations" class="c-tab-pane ">
                                                                        <div class="hour-col">
                                                                            <div class="body-hour-cel">
                                                                                <div class="row gx-0 p-2 text-center">
                                                                                    <div class="col-md-2">
                                                                                        <p class="hour mb-0">05:00 AM
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="col-md-10">
                                                                                        <div class="row gx-0">
                                                                                            <div class="col-md-9">
                                                                                                <div
                                                                                                    class="d-flex h-100 justify-content-around align-items-center">
                                                                                                    <div
                                                                                                        class="gusts">
                                                                                                        <span
                                                                                                            class="table-gusts px-2">
                                                                                                            4</span>
                                                                                                        <span> <i
                                                                                                                class="fa-solid fa-users"></i></span>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="table-res">
                                                                                                        طاولة 1
                                                                                                    </div>
                                                                                                    <span
                                                                                                        class="badge bg-secondary">مؤكد</span>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                                <span>رصيد متبقى
                                                                                                    600</span>
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
                                                                                                <div
                                                                                                    class="d-flex justify-content-center align-items-center">
                                                                                                    <span>لا يوجد
                                                                                                        حجز</span>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                                <span>لا يوجد
                                                                                                    رصيد</span>
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
                                                                                                <div
                                                                                                    class="d-flex justify-content-center align-items-center">
                                                                                                    <span>لا يوجد
                                                                                                        حجز</span>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                                <span>لا يوجد
                                                                                                    رصيد</span>
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
                                                                                                <div
                                                                                                    class="d-flex justify-content-center align-items-center">
                                                                                                    <span>لا يوجد
                                                                                                        حجز</span>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                                <span>لا يوجد
                                                                                                    رصيد</span>
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
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="side-place">
                        <div id="tab-place" class="c-tab-pane fade show active">
                            <ol class="table-list list-group list-group-numbered reversed">
                                <li
                                    class="menu-info-list list-group-item d-flex  flex-column justify-content-center align-items-center text-center p-0">
                                    <a class="new-reserv-btn btn btn-link w-100" href="newReservation.html">
                                        <i class="fa-solid fa-plus"></i>
                                        <p>انشاء حجز جديد </p>
                                    </a>
                                </li>

                            </ol>
                            <ol class="list-group reversed  mt-5">
                                <li class="list-group-item no-number  ">
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
                                                <div
                                                    class="payment-icon active d-flex justify-content-center align-items-center">
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
                                            <div class="btn btn-primary btn-lg w-100" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">ادفع الآن</div>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">تأكيد الدفع
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="consfirm-text">هل تريد تأكيد الدفع</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button"
                                                                class="btn btn-primary">تأكيد</button>
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
            </div>
        </div>
        </div>

        </div>










    </section>
    <!-- js files  -->
    <script src="./js/jquery.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js"
        integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous">
    </script>
    <script src="./js/date.js"></script>
    <script src="./js/bootstrap-clockpicker.min.js"></script>
    <script src="./js/main.js"></script>
    <script>
        $(document).ready(function() {
            $('.home-card .sofa').on('click', function() {
                $('.home-card .sofa').removeClass('active-table');
                $(this).addClass('active-table');

                $('.table-side-bar').hide();
                var newId = '#' + $(this).data('id');

                if ($(this).data('stat') == 'available') {
                    $('#tab-place').show();
                    $(newId).hide();
                } else {
                    $('#tab-place').hide();
                    $(newId).show();
                    $('.side-place').append($(newId));
                }
            });

            // فلتر الحالات للصفحة الرئيسية
            $('.s-filter').on('click', function() {
                var key = $(this).data('st');
                if (key === 'all') {
                    $('.sofa').removeClass('not-selected');
                } else {
                    $('.sofa').addClass('not-selected'); // إخفاء جميع العناصر
                    // إظهار العناصر التي تحمل قيمة مطابقة لـ data-pstat
                    $('.sofa[data-pstat="' + key + '"]').removeClass('not-selected');
                }
            });

            // فلتر الصالات للصفحة الرئيسية
            $('.h-filter').on('click', function() {
                var key = $(this).data('salon');
                $('.home-card').attr('style', 'display: none !important').removeClass(
                    'active-salon'); // إخفاء جميع العناصر
                // إظهار العناصر التي تحمل قيمة مطابقة لـ data-pstat
                $(key).attr('style', 'display: flex !important').addClass('active-salon');

            });

        });
    </script>
</body>

</html>
