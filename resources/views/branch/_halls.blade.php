@extends('branch.parent')
@section('contentFront')
    <div class="col-md-8">
        <div class="reservation-tabs all-halls card card-nav-tabs card-plain ">
            <div class="card-header card-header-danger">
                <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                        <ul class="nav salon-table-tabs nav-tabs" data-tabs="tabs">
                            @foreach ($halles as $key => $item)
                                <li class="nav-item">
                                    <a class="nav-link {{ $key === 0 ? ' active' : '' }}"
                                        data-salonTab="#hall{{ $item->id }}" data-toggle="tab">{{ $item->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body new">
                <div class="tab-content text-center">
                    @foreach ($halles as $e => $item)
                        <div class="tab-pane salon-table-tabs-content  {{ $e === 0 ? ' active' : '' }}"
                            id="hall{{ $item->id }}">
                            <div class="row new-reservation-tables">
                                <!--<h2 class="text-center text-light">{{ $item->name }}</h2>-->
                                <div class="col-md-12">
                                    <div class="row">
                                        @foreach ($item->tables as $i => $tables)
                                            <div class="col-md-4 card-col  d-flex justify-content-center align-items-center "
                                                data-tableNumber="1" data-start="45" data-updatedTime="45" data-h="hall2"
                                                data-pstat="serv">
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
                                                            <h5 class="card-title"> طاولة
                                                                {{ $tables->name }}
                                                            </h5>
                                                            <span class="tableid"> </span>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="items-group">
                                                            <div
                                                                class="card-item mid d-flex justify-content-between align-items-center">
                                                                <p class="hall-name"> اسم الباقة</p>
                                                                <span class="sta">
                                                                    {{ $tables->reservation != null ? $tables->reservation->package->name : 'لا توجد باقة' }}
                                                                </span>
                                                            </div>
                                                            <div
                                                                class="card-item body-package d-flex justify-content-between align-items-center">
                                                                <p class="hall-name"> عدد الأشخاص</p>
                                                                <span class="sta">
                                                                    {{ $tables->reservation != null ? $tables->reservation->package->count_of_visitors : 0 }}
                                                                    اشخاص</span>
                                                            </div>
                                                            <div
                                                                class="card-item body-time d-flex justify-content-between align-items-center">
                                                                <p class="hall-name"> قيمة الحجز الكلي</p>
                                                                <span class="sta">
                                                                    {{ $tables->reservation != null ? $tables->reservation->package->price : 0 }}
                                                                    ريال</span>
                                                            </div>
                                                            <div
                                                                class="card-item body-time d-flex justify-content-between align-items-center">
                                                                <p class="hall-name"> مدة الحجز بالدقائق</p>
                                                                <span class="sta">
                                                                    {{ $tables->reservation != null ? $tables->reservation->minutes : 0 }}
                                                                    دقيقة </span>
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
                                                            <div
                                                                class="card-item body-time d-flex justify-content-between align-items-center">
                                                                <p class="hall-name"> رصيد الطاولة الحالي</p>
                                                                <span class="sta">
                                                                    {{ $tables->reservation != null ? $tables->reservation->package->price - $totalOrderPrices : 0 }}
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
                                                                <p class="hall-name"> الوقت المتبقي</p>
                                                                <div class="countdown-timer"
                                                                    data-start="{{ $tables->reservation ? $tables->reservation->time : '' }}"
                                                                    data-package-time="{{ $tables->reservation->package->time ?? 0 }}">
                                                                    <!-- Add a span to display the countdown timer -->
                                                                    @if ($tables->reservation)
                                                                        <span class="countdown-timer-text">00:00:00</span>
                                                                    @else
                                                                        <span>انتهى</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            @if ($tables->reservation)
                                                                <div
                                                                    class="card-item body-time d-flex justify-content-between">
                                                                    <p class="hall-name">وقت الحجز</p>
                                                                    <span> {{ $tables->reservation->time }} -
                                                                        {{ $tables->reservation->time_end }} </span>
                                                                </div>
                                                            @else
                                                                <div
                                                                    class="card-item body-time d-flex justify-content-between">
                                                                    <p class="hall-name">وقت الحجز</p>
                                                                    <span> لا يوجد </span>
                                                                </div>
                                                            @endif
                                                            <div
                                                                class="card-item body-time d-flex justify-content-between align-items-center">
                                                                @php
                                                                    if ($tables->reservation) {
                                                                        $formattedTime = Carbon\Carbon::createFromFormat('g:i A', $tables->reservation->time)->format('H:i');
                                                                        $reservationDateTime = $tables->reservation->date;
                                                                    }

                                                                @endphp
                                                                <p class="hall-name"> موظف الخدمة "الويتر"</p>
                                                                <span> سعد احمد
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="table-btn my-3 text-center">
                                                            <div class="row">
                                                                <div class="col-md-6 mb-2">
                                                                    @if ($tables->reservation)
                                                                        <button
                                                                            class="table-btn-orders btn btn-primary w-100"
                                                                            type="button"
                                                                            data-id="#tableorders{{ $tables->id }}">
                                                                            الطلبات
                                                                        </button>
                                                                    @else
                                                                        <a class="table-btn-orders btn btn-primary w-100"
                                                                            type="button"
                                                                            href="{{ route('branch.reservation') }}">
                                                                            احجز الان
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <button class="table-btn-info btn btn-primary w-100"
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
                                                                    @if ($tables->reservation)
                                                                        @if ($tables->status == 'in_service')
                                                                            <button type="button" disabled
                                                                                class="btn btn-primary w-100"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#exampleModal_{{ $tables->id }}">
                                                                                تفعيل
                                                                            </button>
                                                                        @else
                                                                            <button type="button"
                                                                                class="btn btn-primary w-100"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#exampleModal_{{ $tables->id }}">
                                                                                تفعيل
                                                                            </button>
                                                                        @endif
                                                                    @else
                                                                        <button type="button" disabled
                                                                            class="btn btn-primary w-100"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#exampleModal_{{ $tables->id }}">
                                                                            تفعيل
                                                                        </button>
                                                                    @endif

                                                                    <!-- Modal -->
                                                                    <div class="modal fade"
                                                                        id="exampleModal_{{ $tables->id }}"
                                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
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
                                                                                    <div class="modal-body text-light">
                                                                                        هل تود تفعيل
                                                                                        الحجز
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <a type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-bs-dismiss="modal">اغلاق</a>
                                                                                    <button
                                                                                        class="forceclosing btn btn-primary"
                                                                                        type="button"
                                                                                        onclick="activeTable({{ $tables->id }})"
                                                                                        class="btn btn-primary">تأكيد
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    @if ($tables->reservation)
                                                                        <button type="button"
                                                                            class="btn btn-primary w-100"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#close_{{ $tables->id }}">
                                                                            انهاء الحجز
                                                                        </button>
                                                                    @else
                                                                        <button type="button" disabled
                                                                            class="btn btn-primary w-100"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#close_{{ $tables->id }}">
                                                                            انهاء الحجز
                                                                        </button>
                                                                    @endif
                                                                    <!-- Modal -->
                                                                    <div class="modal fade"
                                                                        id="close_{{ $tables->id }}" tabindex="-1"
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
                                                                                    <div class="modal-body text-light">
                                                                                        هل تود انهاء الحجز
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class=" btn btn-secondary"
                                                                                        data-bs-dismiss="modal">اغلاق</button>
                                                                                    <a onclick="closeTable({{ $tables->id }})"
                                                                                        class="rev-close btn btn-primary">انهاء
                                                                                    </a>
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
                                                                <input class="form-control bg-dark text-light text-center"
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
                                                                        <a href="{{ route('branch.reservation') }}"
                                                                            class="btn btn-primary w-100 mb-3">اضافة
                                                                            حجز </a>
                                                                    </li>
                                                                    @if ($tables->reservation)
                                                                        <li
                                                                            class="list-group-item d-flex justify-content-between align-items-start">
                                                                            <div
                                                                                class="rev-item d-flex w-100  align-items-start">
                                                                                @php
                                                                                    $dateString = $tables->reservation->date;

                                                                                    // Create a DateTime object from the date string
                                                                                    $date = new DateTime($dateString);

                                                                                    // Format the time as desired (e.g., "H:i")
                                                                                    $formattedTime = $date->format('h:i A');
                                                                                @endphp
                                                                                <div class="rev-time text-center">
                                                                                    <span>{{ $formattedTime }}</span>
                                                                                    <br>
                                                                                    {{-- <span>PM</span> --}}
                                                                                </div>
                                                                                <div class="rev-info">
                                                                                    <h4>{{ $tables->reservation->client->name }}
                                                                                    </h4>
                                                                                    <p>{{ $tables->reservation->client->phone }}
                                                                                    </p>
                                                                                    <p><span>{{ $tables->reservation->package->count_of_visitors }}
                                                                                            اشخاص</span><span>/باقة
                                                                                            {{ $tables->reservation->package->name }}</span>
                                                                                    </p>
                                                                                </div>
                                                                                <div class="rev-statu text-center">
                                                                                    <p>{{ $tables->reservation->package->name }}
                                                                                    </p>
                                                                                    <span>{{ $tables->status }}</span>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    @endif
                                                                    @php
                                                                        $now = Carbon\Carbon::now();

                                                                        // Query to get all reservations for today
                                                                        $reservations = App\Models\Reservation::where('table_id', $tables->id)
                                                                            ->where(function ($query) use ($now) {
                                                                                $query->whereDate('date', $now->toDateString())->whereTime('date', '>=', $now->toTimeString());
                                                                            })
                                                                            ->orderBy('date')
                                                                            ->get();

                                                                        $packages = $tables->packages;
                                                                        foreach ($packages as $key => $package) {
                                                                            # code...

                                                                            $package = App\Models\Package::find($package->id);
                                                                            $minutesPerPackage = $package->time;

                                                                            // Generate time slots based on the package minutes
                                                                            $startTime = Carbon\Carbon::createFromTime(0, 0, 0);
                                                                            $endTime = Carbon\Carbon::createFromTime(23, 59, 59);
                                                                            $timeSlots = [];

                                                                            $currentTime = clone $startTime;
                                                                            while ($currentTime->lte($endTime)) {
                                                                                $endTimeSlot = clone $currentTime;
                                                                                $endTimeSlot->addMinutes($minutesPerPackage);

                                                                                // Check if the time slot is in the past
                                                                                if ($endTimeSlot->isFuture()) {
                                                                                    $timeSlots[] = [
                                                                                        'start' => $currentTime->format('g:i A'),
                                                                                        'end' => $endTimeSlot->format('g:i A'),
                                                                                    ];
                                                                                }

                                                                                $currentTime->addMinutes($minutesPerPackage);
                                                                            }
                                                                            // Calculate the available and unavailable time slots
                                                                            $availableSlots = [];
                                                                            $unavailableSlots = [];

                                                                            $prevEndTime = $startTime;
                                                                            foreach ($reservations as $reservation) {
                                                                                $start = Carbon\Carbon::parse($reservation->date);
                                                                                $end = Carbon\Carbon::parse($reservation->end);

                                                                                if ($prevEndTime->lt($start)) {
                                                                                    $availableSlots[] = [
                                                                                        'start' => $prevEndTime->format('g:i A'),
                                                                                        'end' => $start->format('g:i A'),
                                                                                    ];
                                                                                }
                                                                                $unavailableSlots[] = [
                                                                                    'start' => $start->format('g:i A'),
                                                                                    'end' => $end->format('g:i A'),
                                                                                ];

                                                                                $prevEndTime = $end;
                                                                            }
                                                                            if ($prevEndTime->lt($endTime)) {
                                                                                $availableSlots[] = [
                                                                                    'start' => $prevEndTime->format('g:i A'),
                                                                                    'end' => $endTime->format('g:i A'),
                                                                                ];
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    @foreach ($timeSlots as $slot)
                                                                        @php
                                                                            $slotClosed = false;
                                                                            foreach ($unavailableSlots as $unavailableSlot) {
                                                                                if ($slot['start'] === $unavailableSlot['start'] && $slot['end'] === $unavailableSlot['end']) {
                                                                                    $slotClosed = true;
                                                                                    break;
                                                                                }
                                                                            }
                                                                        @endphp
                                                                        <li
                                                                            class="list-group-item d-flex justify-content-between align-items-start">
                                                                            <div
                                                                                class="rev-item d-flex w-100 align-items-start">

                                                                                @if ($slotClosed)
                                                                                @else
                                                                                    <div class="rev-time text-center">
                                                                                        <span>{{ $slot['start'] }}</span>
                                                                                        <br>
                                                                                        <span>{{ $slot['end'] }}</span>
                                                                                    </div>
                                                                                @endif
                                                                                <div class="rev-info">
                                                                                    <a href="{{ route('branch.reservation') }}"
                                                                                        class="btn btn-primary">احجز
                                                                                        الآن</a>
                                                                                </div>
                                                                                <div class="rev-statu text-center">
                                                                                    <p>VVIP-1</p>
                                                                                    <span>شاغرة</span>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    @endforeach

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
                                                                                <a class="btn btn-primary">تفعيل</a>
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

                                                <div class="table-side-bar side-bar-orders"
                                                    id="tableorders{{ $tables->id }}">
                                                    <div class="tablebrowse">
                                                        <div class="tab-nav-wraper">
                                                            <div
                                                                class="nav-btns d-flex justify-content-around align-items-center">
                                                                <div class="btn btn-dark" data-tab="newOrders">
                                                                    الطلبات</div>
                                                                <a href="{{ route('productOrder.ajax', [$tables->id]) }}"
                                                                    class="btn btn-primary  mb-1"> طلب
                                                                    جديد</a>
                                                            </div>
                                                        </div>
                                                        <!-- عناصر التاب -->
                                                        <div class="side-tab-content">
                                                            <div id="rev"
                                                                class="table-bar-info reversation-side-bar rev active-tab">
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
                                                                <div id="tab1" class="tab-pane fade show active">
                                                                    <ol
                                                                        class="table-list list-group list-group-numbered reversed food-items pr-0">
                                                                        @if ($orders != null && $orders->products->count() != 0)
                                                                            @foreach ($orders->products as $product)
                                                                                <li class="list-group-item drag d-flex justify-content-between align-items-start"
                                                                                    draggable="true">
                                                                                    <div class="me-2 ms-auto">
                                                                                        <div class="fw-bold">
                                                                                            <span class="title">
                                                                                                {{ $product->name }}</span><span
                                                                                                class="count-wrap mr-2"><i
                                                                                                    class="fa-solid fa-x"></i><span
                                                                                                    class="count">{{ $product->pivot->quantity }}</span></span>
                                                                                        </div>
                                                                                    </div><span
                                                                                        class="list-price">{{ $product->pivot->price * $product->pivot->quantity }}
                                                                                        ريال</span><button
                                                                                        class="order-remove btn btn-danger"
                                                                                        type="button"><i
                                                                                            class="fa-solid fa-trash-can"></i></button>
                                                                                </li>
                                                                            @endforeach
                                                                        @endif
                                                                    </ol>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
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


    <div class="col-md-3" id="casher-section">
        <div class="side-place">
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('front/js/jquery.js') }}"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('crudjs/crud.js') }}"></script>
    <script src="{{ asset('front/js/main.js') }}"></script>
    <script>
        function updateCountdown() {
            // Get all the countdown-timer elements
            const countdownTimers = document.querySelectorAll('.countdown-timer');

            countdownTimers.forEach(countdownTimer => {
                const countdownTimerText = countdownTimer.querySelector('.countdown-timer-text');

                // Get the data-start and data-package-time values from the data attributes
                const startTimeString = countdownTimer.getAttribute('data-start');
                const packageTime = parseInt(countdownTimer.getAttribute('data-package-time'));
                console.log(startTimeString);
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
                $('#hal').html(data); // Show the new content

            }).done(function() {
                $('#casher-section').show(); // Hide the casher section

                $('#reserv-main-section').hide(); // Show the reserv main section

            });
        }
    </script>
    <script>
        function activeTable(id) {
            let formData = new FormData();
            storepart('/branch/active/table/' + id, formData)
            location.reload()
            $('#exampleModal_' + id).modal('hide');

            // $('#mainPage').empty(); // Clear the previous page content
            $.get('/branch/branch/halls', {}).done(function(data) {
                $('#mainPage').html(data); // Show the new content
            }).done(function() {
                $('#casher-section').show(); // Hide the casher section
                $('#reserv-main-section').hide();
                $('#reservSideContainer').hide(); // Show the reserv main section
            });

        }

        function closeTable(id) {
            let formData = new FormData();
            storepart('/branch/close/table/' + id, formData)
            location.reload()
            // $('#mainPage').empty(); // Clear the previous page content
            $.get('/branch/branch/halls', {}).done(function(data) {
                $('#mainPage').html(data); // Show the new content
            }).done(function() {
                $('#casher-section').show(); // Hide the casher section
                $('#reserv-main-section').hide();
                $('#reservSideContainer').hide(); // Show the reserv main section
            });
        }
    </script>

    <script>
        $(document).ready(function() {

            $('.forceclosing').on('click', function() {
                $('.modal-backdrop.show').hide();
            });

            $('.rev-close').on('click', function() {
                $('.modal-backdrop.show').hide();

            });



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

            $('.salon-table-tabs .nav-link').on('click', function() {
                console.log('ghghghgh');
                $('.salon-table-tabs .nav-link').removeClass('active');
                $(this).addClass('active');
                $('.salon-table-tabs-content').removeClass('active');
                var salonKey = $(this).data('salontab');
                $(salonKey).addClass('active')
            });

        });
    </script>
@endsection
