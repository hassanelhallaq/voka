<div id="mainPage">
    <div class="col-md-12">
        <div class="seacr-bar mb-5">
            <form class="d-flex search  justify-content-between" role="search">
                <p>اكتب رقم الطاولة</p>
                <input class="search-input form-control" type="search" aria-label="Search" placeholder="12">
                <button class="btn search-btn">
                    بحث
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <div class="container">
            <div class="filter-btns d-flex mb-2">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="h-filter btn btn-dark" data-ha="all">كل الصالات</button>
                    @foreach ($halles as $item)
                        <button type="button" class="h-filter btn btn-dark"
                            data-ha="hall{{ $item->id }}">{{ $item->name }}</button>
                    @endforeach
                </div>
                <div class="btn-group mx-3" role="group" aria-label="Basic example">
                    <button type="button" class="s-filter btn btn-dark" data-st="all">كل الحالات</button>
                    <button type="button" class="s-filter btn btn-dark" data-st="reserved"> المحجوزة</button>
                    <button type="button" class="s-filter btn btn-dark" data-st="available"> المتاحة</button>
                    <button type="button" class="s-filter btn btn-dark" data-st="in_service"> فى الخدمة</button>
                </div>
                <div class="time-filter">
                    <form action="">
                        <div class="d-flex">
                            <p> متبقى دقائق اقل من </p>
                            <input class="time-input form-control form-control-sm" type="text" placeholder="30"
                                aria-label=".form-control-sm example">
                            <button type="submit" class="apply-time btn btn-dark">تطبيق </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row home-card">
                @foreach ($halles as $item)
                    @foreach ($item->tables as $table)
                        @php
                            if ($table->reservation) {
                                $formattedTime = Carbon\Carbon::createFromFormat('g:i A', $table->reservation->time)->format('H:i');
                                $reservationDateTime = $table->reservation->date;
                            }
                            
                        @endphp
                        <div class="col-md-3 card-col  d-flex justify-content-center align-items-center"
                            data-tableNumber="{{ $item->name }}"
                            data-package-time="{{ $table->reservation->package->time ?? 0 }}"
                            data-start="{{ $reservationDateTime ?? 0 }}" data-updatedTime="45"
                            data-h="hall{{ $item->id }}"
                            @if ($table->status == 'in_service') data-pstat="in_service" @elseif($table->status == 'available') data-pstat ="available"
                             @elseif ($table->status == 'reserved') data-pstat ="reserved" @endif>


                            <div class="card @if ($table->status == 'in_service') bg-info
                                 @elseif($table->status == 'available')
                                bg-success text-light
                                @elseif($table->status == 'late')
                                bg-secondary text-light
                                @elseif ($table->status == 'reserved')
                                   bg-danger  text-light @endif
                                 text-dark"
                                data-id="table{{ $table->id }}"
                                @if ($table->status == 'in_service') data-stat="serv" @elseif($table->status == 'available')
                                data-pstat ="available" @elseif ($table->status == 'reserved') data-pstat ="reserved" @endif>
                                <div class="card-header primary-bg-color">
                                    <div class="top d-flex justify-content-between ">
                                        <h5 class="card-title"> طاولة رقم {{ $table->name }}</h5>
                                        <!-- Add the countdown timer element where you want to display the remaining time -->
                                        <!-- Assuming $formattedTime contains the time in "H:i" format -->
                                        <div class="countdown-timer"
                                            data-start="{{ $table->reservation ? $table->reservation->date : '' }}"
                                            data-package-time="{{ $table->reservation->package->time ?? 0 }}">
                                            <!-- Add a span to display the countdown timer -->
                                            @if ($table->reservation)
                                                <span class="countdown-timer-text">00:00:00</span>
                                            @else
                                                <span>انتهى</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="mid d-flex justify-content-between">
                                        <p class="hall-name">{{ $item->name }}</p>
                                        <span class="sta">
                                            @if ($table->status == 'in_service')
                                                فى الخدمة
                                            @elseif($table->status == 'available')
                                                متاحة
                                            @elseif ($table->status == 'reserved')
                                                محجوزة
                                            @endif
                                        </span>
                                    </div>

                                    <div class="body-package d-flex justify-content-between">
                                        <p class="hall-name">
                                            {{ $table->reservation->package->name ?? 'لا يوجد باقة ' }}
                                        </p>
                                        <span class="sta">
                                            {{ $table->reservation->package->count_of_visitors ?? 0 }}
                                            اشخاص</span>
                                    </div>
                                    <div class="body-time d-flex justify-content-between">
                                        <p class="hall-name">
                                            @if (isset($table->reservation->date))
                                                {{ \Illuminate\Support\Carbon::parse($table->reservation->date)->format('Y-m-d') }}
                                            @else
                                                لا يوجد تاريخ
                                            @endif
                                        </p>
                                        <span class="sta">{{ $table->reservation->time ?? 'لا يوجد وقت ' }} </span>
                                    </div>
                                    {{-- <div class="body-activation d-flex justify-content-between">
                                        <p class="hall-name">التفعيل</p>
                                        <div class="table-activation">
                                            <input type="radio" id="radio-1" name="tabs" checked="">
                                            <label class="tab" for="radio-1">نشط</label>
                                            <input type="radio" id="radio-2" name="tabs">
                                            <label class="tab" for="radio-2">غير نشط</label>

                                            <span class="glider"></span>
                                        </div>
                                    </div> --}}
                                    @php
                                        if ($table->reservation) {
                                            $orders = App\Models\Order::where('package_id', $table->reservation->package_id)
                                                ->where('table_id', $table->id)
                                                ->where('is_done', 0)
                                                ->with('products')
                                                ->first();
                                        
                                            // Wrap the related products in a collection (even if there's only one result)
                                            $productsCollection = collect($orders->products);
                                        
                                            // Calculate total order prices using the map function on the products collection
                                            $totalOrderPrices = $productsCollection->map(function ($product) {
                                                return $product->price * $product->quantity;
                                            });
                                        } else {
                                            $totalOrderPrices = 0;
                                        }
                                    @endphp
                                    <div class="card-footer">
                                        <p class="hall-name"> الرصيد :
                                            {{ $table->reservation->package->price ?? ' لا يوجد رصيد' }}</p>
                                        <span class="sta">
                                            @if ($table->reservation)
                                                الرصيد المتبقى :
                                                {{ $table->reservation->package->price ?? (0 - $totalOrderPrices ?? 0) }}
                                            @else
                                                لا يوجد رصيد
                                            @endif
                                        </span>
                                    </div>

                                </div>
                                @if ($table->status == 'in_service')
                                    <div class="table-side-bar" id="table{{ $table->id }}">
                                        <h2 class="text-center mb-4">طاولة رقم {{ $table->name }}</h2>
                                        <div class="tab-nav-wraper">
                                            <ul class="nav c-nav-tabs d-flex justify-content-between home-tab">
                                                <li class="nav-item">
                                                    <a class="nav-link " data-tab="reservations" href="#">
                                                        الحجوزات</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-tab="orders" href="#"> الطلبات</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-tab="the-menu" href="#">
                                                        القائمة</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- عناصر التاب -->
                                        <div class="tab-content">
                                            <div id="the-menu" class="c-tab-pane active">
                                                <ol class="list-group list-group-numbered reversed">


                                                    @foreach ($orders->products as $product)
                                                        <li
                                                            class="list-group-item d-flex justify-content-between align-items-start">
                                                            <div class="me-2 ms-auto">
                                                                <div class="fw-bold">{{ $product->name }}</div>
                                                            </div>

                                                            <span>{{ $product->pivot->price }} ريال</span>
                                                        </li>
                                                    @endforeach

                                                    <li
                                                        class="new-menu-li list-group-item d-flex justify-content-center align-items-start">
                                                        <a onclick="product({{ $table->id }})" class="me-2">
                                                            <div class="fw-bold">اضف عنصر جديد</div>
                                                        </a>
                                                    </li>

                                                </ol>

                                                <ol class="list-group reversed  mt-5">
                                                    <li class="list-group-item no-number  ">
                                                        <div
                                                            class="sub-total d-flex justify-content-between align-items-start">
                                                            <div class="me-2 ms-auto">
                                                                <div class="fw-bold"> حاصل الجمع</div>
                                                            </div>
                                                            <span>{{ $table->reservation->package->price ?? 0 }}
                                                                ريال</span>
                                                        </div>

                                                        <div
                                                            class="tax d-flex justify-content-between align-items-start mt-4">
                                                            <div class="me-2 ms-auto">
                                                                <div class="fw-bold"> ضريبة</div>
                                                            </div>
                                                            <span>10%</span>
                                                        </div>
                                                        <div
                                                            class="tax d-flex justify-content-between align-items-start mt-4 total">
                                                            <div class="me-2 ms-auto">
                                                                <div class="fw-bold"> الإجمالى</div>
                                                            </div>
                                                            <span>{{ $table->reservation->package->price ?? 0 * 0.15 }}
                                                                ريال</span>
                                                        </div>
                                                        <div class="payment-method">
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
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModal6">
                                                                    ادفع الآن</div>
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="exampleModal6"
                                                                    tabindex="-1"
                                                                    aria-labelledby="exampleModalLabel6"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="exampleModalLabel">
                                                                                    تأكيد الدفع</h5>
                                                                                <button type="button"
                                                                                    class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p class="consfirm-text">هل تريد تأكيد
                                                                                    الدفع
                                                                                </p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-primary">تأكيد</button>
                                                                                <button type="button"
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
                                                @foreach ($table->reservations as $reservation)
                                                    <ol class="list-group list-group-numbered reversed bill-info">
                                                        <li
                                                            class="list-group-item d-flex justify-content-between align-items-start">
                                                            <div class="me-2 ms-auto">
                                                                <div class="fw-bold"> طلب باسم</div>
                                                            </div>
                                                            <span>{{ $reservation->client->name }}</span>
                                                        </li>
                                                        <li
                                                            class="list-group-item d-flex justify-content-between align-items-start">
                                                            <div class="me-2 ms-auto">
                                                                <div class="fw-bold">اسم الباقة</div>
                                                            </div>
                                                            <span> {{ $reservation->package->name }}</span>
                                                        </li>
                                                        <li
                                                            class="list-group-item d-flex justify-content-between align-items-start">
                                                            <div class="me-2 ms-auto">
                                                                <div class="fw-bold"> الرصيد</div>
                                                            </div>
                                                            <span>{{ $reservation->package->price }} </span>
                                                        </li>
                                                        <li
                                                            class="list-group-item d-flex justify-content-between align-items-start">
                                                            <div class="me-2 ms-auto">
                                                                <div class="fw-bold"> الحالة</div>
                                                            </div>
                                                            <span class="badge bg-info">تم الدفع </span>
                                                        </li>
                                                        <li
                                                            class="new-menu-li list-group-item d-flex justify-content-center align-items-start">
                                                            <div class="me-2">
                                                                <div class="fw-bold"> طباعة الطلب</div>
                                                            </div>
                                                        </li>
                                                    </ol>
                                                @endforeach

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
                                                                        <div
                                                                            class="d-flex h-100 justify-content-around align-items-center">
                                                                            <div class="gusts">
                                                                                <span class="table-gusts px-2">
                                                                                    4</span>
                                                                                <span> <i
                                                                                        class="fa-solid fa-users"></i></span>
                                                                            </div>
                                                                            <div class="table-res">
                                                                                طاولة 1
                                                                            </div>
                                                                            <span
                                                                                class="badge bg-secondary">مؤكد</span>
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
                                                                        <div
                                                                            class="d-flex justify-content-center align-items-center">
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
                                                                        <div
                                                                            class="d-flex justify-content-center align-items-center">
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
                                                                        <div
                                                                            class="d-flex justify-content-center align-items-center">
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
                                @else
                                    <div class="table-side-bar" id="table{{ $table->id }}">
                                        <ol class="table-list list-group list-group-numbered reversed">
                                            <li
                                                class="menu-info-list list-group-item d-flex  flex-column justify-content-center align-items-center text-center p-0">
                                                <a class="new-reserv-btn btn btn-link w-100"
                                                    href="{{ route('branch.reservation') }}">
                                                    <i class="fa-solid fa-plus"></i>
                                                    <p>انشاء حجز جديد </p>
                                                </a>
                                            </li>

                                        </ol>
                                        <ol class="list-group reversed  mt-5">
                                            <li class="list-group-item no-number  ">
                                                <div
                                                    class="sub-total d-flex justify-content-between align-items-start">
                                                    <div class="me-2 ms-auto">
                                                        <div class="fw-bold"> حاصل الجمع</div>
                                                    </div>
                                                    <span class="sub-total-number">
                                                        {{ $table->reservation->package->price ?? 0 }} </span>
                                                    <span> ريال</span>
                                                </div>


                                                <div class="tax d-flex justify-content-between align-items-start mt-4">
                                                    <div class="me-2 ms-auto">
                                                        <div class="fw-bold"> ضريبة</div>
                                                    </div>
                                                    <span class="taxes">10%</span>
                                                </div>
                                                <div
                                                    class="tax d-flex justify-content-between align-items-start mt-4 total">
                                                    <div class="me-2 ms-auto">
                                                        <div class="fw-bold"> الإجمالى</div>
                                                    </div>
                                                    <span
                                                        class="table-total">{{ $table->reservation->package->price ?? 0 * 0.15 }}
                                                    </span>
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
                                                        <div class="btn btn-primary btn-lg w-100"
                                                            data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                            ادفع الآن</div>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="exampleModalLabel">
                                                                            تأكيد الدفع</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p class="consfirm-text">هل تريد تأكيد
                                                                            الدفع</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-primary">تأكيد</button>
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
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('front/js/jquery.js') }}"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="./js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js"
    integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous">
