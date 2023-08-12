    @extends('menu.parent')
    @section('content')
        <div class="subheader dark-overlay dark-overlay-2"
            style="background-image: url({{ $product->getFirstMediaUrl('product', 'thumb') }})">
            <div class="container">
                <div>
                    <h1 style="text-align: center;">{{ $product->name }}</h1>
                </div>

            </div>
        </div>
        <!-- Subheader End -->

        <div class="section product-single">
            <div class="container">

                <div class="row">
                    <div class="col-md-5">

                        <!-- Main Thumb -->
                        <div class="product-thumb">
                            <img src="{{ $product->getFirstMediaUrl('product', 'thumb') }}" alt="{{ $product->name }}">
                        </div>
                        <!-- /Main Thumb -->

                    </div>
                    <div class="col-md-7">
                        <div class="product-content">

                            <!-- Product Title -->
                            <h2 class="title">{{ $product->name }}</h2>
                            <!-- /Product Title -->

                            <div class="favorite">
                                <i class="far fa-heart"></i>
                            </div>


                            <!-- Price -->
                            <div class="price-wrapper">
                                <p class="product-price">{{ $product->price }} ريال</p>
                            </div>
                            <!-- /Price -->

                            <!-- Product Short Description -->
                            <p> {{ $product->description }}</p>
                            <!-- /Product Short Description -->

                            <!-- Add To Cart Form -->
                            <form class="atc-form" id="add-to-cart-form">
                                <div class="form-group">
                                    <label>الكمية</label>
                                    <div class="qty">
                                        <span class="qty-subtract"><i class="fas fa-minus"></i></span>
                                        <input type="number" name="qty" value="1" class="qty-input"
                                            min="1">
                                        <span class="qty-add"><i class="fas fa-plus"></i></span>
                                    </div>
                                </div>
                                <a href="#" class="اطلب-item btn-custom btn-sm shadow-none"
                                    data-product='{"name": "{{ $product->name }}", "price": "{{ $product->price }}", "image": "{{ $product->getFirstMediaUrl('product', 'thumb') }}"}'>
                                    أضف إلى الطلب <i class="fas fa-shopping-cart"></i>
                                </a>
                            </form>

                            <!-- /Add To Cart Form -->

                            <!-- Product Meta -->
                            {{-- <ul class="product-meta">
                                <li>
                                    <span>الأصناف: </span>
                                    <div class="product-meta-item">
                                        <a href="#">Pizza</a>
                                    </div>
                                </li>
                                <li>
                                    <span>Tags: </span>
                                    <div class="product-meta-item">
                                        <a href="#">Pizza</a>,
                                        <a href="#">Cheese</a>,
                                        <a href="#">Cheesy Crusts</a>
                                    </div>
                                </li>
                                <li>
                                    <span>SKU: </span>
                                    <div class="product-meta-item">
                                        <span>N/A</span>
                                    </div>
                                </li>
                            </ul> --}}
                            <!-- /Product Meta -->

                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endsection
    @section('js')
        <script>
            function getCartItemCount() {
                let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
                let totalItems = cartItems.reduce((acc, item) => acc + item.quantity, 0);
                return totalItems;
            }

            // Function to update the cart item count display
            function updateCartItemCount() {
                const cartItemCountElement = document.getElementById('cart-item-count');
                const cartItemCount = getCartItemCount();
                cartItemCountElement.innerText = cartItemCount;
            }
            // Function to handle adding items to the cart
            function addToCart(item, quantity) {
                // Get existing cart items from local storage
                let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

                // Check if the item is already in the cart
                const existingItem = cartItems.find((cartItem) => cartItem.name === item.name);

                if (existingItem) {
                    // Item already in the cart, update its quantity or other details if needed
                    existingItem.quantity += quantity;
                } else {
                    // Item not in the cart, add it with the selected quantity
                    cartItems.push({
                        ...item,
                        quantity: quantity
                    });
                }

                // Save the updated cart items back to local storage
                localStorage.setItem('cartItems', JSON.stringify(cartItems));
                updateCartItemCount();

            }

            // Add event listener to the "اطلب-item" button
            const addToCartButtons = document.querySelectorAll('.اطلب-item');
            addToCartButtons.forEach((button) => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();

                    // Get the product details from the data attribute
                    const product = JSON.parse(this.getAttribute('data-product'));

                    // Get the quantity input value
                    const quantityInput = this.closest('.atc-form').querySelector('.qty-input');
                    const quantity = parseInt(quantityInput.value, 10);

                    addToCart(product, quantity);
                    // alert('Item added to cart!');
                     Swal.fire(
                      'تم إضافة المنتج إلى السلة!',
                      'حسناَ'
                    )
                });
            });

            document.addEventListener('DOMContentLoaded', updateCartItemCount);
        </script>
    @endsection
