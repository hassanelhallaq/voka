<div class="card-header card-header-danger">
    <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
    <div class="nav-tabs-navigation">
        <div class="nav-tabs-wrapper">
            <ul class="nav nav-tabs" data-tabs="tabs">
                @foreach ($halles as $key => $item)
                    <li class="nav-item">
                        <a class="nav-link {{ $key === 0 ? ' active' : '' }}" href="#hall{{ $item->id }}"
                            data-toggle="tab">{{ $item->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<div class="card-body ">
    <div class="tab-content text-center">
        @foreach ($halles as $key => $item)
            <div class="tab-pane {{ $key === 0 ? ' active show' : '' }}" id="hall{{ $item->id }}">
                <div class="row new-reservation-tables">
                    <h2 class="text-center text-light">{{ $item->name }}</h2>
                    <div class="col-12">
                        <div class="row">
                            @foreach ($item->tables as $table)
                                <div class="col-md-3 card-col  d-flex justify-content-center align-items-center ">
                                    <div class="change-content table-pick card catch-id  bg-success active-card"
                                        data-id="#allguests" data-choosen="{{ $table->id }}">
                                        <input hidden value="{{ $table->id }}">
                                        <div class="card-header primary-bg-color">
                                            <div class="top d-flex justify-content-between ">
                                                <h5 class="card-title"> طاولة رقم
                                                    {{ $table->name }}</h5>
                                                <span class="no-revers">
                                                    @if ($table->status == 'in_service')
                                                        فى الخدمة
                                                    @elseif($table->status == 'available')
                                                        متاحة
                                                    @elseif ($table->status == 'reserved')
                                                        محجوزة
                                                    @endif
                                                </span>
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
                                                <p class="hall-name"> باقة 3 ساعات</p>
                                                <span class="sta"> 2 اشخاص</span>
                                            </div>
                                            <div class="body-time d-flex justify-content-between">
                                                <p class="hall-name"> لا يوجد تاريخ</p>
                                                <span class="sta"> لا يوجد توقيت </span>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <p class="hall-name">لا يوجد رصيد</p>
                                            <span class="sta"> لا يوجد رصيد متبقى </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="row">
    <div class="col-md-2">
        <div class="change-content  btn btn-primary" data-id="#all-packages">السابق</div>
    </div>
    <div class="col-md-8"></div>
    <!--<div class="col-md-2">-->
    <!--    <div class="change-content btn btn-primary" data-id="#allguests">التالى</div>-->
    <!--</div>-->
</div>
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
