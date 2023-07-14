 <x-default-layout>
     <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
         <div class="container">
             <div class="d-flex flex-column flex-column-fluid">
                 <!--begin::Toolbar-->
                 <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                     <!--begin::Toolbar container-->
                     <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                         <!--begin::Page title-->
                         <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                             <!--begin::Title-->
                             <h1
                                 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                 {{ __('settings') }}</h1>
                             <!--end::Title-->
                             <!--begin::Breadcrumb-->
                             <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                 <!--begin::Item-->
                                 <li class="breadcrumb-item text-muted">
                                     <a href="{{ route('home') }}" class="text-muted text-hover-primary">
                                         {{ __('Home') }}</a>
                                 </li>
                                 <!--end::Item-->
                                 <!--begin::Item-->
                                 <li class="breadcrumb-item">
                                     <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                 </li>
                                 <!--end::Item-->
                                 <!--begin::Item-->
                                 <li class="breadcrumb-item text-muted"> {{ __('settings') }}</li>
                                 <!--end::Item-->
                             </ul>
                             <!--end::Breadcrumb-->
                         </div>
                         <!--end::Page title-->
                     </div>
                     <!--end::Toolbar container-->
                 </div>
                 <!--end::Toolbar-->
                 <!--begin::Content-->
                 <div id="kt_app_content" class="app-content flex-column-fluid">
                     <!--begin::Content container-->
                     <div id="kt_app_content_container" class="app-container container-xxl">
                         <!--begin::Card-->
                         <div class="card card-flush">
                             <!--begin::Card body-->
                             <div class="card-body pt-0">
                                 <!--begin::Table-->
                                 <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0"
                                     id="kt_permissions_table">
                                     <thead>
                                         <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                             <th>{{ __('Name') }}</th>
                                             <th class="text-start min-w-100px">{{ __('Status') }}</th>
                                         </tr>
                                     </thead>
                                     <tbody class="fw-semibold text-gray-600">
                                         @foreach ($settings as $item)
                                             <tr>
                                                 <td>{{ $item->name }}</td>
                                                 <td>
                                                     <div
                                                         class="form-check form-check-solid form-switch form-check-custom fv-row ">
                                                         <input class="form-check-input toggle-switch w-45px h-30px"
                                                             type="checkbox" id="{{ $item->id }}"
                                                             @if ($item->status == 'ACTIVE') checked="checked"
                                                                    value="ACTIVE"
                                                                    @else

                                                                    value="DEACTIVE" @endif>
                                                         <label class="form-check-label"></label>
                                                     </div>
                                                 </td>
                                             </tr>
                                         @endforeach
                                     </tbody>
                                 </table>
                                 <!--end::Table-->
                             </div>
                             <!--end::Card body-->
                         </div>
                         <!--end::Card-->

                     </div>
                     <!--end::Content container-->
                 </div>
                 <!--end::Content-->
             </div>
         </div>
     </div>
 </x-default-layout>

 <script>
     $.ajaxSetup({

         headers: {

             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

         }

     });

     $("input.toggle-switch").change(function() {
         var id = $(this).attr('id');
         var unit_toggle_value = $(this).attr('value');
         if (unit_toggle_value == "ACTIVE") {
             unit_toggle_value = "DEACTIVE";
         } else {
             unit_toggle_value = 'ACTIVE';
         }
         $.ajax({

             url: "{{ route('setting.status') }}",
             type: "POST",
             cache: false,
             data: {
                 id: id,
                 unit_toggle_value: unit_toggle_value,
             },
             dataType: "json",
             success: function(response) {}
         });

     });
 </script>
