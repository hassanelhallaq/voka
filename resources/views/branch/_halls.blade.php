<div class="row">
    <div class="col-md-9">
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
                                            <a class="nav-link {{ $key === 0 ? ' active' : '' }}"
                                                href="#hall{{ $item->id }}"
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
                                                    <div class="col-md-3 card-col  d-flex justify-content-center align-items-center "
                                                        data-tableNumber="1" data-start="45" data-updatedTime="45"
                                                        data-h="hall2" data-pstat="serv">
                                                        <div class="card @if ($tables->status == 'in_service') bg-info
                                                 @elseif($tables->status == 'available')
                                                bg-success text-light
                                                @elseif ($tables->status == 'reserved')
                                                   bg-danger  text-light @endif
                                                 text-dark
                                                    text-dark {{ $item === 0 ? 'active-card' : '' }}"
                                                            data-id="table{{ $item->id }}" data-stat="serv">
                                                            <div class="card-header primary-bg-color">
                                                                <div class="top d-flex justify-content-between ">
                                                                    <h5 class="card-title"> طاولة {{ $tables->name }}
                                                                    </h5>
                                                                    <span class="tableid"> #37856 </span>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="items-group">
                                                                    <div
                                                                        class="card-item mid d-flex justify-content-between align-items-center">
                                                                        <p class="hall-name"> الباقة</p>
                                                                        <span
                                                                            class="sta">{{ $tables->reservation != null ? $tables->reservation->package->name : 'لا توجد باقة' }}
                                                                        </span>
                                                                    </div>
                                                                    <div
                                                                        class="card-item body-package d-flex justify-content-between align-items-center">
                                                                        <p class="hall-name"> المقاعد</p>
                                                                        <span class="sta">
                                                                            {{ $tables->reservation != null ? $tables->reservation->package->count_of_visitors : 0 }}
                                                                            اشخاص</span>
                                                                    </div>
                                                                    <div
                                                                        class="card-item body-time d-flex justify-content-between align-items-center">
                                                                        <p class="hall-name"> الحجز</p>
                                                                        <span class="sta">
                                                                            {{ $tables->reservation != null ? $tables->reservation->price : 0 }}
                                                                            ريال</span>
                                                                    </div>
                                                                    <div
                                                                        class="card-item body-time d-flex justify-content-between align-items-center">
                                                                        <p class="hall-name"> المدة</p>
                                                                        <span class="sta">
                                                                            {{ $tables->reservation != null ? $tables->reservation->minutes : 0 }}
                                                                            ساعة </span>
                                                                    </div>
                                                                </div>
                                                                <div class="items-group">
                                                                    <div
                                                                        class="card-item body-time d-flex justify-content-between align-items-center">
                                                                        <p class="hall-name"> الحالة</p>
                                                                        <span class="sta">
                                                                            {{ $tables->reservation != null ? $tables->reservation->status : 'لا يوجد حجز' }}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="items-group">
                                                                    <div
                                                                        class="card-item body-time d-flex justify-content-between align-items-center">
                                                                        <p class="hall-name"> الرصيد الحالى</p>
                                                                        <span class="sta">
                                                                            {{ $tables->reservation != null ? $tables->reservation->price : 0 }}
                                                                            ريال </span>
                                                                    </div>
                                                                    <div
                                                                        class="card-item body-time d-flex justify-content-between align-items-center">
                                                                        @php
                                                                            if ($tables->reservation) {
                                                                                $formattedTime = Carbon\Carbon::createFromFormat('g:i A', $tables->reservation->time)->format('H:i');
                                                                                $reservationDateTime = $tables->reservation->date;
                                                                            }
                                                                            
                                                                        @endphp
                                                                        <p class="hall-name"> الوقت المنقضى</p>
                                                                        <div class="countdown-timer"
                                                                            data-start="{{ $tables->reservation ? $tables->reservation->date : '' }}"
                                                                            data-package-time="{{ $tables->reservation->package->time ?? 0 }}">
                                                                            <!-- Add a span to display the countdown timer -->
                                                                            @if ($tables->reservation)
                                                                                <span
                                                                                    class="countdown-timer-text">00:00:00</span>
                                                                            @else
                                                                                <span>انتهى</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer">
                                                                <div class="table-btn my-3 text-center">
                                                                    <div class="row">
                                                                        <div class="col-md-6 mb-2">
                                                                            <button
                                                                                class="table-btn-orders btn btn-primary w-100"
                                                                                type="button"
                                                                                data-id="#tableorders{{ $tables->id }}">
                                                                                الطلبات
                                                                            </button>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <button
                                                                                class="table-btn-info btn btn-primary w-100"
                                                                                type="button"
                                                                                data-id="#tableinfo{{ $tables->id }}">
                                                                                استعراض
                                                                            </button>
                                                                        </div>
                                                                        <div class="col-md-6 active-the-reversation">
                                                                            <!--<button class="table-btn-action btn btn-primary w-100" type="button"-->
                                                                            <!-- data-id="#tableactive" ata-bs-target="#exampleModalToggle" data-bs-toggle="modal" >-->
                                                                            <!--    تفعيل الحجز-->
                                                                            <!--</button>-->
                                                                            <!-- Button trigger modal -->
                                                                            <button type="button"
                                                                                class="btn btn-primary w-100"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#exampleModal">
                                                                                تفعيل
                                                                            </button>

                                                                            <!-- Modal -->
                                                                            <div class="modal fade" id="exampleModal"
                                                                                tabindex="-1"
                                                                                aria-labelledby="exampleModalLabel"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h1 class="modal-title fs-5"
                                                                                                id="exampleModalLabel">
                                                                                                تفعيل الحجز</h1>
                                                                                            <button type="button"
                                                                                                class="btn-close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div
                                                                                                class="modal-body text-light">
                                                                                                هل تود تفعيل الحجز
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-bs-dismiss="modal">اغلاق</button>
                                                                                            <button type="button"
                                                                                                class="btn btn-primary">تأكيد
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>


                                                                            <!--<a class="btn btn-primary"-->
                                                                            <!--    data-bs-toggle="modal"-->
                                                                            <!--    href="#exampleModalToggle1"-->
                                                                            <!--    role="button">تفعيل الحجز</a>-->


                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <!--<button-->
                                                                            <!--    class="table-btn-action btn btn-primary w-100"-->
                                                                            <!--    type="button" data-id="#tableend">-->
                                                                            <!--    انهاء الحجز-->
                                                                            <!--</button>-->
                                                                            <button type="button"
                                                                                class="btn btn-primary w-100"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#exampleModal">
                                                                                انهاء الحجز
                                                                            </button>

                                                                            <!-- Modal -->
                                                                            <div class="modal fade" id="exampleModal"
                                                                                tabindex="-1"
                                                                                aria-labelledby="exampleModalLabel"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h1 class="modal-title fs-5"
                                                                                                id="exampleModalLabel">
                                                                                                انهاء الحجز</h1>
                                                                                            <button type="button"
                                                                                                class="btn-close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div
                                                                                                class="modal-body text-light">
                                                                                                هل تود انهاء الحجز
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-bs-dismiss="modal">اغلاق</button>
                                                                                            <button type="button"
                                                                                                class="btn btn-primary">انهاء
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="table-side-bar side-bar-info"
                                                            id="tableinfo{{ $tables->id }}">
                                                            <div class="tablebrowse">
                                                                <div class="tab-nav-wraper">
                                                                    <div
                                                                        class="nav-btns d-flex justify-content-around align-items-center">
                                                                        <div class="btn btn-dark" data-tab="rev">
                                                                            الحجوزات</div>
                                                                        <div class="btn btn-dark" data-tab="waitings">
                                                                            الأنتظار</div>
                                                                    </div>
                                                                    <form action="">
                                                                        <input
                                                                            class="form-control bg-dark text-light text-center"
                                                                            type="text" placeholder="ابحث عن ضيف"
                                                                            aria-label="default input example">
                                                                    </form>
                                                                </div>
                                                                <!-- عناصر التاب -->
                                                                <div class="side-tab-content">
                                                                    <div id="rev"
                                                                        class="table-bar-info reversation-side-bar rev active-tab">
                                                                        <div
                                                                            class="first-tabb d-flex justify-content-between align-items-start">
                                                                            <p>حجوزات الطاولة</p>
                                                                            <span> 3 <i
                                                                                    class="fa-solid fa-stopwatch-20 ml-1"></i></span>
                                                                        </div>
                                                                        <ol
                                                                            class="list-group list-group-numbered reversed bill-info">
                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between align-items-start w-100">
                                                                                <a herf="{{ route('branch.reservation') }}"
                                                                                    class="btn btn-primary w-100 mb-3">اضافة
                                                                                    حجز </a>
                                                                            </li>
                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                                <div
                                                                                    class="rev-item d-flex w-100  align-items-start">
                                                                                    <div class="rev-time text-center">
                                                                                        <span>6:00</span> <br>
                                                                                        <span>PM</span>
                                                                                    </div>
                                                                                    <div class="rev-info">
                                                                                        <h4>محمد عبدالعزيز</h4>
                                                                                        <p>012586439</p>
                                                                                        <p><span>4
                                                                                                اشخاص</span><span>/باقة
                                                                                                vip</span></p>
                                                                                    </div>
                                                                                    <div class="rev-statu text-center">
                                                                                        <p>VVIP-1</p>
                                                                                        <span>فى الخدمة</span>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                                <div
                                                                                    class="rev-item d-flex w-100  align-items-start">
                                                                                    <div class="rev-time text-center">
                                                                                        <span>6:00</span> <br>
                                                                                        <span>PM</span>
                                                                                    </div>
                                                                                    <div class="rev-info">
                                                                                        <a href=""
                                                                                            class="btn btn-primary">احجز
                                                                                            الآن</a>
                                                                                    </div>
                                                                                    <div class="rev-statu text-center">
                                                                                        <p>VVIP-1</p>
                                                                                        <span> شاغرة</span>
                                                                                    </div>
                                                                                </div>
                                                                            </li>

                                                                        </ol>
                                                                    </div>
                                                                    <div id="waithings"
                                                                        class="table-bar-info waitings-side-bar waitings hidden-tab">
                                                                        <ol
                                                                            class="list-group list-group-numbered reversed bill-info">
                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                                <div
                                                                                    class="rev-item d-flex w-100  align-items-start">
                                                                                    <div class="rev-time text-center">
                                                                                        <span>1</span>
                                                                                    </div>
                                                                                    <div class="rev-info">
                                                                                        <h4>محمد عبدالعزيز</h4>
                                                                                        <p>012586439</p>
                                                                                        <p><span>4
                                                                                                اشخاص</span><span>/باقة
                                                                                                vip</span></p>
                                                                                    </div>
                                                                                    <div class="rev-statu text-center">
                                                                                        <a href=""
                                                                                            class="btn btn-primary">تفعيل</a>
                                                                                        <br />
                                                                                        <span class="s-time">
                                                                                            1:20:00</span>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                                <div
                                                                                    class="rev-item d-flex w-100  align-items-start">
                                                                                    <div class="rev-time text-center">
                                                                                        <span>2</span>
                                                                                    </div>
                                                                                    <div class="rev-info">
                                                                                        <h4>محمد عبدالعزيز</h4>
                                                                                        <p>012586439</p>
                                                                                        <p><span>4
                                                                                                اشخاص</span><span>/باقة
                                                                                                vip</span></p>
                                                                                    </div>
                                                                                    <div class="rev-statu text-center">
                                                                                        <a href=""
                                                                                            class="btn btn-primary">تفعيل</a>
                                                                                        <br />
                                                                                        <span class="s-time">
                                                                                            1:20:00</span>
                                                                                    </div>
                                                                                </div>
                                                                            </li>

                                                                        </ol>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>
                                                        @php
                                                            if ($tables->reservation) {
                                                                $orders = App\Models\Order::where('package_id', $tables->reservation->package_id)
                                                                    ->where('table_id', $tables->id)
                                                                    ->where('is_done', 0)
                                                                    ->with('products')
                                                                    ->first();
                                                            
                                                                // Wrap the related products in a collection (even if there's only one result)
                                                                if ($orders != null && $orders->products->count() != 0) {
                                                                    // Calculate total order prices using the map function on the products collection
                                                                    $totalOrderPrices = $orders->products->sum(function ($product) {
                                                                        return $product->pivot->price * $product->pivot->quantity;
                                                                    });
                                                                } else {
                                                                    $totalOrderPrices = 0;
                                                                }
                                                            } else {
                                                                $orders = null;
                                                                $totalOrderPrices = 0;
                                                            }
                                                        @endphp
                                                        <div class="table-side-bar side-bar-orders"
                                                            id="tableorders{{ $tables->id }}">
                                                            <div class="tablebrowse">
                                                                <div class="tab-nav-wraper">
                                                                    <div
                                                                        class="nav-btns d-flex justify-content-around align-items-center">
                                                                        <div class="btn btn-dark"
                                                                            data-tab="newOrders">
                                                                            الطلبات</div>
                                                                        <a onclick="product({{ $tables->id }})"
                                                                            class="btn btn-primary  mb-1"> طلب جديد</a>
                                                                    </div>
                                                                    {{-- <form action="">
                                                                        <input
                                                                            class="form-control bg-dark text-light text-center"
                                                                            type="text" placeholder="ابحث عن ضيف"
                                                                            aria-label="default input example">
                                                                    </form> --}}
                                                                </div>
                                                                <!-- عناصر التاب -->
                                                                <div class="side-tab-content">
                                                                    <div id="rev"
                                                                        class="table-bar-info reversation-side-bar rev active-tab">
                                                                        {{-- <div
                                                                            class="first-tabb d-flex justify-content-between align-items-start">
                                                                            <p>حجوزات الطاولة</p>
                                                                            <span> 3 <i
                                                                                    class="fa-solid fa-stopwatch-20 ml-1"></i></span>
                                                                        </div> --}}
                                                                        <ol
                                                                            class="list-group list-group-numbered reversed bill-info">
                                                                            @if ($orders != null && $orders->products->count() != 0)
                                                                                @foreach ($orders->products as $product)
                                                                                    <li
                                                                                        class="list-group-item d-flex justify-content-between align-items-start">
                                                                                        <div class="me-2 ms-auto">
                                                                                            <div class="fw-bold">
                                                                                                {{ $product->name }}
                                                                                            </div>
                                                                                        </div>

                                                                                        <span>{{ $product->pivot->price }}
                                                                                            ريال</span>
                                                                                    </li>
                                                                                @endforeach
                                                                            @endif
                                                                        </ol>
                                                                    </div>
                                                                    <div id="waithings"
                                                                        class="table-bar-info waitings-side-bar waitings hidden-tab">
                                                                        <ol
                                                                            class="list-group list-group-numbered reversed bill-info">

                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                                <div
                                                                                    class="rev-item d-flex w-100  align-items-start">
                                                                                    <div class="rev-time text-center">
                                                                                        <span>1</span>
                                                                                    </div>
                                                                                    <div class="rev-info">
                                                                                        <h4>محمد عبدالعزيز</h4>
                                                                                        <p>012586439</p>
                                                                                        <p><span>4
                                                                                                اشخاص</span><span>/باقة
                                                                                                vip</span></p>
                                                                                    </div>
                                                                                    <div class="rev-statu text-center">
                                                                                        <a href=""
                                                                                            class="btn btn-primary">تفعيل</a>
                                                                                        <br />
                                                                                        <span class="s-time">
                                                                                            1:20:00</span>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                                <div
                                                                                    class="rev-item d-flex w-100  align-items-start">
                                                                                    <div class="rev-time text-center">
                                                                                        <span>2</span>
                                                                                    </div>
                                                                                    <div class="rev-info">
                                                                                        <h4>محمد عبدالعزيز</h4>
                                                                                        <p>012586439</p>
                                                                                        <p><span>4
                                                                                                اشخاص</span><span>/باقة
                                                                                                vip</span></p>
                                                                                    </div>
                                                                                    <div class="rev-statu text-center">
                                                                                        <a href=""
                                                                                            class="btn btn-primary">تفعيل</a>
                                                                                        <br />
                                                                                        <span class="s-time">
                                                                                            1:20:00</span>
                                                                                    </div>
                                                                                </div>
                                                                            </li>

                                                                        </ol>
                                                                    </div>
                                                                    <div id="newOrders"
                                                                        class="table-bar-info newOrders-side-bar newOrders active-tab">
                                                                        <div id="tab1"
                                                                            class="tab-pane fade show active">
                                                                            @php
                                                                                if ($tables->reservation) {
                                                                                    $orders = App\Models\Order::where('package_id', $tables->reservation->package_id)
                                                                                        ->where('table_id', $tables->id)
                                                                                        ->where('is_done', 0)
                                                                                        ->with('products')
                                                                                        ->first();
                                                                                
                                                                                    // Wrap the related products in a collection (even if there's only one result)
                                                                                    if ($orders != null && $orders->products->count() != 0) {
                                                                                        // Calculate total order prices using the map function on the products collection
                                                                                        $totalOrderPrices = $orders->products->sum(function ($product) {
                                                                                            return $product->pivot->price * $product->pivot->quantity;
                                                                                        });
                                                                                    } else {
                                                                                        $totalOrderPrices = 0;
                                                                                    }
                                                                                } else {
                                                                                    $orders = null;
                                                                                    $totalOrderPrices = 0;
                                                                                }
                                                                            @endphp
                                                                            <ol
                                                                                class="table-list list-group list-group-numbered reversed food-items pr-0">
                                                                                @if ($orders != null && $orders->products->count() != 0)
                                                                                    @foreach ($orders->products as $product)
                                                                                        <li class="list-group-item drag d-flex justify-content-between align-items-start"
                                                                                            draggable="true">
                                                                                            <div class="me-2 ms-auto">
                                                                                                <div class="fw-bold">
                                                                                                    <span
                                                                                                        class="title">
                                                                                                        {{ $product->name }}</span><span
                                                                                                        class="count-wrap mr-2"><i
                                                                                                            class="fa-solid fa-x"></i><span
                                                                                                            class="count">3</span></span>
                                                                                                </div>
                                                                                            </div><span
                                                                                                class="list-price">{{ $product->pivot->price }}
                                                                                                ريال</span><button
                                                                                                class="order-remove btn btn-danger"
                                                                                                type="button"><i
                                                                                                    class="fa-solid fa-trash-can"></i></button>
                                                                                        </li>
                                                                                    @endforeach
                                                                                @endif
                                                                            </ol>
                                                                            <!--<ol class="list-group reversed  mt-5">-->
                                                                            <!--  <li class="list-group-item no-number  ">-->
                                                                            <!--      <div class="sub-total d-flex justify-content-between align-items-start">-->
                                                                            <!--          <div class="discount-inputs input-group">-->
                                                                            <!--              <label class="col-sm-2 col-form-label"> %</label>-->
                                                                            <!--              <input class="discount-input form-control bg-dark text-light" lang="en"-->
                                                                            <!--                  type="number" placeholder="قيمة الخصم" aria-label="default input example">-->
                                                                            <!--              <button class="btn btn-dark menu-btn" type="button">تطبيق</button>-->
                                                                            <!--          </div>-->
                                                                            <!--      </div>-->
                                                                            <!--      <div class="sub-total d-flex justify-content-between align-items-start mt-2">-->
                                                                            <!--          <div class="me-2 ms-auto">-->
                                                                            <!--              <div class="fw-bold"> حاصل الجمع</div>-->
                                                                            <!--            </div>-->
                                                                            <!--            <span class="sub-total-number">225</span>-->
                                                                            <!--            <span> ريال</span>-->
                                                                            <!--      </div>-->

                                                                            <!--      <div class="tax d-flex justify-content-between align-items-start mt-4">-->
                                                                            <!--          <div class="me-2 ms-auto">-->
                                                                            <!--              <div class="fw-bold"> ضريبة</div>-->
                                                                            <!--            </div>-->
                                                                            <!--            <span class="taxes">10%</span>-->
                                                                            <!--      </div>-->
                                                                            <!--      <div class="tax d-flex justify-content-between align-items-start mt-4 total">-->
                                                                            <!--          <div class="me-2 ms-auto">-->
                                                                            <!--              <div class="fw-bold"> الإجمالى</div>-->
                                                                            <!--            </div>-->
                                                                            <!--            <span class="table-total">247.5</span>-->
                                                                            <!--            <span> ريال</span>-->
                                                                            <!--      </div>-->
                                                                            <!--      <div class="payment-method">-->
                                                                            <!--          <div class="row">-->
                                                                            <!--              <div class="col-4">-->
                                                                            <!--                  <div class="payment-icon active d-flex justify-content-center align-items-center">-->
                                                                            <!--                      <i class="fa-solid fa-sack-dollar"></i>-->
                                                                            <!--                  </div>-->
                                                                            <!--                  <p class="text-center">كاش</p>-->
                                                                            <!--              </div>-->
                                                                            <!--              <div class="col-4">-->
                                                                            <!--                <div class="payment-icon d-flex justify-content-center align-items-center">-->
                                                                            <!--                  <i class="fa-solid fa-credit-card"></i>-->
                                                                            <!--                </div>-->
                                                                            <!--                <p class="text-center">بطاقة  ائتمان</p>-->
                                                                            <!--            </div>-->
                                                                            <!--            <div class="col-4">-->
                                                                            <!--              <div class="payment-icon d-flex justify-content-center align-items-center">-->
                                                                            <!--                <i class="fa-solid fa-wallet"></i>-->
                                                                            <!--              </div>-->
                                                                            <!--              <p class="text-center">المحفظة</p>-->
                                                                            <!--          </div>-->
                                                                            <!--          </div>-->
                                                                            <!--          <div class="payment-btn my-3 text-center">-->
                                                                            <!--              <div class="btn btn-primary btn-lg w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">ادفع الآن</div>-->
                                                                            <!-- Modal -->
                                                                            <!--              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
                                                                            <!--                <div class="modal-dialog">-->
                                                                            <!--                  <div class="modal-content">-->
                                                                            <!--                    <div class="modal-header">-->
                                                                            <!--                      <h5 class="modal-title" id="exampleModalLabel">تأكيد الدفع</h5>-->
                                                                            <!--                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
                                                                            <!--                    </div>-->
                                                                            <!--                    <div class="modal-body">-->
                                                                            <!--                      <p class="consfirm-text">هل تريد تأكيد الدفع</p>-->
                                                                            <!--                    </div>-->
                                                                            <!--                    <div class="modal-footer">-->
                                                                            <!--                      <button type="button" class="btn btn-primary">تأكيد</button>-->
                                                                            <!--                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لا </button>-->
                                                                            <!--                    </div>-->
                                                                            <!--                  </div>-->
                                                                            <!--                </div>-->
                                                                            <!--              </div>-->
                                                                            <!--          </div>-->
                                                                            <!--      </div>-->
                                                                            <!--    </li>-->



                                                                            <!--</ol>-->

                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>



                                                        @php
                                                            if ($tables->reservation) {
                                                                $orders = App\Models\Order::where('package_id', $tables->reservation->package_id)
                                                                    ->where('table_id', $tables->id)
                                                                    ->where('is_done', 0)
                                                                    ->with('products')
                                                                    ->first();
                                                            
                                                                // Wrap the related products in a collection (even if there's only one result)
                                                                if ($orders != null && $orders->products->count() != 0) {
                                                                    // Calculate total order prices using the map function on the products collection
                                                                    $totalOrderPrices = $orders->products->sum(function ($product) {
                                                                        return $product->pivot->price * $product->pivot->quantity;
                                                                    });
                                                                } else {
                                                                    $totalOrderPrices = 0;
                                                                }
                                                            } else {
                                                                $orders = null;
                                                                $totalOrderPrices = 0;
                                                            }
                                                        @endphp
                                                        <!--</div>-->
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
    </div>
    <div class="col-md-3" id="casher-section">
        <div class="side-place">
            <!--<div id="tab-place" class="c-tab-pane fade show active">-->
            <!--    <ol class="table-list list-group list-group-numbered reversed">-->
            <!--        <li-->
            <!--            class="menu-info-list list-group-item d-flex  flex-column justify-content-center align-items-center text-center p-0">-->
            <!--            <a class="new-reserv-btn btn btn-link w-100" href="{{ route('branch.reservation') }}">-->
            <!--                <i class="fa-solid fa-plus"></i>-->
            <!--                <p>انشاء حجز جديد </p>-->
            <!--            </a>-->
            <!--        </li>-->

            <!--    </ol>-->
            <!--    <ol class="list-group reversed casher-box mt-5 none">-->
            <!--        <li class="list-group-item no-number  ">-->
            <!--            <div class="tax d-flex justify-content-between align-items-start my-4 total w-100">-->
            <!--                <div class="discount-inputs input-group">-->
            <!--                    <label class="col-sm-2 col-form-label"> %</label>-->
            <!--                    <input class="discount-input form-control bg-dark text-light" lang="en"-->
            <!--                        type="number" placeholder="قيمة الخصم" aria-label="default input example">-->
            <!--                    <button class="btn btn-dark menu-btn" type="button">تطبيق</button>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            <div class="sub-total d-flex justify-content-between align-items-start">-->
            <!--                <div class="me-2 ms-auto">-->
            <!--                    <div class="fw-bold"> حاصل الجمع</div>-->
            <!--                </div>-->
            <!--                <span class="sub-total-number"> 260 </span>-->
            <!--                <span> ريال</span>-->
            <!--            </div>-->

            <!--            <div class="tax d-flex justify-content-between align-items-start mt-4">-->
            <!--                <div class="me-2 ms-auto">-->
            <!--                    <div class="fw-bold"> ضريبة</div>-->
            <!--                </div>-->
            <!--                <span class="taxes">10%</span>-->
            <!--            </div>-->
            <!--            <div class="tax d-flex justify-content-between align-items-start mt-4 total">-->
            <!--                <div class="me-2 ms-auto">-->
            <!--                    <div class="fw-bold"> الإجمالى</div>-->
            <!--                </div>-->
            <!--                <span class="table-total">286 </span>-->
            <!--                <span> ريال</span>-->
            <!--            </div>-->
            <!--            <div class="payment-method">-->
            <!--                <div class="row">-->
            <!--                    <div class="col-4">-->
            <!--                        <div class="payment-icon active d-flex justify-content-center align-items-center">-->
            <!--                            <i class="fa-solid fa-sack-dollar"></i>-->
            <!--                        </div>-->
            <!--                        <p class="text-center">كاش</p>-->
            <!--                    </div>-->
            <!--                    <div class="col-4">-->
            <!--                        <div class="payment-icon d-flex justify-content-center align-items-center">-->
            <!--                            <i class="fa-solid fa-credit-card"></i>-->
            <!--                        </div>-->
            <!--                        <p class="text-center">بطاقة ائتمان</p>-->
            <!--                    </div>-->
            <!--                    <div class="col-4">-->
            <!--                        <div class="payment-icon d-flex justify-content-center align-items-center">-->
            <!--                            <i class="fa-solid fa-wallet"></i>-->
            <!--                        </div>-->
            <!--                        <p class="text-center">المحفظة</p>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--                <div class="payment-btn my-3 text-center">-->
            <!--                    <div class="btn btn-primary btn-lg w-100" data-bs-toggle="modal"-->
            <!--                        data-bs-target="#exampleModal">ادفع الآن</div>-->
            <!-- Modal -->
            <!--                    <div class="modal fade" id="exampleModal" tabindex="-1"-->
            <!--                        aria-labelledby="exampleModalLabel" aria-hidden="true">-->
            <!--                        <div class="modal-dialog">-->
            <!--                            <div class="modal-content">-->
            <!--                                <div class="modal-header">-->
            <!--                                    <h5 class="modal-title" id="exampleModalLabel">تأكيد الدفع</h5>-->
            <!--                                    <button type="button" class="btn-close" data-bs-dismiss="modal"-->
            <!--                                        aria-label="Close"></button>-->
            <!--                                </div>-->
            <!--                                <div class="modal-body">-->
            <!--                                    <p class="consfirm-text">هل تريد تأكيد الدفع</p>-->
            <!--                                </div>-->
            <!--                                <div class="modal-footer">-->
            <!--                                    <button type="button" class="btn btn-primary">تأكيد</button>-->
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
            <!--</div>-->
        </div>
    </div>
