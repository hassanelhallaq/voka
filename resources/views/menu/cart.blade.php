    @extends('menu.parent')
    @section('content')
        <div class="subheader dark-overlay dark-overlay-2" style="background-image: url('assets/img/cover.jpg')">
            <div class="container">
                <div>
                    <h1 style="text-align: center;">السلة</h1>
                </div>
            </div>
        </div>
        <!-- Subheader End -->

        <!--Cart Start -->
        <section class="section">
            <div class="container">

                <!-- Cart Table Start -->
                <table class="ct-responsive-table">
                    <thead>
                        <tr>
                            <th class="remove-item"></th>
                            <th>المنتج</th>
                            <th>السعر</th>

                        </tr>
                    </thead>
                    <tbody id="cart-body">
                        <!-- Cart items will be dynamically added here -->
                    </tbody>
                </table>
                <!-- Cart Table End -->
                <!-- Cart form Start -->
                <div class="row ct-cart-form">
                    <div class="offset-lg-6 col-lg-6">
                        <h4>مجموع السلة</h4>
                        <table>
                            <tbody>
                                <tr>
                                    <th>مجموع سعر المنتجات</th>
                                    <td id="total-price">0$</td>
                                </tr>
                                <tr>
                                    <th>رصيد الباقة</th>
                                    <td>{{ $reservation->package->price }}</td>
                                </tr>
                                <tr>
                                    <th>السعر المتبقي</th>
                                    <td><b id="remaining-balance">0</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Cart form End -->
                <!-- pay -->
                <h4 class="title-pay">طريقة الدفع</h4>
                <ul class="nav" id="bordered-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tab-palance-tab" data-toggle="pill" href="#tab-palance"
                            role="tab" aria-controls="tab-palance" aria-selected="true">الرصيد</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mr-0" id="tab-e-pay-tab" data-toggle="pill" href="#tab-e-pay" role="tab"
                            aria-controls="tab-product-reviews" aria-selected="false">دفع إلكتروني</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="tab-palance" role="tabpanel"
                        aria-labelledby="tab-palance-tab">
                        <p>يمكنك التمتع برصيد الباقة وطلب مختلف الأصناف من خلال زر إنشاء طلب</p>
                        <button id="balancePaymentButton" class="btn-custom btn-sm shadow-non" style="width:100%">إنشاء
                            طلب</button>
                    </div>
                    <div class="tab-pane" id="tab-e-pay" role="tabpanel" aria-labelledby="tab-e-pay-tab">
                        <p>يمكنك التمتع برصيد الباقة وطلب مختلف الأصناف من خلال زر إنشاء طلب</p>
                        <button id="electronicPaymentButton" class="btn-custom btn-sm shadow-non" style="width:100%">إنشاء
                            طلب</button>
                    </div>
                </div>
                <!-- end pay -->

            </div>
        </section>
    @endsection
    @section('js')
        <script>
            // Function to display cart items in the table
            function displayCartItems() {
                // Get existing cart items from local storage
                let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

                // Select the cart body to append cart items
                const cartBody = document.getElementById('cart-body');
                cartBody.innerHTML = '';

                // Loop through the cart items and append them to the table
                cartItems.forEach((item) => {
                    const cartItemRow = document.createElement('tr');
                    cartItemRow.innerHTML = `
                <td class="remove">
                    <button type="button" class="close-btn close-danger remove-from-cart" data-name="${item.name}">
                        <span></span>
                        <span></span>
                    </button>
                </td>
                <td data-title="المنتج">
                    <div class="cart-product-wrapper">
                        <!-- <img src="${item.image}" alt="${item.name}">-->
                        <div class="cart-product-body">
                            <h6> <a href="#">${item.name}</a> </h6>
                        </div>
                    </div>
                </td>
                <td data-title="السعر"> <strong>${item.price}$</strong> </td>

            `;
                    cartBody.appendChild(cartItemRow);
                });
            }

            // Call the function to display cart items when the page loads
            displayCartItems();

            // Add event listener to remove items from the cart
            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-from-cart')) {
                    const itemName = event.target.getAttribute('data-name');
                    removeItemFromCart(itemName);
                    displayCartItems();
                }
            });

            // Function to remove items from the cart
            function removeItemFromCart(itemName) {
                // Get existing cart items from local storage
                let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

                // Filter out the item to be removed
                cartItems = cartItems.filter((item) => item.name !== itemName);

                // Save the updated cart items back to local storage
                localStorage.setItem('cartItems', JSON.stringify(cartItems));
            }
            const balancePaymentButton = document.getElementById('balancePaymentButton');
            const electronicPaymentButton = document.getElementById('electronicPaymentButton');

            balancePaymentButton.addEventListener('click', () => createOrder('الرصيد'));
            electronicPaymentButton.addEventListener('click', () => createOrder('دفع إلكتروني'));

            function createOrder(paymentMethod) {
                const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
                const routeUrl = `{!! route('store.order', ['table_id' => $table->id, 'branch_id' => $branch->id]) !!}`;

                // Send data to Laravel
                fetch(routeUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}', // Assuming you're using CSRF protection
                        },
                        body: JSON.stringify({
                            paymentMethod: paymentMethod,
                            cartItems: cartItems,
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data.message);

                        // Handle success, reset cart, etc.
                        if (paymentMethod === 'دفع إلكتروني') {
                            // Assuming the response contains a redirect URL

                            console.log(data);
                            debugger

                         

                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Handle error
                    });
            }
        </script>
        <script>
            // Function to calculate the total price of the products in the cart
            function calculateTotalPrice() {
                let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
                let totalPrice = 0;

                cartItems.forEach((item) => {
                    totalPrice += item.price * item.quantity;
                });

                return totalPrice.toFixed(2); // Convert to 2 decimal places
            }

            // Function to update the cart summary
            function updateCartSummary() {
                const totalPriceElement = document.getElementById('total-price');
                const remainingBalanceElement = document.getElementById('remaining-balance');

                // Get the total price of the products in the cart
                const totalPrice = calculateTotalPrice();

                // Get the balance from the package
                const packageBalance = {{ $reservation->package->price }};

                // Calculate the remaining balance
                const remainingBalance = packageBalance - totalPrice;

                // Update the cart summary elements with the calculated values
                totalPriceElement.innerText = totalPrice;
                remainingBalanceElement.innerText = remainingBalance;
            }

            // Call the function to update the cart summary when the page loads
            updateCartSummary();

            // Add event listener to quantity inputs for updating the cart summary
            document.addEventListener('input', function(event) {
                if (event.target.classList.contains('qty')) {
                    updateCartSummary();
                }
            });
        </script>


        <script>
            function getCartItemCount() {
                let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
                let totalItems = cartItems.reduce((acc, item) => acc + item.quantity, 0);
                return totalItems;
            }

            function updateCartItemCount() {
                const cartItemCountElement = document.getElementById('cart-item-count');
                const cartItemCount = getCartItemCount();
                cartItemCountElement.innerText = cartItemCount;
            }
            document.addEventListener('DOMContentLoaded', updateCartItemCount);
        </script>
    @endsection
