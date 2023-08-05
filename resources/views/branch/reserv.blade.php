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
   <div id="mainPage">
       <div class="container mt-5">
           <div id="calendar">
           </div>
       </div>
   </div>
   <meta name="csrf-token" content="{{ csrf_token() }}" />
   @csrf
   <!-- FullCalendar CSS -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet" />
   <link rel="stylesheet" type="text/css"
       href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.print.css" media="print">

   <!-- jQuery -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

   <!-- Moment.js -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

   <!-- FullCalendar JavaScript -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

   <script src="{{ asset('front/js/jquery.js') }}"></script>
   <script src="https://unpkg.com/@popperjs/core@2"></script>
   <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js"
       integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous">
   </script>
   <script src="{{ asset('front/js/date.js') }}"></script>
   <script src="{{ asset('front/js/bootstrap-clockpicker.min.js') }}"></script>
   <script src="{{ asset('front/js/main.js') }}"></script>
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

       });
   </script>