</div>


<script src="{{ asset('front/js/jquery.js') }}"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
<!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
<!--<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" -->
    <!--    integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous">
    -->
<!--</script>-->
<!--<script src="{{ asset('front/js/date.js') }}"></script>-->
<!--<script src="{{ asset('front/js/bootstrap-clockpicker.min.js') }}"></script>-->
<script src="{{ asset('front/js/main.js') }}"></script>
<script>
    Function to update the countdown timer display

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
    $(document).ready(function() {
        //   $('.table-btn-action').on('click', function(){
        //     var newId = $(this).data('id');
        //     var $appendedContent = $('.side-place .appended');

        //     if ($appendedContent.length && !$appendedContent.is($(newId))) {
        //       $appendedContent.removeClass('appended');
        //       $appendedContent.remove();
        //     } else {
        //       $appendedContent.addClass('appended');
        //     }

        //     $(newId).toggleClass('appended');
        //     $('.side-place').addClass('have-bg').append($(newId));
        //   });


        $('.table-btn-orders').on('click', function() {
            var newId = $(this).data('id');
            $('.side-place').empty();
            $('.side-place').append($(newId).clone().css('display', 'block')).addClass('have-bg');
            console.log('first');
        });

        $('.table-btn-info').on('click', function() {
            var newId = $(this).data('id');
            $('.side-place').empty();
            $('.side-place').append($(newId).clone().css('display', 'block')).addClass('have-bg');
            console.log('second');
        });

    });
</script>
<div class="modal fade" id="exampleModalToggle1" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-light" id="exampleModalToggleLabe2">
                    تفعيل الحجز</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-light">
                هل تود تفعيل الحجز
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">تفعيل
                    يدوى</button>
                <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">
                    QR </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-light" id="exampleModalToggleLabel2">
                    تفعيل الحجز</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-light">
                تم تفعيل الحجز بنجاح
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary custome-close" data-bs-dismiss="modal"
                    aria-label="Close">اغلاق</button>
            </div>
        </div>
    </div>
</div>
