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
    </style>
</head>

<body>

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
                                    <a href="{{ route('branch.home') }}" type="button"
                                        class="s-filter btn btn-lg btn-primary"> اقفال الشاشة </a>
                                </div>
                            </li>
                            <li class="nav-item py-3 show-content no-border" data-id="#pay" data-v="0">
                                <div class="btn to-pay btn-lg w-100">الدفع </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <div class="reservation-tabs" id="all-packages">
                            <div class="container ">
                                <div class="row">
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
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="reservation-tabs halls-tab card card-nav-tabs card-plain " id="all-tables">
                            @include('branch._halles_branch')
                        </div>
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
                    <button type="button" class="btn btn-primary" onclick="storeReaervation()"
                        style="margin-left: 10px;">تسجيل</button>
                    <button type="button" class="btn btn-primary" onclick="storeReaervation()"
                        style="margin-left: 10px;">تسجيل وتغعيل</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لا </button>
                </div>
            </div>
        </div>
    </div>
    <!--مودال طباعة الفاتورة -->
    <div class="modal fade" id="pill" tabindex="-1" aria-labelledby="pill" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

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
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" style="margin-left: 10px;">طباعة</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لا </button>
                </div>
            </div>
        </div>
    </div>

    <!-- js files  -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js"
        integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
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
                    $('#pill').show(); // Show the reserv main section

                })
        }

        function generateReservationHTML(reservation) {
            // Generate the HTML content using reservation data
            var html = `
        <!-- Populate the content with reservation details -->
        <h2>Reservation Details</h2>
        <p class="info">Client: ${reservation.client.name}</p>
        <p class="info">Phone: ${reservation.client.phone}</p>
        <p class="info">Table: ${reservation.table.name}</p>
        <!-- Update client information here -->
        <!-- Add more details as needed -->
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
                                            <p class="itemtext">${reservation.package.name}</p>
                                        </td>
                                        <td class="tableitem">
                                            <p class="itemtext">1</p>
                                        </td>
                                        <td class="tableitem">
                                            <p class="itemtext">${reservation.package.price}</p>
                                        </td>
                                    </tr>



                                </table>
                            </div>
        `;
            return html;
        }

        function updateReservationDetails(reservationId) {
            $('#reservation-details').attr('data-reservation-id', reservationId);
            $('#reservation-details button[disabled]').prop('disabled', false);
            $('#reservation-details button[data-bs-target="#pill"]').removeAttr('disabled');
            $('#reservation-details button[data-bs-target="#activate-reservation-btn"]').removeAttr('disabled');


        }

        function activateReservation(reservationId) {
            // Perform actions related to activating the reservation using the reservationId
            let formData = new FormData();
            store('/branch/active/table/' + reservationId, formData)
            // You can replace the console.log with your desired logic
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