</script>
<script src="{{ asset('front/js/date.js') }}"></script>
<script src="{{ asset('front/js/bootstrap-clockpicker.min.js') }}"></script>
<script src="{{ asset('front/js/main.js') }}"></script>
<script>
    function product(id) {

        // Add active class to "القائمة" link
        $.get('product-order/ajax/' + id, {}).done(function(data) {
            $('#mainPage').html(data); // Show the new content

        }).done(function() {
            $('#casher-section').show(); // Hide the casher section

            $('#reserv-main-section').hide(); // Show the reserv main section

        });


    }
</script>
<script>
    // Function to update the countdown timer display
    function updateCountdown() {
        // Get all the countdown-timer elements
        const countdownTimers = document.querySelectorAll('.countdown-timer');

        countdownTimers.forEach(countdownTimer => {
            const countdownTimerText = countdownTimer.querySelector('.countdown-timer-text');

            // Get the data-start and data-package-time values from the data attributes
            const startTimeString = countdownTimer.getAttribute('data-start');
            const packageTime = parseInt(countdownTimer.getAttribute('data-package-time'));

            // Convert the startTimeString to a Date object
            const startTime = new Date(startTimeString);

            // Calculate the target end time by adding the packageTime in minutes to the start time
            const endTime = new Date(startTime.getTime() + packageTime * 60000);

            const currentTime = new Date().getTime();
            const timeRemaining = endTime - currentTime;

            if (timeRemaining <= 0) {
                // Timer has ended
                countdownTimerText.textContent = 'انتهى';
            } else {
                // Calculate hours, minutes, and seconds
                const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

                // Format the time and update the countdown display
                const formattedTime =
                    `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                countdownTimerText.textContent = formattedTime;
            }
        });
    }

    // Update the countdown every second
    setInterval(updateCountdown, 1000);

    // Initialize the countdown on page load
    updateCountdown();
</script>

//
<script>
    //     var tableclick = document.getElementById("tableclick").value;
    //     console.log(tableclick);
    //     var x = document.getElementById("casher-section");
    //     if (tableclick === "available") {
    //         x.style.display = "block";
    //     }
    //
</script>
