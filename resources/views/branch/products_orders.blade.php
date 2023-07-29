<div id="mainPage-menu" class="menu-items-selector">

    <div class="col-md-12">

        <div class="seacr-bar mb-5">
            <form class="d-flex search " role="search">
                <input class="form-control" type="search" aria-label="Search">
                <button class="btn search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>

        
        <div class="row">
        <div class="col-md-9">
            <div class="menu-category-wrap d-flex mb-4">

            <input value="{{ $table->id }}" id="table_id" hidden>
            <input value="{{ $table->reservation->package_id }}" id="package_id" hidden>
            <input value="{{ $table->reservation->client_id }}" id="client_id" hidden>

            <div class="voka-slider">
                @foreach ($products as $key => $item)
                    <div class="item">
                        <div class="cat-tap card mb-3 @if ($key == 0) active-card @endif"
                            data-class="cat{{ $item->category_id }}" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-4 d-flex align-items-center justify-content-center">
                                    <img src="{{ $item->getFirstMediaUrl('category_image', 'thumb') }}"
                                        class="img-fluid rounded-start" alt="...">
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
            @foreach ($products as $item)
                <div class="all-items cat{{ $item->category_id }}">
                    <div class="row menu-items my-4">
                        @foreach ($item->Product as $product)
                            <div class="col-md-3  d-flex justify-content-center align-items-center">
                                <div class="card" style="width: 18rem;">
                                    <div class="menu-item-img">
                                        <img src="{{ $product->getFirstMediaUrl('product', 'thumb') }}"
                                            class="card-img-top" alt="...">
                                    </div>
                                    <div class="card-body">
                                        <header>
                                            <h5 class="card-title mb-2">{{ $product->name }}</h5>
                                            <p class="price">{{ $product->price }}$</p>
                                        </header>
                                        <footer>
                                            <i class="fa-solid fa-minus"></i>
                                            <span id="number_{{ $product->product_id }}" class="number mx-3">0</span>
                                            <i class="fa-solid fa-plus"></i>
                                        </footer>
                                        <div id="testAdd" class="addBtn btn btn-primary btn-lg w-100 mt-3"
                                            onclick="storeProduct({{ $product->product_id }})">
                                            أضف
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-3">
                  <h2 class="text-center mb-4">طاولة رقم 1</h2>
                      <!-- عناصر التاب -->
                      <div class="tab-content">
                        <div id="tab1" class="tab-pane fade show active">
                            <ol class="table-list list-group list-group-numbered reversed">
                                <li class="menu-info-list list-group-item d-flex justify-content-center align-items-center text-center">
                                    <p>لا يوجد عناصر</p>
                                </li>

                              </ol>
                              <ol class="list-group reversed  mt-5">
                                <li class="list-group-item no-number  ">
                                    <div class="sub-total d-flex justify-content-between align-items-start">
                                        <div class="me-2 ms-auto">
                                            <div class="fw-bold"> حاصل الجمع</div>
                                          </div>
                                          <span class="sub-total-number"> 260 </span>
                                          <span> ريال</span>
                                    </div>

                                    <div class="tax d-flex justify-content-between align-items-start mt-4">
                                        <div class="me-2 ms-auto">
                                            <div class="fw-bold"> ضريبة</div>
                                          </div>
                                          <span class="taxes">10%</span>
                                    </div>
                                    <div class="tax d-flex justify-content-between align-items-start mt-4 total">
                                        <div class="me-2 ms-auto">
                                            <div class="fw-bold"> الإجمالى</div>
                                          </div>
                                          <span class="table-total">286 </span>
                                          <span> ريال</span>
                                    </div>
                                    <div class="payment-method">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="payment-icon active d-flex justify-content-center align-items-center">
                                                    <i class="fa-solid fa-sack-dollar"></i>
                                                </div>
                                                <p class="text-center">كاش</p>
                                            </div>
                                            <div class="col-4">
                                              <div class="payment-icon d-flex justify-content-center align-items-center">
                                                <i class="fa-solid fa-credit-card"></i>
                                              </div>
                                              <p class="text-center">بطاقة  ائتمان</p>
                                          </div>
                                          <div class="col-4">
                                            <div class="payment-icon d-flex justify-content-center align-items-center">
                                              <i class="fa-solid fa-wallet"></i>
                                            </div>
                                            <p class="text-center">المحفظة</p>
                                        </div>
                                        </div>
                                        <div class="payment-btn my-3 text-center">
                                            <div class="btn btn-primary btn-lg w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">ادفع الآن</div>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">تأكيد الدفع</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <p class="consfirm-text">هل تريد تأكيد الدفع</p>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary">تأكيد</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لا </button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                  </li>



                              </ol>

                        </div>
                      </div>
                    </div>
                    </div>
                    </div>
                </div>




    </div>


</div>
<script src="{{ asset('front/js/jquery.js') }}"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{ asset('crudjs/crud.js') }}"></script>
<script src="{{ asset('front/js/main.js') }}"></script>
<script>
    // Function to store product information
    function storeProduct(id) {

        let formData = new FormData();
        formData.append('table_id', document.getElementById('table_id').value);
        formData.append('product_id', id);
        formData.append('package_id', document.getElementById('package_id').value);

        formData.append('client_id', document.getElementById('client_id').value);

        // Get the quantity value from the element with class name 'number'
        let quantityText = document.getElementById("number_" + id).textContent;


        // let boxItemOrder = document.getElementById("boxItemOrder");
        // boxItemOrder.style.visibility = "visible";

        // let quantityText = $('.number').text().replace(/,/g, ''); // Remove commas from the text
        let quantity = parseInt(quantityText);

        formData.append('quantity', quantity);

        // Call the 'store' function to handle the form data submission
        store('order-product/store', formData);


    }
</script>
<!--<script>
    -- >
    <
    !--
    let testAdd = document.getElementById("testAdd");
    -- >
    <
    !--testAdd.addEventListener("mouseover", function() {
        -- >
        <
        !--
        let boxItemOrder = document.getElementById("boxItemOrder");
        -- >
        <
        !--boxItemOrder.style.display = "block";
        -- >
        <
        !--
    });
    -- >
    <
    !--
</script>-->
