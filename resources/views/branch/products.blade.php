<div id="mainPage">
    <div class="row">
    <div class="col-md-9">

        <div class="seacr-bar mb-5">
            <form class="d-flex search " role="search">
                <input class="form-control" type="search" aria-label="Search">
                <button class="btn search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
        <div class="menu-category-wrap d-flex mb-4">
            <div class="voka-slider">
                @foreach ($products as $key => $item)
                            <div class="item">
                                <div class="cat-tap card mb-3 @if ($key == 0) active-card @endif"
                                data-class="cat{{ $item->category_id }}" style="max-width: 540px;">
                                    <div class="row g-0">
                                      <div class="col-md-4 d-flex align-items-center justify-content-center">
                                        <img src="{{ $item->getFirstMediaUrl('category_image', 'thumb') }}" class="img-fluid rounded-start" alt="...">
                                      </div>
                                      <div class="col-md-8">
                                        <div class="card-body">
                                          <h5 class="card-title">{{ $item->category_name }}</h5>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                @endforeach
                </div>
        </div>
        {{-- <div class="col-md-2">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fa-solid fa-arrow-left"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="card cat-tap mb-3" style="max-width: 540px;">
                                        <div class="row g-0">
                                            <div class="col-md-4 d-flex align-items-center justify-content-center">
                                                <img src="images/soup.png" class="img-fluid rounded-start"
                                                    alt="...">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title">الشربة</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="card cat-tap mb-3" style="max-width: 540px;">
                                        <div class="row g-0">
                                            <div class="col-md-4 d-flex align-items-center justify-content-center">
                                                <img src="images/checkien.png" class="img-fluid rounded-start"
                                                    alt="...">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title">دجاج</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="card cat-tap mb-3" style="max-width: 540px;">
                                        <div class="row g-0">
                                            <div class="col-md-4 d-flex align-items-center justify-content-center">
                                                <img src="images/bizza.png" class="img-fluid rounded-start"
                                                    alt="...">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title">بيتزا</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div> --}}
        @foreach ($products as $item)
            <div class="all-items cat{{ $item->category_id }}">
                <div class="row menu-items my-4">
                    @foreach ($item->Product as $product)
                        <div class="col-md-3  d-flex justify-content-center align-items-center">
                            <div class="card" style="width: 18rem;">
                                <div class="menu-item-img">
                                    <img src="{{ $product->getFirstMediaUrl('product', 'thumb') }}" class="card-img-top"
                                        alt="...">
                                </div>
                                <div class="card-body">
                                    <header>
                                        <h5 class="card-title mb-2">{{ $product->name }}</h5>
                                        <p class="price">{{ $product->price }}$</p>
                                    </header>
                                    <footer>
                                        <i class="fa-solid fa-minus"></i>
                                        <span class="number mx-3">0</span>
                                        <i class="fa-solid fa-plus"></i>
                                    </footer>
                                    <div class="addBtn btn btn-primary btn-lg w-100 mt-3">أضف</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

    </div>
    <!--<div class="col-md-3">-->
    <!--              <h2 class="text-center mb-4">طاولة رقم 1</h2>-->
    <!--                   عناصر التاب -->
    <!--                  <div class="tab-content">-->
    <!--                    <div id="tab1" class="tab-pane fade show active">-->
    <!--                        <ol class="table-list list-group list-group-numbered reversed">-->
    <!--                            <li class="menu-info-list list-group-item d-flex justify-content-center align-items-center text-center">-->
    <!--                                <p>لا يوجد عناصر</p>-->
    <!--                            </li>-->

    <!--                          </ol>-->
    <!--                          <ol class="list-group reversed  mt-5">-->
    <!--                            <li class="list-group-item no-number  ">-->
    <!--                                <div class="sub-total d-flex justify-content-between align-items-start">-->
    <!--                                    <div class="me-2 ms-auto">-->
    <!--                                        <div class="fw-bold"> حاصل الجمع</div>-->
    <!--                                      </div>-->
    <!--                                      <span class="sub-total-number"> 260 </span>-->
    <!--                                      <span> ريال</span>-->
    <!--                                </div>-->

    <!--                                <div class="tax d-flex justify-content-between align-items-start mt-4">-->
    <!--                                    <div class="me-2 ms-auto">-->
    <!--                                        <div class="fw-bold"> ضريبة</div>-->
    <!--                                      </div>-->
    <!--                                      <span class="taxes">10%</span>-->
    <!--                                </div>-->
    <!--                                <div class="tax d-flex justify-content-between align-items-start mt-4 total">-->
    <!--                                    <div class="me-2 ms-auto">-->
    <!--                                        <div class="fw-bold"> الإجمالى</div>-->
    <!--                                      </div>-->
    <!--                                      <span class="table-total">286 </span>-->
    <!--                                      <span> ريال</span>-->
    <!--                                </div>-->
    <!--                                <div class="payment-method">-->
    <!--                                    <div class="row">-->
    <!--                                        <div class="col-4">-->
    <!--                                            <div class="payment-icon active d-flex justify-content-center align-items-center">-->
    <!--                                                <i class="fa-solid fa-sack-dollar"></i>-->
    <!--                                            </div>-->
    <!--                                            <p class="text-center">كاش</p>-->
    <!--                                        </div>-->
    <!--                                        <div class="col-4">-->
    <!--                                          <div class="payment-icon d-flex justify-content-center align-items-center">-->
    <!--                                            <i class="fa-solid fa-credit-card"></i>-->
    <!--                                          </div>-->
    <!--                                          <p class="text-center">بطاقة  ائتمان</p>-->
    <!--                                      </div>-->
    <!--                                      <div class="col-4">-->
    <!--                                        <div class="payment-icon d-flex justify-content-center align-items-center">-->
    <!--                                          <i class="fa-solid fa-wallet"></i>-->
    <!--                                        </div>-->
    <!--                                        <p class="text-center">المحفظة</p>-->
    <!--                                    </div>-->
    <!--                                    </div>-->
    <!--                                    <div class="payment-btn my-3 text-center">-->
    <!--                                        <div class="btn btn-primary btn-lg w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">ادفع الآن</div>-->
    <!--                                         Modal -->
    <!--                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
    <!--                                          <div class="modal-dialog">-->
    <!--                                            <div class="modal-content">-->
    <!--                                              <div class="modal-header">-->
    <!--                                                <h5 class="modal-title" id="exampleModalLabel">تأكيد الدفع</h5>-->
    <!--                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
    <!--                                              </div>-->
    <!--                                              <div class="modal-body">-->
    <!--                                                <p class="consfirm-text">هل تريد تأكيد الدفع</p>-->
    <!--                                              </div>-->
    <!--                                              <div class="modal-footer">-->
    <!--                                                <button type="button" class="btn btn-primary">تأكيد</button>-->
    <!--                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لا </button>-->
    <!--                                              </div>-->
    <!--                                            </div>-->
    <!--                                          </div>-->
    <!--                                        </div>-->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                              </li>-->



    <!--                          </ol>-->

    <!--                    </div>-->
    <!--                  </div>-->
    <!--                </div>-->
    </div>
                    </div>
                </div>
</div>
<script src="{{ asset('front/js/jquery.js') }}"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="{{ asset('front/js/main.js') }}"></script>

