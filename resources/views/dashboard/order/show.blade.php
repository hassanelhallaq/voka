 <x-default-layout>
     <div id="kt_app_content" class="app-content flex-column-fluid">
         <!--begin::Content container-->
         <div id="kt_app_content_container" class="app-container container-xxl">
             <!--begin::Order details page-->
             <div class="d-flex flex-column gap-7 gap-lg-10">
                 <div class="d-flex flex-wrap flex-stack gap-5 gap-lg-10">
                     <!--begin:::Tabs-->
                     <ul
                         class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-lg-n2 me-auto">
                         <!--begin:::Tab item-->
                         <li class="nav-item">
                             <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                 href="#kt_ecommerce_sales_order_summary">Order Summary</a>
                         </li>

                         <!--end:::Tab item-->
                     </ul>


                     <!--end::Button-->
                 </div>
                 <!--begin::Order summary-->
                 <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                     <!--begin::Order details-->
                     <div class="card card-flush py-4 flex-row-fluid">
                         <!--begin::Card header-->
                         <div class="card-header">
                             <div class="card-title">
                                 <h2>Order Details </h2>
                             </div>
                         </div>
                         <!--end::Card header-->
                         <!--begin::Card body-->
                         <div class="card-body pt-0">
                             <div class="table-responsive">
                                 <!--begin::Table-->
                                 <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                     <tbody class="fw-semibold text-gray-600">
                                         <tr>
                                             <td class="text-muted">
                                                 <div class="d-flex align-items-center">
                                                     <i class="ki-duotone ki-calendar fs-2 me-2">
                                                         <span class="path1"></span>
                                                         <span class="path2"></span>
                                                     </i>Date Added
                                                 </div>
                                             </td>
                                             <td class="fw-bold text-end">{{ $order->created_at->format('Y/m/d') }}</td>
                                         </tr>
                                         <tr>
                                             <td class="text-muted">
                                                 <div class="d-flex align-items-center">
                                                     <i class="ki-duotone ki-wallet fs-2 me-2">
                                                         <span class="path1"></span>
                                                         <span class="path2"></span>
                                                         <span class="path3"></span>
                                                         <span class="path4"></span>
                                                     </i>Payment Method
                                                 </div>
                                             </td>
                                             <td class="fw-bold text-end">{{ $order->reservation->payment_type ?? '' }}
                                                 <img src="{{ asset('assets/media/svg/card-logos/visa.svg') }}"
                                                     class="w-50px ms-2" />
                                             </td>
                                         </tr>

                                     </tbody>
                                 </table>
                                 <!--end::Table-->
                             </div>
                         </div>
                         <!--end::Card body-->
                     </div>
                     <!--end::Order details-->
                     <!--begin::Customer details-->
                     <div class="card card-flush py-4 flex-row-fluid">
                         <!--begin::Card header-->
                         <div class="card-header">
                             <div class="card-title">
                                 <h2>Customer Details</h2>
                             </div>
                         </div>
                         <!--end::Card header-->
                         <!--begin::Card body-->
                         <div class="card-body pt-0">
                             <div class="table-responsive">
                                 <!--begin::Table-->
                                 <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                     <tbody class="fw-semibold text-gray-600">
                                         <tr>
                                             <td class="text-muted">
                                                 <div class="d-flex align-items-center">
                                                     <i class="ki-duotone ki-profile-circle fs-2 me-2">
                                                         <span class="path1"></span>
                                                         <span class="path2"></span>
                                                         <span class="path3"></span>
                                                     </i>Customer
                                                 </div>
                                             </td>
                                             <td class="fw-bold text-end">
                                                 <div class="d-flex align-items-center justify-content-end">
                                                     <!--begin:: Avatar -->
                                                     <div class="symbol symbol-circle symbol-25px overflow-hidden me-3">
                                                         <a
                                                             href="../../demo1/dist/apps/ecommerce/customers/details.html">
                                                             <div class="symbol-label">
                                                                 <img src="assets/media/avatars/300-23.jpg"
                                                                     alt="Dan Wilson" class="w-100" />
                                                             </div>
                                                         </a>
                                                     </div>
                                                     <!--end::Avatar-->
                                                     <!--begin::Name-->
                                                     <a href="../../demo1/dist/apps/ecommerce/customers/details.html"
                                                         class="text-gray-600 text-hover-primary">{{ $order->client->name }}</a>
                                                     <!--end::Name-->
                                                 </div>
                                             </td>
                                         </tr>

                                         <tr>
                                             <td class="text-muted">
                                                 <div class="d-flex align-items-center">
                                                     <i class="ki-duotone ki-phone fs-2 me-2">
                                                         <span class="path1"></span>
                                                         <span class="path2"></span>
                                                     </i>Phone
                                                 </div>
                                             </td>
                                             <td class="fw-bold text-end">{{ $order->client->phone }}</td>
                                         </tr>
                                     </tbody>
                                 </table>
                                 <!--end::Table-->
                             </div>
                         </div>
                         <!--end::Card body-->
                     </div>
                     <!--end::Customer details-->
                     <!--begin::Documents-->

                     <!--end::Documents-->
                 </div>
                 <!--end::Order summary-->
                 <!--begin::Tab content-->
                 <div class="tab-content">
                     <!--begin::Tab pane-->
                     <div class="tab-pane fade show active" id="kt_ecommerce_sales_order_summary" role="tab-panel">
                         <!--begin::Orders-->
                         <div class="d-flex flex-column gap-7 gap-lg-10">

                             <!--begin::Product List-->
                             <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                                 <!--begin::Card header-->
                                 <div class="card-header">
                                     <div class="card-title">
                                         <h2>Order </h2>
                                     </div>
                                 </div>
                                 <!--end::Card header-->
                                 <!--begin::Card body-->
                                 <div class="card-body pt-0">
                                     <div class="table-responsive">
                                         <!--begin::Table-->
                                         <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                             <thead>
                                                 <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                     <th class="min-w-175px">Product</th>
                                                     <th class="min-w-70px text-end">Qty</th>
                                                     <th class="min-w-100px text-end">Unit Price</th>
                                                     <th class="min-w-100px text-end">Total</th>
                                                 </tr>
                                             </thead>
                                             <tbody class="fw-semibold text-gray-600">
                                                 @foreach ($order->products as $products)
                                                     <tr>
                                                         <td>
                                                             <div class="d-flex align-items-center">
                                                                 <!--begin::Thumbnail-->
                                                                 <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html"
                                                                     class="symbol symbol-50px">
                                                                     <span class="symbol-label"
                                                                         style="background-image:url(assets/media//stock/ecommerce/1.png);"></span>
                                                                 </a>
                                                                 <!--end::Thumbnail-->
                                                                 <!--begin::Title-->
                                                                 <div class="ms-5">
                                                                     <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html"
                                                                         class="fw-bold text-gray-600 text-hover-primary">{{ $products->name }}</a>

                                                                 </div>
                                                                 <!--end::Title-->
                                                             </div>
                                                         </td>
                                                         <td class="text-end">{{ $products->pivot->quantity }}</td>
                                                         <td class="text-end">{{ $products->pivot->price }}</td>
                                                         <td class="text-end">
                                                             {{ $products->pivot->quantity * $products->pivot->price }}
                                                         </td>
                                                     </tr>
                                                     @php
                                                         $totalOrderPrice = 0;
                                                         $totalOrderPrice += $products->pivot->quantity * $products->pivot->price;
                                                     @endphp
                                                 @endforeach


                                                 <tr>
                                                     <td colspan="4" class="fs-3 text-dark text-end">Grand
                                                         Total</td>
                                                     <td class="text-dark fs-3 fw-bolder text-end">
                                                         {{ $totalOrderPrice ?? 0 }}</td>
                                                 </tr>
                                             </tbody>
                                         </table>
                                         <!--end::Table-->
                                     </div>
                                 </div>
                                 <!--end::Card body-->
                             </div>
                             <!--end::Product List-->
                         </div>
                         <!--end::Orders-->
                     </div>
                     <!--end::Tab pane-->
                     <!--begin::Tab pane-->

                     <!--end::Tab pane-->
                 </div>
                 <!--end::Tab content-->
             </div>
             <!--end::Order details page-->
         </div>
         <!--end::Content container-->
     </div>
 </x-default-layout>
