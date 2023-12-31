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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap-clockpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/main.css') }}">
    <style>
        tbody td:hover,
        .selected {
            color: #e5772a;
        }

        .halls-tab {
            background-color: transparent;
            box-shadow: none;
        }

        .btn-clock {
            width: 120px;
            padding: 8px;
            background: #707070 !important;
            color: #fff;
            border: none;
            margin-bottom: 10px;
        }

        .modal-backdrop.show {
            display: none !important;
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
        .quick-reservation #allguests {
            display: block;
        }
        /*----------------------------------------------end of the lock screen css code ----------------------------------------*/
        
        .subscribe-checkbox input[type="checkbox"], input[type="radio"] {
            opacity: 1 ;
        }

    </style>
</head>

<body>

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

    <section class="main">
        <div class="top-bar">
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4 text-center">
                </div>
                <!--<div class="col-4 text-left px-5">-->
                <!--    <a href="{{ route('branch.home') }}" class="close-icon">-->
                <!--        الإغلاق والذهاب الى الرئيسية-->
                <!--        <i class="fa-solid fa-xmark"></i>-->
                <!--    </a>-->
                <!--</div>-->
            </div>
        </div>
        <div class="reservation">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <ul class="side-nav side-items">
                         
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

                            <!--<li class="nav-item py-3 show-content" data-id="#date-content" data-v="0">-->
                            <!--    <a class="nav-link" href="#">-->
                            <!--        <div class="d-flex w-100">-->
                            <!--            <div class="icon text-right">-->
                            <!--                <i class="fa-solid fa-calendar-days"></i> التاريخ-->
                            <!--            </div>-->
                            <!--            <div class="guests reserv-date text-center">-->

                            <!--            </div>-->
                            <!--            <div class="chevro text-left">-->
                            <!--                <i class="fas fa-chevron-left"></i>-->
                            <!--            </div>-->
                            <!--        </div>-->

                            <!--    </a>-->
                            <!--</li>-->
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
                            <li class="mt-5">
                                <div class="btn-group flex-column w-100" role="group" aria-label="Basic example">
                                    <a href="{{ route('branch.home') }}" type="button"
                                        class="s-filter btn btn-lg btn-primary"> الغاء الحجز </a>
                                    <a href="{{ route('branch.home') }}" type="button"
                                        class="s-filter btn btn-lg btn-primary my-3"> عرض الصالة </a>
                                    <button type="button" class="s-filter btn btn-lg btn-primary close-the-screen">
                                        اقفال الشاشة
                                    </button>
                                </div>
                            </li>
                            <li class="nav-item py-3 show-content no-border" data-id="#pay" data-v="0">
                                <div class="btn to-pay btn-lg w-100">الدفع </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-9 quick-reservation">
                        <div class="reservation-tabs" id="allguests">
                            <div class="container pt-3">
                                <!--<div class="row">-->
                                <!--    <div class="col-10">-->

                                <!--<div class="seacr-bar mb-5">-->
                                <!--    <form class="d-flex search w-100 " role="search">-->
                                <!--        <input class="form-control" oninput="clients()" id="search"-->
                                <!--            type="search" aria-label="Search">-->
                                <!--        <button class="btn search-btn"><i-->
                                <!--                class="fa-solid fa-magnifying-glass"></i></button>-->
                                <!--    </form>-->
                                <!--</div>-->
                                <!--    </div>-->
                                <!--    <div class="col-md-2">-->
                                <!--        <div class="top-prev change-content btn btn-primary" data-id="#all-tables">السابق</div>-->
                                <!--    </div>-->
                                <!--</div>-->
                                <div class="row">
                                    <div class="col-1">
                                        <button type="button" class="btn btn-primary addgustbtn"
                                            data-bs-toggle="modal" data-bs-target="#staticBackdrop">
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
                                                                <label for="name" class="form-label bg-dark">أسم
                                                                    الضيف</label>
                                                                <input type="text" class="form-control"
                                                                    id="name" aria-describedby="name">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="phone" class="form-label bg-dark">رقم
                                                                    الهاتف</label>
                                                                <input type="text" class="form-control"
                                                                    id="phone">
                                                            </div>

                                                            <div class="modal-footer d-flex justify-content-between">
                                                                <div class="subscribe-checkbox">
                                                                    <input type="radio" id="allDay" name="shift_type" value="allDay">
                                                                    <label for="allDay">الاشتراك فى الحملات التسويقية </labe >  
                                                                </div>
                                                                <div class="btns">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">اغلاق</button>
                                                                    <button type="button" data-bs-dismiss="modal" onclick="performStore()"
                                                                        class="btn btn-primary add-gust">تسجيل</button>
                                                                </div>
                                                                
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <h3>
                                            أضف ضيف جديد</h3>

                                    </div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-2">
                                        <div class="top-prev change-content btn btn-primary" data-id="#all-tables">
                                            السابق</div>
                                    </div>
                                </div>
                                <div class="row gust-cards" id="clients">
                                    @include('branch._clients')
                                </div>
                                <!--<div class="row">-->
                                <!--    <div class="col-md-2">-->
                                <!--        <div class="change-content btn btn-primary" data-id="#all-tables">السابق</div>-->
                                <!--    </div>-->
                                <!--    <div class="col-md-8"></div>-->
                                <!--<div class="col-md-2">-->
                                <!--    <button class="change-content btn btn-primary"-->
                                <!--        data-id="#date-content">التالى</button>-->
                                <!--</div>-->
                                <!--</div>-->
                            </div>
                        </div>
                        <div class="reservation-tabs alltime" id="alltime">
                            <div class="container">
                                @include('branch.time_slots')

                            </div>
                        </div>
                        <div id="pay-mod">
                            @include('branch.pay')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="modalPay" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تأكيد الدفع
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="margin-left: 0;"></button>
                </div>
                <div class="modal-body">
                    <p class="consfirm-text" style="color: #fff; text-align: center;">هل تريد تأكيد الدفع </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary register-and-close" onclick="storeReaervation()"
                        style="margin-left: 10px;">تسجيل</button>
                    <button type="button" class="btn btn-primary register-and-close"
                        onclick="storeReaervationActive()" style="margin-left: 10px;">تسجيل وتغعيل</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لا </button>
                </div>
            </div>
        </div>
    </div>
    <!--مودال طباعة الفاتورة -->
    <div class="modal fade" id="pill" tabindex="-1" aria-labelledby="pill" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" style="margin-left: 10px;">طباعة</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لا </button>
                </div>

                <div class="modal-body" id="modal-body-content">
                    <div id="invoice-POS">

                        <center id="top">
                            <div class="logo"></div>
                            <div class="info">
                                <h2>SBISTechs Inc</h2>
                            </div><!--End Info-->
                        </center><!--End InvoiceTop-->

                        <div id="mid">
                            <div class="info">
                                <h2>Contact Info</h2>
                                <p>
                                    Address : street city, state 0000</br>
                                    Email : JohnDoe@gmail.com</br>
                                    Phone : 555-555-5555</br>
                                </p>
                            </div>
                        </div><!--End Invoice Mid-->

                        <div id="bot">

                            <div id="table">
                                <table>
                                    <tr class="tabletitle">
                                        <td class="item">
                                            <h2>Item</h2>
                                        </td>
                                        <td class="Hours">
                                            <h2>Qty</h2>
                                        </td>
                                        <td class="Rate">
                                            <h2>Sub Total</h2>
                                        </td>
                                    </tr>
                                    <tr class="service">
                                        <td class="tableitem">
                                            <p class="itemtext">Animation Revisions</p>
                                        </td>
                                        <td class="tableitem">
                                            <p class="itemtext">10</p>
                                        </td>
                                        <td class="tableitem">
                                            <p class="itemtext">$750.00</p>
                                        </td>
                                    </tr>
                                    <tr class="tabletitle">
                                        <td></td>
                                        <td class="Rate">
                                            <h2>tax</h2>
                                        </td>
                                        <td class="payment">
                                            <h2>$419.25</h2>
                                        </td>
                                    </tr>
                                    <tr class="tabletitle">
                                        <td></td>
                                        <td class="Rate">
                                            <h2>Total</h2>
                                        </td>
                                        <td class="payment">
                                            <h2>$3,644.25</h2>
                                        </td>
                                    </tr>

                                </table>
                            </div><!--End Table-->

                            <div id="legalcopy">
                                <p class="legal"><strong>Thank you for your business!</strong>  Payment is expected
                                    within 31 days; please process this invoice within that time. There will be a 5%
                                    interest charge per month on late invoices.
                                </p>
                            </div>

                        </div><!--End InvoiceBot-->
                    </div><!--End Invoice-->

                </div>

            </div>
        </div>
    </div>

    <!-- js files  -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('crudjs/crud.js') }}"></script>
    <script src="{{ asset('front/js/main.js') }}"></script>

    <script>
        function pack(id) {

            $.get('/branch/branch/halls/ajax', {
                id: id,
            }).done(function(data) {
                // Clear previous content
                $('#all-tables').html(data); // Show the new content
            });
        }

        function table(id) {
            var packageId = $('.package-name').attr('data-choos');

            $.get('/branch/table/slots/ajax', {
                // Add a comma after packageId to separate the parameters
                table_id: id,
                packageId: packageId,
            }).done(function(data) {
                // Clear previous content

                $('#alltime').html(data); // Show the new content
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
                debugger;
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
        let selectedOption = null;

        // Get references to the payment option elements
        const cashElement = document.getElementById("cash");
        const creditCardElement = document.getElementById("credit-card");
        const walletElement = document.getElementById("wallet");

        // Add event listeners to each element
        cashElement.addEventListener("click", function() {
            handlePaymentOption("كاش");
        });

        creditCardElement.addEventListener("click", function() {
            handlePaymentOption("بطاقة ائتمان");
        });

        walletElement.addEventListener("click", function() {
            handlePaymentOption("المحفظة");
        });

        // Function to handle the selected payment option
        function handlePaymentOption(option) {
            selectedOption = option;

        }

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
            formData.append('time', time);
            formData.append('payment', selectedOption);
            formData.append('status', 'مؤكد');

            // Call the 'store' function to handle the form data submission
            axios.post('/branch/reservations', formData)
                .then(function(response) {
                    
                    var reservationId = response.data.reservation.id;
                    updateReservationDetails(reservationId);
                    // Add onClick event to the "تفعيل الحجز" button
                    document.getElementById('activate-reservation-btn').onclick = function() {
                        activateReservation(reservationId);
                    };

                    var htmlContent = generateReservationHTML(response.data.reservation);
                    // Update modal content with reservation details
                    $('#modal-body-content').html(htmlContent);
                    $('#modalPay').hide(); // Show the reserv main section
                    $('#pill').modal('show'); // Show the reserv main section

                })
        }

        function storeReaervationActive() {
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
            formData.append('time', time);
            formData.append('payment', selectedOption);
            formData.append('status', 'تم الحضور');

            // Call the 'store' function to handle the form data submission
            axios.post('/branch/reservations', formData)
                .then(function(response) {

                    
                    var reservationId = response.data.reservation.id;
                    updateReservationDetails(reservationId);
                    // Add onClick event to the "تفعيل الحجز" button
                    document.getElementById('activate-reservation-btn').onclick = function() {
                        activateReservation(reservationId);
                    };
                    $('#activate-reservation-btn').prop('disabled', true);
                    var htmlContent = generateReservationHTML(response.data.reservation);
                    // Update modal content with reservation details
                    $('#modal-body-content').html(htmlContent);
                    $('#modalPay').hide(); // Show the reserv main section
                    $('#pill').modal('show'); // Show the reserv main section

                })
        }

        function showMessage(data) {
            console.log(data);
            Swal.fire({
                position: 'center',
                icon: data.icon,
                title: data.title,
                showConfirmButton: false,
                timer: 1500
            })
        }

        function generateReservationHTML(reservation) {
            // Generate the HTML content using reservation data
            var html = `
        <!-- Populate the content with reservation details -->
        <div id="invoice-POS">
        <center id="top">
            <div class="logo"></div>
            <div class="info">
              <h2>SBISTechs Inc</h2>
            </div><!--End Info-->
          </center>
        <div id="mid">
            <div class="info">
                <h2>Reservation Details</h2>
                <p>Client: ${reservation.client.name}</p>
                <p>Phone: ${reservation.client.phone}</p>
                <p>Table: ${reservation.table.name}</p>
                <!-- Update client information here -->
            </div>
        </div>

        <!-- Add more details as needed -->
            <div id="bot">
              <div id="table">
                    <table style="color: #333;">
                        <tr class="tabletitle">
                            <td class="item">
                                <h2>Item</h2>
                            </td>
                            <td class="Hours">
                                <h2>Qty</h2>
                            </td>
                            <td class="Rate">
                                <h2>Sub Total</h2>
                            </td>
                        </tr>

                        <tr class="service">
                            <td class="tableitem">
                                <p class="itemtext">${reservation.package.name}</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext">1</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext">${reservation.package.price}</p>
                            </td>
                        </tr>

                        <tr class="tabletitle">

                          <td class="Rate"><h2>tax</h2></td>
                          <td class="payment"><h2>$4</h2></td>
                          <td></td>
                        </tr>

                        <tr class="tabletitle">
                          <td class="Rate"><h2>Total</h2></td>
                          <td class="payment"><h2>$3,644.25</h2></td>
                          <td></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div id="legalcopy">
          <p class="legal"><strong>Thank you for your business!</strong>  Payment is expected within 31 days; please process this invoice within that time. There will be a 5% interest charge per month on late invoices.
          </p>
        </div>
        </div>
        `;
            return html;
        }

        function updateReservationDetails(reservationId) {
            $('#reservation-details').attr('data-reservation-id', reservationId);
            $('#reservation-details button[disabled]').prop('disabled', false);
            $('#reservation-details button[data-bs-target="#pill"]').removeAttr('disabled');
            $('#reservation-details button[data-bs-target="#activate-reservation-btn"]').removeAttr('disabled');
            $('#add-booking').prop('disabled', true);


        }

        function activateReservation(reservationId) {
            // Perform actions related to activating the reservation using the reservationId
            let formData = new FormData();
            storepart('/branch/active/reservation/' + reservationId, formData)
            $('#activate-reservation-btn').prop('disabled', true);

            // You can replace the console.log with your desired logic
        }
        // Add event listener to form submission
        $('#reservation-form').on('submit', function(event) {
            event.preventDefault();
            handleFormSubmission();
        });

        $('#pill').addClass('dis-none');

        $('.register-and-close').on('click', function() {
            $('.modal-backdrop.show').hide();

            $('.modal-backdrop.show').hide();
            $('#pill').removeClass('dis-none').addClass('show');

        });

        $('.bill-print').on('click', function() {
            $('#pill').removeClass('dis-none');
        });




        $('.register-and-close').on('click', function() {

            $('#modalPay').modal('hide');
            $('.fade.show').hide();
        });
    </script>
    <script>
        var dt = new Date().toLocaleTimeString();
        document.getElementById('date-time').value = dt;
    </script>
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
        });
    </script>
</body>

</html>
