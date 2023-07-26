<div id="mainPage">
    <div class="col-md-12">

        <div class="seacr-bar mb-5">
            <form class="d-flex search " role="search">
                <input class="form-control" type="search" aria-label="Search">
                <button class="btn search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
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
                                        <span id="number" class="number mx-3">0</span>
                                        <i class="fa-solid fa-plus"></i>
                                    </footer>
                                    <div class="addBtn btn btn-primary btn-lg w-100 mt-3"
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
         let quantityText = document.getElementById("number").textContent;
         
        // let quantityText = $('.number').text().replace(/,/g, ''); // Remove commas from the text
        let quantity = parseInt(quantityText);
        
        formData.append('quantity', quantity);
        
        // Call the 'store' function to handle the form data submission
        store('order-product/store', formData);
        
    }
</script>
