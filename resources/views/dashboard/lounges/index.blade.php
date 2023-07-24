 <x-default-layout>
     <style>
         .card-body {
             font-size: 16px;
             background-color: #f9f9f9;
         }

         .table {
             border-collapse: collapse;
             width: 100%;
             margin-bottom: 1rem;
             background-color: #ffffff;
         }

         .table th,
         .table td {
             padding: 0.75rem;
             vertical-align: middle;
             border-top: 1px solid #dee2e6;
         }

         .table th {
             background-color: #474646;
             color: #fff5f5;
             font-weight: bold;
         }

         .table th a {
             color: #fff5f5;
             text-decoration: none;
         }

         .table tbody tr:nth-of-type(even) {
             background-color: #f9f9f9;
         }

         .table td img {
             width: 50px;
             height: 50px;
         }

         .table td:last-child {
             width: 100px;
         }

         .table tbody tr:hover {
             background-color: #e6e6e6;
             cursor: pointer;
         }
     </style>

     <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
         <div class="col-md-12 col-sm-12 text-right hidden-xs text-center my-4">


             <a data-bs-toggle="modal" data-bs-target="#lounge" class="btn btn-success">
                 <i class="fa fa-plus"></i> {{ __('New lounge') }}
             </a>

         </div>
         <div class="body">

             <div class="table-responsive">
                 <table class="table table-hover js-basic-example dataTable table-custom spacing5">
                     @foreach ($lounges as $lounge)
                         <thead>
                             <tr>
                                 <th>
                                     <a>
                                         <h5 style="color: #dee2e6">&nbsp;
                                             @if (app()->getLocale() == 'en')
                                                 {{ $lounge->name_en }}
                                             @elseif(app()->getLocale() == 'ar')
                                                 {{ $lounge->name ?? '' }}
                                             @endif
                                         </h5>
                                     </a>
                                 </th>
                                 <th colspan="9"></th>
                                 <th colspan="9"></th>
                                 <th colspan="9"></th>
                                 <th>
                                     <a class="btn btn-icon btn-sm btn-success" data-bs-toggle="modal"
                                         data-bs-target="#table_{{ $lounge->id }}" data-toggle="modal" href="">
                                         <i class="fa fa-plus"></i></a>
                                 </th>
                                 <div class="modal fade" id="table_{{ $lounge->id }}" tabindex="-1"
                                     aria-hidden="true">
                                     <div class="modal-dialog modal-dialog-centered mw-750px">
                                         <div class="modal-content">
                                             <div class="modal-header">

                                             </div>
                                             <!--end::Modal header-->
                                             <!--begin::Modal body-->
                                             <div class="modal-body scroll-y mx-lg-5 my-7">
                                                 <!--begin::Form-->
                                                 <form id="kt_modal_add_role_form" class="form"
                                                     action="{{ route('tables.store', ['id' => $lounge->id]) }}"
                                                     method="POST">
                                                     @csrf
                                                     <!--begin::Scroll-->
                                                     <div class="d-flex flex-column scroll-y me-n7 pe-7">
                                                         <div class="col-lg-6">
                                                             <div class="form-group mb-6">
                                                                 <label for="basic-url">
                                                                     <small class="text-danger">*</small>
                                                                     {{ __('table number') }}
                                                                 </label>
                                                                 <div class="input-group mb-3">

                                                                     <input type="text"
                                                                         class="form-control meal_price" name="name"
                                                                         required id='name'
                                                                         value="{{ old('table number') }}">
                                                                 </div>
                                                                 @if ($errors->has('name'))
                                                                     <p style="color: red">
                                                                         {{ $errors->first('name') }}
                                                                     </p>
                                                                 @endif
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <!--end::Scroll-->
                                                     <!--begin::Actions-->
                                                     <div class="text-center pt-15">
                                                         <button type="reset" class="btn btn-light me-3"
                                                             data-bs-dismiss="modal"
                                                             data-kt-roles-modal-action="cancel">
                                                             {{ __('Discard') }}</button>
                                                         <button type="submit" class="btn btn-primary"
                                                             data-kt-roles-modal-action="submit">
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
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($lounge->tables as $tables)
                                 <tr>
                                     <td>
                                         <a href="{{ url($tables->qr) }}" download="{{ url($tables->qr) }}"
                                             class="">
                                             <img src="{{ url($tables->qr) }}" alt="QR">
                                         </a>
                                         {{ __('table number') }} &nbsp; {{ $tables->name }}
                                     </td>
                                     <td colspan="9"></td>
                                     <td colspan="9"></td>
                                     <td colspan="9"></td>
                                     <td>
                                         <div class="form-check form-check-solid form-switch form-check-custom fv-row ">
                                             <input class="form-check-input toggle-switch w-45px h-30px" type="checkbox"
                                                 data-toggle="toggle" data-on="Active" data-off="Deactive"
                                                 id="{{ $tables->id }}"
                                                 @if ($tables->status == 'available') checked="checked" value="available"
                                                @else value="in_service" @endif>
                                             <span> </span>
                                         </div>
                                         <a class="btn btn-icon btn-sm btn-success" data-bs-toggle="modal"
                                             data-bs-target="#editTable_{{ $tables->id }}" data-toggle="modal"
                                             href="">
                                             <i class="fa fa-edit"></i></a>
                                     </td>
                                 </tr>

                                 <div class="modal fade" id="editTable_{{ $tables->id }}" tabindex="-1"
                                     aria-hidden="true">
                                     <div class="modal-dialog modal-dialog-centered mw-750px">
                                         <div class="modal-content">
                                             <div class="modal-header">

                                             </div>
                                             <!--end::Modal header-->
                                             <!--begin::Modal body-->
                                             <div class="modal-body scroll-y mx-lg-5 my-7">
                                                 <!--begin::Form-->
                                                 <form id="kt_modal_add_role_form" class="form"
                                                     action="{{ route('tables.update', ['id' => $lounge->id]) }}"
                                                     method="POST">
                                                     @method('put')
                                                     @csrf
                                                     <!--begin::Scroll-->
                                                     <div class="d-flex flex-column scroll-y me-n7 pe-7">
                                                         <div class="col-lg-6">
                                                             <div class="form-group mb-6">
                                                                 <label for="basic-url">
                                                                     <small class="text-danger">*</small>
                                                                     {{ __('table number') }}
                                                                 </label>
                                                                 <div class="input-group mb-3">

                                                                     <input type="text"
                                                                         class="form-control meal_price" name="name"
                                                                         required id='name'
                                                                         value="{{ old('table number') }}">
                                                                 </div>
                                                                 @if ($errors->has('name'))
                                                                     <p style="color: red">
                                                                         {{ $errors->first('name') }}
                                                                     </p>
                                                                 @endif
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <!--end::Scroll-->
                                                     <!--begin::Actions-->
                                                     <div class="text-center pt-15">
                                                         <button type="reset" class="btn btn-light me-3"
                                                             data-bs-dismiss="modal"
                                                             data-kt-roles-modal-action="cancel">
                                                             {{ __('Discard') }}</button>
                                                         <button type="submit" class="btn btn-primary"
                                                             data-kt-roles-modal-action="submit">
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
                             @endforeach
                         </tbody>
                     @endforeach
                 </table>
             </div>
         </div>
     </div>
     <div class="modal fade" id="lounge" tabindex="-1" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered mw-750px">
             <div class="modal-content">
                 <div class="modal-header">

                 </div>
                 <!--end::Modal header-->
                 <!--begin::Modal body-->
                 <div class="modal-body scroll-y mx-lg-5 my-7">
                     <!--begin::Form-->
                     <form id="kt_modal_add_role_form" class="form"
                         action="{{ route('lounge.store', ['id' => $id]) }}" method="POST">
                         @csrf
                         <!--begin::Scroll-->
                         <div class="d-flex flex-column scroll-y me-n7 pe-7">
                             <div class="row">
                                 <div class="form-group mb-6">
                                     <label>{{ __('name') }}</label>
                                     <div class="input-group mb-3">
                                         <input type="text" class="form-control meal_price" name="name"
                                             required id='name' value="{{ old('name') }}">
                                     </div>
                                     @if ($errors->has('name'))
                                         <p style="color: red">
                                             {{ $errors->first('name') }}
                                         </p>
                                     @endif
                                 </div>
                                 <div class="form-group mb-6">
                                     <label>{{ __('name_en') }}</label>

                                     <div class="input-group mb-3">
                                         <input type="text" class="form-control meal_price" name="name_en"
                                             required id='name_en' value="{{ old('name_en') }}">
                                     </div>
                                     @if ($errors->has('name_en'))
                                         <p style="color: red">
                                             {{ $errors->first('name_en') }}
                                         </p>
                                     @endif
                                 </div>
                             </div>
                         </div>
                         <!--end::Scroll-->
                         <!--begin::Actions-->
                         <div class="text-center pt-15">
                             <button type="reset" class="btn btn-light me-3"
                                 data-kt-roles-modal-action="cancel">Discard</button>
                             <button type="submit" class="btn btn-primary" data-kt-roles-modal-action="submit">
                                 Submit
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
 </x-default-layout>
