<div class="col-md-3 mt-5" id="reservSideContainer">
    <h2 class="text-center mb-5">بيانات الحجز</h2>
    <ol class="list-group list-group-numbered reservations-list">
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="me-2 ms-auto">a
                <div class="fw-bold"> رقم الطاولة</div>
            </div>
            <span class="reservations-table-nmber">{{ $reservation->table->name ?? '' }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="me-2 ms-auto">
                <div class="fw-bold"> الاسم</div>
            </div>
            <span class="guest-name">{{ $reservation->client->name ?? '' }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="me-2 ms-auto">
                <div class="fw-bold">الضيوف</div>
            </div>
            <span class="guest-number">...</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="me-2 ms-auto">
                <div class="fw-bold"> رقم الهاتف</div>
            </div>
            <span class="reservations-phone">{{ $reservation->client->phone ?? '' }} </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="me-2 ms-auto">
                <div class="fw-bold"> الباقة</div>
            </div>
            <span class="reservations-package">{{ $reservation->package->name ?? '' }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="me-2 ms-auto">
                <div class="fw-bold"> الحالة</div>
            </div>
            <span class="reservations-statue">... </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="me-2 ms-auto">
                <div class="fw-bold"> الرصيد</div>
            </div>
            <span class="reservations-points">{{ $reservation->package->price ?? '' }}</span>
        </li>
        <li class="show-table-li list-group-item d-flex justify-content-center align-items-start ">
            <a href="menu.html" class="me-2 btn btn-secondary w-100">
                <div class="fw-bold" data-tableId="1"> عرض الطاولة</div>
            </a>
        </li>

    </ol>
</div>
