    @extends('menu.parent')
    @section('content')
        <!-- Header End -->

        <!-- Subheader Start -->
        <div class="subheader dark-overlay dark-overlay-2" style="background-image: url('assets/img/cover.jpg')">
            <div class="container">
                <div class="header-details">
                    <!--<h1 style="text-align: center;">فرع {{ $branch->name }}</h1>-->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb"
                            style="background-color: transparent; justify-content: space-between; align-items: end;">
                            <div class="breadcrumb-item">
                                <h4 class="tableDetails">رصيد الطاولة: <span>{{ $reservation->package->price }}</span></h4>
                            </div>
                            <div class="breadcrumb-item">
                                <h4 class="tableDetails">رقم الطاولة: <span>{{ $table->name }}</span></h4>
                            </div>

                        </ol>
                    </nav>
                </div>

            </div>
        </div>
        <!-- Subheader End -->

        <!-- Menu Categories Start -->
        <div class="ct-menu-categories menu-filter">
            <div class="container">
                <div class="menu-category-slider">
                    <a href="#" data-filter="*" class="ct-menu-category-item active">
                        <div class="menu-category-thumb">
                            <img src="{{ asset('menu/assets/img/side-view-shawarma-with-fried-potatoes-board-cookware.jpg') }}"
                                alt="category">
                        </div>
                        <div class="menu-category-desc">
                            <h6>All</h6>
                        </div>
                    </a>
                    @foreach ($categories as $item)
                        <a href="#" data-filter=".{{ $item->category_id }}" class="ct-menu-category-item">
                            <div class="menu-category-thumb">
                                <img src="{{ $item->getFirstMediaUrl('category_image', 'thumb') }}" alt="category">
                            </div>
                            <div class="menu-category-desc">
                                <h6>{{ $item->category_name }}</h6>
                            </div>
                        </a>
                    @endforeach


                </div>
            </div>
        </div>
        <!-- Menu Categories End -->

        <!-- Menu Wrapper Start -->
        <div class="section section-padding">
            <div class="container">

                <div class="menu-container row">
                    @foreach ($categories as $item)
                        @foreach ($item->Product as $product)
                            <!-- Product Start -->
                            <div class="col-lg-4 col-6 {{ $item->category_id }}">
                                <div class="product">
                                    <a class="product-thumb"
                                        href="{{ route('product.index', ['table_id' => $table->id, 'branch_id' => $branch->id, 'id' => $product->product_id]) }}">
                                        <img src="{{ $product->getFirstMediaUrl('product', 'thumb') }}" alt="menu item" />
                                    </a>
                                    <div class="product-body">
                                        <div class="product-desc">
                                            <div class="headProduct">
                                                <h4><a href="menu-item.html">{{ $product->name }}</a></h4>
                                                <p class="product-price">{{ $product->price }}</p>
                                            </div>
                                            <span>اسم الفئة</span>
                                            <p>{{ $product->description }}</p>
                                           
                                        </div>
                                        <div class="product-controls">
                                            <a href="#" class="اطلب-item btn-custom btn-sm shadow-none"
                                                data-product='{"name": "{{ $product->name }}", "price": "{{ $product->price }}", "image": "{{ $product->getFirstMediaUrl('product', 'thumb') }}"}'>
                                                أضف للطلب <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Product End -->
                        @endforeach
                    @endforeach
                    <!-- Product End -->

                </div>

            </div>
        </div>
        <!-- Menu Wrapper End -->

        <!-- Footer Start -->

        <!-- Footer End -->

        <!-- Vendor Scripts -->
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
            function addToCart(item) {
                // Get existing cart items from local storage
                let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

                // Check if the item is already in the cart
                const existingItem = cartItems.find((cartItem) => cartItem.name === item.name);

                if (existingItem) {
                    // Item already in the cart, update its quantity or other details if needed
                    existingItem.quantity += 1;
                } else {
                    // Item not in the cart, add it with a quantity of 1
                    cartItems.push({
                        ...item,
                        quantity: 1
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
                    const product = JSON.parse(this.getAttribute('data-product'));
                    addToCart(product);
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
