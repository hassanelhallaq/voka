 <x-default-layout>

     <div class="card card-custom">
         <div class="card-header flex-wrap border-0 pt-6 pb-0">
             <div class="card-title">
                 <h3 class="card-label"> {{ __('accounts') }}
                     <span class="d-block text-muted pt-2 font-size-sm"> </span>
                 </h3>
             </div>
             {{-- @can('create-admins') --}}
             <div class="card-toolbar">
                 <!--begin::Dropdown-->
                 <a data-bs-toggle="modal" data-bs-target="#account" class="btn btn-primary font-weight-bolder">
                     <i class="la la-plus"></i>
                     {{ __('create') }}
                 </a>
                 <!--end::Button-->
             </div>
             {{-- @endcan --}}
         </div>
         <div class="card-body">
             <!--begin: Datatable-->
             <table class="table table-separate table-head-custom table-checkable" id="kt_datatable_2">
                 <thead>

                     <tr>


                         <th>{{ __('Email') }}</th>
                         <th>{{ __('Role') }}</th>

                         <th>{{ __('Settings') }}</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($users as $user)
                         <tr>
                             <td>{{ $user->email }}</td>
                             <td>
                                 {{ $user->getRoleNames() }}
                             </td>

                             {{-- <td>
                                 @if ($admin->status == 'active')
                                     {{ __('Active') }}
                                 @elseif ($admin->status == 'deactive')
                                     {{ __('Deactive') }}
                                 @endif
                             </td> --}}
                             <td>
                                 <div class="btn-group">
                                     {{-- @can('edit-admin') --}}
                                     {{-- <a href="" class="btn btn-primary mr-2" title="Edit Informations"> <i
                                            class="fas fa-edit"></i> </a> --}}
                                     {{-- @endcan --}}
                                     <a href="#" onclick="performDestroy({{ $user->id }}, this)"
                                         class="btn btn-danger mr-2">
                                         <i class="fas fa-trash"></i>
                                     </a>

                                 </div>
                             </td>
                         </tr>
                     @endforeach
                 </tbody>
             </table>
             <span class="span">
                 {!! $users->links() !!}
             </span>
             <!--end: Datatable-->
         </div>
     </div>
     <div class="modal fade" id="account" tabindex="-1" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered mw-750px">
             <div class="modal-content">
                 <div class="modal-header">

                 </div>
                 <!--end::Modal header-->
                 <!--begin::Modal body-->
                 <div class="modal-body scroll-y mx-lg-5 my-7">
                     <!--begin::Form-->
                     <form id="kt_modal_add_role_form" class="form"
                         action="{{ route('branch-account.store', ['id' => $id]) }}" method="POST">
                         @csrf
                         <!--begin::Scroll-->
                         <div class="d-flex flex-column scroll-y me-n7 pe-7">
                             <div class="row">
                                 <div class="form-group col-md-12">
                                     <label>{{ __('Roles') }}:</label>
                                     <select class="form-control form-control-solid" name="role_id" id="role_id">
                                         @foreach ($roles as $role)
                                             <option value="{{ $role->id }}">
                                                 {{ $role->name }}</option>
                                         @endforeach
                                     </select>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="form-group mb-6">
                                     <label>{{ __('email') }}</label>

                                     <div class="input-group mb-3">
                                         <input type="text" class="form-control meal_price" name="email" required
                                             id='email' value="{{ old('email') }}">
                                     </div>
                                     @if ($errors->has('email'))
                                         <p style="color: red">
                                             {{ $errors->first('email') }}
                                         </p>
                                     @endif
                                 </div>
                                 <div class="form-group mb-6">
                                     <label>{{ __('password') }}</label>
                                     <div class="input-group mb-3">
                                         <input type="password" class="form-control meal_price" name="password" required
                                             id='password' value="{{ old('password') }}">
                                     </div>
                                     @if ($errors->has('password'))
                                         <p style="color: red">
                                             {{ $errors->first('password') }}
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
                             <button type="submit" class="btn btn-primary" data-kt-roles-modal-action="submit">
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



 </x-default-layout>
 <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>

 <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

 <script src="{{ asset('crudjs/crud.js') }}"></script>
 <script>
     function performDestroy(id, reference) {

         let url = '/admin/branch-account/' + id;

         confirmDestroy(url, reference);

     }
 </script>
