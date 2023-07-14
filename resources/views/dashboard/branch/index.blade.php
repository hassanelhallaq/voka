 <x-default-layout>
     <div class="d-flex flex-column flex-column-fluid">
         <div id="kt_app_content" class="app-content flex-column-fluid">
             <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                 <!--begin::Toolbar container-->
                 <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                     <!--begin::Page title-->
                     <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                         <!--begin::Title-->
                         <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                             إدارة الأفرع</h1>
                         <!--end::Title-->
                     </div>
                     <!--end::Page title-->
                     <!--begin::Actions-->

                     <!--end::Actions-->
                 </div>
                 <!--end::Toolbar container-->
             </div>
             <!--begin::Content container-->
             <div id="kt_app_content_container" class="app-container container-xxl">
                 <div class="card">
                     <div class="card-header border-0 pt-6">
                         <!--begin::Card title-->
                         <div class="card-title">
                             <!--begin::Search-->
                             <div class="d-flex align-items-center position-relative my-1">
                                 <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                     <span class="path1"></span>
                                     <span class="path2"></span>
                                 </i>
                                 <input type="text" data-kt-customer-table-filter="search"
                                     class="form-control form-control-solid w-250px ps-12"
                                     placeholder="Search Customers" />
                             </div>
                             <!--end::Search-->
                         </div>
                         <!--begin::Card title-->
                         <!--begin::Card toolbar-->
                         <div class="card-toolbar">
                             <!--begin::Toolbar-->
                             <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                                 <!--begin::Filter-->
                                 <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
                                     data-kt-menu-placement="bottom-end">
                                     <i class="ki-duotone ki-filter fs-2">
                                         <span class="path1"></span>
                                         <span class="path2"></span>
                                     </i>Filter</button>
                                 <!--begin::Menu 1-->
                                 <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true"
                                     id="kt-toolbar-filter">
                                     <!--begin::Header-->
                                     <div class="px-7 py-5">
                                         <div class="fs-4 text-dark fw-bold">Filter Options</div>
                                     </div>
                                     <!--end::Header-->
                                     <!--begin::Separator-->
                                     <div class="separator border-gray-200"></div>
                                     <!--end::Separator-->
                                     <!--begin::Content-->
                                     <div class="px-7 py-5">
                                         <!--begin::Input group-->
                                         <div class="mb-10">
                                             <!--begin::Label-->
                                             <label class="form-label fs-5 fw-semibold mb-3">Month:</label>
                                             <!--end::Label-->
                                             <!--begin::Input-->
                                             <select class="form-select form-select-solid fw-bold"
                                                 data-kt-select2="true" data-placeholder="Select option"
                                                 data-allow-clear="true" data-kt-customer-table-filter="month"
                                                 data-dropdown-parent="#kt-toolbar-filter">
                                                 <option></option>
                                                 <option value="aug">August</option>
                                                 <option value="sep">September</option>
                                                 <option value="oct">October</option>
                                                 <option value="nov">November</option>
                                                 <option value="dec">December</option>
                                             </select>
                                             <!--end::Input-->
                                         </div>
                                         <!--end::Input group-->
                                         <!--begin::Input group-->
                                         <div class="mb-10">
                                             <!--begin::Label-->
                                             <label class="form-label fs-5 fw-semibold mb-3">Payment Type:</label>
                                             <!--end::Label-->
                                             <!--begin::Options-->
                                             <div class="d-flex flex-column flex-wrap fw-semibold"
                                                 data-kt-customer-table-filter="payment_type">
                                                 <!--begin::Option-->
                                                 <label
                                                     class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
                                                     <input class="form-check-input" type="radio" name="payment_type"
                                                         value="all" checked="checked" />
                                                     <span class="form-check-label text-gray-600">All</span>
                                                 </label>
                                                 <!--end::Option-->
                                                 <!--begin::Option-->
                                                 <label
                                                     class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
                                                     <input class="form-check-input" type="radio" name="payment_type"
                                                         value="visa" />
                                                     <span class="form-check-label text-gray-600">Visa</span>
                                                 </label>
                                                 <!--end::Option-->
                                                 <!--begin::Option-->
                                                 <label
                                                     class="form-check form-check-sm form-check-custom form-check-solid mb-3">
                                                     <input class="form-check-input" type="radio" name="payment_type"
                                                         value="mastercard" />
                                                     <span class="form-check-label text-gray-600">Mastercard</span>
                                                 </label>
                                                 <!--end::Option-->
                                                 <!--begin::Option-->
                                                 <label
                                                     class="form-check form-check-sm form-check-custom form-check-solid">
                                                     <input class="form-check-input" type="radio" name="payment_type"
                                                         value="american_express" />
                                                     <span class="form-check-label text-gray-600">American
                                                         Express</span>
                                                 </label>
                                                 <!--end::Option-->
                                             </div>
                                             <!--end::Options-->
                                         </div>
                                         <!--end::Input group-->
                                         <!--begin::Actions-->
                                         <div class="d-flex justify-content-end">
                                             <button type="reset" class="btn btn-light btn-active-light-primary me-2"
                                                 data-kt-menu-dismiss="true"
                                                 data-kt-customer-table-filter="reset">Reset</button>
                                             <button type="submit" class="btn btn-primary" data-kt-menu-dismiss="true"
                                                 data-kt-customer-table-filter="filter">Apply</button>
                                         </div>
                                         <!--end::Actions-->
                                     </div>
                                     <!--end::Content-->
                                 </div>
                                 <!--end::Menu 1-->
                                 <!--end::Filter-->
                                 <!--begin::Export-->
                                 <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal"
                                     data-bs-target="#kt_customers_export_modal">
                                     <i class="ki-duotone ki-exit-up fs-2">
                                         <span class="path1"></span>
                                         <span class="path2"></span>
                                     </i>Export</button>
                                 <!--end::Export-->
                                 <!--begin::Add customer-->
                                 <a type="button" class="btn btn-primary" href="{{ route('branch.create') }}">
                                     {{ __('Add Branch') }}</a>

                                 <div class="modal fade" id="kt_modal_add_customer" tabindex="-1"
                                     aria-hidden="true">
                                     <!--begin::Modal dialog-->
                                     <div class="modal-dialog modal-dialog-centered mw-650px">
                                         <!--begin::Modal content-->
                                         <div class="modal-content">
                                             <!--begin::Form-->
                                             <form class="form" action="#" id="kt_modal_add_customer_form"
                                                 data-kt-redirect="../../demo1/dist/apps/customers/list.html">
                                                 <!--begin::Modal header-->
                                                 <div class="modal-body py-10 px-lg-17">
                                                     <!--begin::Scroll-->
                                                     <div class="scroll-y me-n7 pe-7"
                                                         id="kt_modal_add_customer_scroll" data-kt-scroll="true"
                                                         data-kt-scroll-activate="{default: false, lg: true}"
                                                         data-kt-scroll-max-height="auto"
                                                         data-kt-scroll-dependencies="#kt_modal_add_customer_header"
                                                         data-kt-scroll-wrappers="#kt_modal_add_customer_scroll"
                                                         data-kt-scroll-offset="300px">
                                                         <div class="fv-row mb-7">
                                                             <label
                                                                 class="required fs-6 fw-semibold mb-2">{{ __('Branch Name') }}</label>
                                                             <input type="text" class="form-control mb-3"
                                                                 id="validationCustom01"
                                                                 placeholder="{{ __('Branch Name') }}" required="">
                                                         </div>
                                                         <div class="fv-row mb-7">
                                                             <label class="fs-6 fw-semibold mb-2">
                                                                 <span
                                                                     class="required">{{ __('Branch Manger') }}</span>
                                                             </label>
                                                             <input type="text" class="form-control mb-3"
                                                                 id="validationCustom01"
                                                                 placeholder="{{ __('Branch Manger') }}"
                                                                 required="">
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="modal-footer flex-center">
                                                     <!--begin::Button-->
                                                     <button type="reset" id="kt_modal_add_customer_cancel"
                                                         class="btn btn-light me-3"
                                                         data-bs-dismiss="modal">Discard</button>
                                                     <!--end::Button-->
                                                     <!--begin::Button-->
                                                     <button type="submit" id="kt_modal_add_customer_submit"
                                                         class="btn btn-primary">
                                                         <span class="indicator-label">Submit</span>
                                                         <span class="indicator-progress">Please wait...
                                                             <span
                                                                 class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                     </button>
                                                     <!--end::Button-->
                                                 </div>
                                                 <!--end::Modal footer-->
                                             </form>
                                             <!--end::Form-->
                                         </div>
                                     </div>
                                 </div>
                                 <!--end::Add customer-->
                             </div>
                             <!--end::Toolbar-->
                             <!--begin::Group actions-->
                             <div class="d-flex justify-content-end align-items-center d-none"
                                 data-kt-customer-table-toolbar="selected">
                                 <div class="fw-bold me-5">
                                     <span class="me-2"
                                         data-kt-customer-table-select="selected_count"></span>Selected
                                 </div>
                                 <button type="button" class="btn btn-danger"
                                     data-kt-customer-table-select="delete_selected">Delete
                                     Selected</button>
                             </div>
                             <!--end::Group actions-->
                         </div>
                         <!--end::Card toolbar-->
                     </div>
                     <div class="card-body pt-0">
                         <!--begin::Table-->
                         <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                             <thead>
                                 <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                     <th class="w-10px pe-2">
                                         <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                             <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                 data-kt-check-target="#kt_customers_table .form-check-input"
                                                 value="1" />
                                         </div>
                                     </th>
                                     <th class="min-w-125px"> {{ __('Branch ID') }} </th>
                                     <th class="min-w-125px">{{ __('Branch Name') }}</th>
                                     <th class="min-w-125px"> {{ __('Branch Manger') }}</th>
                                     <th class="min-w-125px">{{ __('Branch Created') }}</th>
                                     <th class="min-w-125px"><strong>{{ __('Status') }}</th>
                                     <th class="min-w-125px">{{ __('settings') }}</th>
                                 </tr>
                             </thead>
                             <tbody class="fw-semibold text-gray-600">
                                 @foreach ($branches as $branch)
                                     <tr>
                                         <td>
                                             <div class="form-check">
                                                 <input class="form-check-input" type="checkbox" value=""
                                                     id="flexCheckDefault-1">
                                                 <label class="form-check-label" for="flexCheckDefault-1">
                                                 </label>
                                             </div>
                                         </td>
                                         <td><b>{{ $branch->id }}</b></td>
                                         <td>{{ $branch->name }}</td>
                                         <td>{{ $branch->manger }}</td>
                                         <td>{{ $branch->created_at }}</td>
                                         <td class="recent-stats"><i
                                                 class="fa fa-circle text-success ms-1"></i>{{ $branch->status }}
                                         </td>
                                         <td>
                                             <a href="#"
                                                 class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                 data-kt-menu-trigger="click"
                                                 data-kt-menu-placement="bottom-end">Actions
                                                 <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                             <!--begin::Menu-->
                                             <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                 data-kt-menu="true">
                                                 <!--begin::Menu item-->
                                                 <div class="menu-item px-3">
                                                     <a href="../../demo1/dist/apps/customers/view.html"
                                                         class="menu-link px-3">View</a>
                                                 </div>
                                                 <!--end::Menu item-->
                                                 <!--begin::Menu item-->
                                                 <div class="menu-item px-3">
                                                     <a href="#" class="menu-link px-3"
                                                         data-kt-customer-table-filter="delete_row">Delete</a>
                                                 </div>
                                                 <!--end::Menu item-->
                                             </div>
                                             <!--end::Menu-->
                                         </td>
                                     </tr>
                                 @endforeach
                             </tbody>
                         </table>
                         <!--end::Table-->
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </x-default-layout>
 <script src="{{ asset('assets/js/custom/utilities/modals/create-app.js') }}"></script>
 <script src="{{ asset('assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
 <script src="{{ asset('assets/js/custom/utilities/modals/users-search.js') }}"></script>
