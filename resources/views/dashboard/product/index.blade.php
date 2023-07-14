 <x-default-layout>
     <style>
         .display-none {
             display: none;
         }

         .cursor-pointer {
             cursor: pointer;
         }

         table {
             table-layout: fixed;
             overflow: hidden;
             border-spacing: 10px;
         }

         table,
         tr,
         td {
             width: 100%;
         }

         .inline-item-input {
             width: 60px;
         }

         .card-header {
             padding: 1.1rem 2.25rem;
         }

         .cards-container {
             display: grid;
             overflow: hidden;
             grid-template-columns: repeat(4, 1fr);
             grid-auto-rows: 1fr;
             grid-column-gap: 5px;
             grid-row-gap: 5px;
         }

         .popup-cards-container {
             display: grid;
             overflow: hidden;
             grid-template-columns: repeat(2, 1fr);
             grid-auto-rows: 1fr;
             grid-column-gap: 5px;
             grid-row-gap: 5px;
         }

         table th {
             color: white;
         }


         @media screen and (max-width: 480px) {
             .only-desktop {
                 display: none;
             }

             .cards-container {
                 grid-template-columns: repeat(2, 1fr);
             }

             .products-list-container {
                 padding-left: 0 !important;
                 padding-right: 0 !important;
             }

             .card-header {
                 padding: 10px;
             }
         }

         .show-product-quick-info {
             top: 0;
         }

         .quick-actions {
             font-size: 11px;
         }
     </style>
     <div class="card card-custom">
         @if ($errors->any())
             <div class="alert alert-danger" role="alert">
                 <ul>
                     @foreach ($errors->all() as $error)
                         <li>{{ $error }}</li>
                     @endforeach
                 </ul>
             </div>
         @endif
         @if (session()->has('message'))
             <div class="alert {{ session()->get('status') }} alert-dismissible fade show" role="alert">
                 {!! Session::get('message') !!}
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
         @endif
         <div class="col-md-12 col-sm-12 text-right hidden-xs text-center my-4">


             <a href="{{ route('product-category.create') }}" class="btn btn-success">
                 <i class="fa fa-plus"></i> {{ __('New Category') }}
             </a>

         </div>


     </div>
     <style>
         .slick-slide {
             float: right;
             display: inline-block;
         }

         .slick-arrow {
             width: 25px;
             height: 25px;
             border-radius: 100%;
             background: rgba(196, 196, 196, 0.493);
             display: flex;
             align-items: center;
             justify-content: center;
             cursor: pointer;
             border: 1px solid #cfcfcf;
         }

         .slick-arrow i {
             font-size: 15px;
             color: white;
         }

         .slick-arrow:hover {
             background-color: rgba(112, 112, 112, 0.493);
         }

         .slick-prev.slick-arrow {
             position: absolute;
             right: 0;
             top: 40%;
             z-index: 10;
         }

         .slick-next.slick-arrow {
             position: absolute;
             left: 0;
             top: 40%;
             z-index: 10;
             right: auto;
         }
     </style>


     <div class="card card-custom">
         <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700 products-list-container">

             <div class="body">

                 <div class="table-responsive">

                     @foreach ($product_categories as $one_product_category)
                         <table class="table table-hover js-basic-example dataTable table-custom spacing5"
                             width="100%">
                             <thead style="background-color: #474646">

                                 <tr>
                                     <th class="main" id={{ $one_product_category->category_id }}>
                                         {{-- <div> --}}

                                         <h5 class="text-light">
                                             @if (app()->getLocale() == 'en')
                                                 {{ $one_product_category->category_name_english }}
                                             @elseif(app()->getLocale() == 'ar')
                                                 {{ $one_product_category->category_name }}
                                             @endif
                                         </h5>
                                     </th>
                                     <th class="only-desktop text-light">{{ __('Product_Price') }}
                                     </th>
                                     <th class="only-desktop text-light">{{ __('Product_Calories') }}</th>
                                     <th class="only-desktop text-light"></th>
                                     <th class="pr-5">
                                         <div class="d-flex justify-content-end">

                                             <div class="switch text-light">
                                                 @if ($one_product_category->category_status == 1)
                                                     On
                                                 @else
                                                     Off
                                                 @endif
                                                 <div
                                                     class="form-check form-check-solid form-switch form-check-custom fv-row ">
                                                     <input class="form-check-input toggle-switch w-45px h-30px"
                                                         type="checkbox" id="{{ $one_product_category->category_id }}"
                                                         @if ($one_product_category->category_status == '1') checked="checked"
                                                                    value="1"
                                                                    @else
                                                                    value="0" @endif>
                                                     <label class="form-check-label"></label>
                                                 </div>
                                             </div>&nbsp;&nbsp;
                                             <a href="{{ url('admin/products/create?category_id=' . $one_product_category->category_id) }}"
                                                 class="btn btn-icon btn-sm btn-success">
                                                 <i class="fa fa-plus"></i>
                                             </a>&nbsp;&nbsp;
                                             <a href="{{ route('product-category.edit', [$one_product_category->category_id]) }}"
                                                 class="btn btn-icon btn-sm btn-primary">
                                                 <i class="fa fa-edit"></i>
                                             </a>&nbsp;&nbsp;

                                             <a class="btn btn-icon btn-sm btn-danger" data-bs-toggle="modal"
                                                 data-bs-target="#delete_model_{{ $one_product_category->category_id }}">
                                                 <i class="fa fa-trash"></i>
                                             </a>&nbsp;&nbsp;
                                         </div>

                                     </th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($one_product_category->product as $product)
                                     <tr>
                                         {{-- <th>{{$i +1}}</th> --}}
                                         @if ($product != null)
                                             <td>

                                                 <img src="{{ $product->getFirstMediaUrl('product', 'thumb') }}"
                                                     style="width: 20px;height: 30px">

                                                 {{-- src="{{url('/upload/2.png')}}" --}}
                                                 @if (app()->getLocale() == 'en')
                                                     {{ $product->name_english ?? '' }}
                                                 @elseif(app()->getLocale() == 'ar')
                                                     {{ $product->name ?? '' }}
                                                 @endif
                                                 <div class="quick-actions py-3 position-relative">
                                                     <div
                                                         class="show-product-quick-info cursor-pointer text-left display-none position-absolute">
                                                         |<span class="mx-2"><a
                                                                 href="{{ route('products.edit', [$product->product_id]) }}">{{ __('Edit') }}</a></span>
                                                         |<span class="quick-edit-toggler font-weight-bold mx-2">
                                                             {{ __('Quick edit') }}
                                                         </span>
                                                     </div>
                                                 </div>
                                             </td>
                                         @endif

                                         <td class="only-desktop">
                                             <div class="inline-item-edit d-flex align-items-center">
                                                 <span class="inline-item-value">{{ $product->price ?? '' }}</span>
                                                 <form class="inline-item-form display-none w-auto">
                                                     <input type="number" class="inline-item-input"
                                                         value='{{ $product->price ?? '' }}' data-field-name="price"
                                                         name="price" />
                                                     <input type="hidden" value="{{ $product->product_id }}"
                                                         class="product_id" />

                                                     <input type="submit" value="Done"
                                                         class="inline-item-form-submit w-auto" />
                                                 </form>
                                                 <button
                                                     class="btn btn-secondary inline-item-edit-button px-2 py-1 ml-1">{{ __('Edit') }}</button>
                                             </div>
                                         </td>
                                         <td class="only-desktop">
                                             <div class="inline-item-edit d-flex align-items-center">
                                                 <span class="inline-item-value">{{ $product->calories ?? '' }}</span>
                                                 <form class="inline-item-form display-none w-auto">
                                                     <input type="number" class="inline-item-input"
                                                         value='{{ $product->calories ?? '' }}'
                                                         data-field-name="calories" name="slae_price" />
                                                     <input type="hidden" value="{{ $product->product_id }}"
                                                         class="product_id" />

                                                     <input type="submit" value="Done"
                                                         class="inline-item-form-submit w-auto" />
                                                 </form>
                                                 <button
                                                     class="btn btn-secondary inline-item-edit-button px-2 py-1 ml-1">{{ __('Edit') }}</button>
                                             </div>
                                         </td>
                                         <td class="only-desktop">
                                             {{-- <label>Sold out</label> --}}
                                         </td>


                                         @if ($product != null)
                                             <td class="pr-5">
                                                 <div class="d-flex justify-content-end">
                                                     <div class="switch">
                                                         @if ($product->status == 1)
                                                             On
                                                         @else
                                                             Off
                                                         @endif
                                                         <label>
                                                             <div
                                                                 class="form-check form-check-solid form-switch form-check-custom fv-row ">
                                                                 <input
                                                                     class="form-check-input toggle-switch w-45px h-30px"
                                                                     type="checkbox" id="{{ $product->product_id }}"
                                                                     @if ($product->status == '1') checked="checked"
                                                                    value="1"
                                                                    @else
                                                                    value="0" @endif>
                                                                 <label class="form-check-label"></label>
                                                             </div>
                                                             <span> </span>
                                                         </label>
                                                     </div>&nbsp;&nbsp;

                                                     {{-- <a href="javascript:void(0)" data-href-url=""
                                                         class="btn productOptions btn-success btn-sm btn-icon">
                                                         <i class="fa fa-plus"></i></a>&nbsp;&nbsp; --}}

                                                     <a class="btn btn-icon btn-sm btn-primary"
                                                         href="{{ route('products.edit', [$product->product_id]) }}">
                                                         <i class="fa fa-edit"></i>
                                                     </a>&nbsp;&nbsp;

                                                     <a class="btn  btn-icon btn-sm btn-danger" data-bs-toggle="modal"
                                                         data-bs-target="#delete_model_product_{{ $product->product_id }}">
                                                         <i class="fa fa-trash"></i></a>
                                                     &nbsp;&nbsp;
                                                 </div>

                                                 <div class="modal fade"
                                                     id="delete_model_product_{{ $product->product_id }}"
                                                     tabindex="-1" aria-hidden="true" role="dialog"
                                                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                     <div class="modal-dialog modal-dialog-centered" role="document">
                                                         <div class="modal-content">
                                                             <div class="modal-header">
                                                                 <h5 class="modal-title" id="exampleModalCenterTitle">
                                                                     @if (app()->getLocale() == 'en')
                                                                         {{ $product->name_english }}
                                                                     @elseif(app()->getLocale() == 'ar')
                                                                         {{ $product->name }}
                                                                     @endif
                                                                 </h5>
                                                                 <button type="button" class="close"
                                                                     data-dismiss="modal" aria-label="Close">
                                                                     <span aria-hidden="true">&times;</span>
                                                                 </button>
                                                             </div>
                                                             <div class="modal-body" style="text-align: center;">
                                                                 <h1>
                                                                     <i class="fa fa-exclamation"></i>
                                                                 </h1>
                                                                 <h2>{{ __('Are you sure?') }}</h2>
                                                                 <p> {{ __('You Will Not Be Able To Recover This Item Again?') }}
                                                                 </p>
                                                             </div>
                                                             <div class="modal-footer">
                                                                 <button type="button"
                                                                     class="btn btn-round btn-default"
                                                                     data-dismiss="modal">
                                                                     {{ __('No, cancel!') }}
                                                                 </button>
                                                                 <a href="{{ route('products.destroy', [$product->product_id]) }}"
                                                                     class="btn btn-round btn-danger">{{ __('Yes, delete it!') }}</a>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>

                                             </td>
                                         @endif
                                     </tr>
                                     <tr class="display-none  product-quick-info bg-light rounded">

                                         <td colspan="5" width="100%">
                                             <div class="row">
                                                 <div class="col-4">
                                                     <div class="form-group">
                                                         <label for="name_ar"> {{ __('Name AR') }}</label>
                                                         <input type="email" class="form-control" id="name_ar"
                                                             name="name_ar" aria-describedby="emailHelp"
                                                             value="{{ $product->name }}">
                                                     </div>
                                                 </div>
                                                 <div class="col-4">
                                                     <div class="form-group">
                                                         <label for="name_en">{{ __('Name EN') }}</label>
                                                         <input type="email" class="form-control" id="name_en"
                                                             value="{{ $product->name_english ?? '' }}"
                                                             name="name_en" aria-describedby="emailHelp">
                                                     </div>
                                                 </div>
                                                 <div class="col-4">
                                                     <div class="form-group">
                                                         <label for="sku">SKU</label>
                                                         <input type="text" class="form-control" id="sku"
                                                             value="{{ $product->SKU }}" name="sku"
                                                             aria-describedby="emailHelp">
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="row">
                                                 <div class="col-6">
                                                     <div class="form-group">
                                                         <label
                                                             for="description_ar">{{ __('product_Description_ar') }}</label>
                                                         <textarea class="form-control" id="description_ar" rows="3">{{ $product->description }}</textarea>
                                                     </div>
                                                 </div>
                                                 <div class="col-6">
                                                     <div class="form-group">
                                                         <label
                                                             for="description_en">{{ __('product_Description_en') }}</label>
                                                         <textarea class="form-control" id="description_en" rows="3">{{ $product->description_english }}</textarea>
                                                     </div>
                                                     <input type="text" class="form-control" id="product_id"
                                                         value="{{ $product->product_id }}" name="sku" hidden>

                                                     {{-- <button
                                                         class="w-100 btn btn-primary float-right add-new-addon mt-2"
                                                         onclick="performStore()"
                                                         data-target="#add-new-addon-modal">{{ __('Save_Changes') }}</button> --}}
                                                     <a id="create_option" href="javascript:void(0)"
                                                         class="w-100 btn btn-success">
                                                         <i class="fa fa-plus"></i> {{ __('New Options') }}
                                                     </a>
                                                 </div>
                                             </div>





                                         </td>
                                     </tr>
                                 @endforeach
                             </tbody>
                     @endforeach
                     </table>

                 </div>
             </div>
         </div>
     </div>
     @foreach ($product_categories as $one_product_category)
         <div class="modal fade" id="delete_model_{{ $one_product_category->category_id }}" tabindex="-1"
             aria-hidden="true" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
             <form method="delete" id='create_form'
                 action="{{ route('product-category.destroy', [$one_product_category->category_id]) }}"
                 enctype="multipart/form-data">
                 <div class="modal-dialog modal-dialog-centered" role="document">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalCenterTitle">
                                 @if (app()->getLocale() == 'en')
                                     {{ $one_product_category->category_name_english }}
                                 @elseif(app()->getLocale() == 'ar')
                                     {{ $one_product_category->category_name }}
                                 @endif
                             </h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                             </button>
                         </div>
                         <div class="modal-body" style="text-align: center;">
                             <h1>
                                 <i class="fa fa-exclamation"></i>
                             </h1>
                             <h2>{{ __('Are you sure?') }}</h2>
                             <p> {{ __('You Will Not Be Able To Recover This Item Again?') }}</p>
                         </div>
                         <div class="modal-footer">
                             <button type="button" class="btn btn-round btn-default" data-dismiss="modal">
                                 {{ __('No, cancel!') }}
                             </button>
                             <button type="submit"
                                 class="btn btn-round btn-danger">{{ __('Yes, delete it!') }}</button>
                         </div>
                     </div>
             </form>
         </div>
         </div>
     @endforeach

 </x-default-layout>
 <script src="{{ asset('crudjs/crud.js') }}"></script>

 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

 <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
 <script type="text/javascript">
     $("input.toggle-switch-product").change(function() {
         var product_category_id = $(this).attr('id');
         var product_category_toggle_value = $(this).attr('value');
         if (product_category_toggle_value == "1") {
             product_category_toggle_value = 0;
         } else {
             product_category_toggle_value = 1;
         }
         $.ajax({
             url: "",
             type: "POST",
             cache: false,
             data: {
                 product_category_id: product_category_id,
                 product_category_toggle_value: product_category_toggle_value,
             },
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             dataType: "json",
             success: function(response) {
                 location.reload();
             }
         });
     });


     $("input.toggle-switch").change(function() {
         var product_category_id = $(this).attr('id');
         var product_category_toggle_value = $(this).attr('value');
         if (product_category_toggle_value == "1") {
             product_category_toggle_value = 0;
         } else {
             product_category_toggle_value = 1;
         }
         $.ajax({
             url: "",
             type: "POST",
             cache: false,
             data: {
                 product_category_id: product_category_id,
                 product_category_toggle_value: product_category_toggle_value,
             },
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             dataType: "json",
             success: function(response) {
                 location.reload();
             }
         });
     });
 </script>
 <script>
     $(document).ready(function() {
         // Add smooth scrolling to all links
         $("a").on('click', function(event) {

             // Make sure this.hash has a value before overriding default behavior
             if (this.hash !== "") {
                 // Prevent default anchor click behavior
                 event.preventDefault();

                 // Store hash
                 var hash = this.hash;

                 // Using jQuery's animate() method to add smooth page scroll
                 // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
                 $('html, body').animate({
                     scrollTop: $(hash).offset().top
                 }, 800, function() {

                     // Add hash (#) to URL when done scrolling (default click behavior)
                     window.location.hash = hash;
                 });
             } // End if
         });
     });
 </script>



 <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>



 <script>
     $(function() {
         $('.show-product-quick-info').on('click', function(event) {
             var showProductQuickInfo = $(this);
             var isProductInfoVisible = $(this).closest('tr').next('tr').is(':visible');
             $(this).closest('tbody').find('tr.product-quick-info').each(function(e) {
                 if ($(this).is(':visible')) {
                     $(this).hide();
                 }
             });
             if (isProductInfoVisible) {
                 showProductQuickInfo.find('.quick-edit-toggler').text('Quick edit');
                 $(this).closest('tr').next('tr').hide();
                 // $(this).closest('tr').find('td:first-of-type').removeAttr('colspan')
             } else {
                 showProductQuickInfo.find('.quick-edit-toggler').text('Cancel');
                 $(this).closest('tr').next('tr').css('display', 'table-row');
                 // $(this).closest('tr').find('td:first-of-type').attr('colspan',4)
                 // $(this).closest('table').find('th.main').attr('colspan',4)
             }

         });

         $('.inline-item-edit').on('dblclick', function() {
             $(this).find('.inline-item-value').hide();
             $(this).find('.inline-item-form').css('display', 'inline-block');
             $(this).find('.inline-item-edit-button').hide();

         });

         $('.inline-item-edit-button').on('click', function() {
             $(this).closest('.inline-item-edit').find('.inline-item-value').hide();
             $(this).closest('.inline-item-edit').find('.inline-item-form').css('display',
                 'inline-block');
             $(this).hide();
         });
         $('.inline-item-form-submit').on('click', function(e) {
             var newInputValue = $(this).parent().find('.inline-item-input').val();
             var newInputName = $(this).parent().find('.inline-item-input').attr('data-field-name');
             var product_id = $(this).parent().find('.product_id').val();

             $(this).parent().hide();
             $(this).parent().parent().find('.inline-item-value').html(
                 newInputValue
             );
             updateFieldValue(newInputValue, newInputName, product_id);
             $(this).parent().parent().find('.inline-item-value').show();

             return false;
         });

         function updateFieldValue(fieldValue, newInputName, product_id) {

             $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                 }
             });
             $.ajax({
                 type: 'post',
                 url: "",
                 data: {
                     'value': fieldValue,
                     'id': product_id,
                     'field_name': newInputName,
                 },
                 dataType: 'json',
                 success: function(data) {
                     showMessage(data);
                     console.log(data);
                 }
             });

         }

         function showMessage(data) {
             console.log(data);
             Swal.fire({
                 position: 'center',
                 icon: data.icon,
                 title: data.title,
                 showConfirmButton: false,
                 timer: 1500
             })
         }
         $('.add-new-addon').on('click', function() {});

         $('tbody tr').on('mouseover', function(event) {
             $(this).find('.show-product-quick-info').show();
         }).on('mouseout', function(event) {
             $(this).find('.show-product-quick-info').hide();
         });

         $('#new-addon-inserter').on('click', function(event) {
             $(this).before($('#new-addon-template').html());
         });
         $(document).on('click', '.new-addon-block .close', function(event) {
             $(this).parent().remove();
         });
         if ($(window).width() < 480) {
             $('.product-quick-info>td').attr('colspan', 2);
         }

     });
 </script>
