 <x-default-layout>
     <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
         <div class="container">
             <div class="card">
                 <div class="card-header">
                     <h4 class="card-title">إضافة كوبون</h4>
                 </div>
                 <div class="card-body">
                     <div class="form-validation">
                         <form method="post" action="{{ route('coupons.store') }}" class="needs-validation"
                             enctype="multipart/form-data">
                             @csrf
                             <div class="row">
                                 <div class="form-group col-md-6">
                                     <label class="col-lg-4 col-form-label" for="validationCustom01">
                                         {{ __('coupon name') }}
                                         <span class="text-danger">*</span>
                                     </label>

                                     <input type="text" value="{{ old('name') }}" class="form-control mb-3"
                                         id="name" name="name" placeholder="{{ __('coupon name') }}" required>

                                     @if ($errors->has('name'))
                                         <p style="color: red">{{ $errors->first('name') }}
                                         </p>
                                     @endif

                                 </div>
                                 <div class="form-group col-md-6">
                                     <label class="col-lg-4 col-form-label" for="validationCustom01">
                                         {{ __('coupon code') }}
                                         <span class="text-danger">*</span>
                                     </label>

                                     <input type="text" class="form-control mb-3" id="code" name="code"
                                         value="{{ old('code') }}" placeholder=" {{ __('coupon code') }}" required>

                                     @if ($errors->has('code'))
                                         <p style="color: red">{{ $errors->first('code') }}
                                         </p>
                                     @endif

                                 </div>
                             </div>

                             <div class="row">
                                 <div class="form-group col-md-6">
                                     <label class="col-lg-4 col-form-label"
                                         for="validationCustom01">{{ __('coupon type') }}
                                         <span class="text-danger">*</span>
                                     </label>

                                     <select class="default-select wide form-control mb-3" id="coupon_type"
                                         name="coupon_type">
                                         <option value="0">....</option>
                                         <option value="percent">{{ __('percent') }}</option>
                                         <option value="value">{{ __('value') }}</option>
                                     </select>

                                     @if ($errors->has('coupon_type'))
                                         <p style="color: red">{{ $errors->first('coupon_type') }}
                                         </p>
                                     @endif

                                 </div>
                                 <div class="form-group col-md-6">
                                     <label class="col-lg-4 col-form-label " for="validationCustom01">
                                         {{ __('coupon discount') }}
                                         <span class="text-danger">*</span>
                                     </label>

                                     <input type="number" class="form-control mb-3" id="coupon_discount"
                                         value="{{ old('coupon_discount') }}" name="coupon_discount" required>

                                     @if ($errors->has('coupon_discount'))
                                         <p style="color: red">{{ $errors->first('coupon_discount') }}
                                         </p>
                                     @endif

                                 </div>
                             </div>

                             <div class="row">
                                 <div class="form-group col-md-6">
                                     <label class="col-lg-4 col-form-label" for="validationCustom01">
                                         {{ __('Frequency of use for the coupon') }}
                                         <span class="text-danger">*</span>
                                     </label>
                                     <!--  عدد المرات التى يمكن استخدام الكوبون فيها -->

                                     <input type="number" class="form-control mb-3" id="count_use" name="count_use"
                                         value="{{ old('count_use') }}"
                                         placeholder="{{ __('Frequency of use for the coupon') }}" required>
                                     <div class="invalid-feedback">
                                         @if ($errors->has('count_use'))
                                             <p style="color: red">{{ $errors->first('count_use') }}
                                             </p>
                                         @endif
                                     </div>
                                 </div>


                                 <div class="form-group col-md-6">
                                     <label class="col-lg-4 col-form-label" for="validationCustom01">
                                         {{ __('The number of times a customer has used it') }}
                                         <span class="text-danger">*</span>
                                     </label>
                                     <!-- عدد مرات استخدام الكوبون للعميل الواحد -->

                                     <input type="number" class="form-control mb-3" id="customer_use"
                                         value="{{ old('customer_use') }}" name="customer_use"
                                         placeholder="أضف عدد مرات الاستخدام للعميل" required>

                                     @if ($errors->has('customer_use'))
                                         <p style="color: red">{{ $errors->first('customer_use') }}
                                         </p>
                                     @endif

                                 </div>
                             </div>

                             <div class="row mb-3">

                                 <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                     {{ __('customer use') }}</label>
                                 <div class="col-lg-8 d-flex align-items-center">
                                     <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                         <input class="form-check-input w-45px h-30px" name="is_customer"
                                             type="checkbox" id="is_customer" checked="checked">
                                         <label class="form-check-label" for="allowmarketing"></label>
                                     </div>
                                 </div>

                             </div>
                             <div class="row">
                                 <div class="form-group col-md-6">
                                     <label
                                         class="col-lg-4 col-form-label fw-semibold fs-6">{{ __('from') }}</label>

                                     <input type="date" class="form-control  flatpickr-input"
                                         placeholder="{{ __('from') }}" name="from" value="{{ old('from') }}">

                                     @if ($errors->has('from'))
                                         <p style="color: red">{{ $errors->first('from') }}
                                         </p>
                                     @endif

                                 </div>

                                 <div class="form-group col-md-6">
                                     <label class="col-lg-4 col-form-label fw-semibold fs-6">{{ __('to') }}
                                     </label>
                                     <input type="date" class="form-control flatpickr-input"
                                         placeholder="{{ __('to') }}" name="to"
                                         value="{{ old('to') }}">

                                     @if ($errors->has('to'))
                                         <p style="color: red">{{ $errors->first('to') }}
                                         </p>
                                     @endif

                                 </div>

                             </div>
                             <div class="row">
                                 <div class="form-group col-md-6">
                                     <label class="col-lg-4 col-form-label"
                                         for="validationCustom01">{{ __('Branches') }}
                                         <span class="text-danger">*</span>
                                     </label>
                                     <select class="default-select wide form-control mb-3"
                                         onchange="product(this.value)" name="branch_id" id="branch_id" required>
                                         <option value="0"> .... </option>
                                         @foreach ($branches as $branche)
                                             <option value="{{ $branche->id }}">
                                                 @if (app()->getLocale() == 'ar')
                                                     {{ $branche->name }}
                                                 @else
                                                     {{ $branche->name_en }}
                                                 @endif
                                             </option>
                                         @endforeach
                                     </select>

                                     @if ($errors->has('branch_id'))
                                         <p style="color: red">{{ $errors->first('branch_id') }}
                                         </p>
                                     @endif
                                 </div>
                                 <div class="form-group col-md-6">
                                     <label class="col-lg-4 col-form-label"
                                         for="validationCustom01">{{ __('packages') }}
                                         <span class="text-danger">*</span>
                                     </label>
                                     <select class="default-select wide form-control mb-3"
                                         onchange="product(this.value)" name="package_id" id="package_id" multiple required>
                                         <option value="0"> .... </option>
                                         @foreach ($packages as $package)
                                             <option value="{{ $package->id }}">
                                                 @if (app()->getLocale() == 'ar')
                                                     {{ $package->name }}
                                                 @else
                                                     {{ $package->name_en }}
                                                 @endif
                                             </option>
                                         @endforeach
                                     </select>

                                     @if ($errors->has('package_id'))
                                         <p style="color: red">{{ $errors->first('package_id') }}
                                         </p>
                                     @endif
                                 </div>
                             </div>
                             <div class="input-group mb-3">
                                 <button type="submit" class="btn btn-success"
                                     style="margin: 5px;">{{ __('Save_Changes') }}</button>
                                 <button type="button" onclick="clearForm()" class="btn btn-info reset-btn"
                                     style="margin: 5px;">{{ __('Clear') }}
                                 </button>
                                 <a href="{{ route('product-category.index') }}" class="m-1 btn btn-danger">
                                     <i class="fa fa-remove"></i> {{ __('Cancel') }}
                                 </a>
                             </div>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </x-default-layout>
 <script>
     // success message popup notification
     @if (Session::has('success'))
         toastr.success("{{ Session::get('success') }}");
     @endif

     // info message popup notification
     @if (Session::has('info'))
         toastr.info("{{ Session::get('info') }}");
     @endif

     // warning message popup notification
     @if (Session::has('warning'))
         toastr.warning("{{ Session::get('warning') }}");
     @endif

     // error message popup notification
     @if (Session::has('error'))
         toastr.error("{{ Session::get('error') }}");
     @endif


     function product(id) {
         $(document).ready(function() {
             $.ajax({
                 type: 'get',
                 url: "{{ route('product.ajax') }}",
                 data: {
                     'id': id
                 },
                 success: function(data) {

                     @if (app()->getLocale() == 'en')
                         $('#product_id').html(new Option(
                             '{{ __('chose product') }}',
                             '0'));
                     @else
                         $('#product_id').html(new Option('اختر منتج',
                             '0'));
                     @endif
                     for (var i = 0; i < data.length; i++) {
                         @if (app()->getLocale() == 'en')
                             $('#product_id').append(new Option(data[i].name_english, data[i]
                                 .product_id));
                         @else
                             $('#product_id').append(new Option(data[i].name, data[i].product_id));
                         @endif

                     }
                 },
                 error: function() {

                 }
             });

         });
     }
 </script>
