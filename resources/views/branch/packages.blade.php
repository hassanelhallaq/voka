<div id="mainPage">
    <div class="col-md-12">
        <div class="reservation-tabs  py-5" id="all-packages">
            <div class="container  py-5">
                <div class="row py-5">
                    <!--<div class="col-md-2"></div>-->
                    @foreach ($packages as $item)
                        <div class="col-md-4">
                            <div class="card btn-dark  text-center" data-choosen="{{ $item->id }}">
                                <div class="card-body">
                                    <h2 class="card-title">{{ $item->name }}</h2>
                                    <p class="card-text package-text mt-2">باقة {{ $item->time }}
                                        ساعة مع
                                        {{ $item->price }} نقطة رصيد</p>
                                    {{-- <div class="choos-btn btn btn-primary mt-4">
                                        <input type="radio" value="{{ $item->id }}" id="package_id" name="package"
                                            onclick="pack({{ $item->id }})">
                                        <label for="package_id">اختر الباقة</label>

                                    </div> --}}

                                </div>
                                {{-- <div class="card-footer btn-dark text-light text-body-secondary">
                                    الباقة الأولى
                                </div> --}}
                            </div>
                        </div>
                    @endforeach
                    <!--<div class="col-md-2"></div>-->
                </div>
            </div>
        </div>
    </div>
</div>
