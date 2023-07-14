 <x-default-layout>
     <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
         <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
             <!--begin::Toolbar container-->
             <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                 <!--begin::Page title-->
                 <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                     <!--begin::Title-->
                     <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                         {{ __('Branch') }}</h1>

                 </div>

             </div>

         </div>
         <div class="container">
             <div class="card">
                 <div class="card-body">
                     <div class="form-validation">
                         <form class="needs-validation" action="{{ route('branch-account.store', ['id' => $id]) }}"
                             method="post" novalidate>
                             @csrf
                             <div class="row">
                                 <div class="form-group col-md-12">
                                     <label>{{ __('Roles') }}:</label>
                                     <select class="form-control form-control-solid" name="role_id" id="role_id">
                                         @foreach ($roles as $role)
                                             <option value="{{ $role->id }}">{{ $role->name }}</option>
                                         @endforeach
                                     </select>
                                 </div>
                             </div>
                             <br>
                             <div class="row">
                                 <div class="form-group col-md-6">
                                     <label>{{ __('Email') }} <span class="text-danger">*</span>
                                     </label>
                                     <input type="text" class="form-control mb-3" name="email"
                                         id="validationCustom01" placeholder="{{ __('Email') }}" required="">
                                     @if ($errors->has('email'))
                                         <p style="color: red">{{ $errors->first('email') }}</p>
                                     @endif
                                 </div>
                                 <div class="form-group col-md-6">
                                     <label>{{ __('password') }} <span class="text-danger">*</span>
                                     </label>
                                     <input type="text" class="form-control mb-3" name="password"
                                         id="validationCustom01" placeholder="{{ __('password') }}" required="">
                                     @if ($errors->has('password'))
                                         <p style="color: red">{{ $errors->first('password') }}</p>
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
