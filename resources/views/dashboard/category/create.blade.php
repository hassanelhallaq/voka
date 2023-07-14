 <x-default-layout>
     <div class="card card-custom">
         <div class="card-header">
             <h3 class="card-title">
                 {{ __('New_Product_Category') }}
             </h3>
         </div>
         <div class="col-lg-12 col-md-12">
             <div class="body">
                 <form method="post" id='create_form' action="{{ route('product-category.store') }}"
                     enctype="multipart/form-data">
                     @csrf
                     <div class="image-section">
                         <!--image-->
                         <center>
                             <!--begin::Image input placeholder-->
                             <style>
                                 .image-input-placeholder {
                                     background-image: url('svg/avatars/blank.svg');
                                 }

                                 [data-bs-theme="dark"] .image-input-placeholder {
                                     background-image: url('svg/avatars/blank-dark.svg');
                                 }
                             </style>
                             <!--end::Image input placeholder-->

                             <!--begin::Image input-->
                             <div class="image-input image-input-outline" data-kt-image-input="true"
                                 style="background-image: url(/assets/media/svg/avatars/blank.svg)">
                                 <!--begin::Image preview wrapper-->
                                 <div class="image-input-wrapper w-125px h-125px"
                                     style="background-image: url(/assets/media/avatars/300-1.jpg)"></div>
                                 <!--end::Image preview wrapper-->

                                 <!--begin::Edit button-->
                                 <label
                                     class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                     data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                     data-bs-dismiss="click" title="Change avatar">
                                     <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span
                                             class="path2"></span></i>

                                     <!--begin::Inputs-->
                                     <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                     <input type="hidden" name="avatar_remove" />
                                     <!--end::Inputs-->
                                 </label>
                                 <!--end::Edit button-->

                                 <!--begin::Cancel button-->
                                 <span
                                     class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                     data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                     data-bs-dismiss="click" title="Cancel avatar">
                                     <i class="ki-outline ki-cross fs-3"></i>
                                 </span>
                                 <!--end::Cancel button-->

                                 <!--begin::Remove button-->
                                 <span
                                     class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                     data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                     data-bs-dismiss="click" title="Remove avatar">
                                     <i class="ki-outline ki-cross fs-3"></i>
                                 </span>
                                 <!--end::Remove button-->
                             </div>
                             <!--end::Image input-->
                         </center>
                     </div>
                     <br>
                     <div class="row clearfix">
                         <!--category_name-->
                         <div class="form-group col-md-6">
                             <label for="basic-url" @if ($errors->has('category_name')) style="color: red" @endif>
                                 {{ __('Category_Name_Arabic') }}
                             </label>
                             <div class="input-group mb-3">

                                 <input type="text" class="form-control"
                                     placeholder="{{ __('Category_Name_Arabic') }}" name="category_name"
                                     aria-label="Username" aria-describedby="basic-addon1"
                                     @if (Session::has('category_name')) value="{{ Session::get('category_name') }}" @endif
                                     @if (!$errors->isEmpty()) value ={{ old('category_name') }} @endif>
                             </div>
                             @if ($errors->has('category_name'))
                                 <p style="color: red">{{ $errors->first('category_name') }}</p>
                             @endif
                         </div>
                         <!--category_name_english-->
                         <div class="form-group col-md-6">
                             <label for="basic-url" @if ($errors->has('category_name_english')) style="color: red" @endif>
                                 {{ __('Category_Name_English') }}
                             </label>
                             <div class="input-group mb-3">

                                 <input type="text" class="form-control"
                                     placeholder="{{ __('Category_Name_English') }}" name="category_name_english"
                                     aria-label="Username" aria-describedby="basic-addon1"
                                     @if (Session::has('category_name_english')) value="{{ Session::get('category_name_english') }}" @endif
                                     @if (!$errors->isEmpty()) value ={{ old('category_name_english') }} @endif>
                             </div>
                             @if ($errors->has('category_name_english'))
                                 <p style="color: red">{{ $errors->first('category_name_english') }}</p>
                             @endif
                         </div>
                     </div>
                     <div class="row clearfix">
                         <!--category_order-->
                         <div class="form-group col-md-6">
                             <label for="basic-url" @if ($errors->has('category_order')) style="color: red" @endif>
                                 {{ __('Sort') }}
                             </label>
                             <div class="input-group mb-3">

                                 <input type="number" class="form-control" placeholder="{{ __('Sort') }}"
                                     name="category_order" aria-label="Username" aria-describedby="basic-addon1"
                                     @if (Session::has('category_order')) value="{{ Session::get('category_order') }}" @endif
                                     @if (!$errors->isEmpty()) value ={{ old('category_order') }} @endif
                                     @if ($errors->has('category_order')) style="border: 1px solid red" @endif>
                             </div>
                             @if ($errors->has('category_order'))
                                 <p style="color: red">{{ $errors->first('category_order') }}</p>
                             @endif
                         </div>

                         <!--category_status-->
                         <div class="form-group col-md-6">
                             <label for="basic-url" @if ($errors->has('category_status')) style="color: red" @endif>
                                 {{ __('Category_Status') }}
                             </label>
                             <div class="input-group mb-3">

                                 <select class="form-select" data-control="select2" name="category_status"
                                     @if ($errors->has('category_status')) style="border: 1px solid red" @endif>
                                     <option selected>{{ __('Choose_Category_Status') }}...</option>
                                     <option value="1"
                                         @if (Session::get('category_status') == '1') selected="selected" @endif
                                         @if (old('category_status') == '1') selected="selected" @endif>
                                         {{ __('Active') }}
                                     </option>
                                     <option value="0"
                                         @if (Session::get('category_status') == '0') selected="selected" @endif
                                         @if (old('category_status') == '0') selected="selected" @endif>
                                         {{ __('Deactive') }}
                                     </option>
                                 </select>
                             </div>
                             @if ($errors->has('category_status'))
                                 <p style="color: red">{{ $errors->first('category_status') }}</p>
                             @endif
                         </div>
                     </div>
                     <div class="input-group mb-3">
                         <input type="submit" name="Save Changes" class="btn btn-success"
                             value="{{ __('Save_Changes') }}" style="margin: 5px;">
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
 </script>
