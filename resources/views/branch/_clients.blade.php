    @foreach ($clients as $client)
        <div class="col-12 col-md-4">

            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-3">
                        <img src="{{ asset('front/images/avatar.png') }}" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-9">
                        <div class="card-body text-right">
                            <h5 class="card-title">{{ $client->name }}</h5>
                            <h4 class="card-text">
                                <a class="tel" href="tel:+966545255177">{{ $client->phone }}</a>
                            </h4>
                            <div class="card-text">

                            </div>
                        </div>
                    </div>
                    <div class="row pb-4">
                        <div class="col-4">
                            <div class="upcoming d-flex flex-column text-center ">
                                <span class="number">3</span>
                                <span class="key">حجوزات</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="upcoming d-flex flex-column text-center ">
                                <span class="number">15</span>
                                <span class="key">زيارة</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="upcoming d-flex flex-column text-center ">
                                <span class="number">عمليات دفع</span>
                                <span class="key">1,300 $</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('crudjs/crud.js') }}"></script>
