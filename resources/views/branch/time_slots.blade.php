<div class="row" style="margin-bottom:50px; margin-top:50px">
    <div class="col-lg-12">
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
                <button class="btn btn-lg btn-danger btn-clock" disabled>{{ $slot['start'] }} -
                    {{ $slot['end'] }}</button>
            @else
                <button class="btn btn-lg btn-success btn-clock">{{ $slot['start'] }} -
                    {{ $slot['end'] }}</button>
            @endif
        @endforeach
    </div>
</div>
<div class="row">
    <div class="col-md-2">
        <div class="change-content btn btn-primary" data-id="#allguests">السابق</div>
    </div>
    <div class="col-md-8"></div>
    <div class="col-md-2">
        <button class="change-content btn btn-primary" data-id="#pay">تقدم
            للدفع</button>
    </div>
</div>
