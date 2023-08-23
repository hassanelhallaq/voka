<div class="row" style="margin-bottom:50px; margin-top:50px">
    <div class="col-lg-12 time-slots">
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
            @if ($slotClosed)
                <div class="btn btn-lg btn-danger time-slot btn-clock"
                    data-choos="{{ $slot['start'] }} - {{ $slot['end'] }}" data-id="#pay" disabled>
                    {{ $slot['start'] }} - {{ $slot['end'] }}
                </div>
            @else
                <div class="btn btn-lg btn-success time-slot change-content btn-clock"
                    data-choos="{{ $slot['start'] }} - {{ $slot['end'] }}" data-id="#pay">
                    {{ $slot['start'] }} - {{ $slot['end'] }}
                </div>
            @endif
        @endforeach
    </div>

</div>
<!--<div class="row">-->
<!--    <div class="col-md-2">-->
<!--        <div class="change-content btn btn-primary" data-id="#allguests">السابق</div>-->
<!--    </div>-->
<!--    <div class="col-md-8"></div>-->
<!--    <div class="col-md-2">-->
<!--        <button class="change-content btn btn-primary" data-id="#pay">تقدم-->
<!--            للدفع</button>-->
<!--    </div>-->
<!--</div>-->
<script src="{{ asset('front/js/main.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.time-slot').on('click', function() {
            var showenId = $(this).data('id');
            $('.reservation-tabs').hide();
            $(showenId).show();
            var forDataV = $(this).html();
            $('.reserv-time').html(forDataV);
            console.log(forDataV);
        });
    });
</script>
