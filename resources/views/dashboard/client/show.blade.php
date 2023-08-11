       <x-default-layout>
           <div id="kt_app_content" class="app-content flex-column-fluid">
               <!--begin::Content container-->
               <div id="kt_app_content_container" class="app-container container-xxl">
                   <!--begin::Navbar-->
                   <div class="card mb-5 mb-xl-10">
                       <div class="card-body pt-9 pb-0">
                           <!--begin::Details-->
                           <div class="d-flex flex-wrap flex-sm-nowrap">
                               <!--begin: Pic-->
                               <div class="me-7 mb-4">
                                   <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                       <img src="{{ asset('assets/media/avatars/300-1.jpg') }}" alt="image" />
                                       <div
                                           class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px">
                                       </div>
                                   </div>
                               </div>
                               <!--end::Pic-->
                               <!--begin::Info-->
                               <div class="flex-grow-1">
                                   <!--begin::Title-->
                                   <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                       <!--begin::User-->
                                       <div class="d-flex flex-column">
                                           <!--begin::Name-->
                                           <div class="d-flex align-items-center mb-2">
                                               <a href="#"
                                                   class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $client->name }}</a>
                                               <a href="#">
                                                   <i class="ki-duotone ki-verify fs-1 text-primary">
                                                       <span class="path1"></span>
                                                       <span class="path2"></span>
                                                   </i>
                                               </a>
                                           </div>
                                           <!--end::Name-->
                                           <!--begin::Info-->
                                           <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">

                                               <a
                                                   class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                                   <i class="ki-duotone ki-sms fs-4 me-1">
                                                       <span class="path1"></span>
                                                       <span class="path2"></span>
                                                   </i>{{ $client->phone }}</a>
                                           </div>
                                           <!--end::Info-->
                                       </div>

                                   </div>
                                   <!--end::Title-->
                                   <!--begin::Stats-->

                                   <!--end::Stats-->
                               </div>
                               <!--end::Info-->
                           </div>
                           <!--end::Details-->
                           <!--begin::Navs-->
                           <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                               <!--begin::Nav item-->
                               <li class="nav-item mt-2">
                                   <a class="nav-link text-active-primary ms-0 me-10 py-5 active"
                                       href="">Overview</a>
                               </li>
                           </ul>
                           <!--begin::Navs-->
                       </div>
                   </div>
                   <!--end::Navbar-->
                   <!--begin::details View-->
                   <a data-bs-toggle="modal" data-bs-target="#blance" class="btn btn-sm fw-bold btn-primary"
                       data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">{{ __('Add Blance') }}</a>

                   <div class="modal fade" id="blance" tabindex="-1" aria-hidden="true">
                       <div class="modal-dialog modal-dialog-centered mw-750px">
                           <div class="modal-content">
                               <div class="modal-body scroll-y mx-lg-5 my-7">
                                   <!--begin::Form-->
                                   <form id="kt_modal_add_role_form" class="form">
                                       @csrf
                                       <!--begin::Scroll-->
                                       <div class="d-flex flex-column scroll-y me-n7 pe-7">
                                           <div class="row">
                                               <div class="form-group mb-6">
                                                   <label>{{ __('blance') }}</label>

                                                   <div class="input-group mb-3">
                                                       <input type="number" class="form-control meal_price"
                                                           name="blance" required id='blanceAmount'>
                                                   </div>
                                                   @if ($errors->has('blance'))
                                                       <p style="color: red">
                                                           {{ $errors->first('blance') }}
                                                       </p>
                                                   @endif
                                               </div>
                                           </div>
                                       </div>
                                       <!--end::Scroll-->
                                       <!--begin::Actions-->
                                       <div class="text-center pt-15">
                                           <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal"
                                               data-kt-roles-modal-action="cancel">
                                               {{ __('Discard') }}</button>
                                           <button onclick="performStore({{ $client->id }})" type="button"
                                               class="btn btn-primary">
                                               {{ __('Submit') }}
                                           </button>
                                       </div>
                                       <!--end::Actions-->
                                   </form>
                                   <!--end::Form-->
                               </div>
                               <!--end::Modal body-->
                           </div>
                           <!--end::Modal content-->
                       </div>
                       <!--end::Modal dialog-->
                   </div>
                   <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">

                       <!--begin::Card header-->
                       <div class="card-header cursor-pointer">
                           <!--begin::Card title-->
                           <div class="card-title m-0">
                               <h3 class="fw-bold m-0">تفاصيل المحفظة</h3>
                           </div>
                           <!--end::Card title-->
                           <!--begin::Action-->

                           <!--end::Action-->
                       </div>
                       <!--begin::Card header-->
                       <!--begin::Card body-->
                       <div class="card-body p-9">
                           <!--begin::Row-->
                           <div class="row mb-7">
                               <!--begin::Label-->
                               <label class="col-lg-4 fw-semibold text-muted">رصيد المحفظة</label>
                               <!--end::Label-->
                               <!--begin::Col-->
                               <div class="col-lg-8">
                                   <span class="fw-bold fs-6 text-gray-800">{{ $client->wallet->credit ?? 0 }}</span>
                               </div>
                               <!--end::Col-->
                           </div>

                       </div>
                       <h3 class="card-title align-items-start flex-column">
                           <span class="card-label fw-bold text-dark">حركات المحفظة</span>

                       </h3>
                       <div class="col-xl-8">
                           <!--begin::Table Widget 5-->
                           <div class="card card-flush h-xl-100">
                               <!--begin::Card header-->
                               <div class="card-header pt-7">
                                   <!--begin::Title-->

                                   <!--end::Title-->
                                   <!--begin::Actions-->
                                   <div class="card-toolbar">

                                   </div>
                                   <!--end::Card header-->
                                   <!--begin::Card body-->
                                   <div class="card-body">
                                       <!--begin::Table-->
                                       <table class="table">
                                           <!--begin::Table head-->
                                           <thead>
                                               <!--begin::Table row-->
                                               <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                   <th class="min-w-150px">العنوان</th>
                                                   <th class="text-end pe-3 min-w-100px">القيمة</th>
                                                   <th class="text-end pe-3 min-w-150px">الرصيد السابق</th>
                                                   <th class="text-end pe-3 min-w-100px">النوع</th>
                                               </tr>
                                               <!--end::Table row-->
                                           </thead>
                                           <!--end::Table head-->
                                           <!--begin::Table body-->
                                           <tbody class="fw-bold text-gray-600">
                                               @if ($client->wallet && $client->wallet->wallet_action->count() != 0)
                                                   @foreach ($client->wallet->wallet_action as $items)
                                                       <tr>
                                                           <td>
                                                               <a href=" "
                                                                   class="text-dark text-hover-primary">{{ $items->action_tite }}</a>
                                                           </td>
                                                           <!--end::Item-->
                                                           <!--begin::Product ID-->
                                                           <td class="text-end">{{ $items->amount }}</td>
                                                           <!--end::Product ID-->
                                                           <!--begin::Date added-->
                                                           <td class="text-end">{{ $items->balance_before }}</td>
                                                           <!--end::Date added-->
                                                           <!--begin::Price-->

                                                           <td class="text-end">
                                                               {{ $items->type }}
                                                           </td>
                                                       </tr>
                                                   @endforeach
                                               @endif
                                           </tbody>
                                           <!--end::Table body-->
                                       </table>
                                       <!--end::Table-->
                                   </div>
                                   <!--end::Card body-->
                               </div>
                               <!--end::Table Widget 5-->
                           </div>
                           <!--end::Col-->
                       </div>
                       <!--end::Card body-->
                   </div>
                   <!--end::details View-->
                   <!--begin::Row-->

                   <!--end::Row-->
                   <!--begin::Row-->
                   <div class="row gy-5 g-xl-10">
                       <!--begin::Col-->
                       <div class="col-xl-4">
                           <!--begin::List widget 5-->
                           <div class="card card-flush h-xl-100">
                               <!--begin::Header-->
                               <div class="card-header pt-7">
                                   <!--begin::Title-->
                                   <h3 class="card-title align-items-start flex-column">
                                       <span class="card-label fw-bold text-dark">Packages</span>

                                   </h3>

                               </div>
                               <!--end::Header-->
                               <!--begin::Body-->
                               <div class="card-body">
                                   <!--begin::Scroll-->

                                   <div class="hover-scroll-overlay-y pe-6 me-n6" style="height: 415px">
                                       @foreach ($client->packages as $item)
                                           <div class="border border-dashed border-gray-300 rounded px-7 py-3">
                                               <div class="d-flex flex-stack mb-3">
                                                   <div class="me-3">
                                                       <img src="assets/media/stock/ecommerce/192.png"
                                                           class="w-50px ms-n1 me-1" alt="" />
                                                       <a
                                                           class="text-gray-800 text-hover-primary fw-bold">{{ $item->name }}</a>
                                                   </div>
                                               </div>
                                           </div>
                                       @endforeach
                                   </div>

                                   <!--end::Scroll-->
                               </div>
                               <!--end::Body-->
                           </div>
                           <!--end::List widget 5-->
                       </div>
                       <!--end::Col-->
                       <!--begin::Col-->
                       <div class="col-xl-8">
                           <!--begin::Table Widget 5-->
                           <div class="card card-flush h-xl-100">
                               <!--begin::Card header-->
                               <div class="card-header pt-7">
                                   <!--begin::Title-->
                                   <h3 class="card-title align-items-start flex-column">
                                       <span class="card-label fw-bold text-dark">Products</span>

                                   </h3>
                                   <!--end::Title-->
                                   <!--begin::Actions-->
                                   <div class="card-toolbar">

                                   </div>
                                   <!--end::Card header-->
                                   <!--begin::Card body-->
                                   <div class="card-body">
                                       <!--begin::Table-->
                                       <table class="table">
                                           <!--begin::Table head-->
                                           <thead>
                                               <!--begin::Table row-->
                                               <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                   <th class="min-w-150px">Item</th>
                                                   <th class="text-end pe-3 min-w-100px">Product ID</th>
                                                   <th class="text-end pe-3 min-w-150px">Date Added</th>
                                                   <th class="text-end pe-3 min-w-100px">Price</th>
                                                   <th class="text-end pe-0 min-w-75px">Qty</th>
                                               </tr>
                                               <!--end::Table row-->
                                           </thead>
                                           <!--end::Table head-->
                                           <!--begin::Table body-->
                                           <tbody class="fw-bold text-gray-600">
                                               @foreach ($client->orders as $item)
                                                   @foreach ($item->products as $items)
                                                       <tr>

                                                           <td>
                                                               <a href=" "
                                                                   class="text-dark text-hover-primary">{{ $items->name }}</a>
                                                           </td>
                                                           <!--end::Item-->
                                                           <!--begin::Product ID-->
                                                           <td class="text-end">{{ $items->product_id }}</td>
                                                           <!--end::Product ID-->
                                                           <!--begin::Date added-->
                                                           <td class="text-end">{{ $items->created_at }}</td>
                                                           <!--end::Date added-->
                                                           <!--begin::Price-->
                                                           <td class="text-end">
                                                               {{ $items->pivot->price }}
                                                           </td>
                                                           <td class="text-end">
                                                               {{ $items->pivot->quantity }}
                                                           </td>


                                                       </tr>
                                                   @endforeach
                                               @endforeach
                                           </tbody>
                                           <!--end::Table body-->
                                       </table>
                                       <!--end::Table-->
                                   </div>
                                   <!--end::Card body-->
                               </div>
                               <!--end::Table Widget 5-->
                           </div>
                           <!--end::Col-->
                       </div>
                       <!--end::Row-->
                   </div>
                   <!--end::Content container-->
               </div>
       </x-default-layout>
       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
       <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
       <script src="{{ asset('crudjs/crud.js') }}"></script>
       <script>
           function performStore(id) {
               let formData = new FormData();
               formData.append('blance', document.getElementById('blanceAmount').value);
               storeReload('/admin/wallet-blance/' + id, formData)
           }
       </script>
