   <!-- Search form -->
    <form class="form-inline d-flex justify-content-center md-form form-sm mt-5">
      
      <input class="form-control form-control-sm  ml-3 w-75" type="text" placeholder="بحث عن ضيف"
        aria-label="Search">
        <i class="fas fa-search" aria-hidden="true"></i>
    </form>
    @foreach ($clients as $client)
        <div class="col-12 col-md-4">

            <div class="card catch-id mb-3 change-content btn" data-id="#alltime" id="guest-input" data-choosen="{{ $client->id }}">
                <div class="row g-0">
                    <div class="col-md-3">
                        <img src="{{ asset('front/images/avatar.png') }}" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-9">
                        <div class="card-body text-right">
                            <h5 class="card-title">{{ $client->name }}</h5>
                            <input hidden id="client_id" value="{{ $client->id }}">
                            <h4 class="card-text">
                                <a class="tel" href="tel:+966545255177">{{ $client->phone }}</a>
                            </h4>
                            <div class="card-text">

                            </div>
                        </div>
                    </div>
                    <!--<div class="row pb-4">-->
                    <!--    <div class="col-4">-->
                    <!--        <div class="upcoming d-flex flex-column text-center ">-->
                    <!--            <span class="number">3</span>-->
                    <!--            <span class="key">حجوزات</span>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--    <div class="col-4">-->
                    <!--        <div class="upcoming d-flex flex-column text-center ">-->
                    <!--            <span class="number">15</span>-->
                    <!--            <span class="key">زيارة</span>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--    <div class="col-4">-->
                    <!--        <div class="upcoming d-flex flex-column text-center ">-->
                    <!--            <span class="number">عمليات دفع</span>-->
                    <!--            <span class="key">1,300 $</span>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>
            </div>
        </div>
    @endforeach
    <script src="{{ asset('front/js/jquery.js') }}"></script>

     <script src="{{ asset('front/js/main.js') }}"></script>
