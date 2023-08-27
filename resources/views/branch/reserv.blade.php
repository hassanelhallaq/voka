@extends('branch.parent')
@section('contentFront')
    <style>
        .fc-day-number {
            color: #fff;
        }

        .fc-widget-header thead tr {
            color: #fff;
            font-size: 20px;
        }

        tbody td {
            border-radius: 0;
        }

        .fc-unthemed td.fc-today .fc-day-number {
            color: #fff;
        }

        .fc-state-active,
        .fc-state-disabled,
        .fc-state-down,
        .fc-state-top,
        .fc-state-hover {
            color: #fff !important;
            background-color: #e5772a !important;
        }

        .fc-state-hover {
            background-position: 0 2.1em !important;
        }

        tbody td:hover {
            border: 1px solid #ddd;
        }

        .fc-unthemed td.fc-today {
            background-color: #e5772a !important;
        }

        tbody tr {
            color: #fff;
        }

        .fc-event,
        .fc-event-dot {
            background-color: #d59161 !important;
        }
    </style>
    <div id="mainPage" class="reves-main">
        <div class="container mt-5">
            <div id="calendar">
            </div>
        </div>
    </div>
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

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @csrf
@endsection
@section('js')
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.4/fullcalendar.print.css" rel="stylesheet" type="text/css"
        media="print" />
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var calendar = $('#calendar').fullCalendar({
                editable: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay',
                },
                events: "{{ route('ajaxCalender') }}",
                selectable: true,
                selectHelper: true,
                firstDay: 0,
                eventClick: function(event) {
                    $.get('/branch/path/to/branch.reservSide', {
                        id: event.id,
                    }).done(function(data) {
                        $('#reservSideContainer').html(data); // Show the new content
                        $('#reservSideContainer #reservSideContainer').css("width", "100%");
                    });
                },

            });

            $('#mainPage').removeClass('col-md-11').addClass('col-md-8');

        });
    </script>
@endsection
