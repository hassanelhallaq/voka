 <x-default-layout>


     <div class="card card-custom">



         <div class="card-header">

             <h3 class="card-title">

                 Add Admin

             </h3>

             <div class="card-toolbar">

                 <div class="example-tools justify-content-center">

                     <span class="example-toggle" data-toggle="tooltip" title="View code"></span>

                     <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>

                 </div>

             </div>

         </div>



         <form class="form" method="post" id='create_form'>

             @csrf

             <div class="card-body">

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



                 <div class="row">

                     <div class="form-group col-md-6">

                         <label>{{ __('Name') }}:</label>

                         <input type="text" id="first_name" class="form-control form-control-solid"
                             placeholder="First Name" />

                     </div>

                     <div class="form-group col-md-6">

                         <label>{{ __('Email') }}:</label>

                         <input type="email" id="email" class="form-control form-control-solid"
                             placeholder="Email" />

                     </div>

                 </div>



                 <div class="row">



                     <div class="form-group col-md-6">

                         <label>{{ __('Password') }}:</label>

                         <input type="password" id="password" class="form-control form-control-solid"
                             placeholder="Password" />

                     </div>

                 </div>



                 <div class="row">

                     <div class="form-group col-md-6">

                         <label>{{ __('Mobile') }}</label>

                         <input type="number" id="mobile" class="form-control form-control-solid"
                             placeholder="Mobile" />

                     </div>

                     <div class="form-group col-md-6">
                         <label> {{ __('Status') }} </label>
                         <select class="form-control form-control-solid" name="status" id="status">
                             <option value="active">{{ __('Active') }}</option>
                             <option value="deactive">{{ __('Deactive') }}</option>
                         </select>
                     </div>

                 </div>
             </div>
             <div class="card-footer">

                 <button type="button" onclick="performStore()"
                     class="btn btn-primary mr-2">{{ __('Submit') }}</button>
                 <a href="{{ route('admins.index') }}"><button type="button"
                         class="btn btn-primary mr-2">{{ __('Cancel') }}</button></a>
             </div>

     </div>

     </form>




 </x-default-layout>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>

 <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

 <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

 <script src="{{ asset('crudjs/crud.js') }}"></script>


 <script>
     $(document).ready(function(e) {
         $('#image').change(function() {
             let reader = new FileReader();
             reader.onload = (e) => {
                 $('#preview-logo-before-upload').attr('src', e.target.result);
             }
             reader.readAsDataURL(this.files[0]);
         });
     });


     function performStore() {

         let formData = new FormData();
         formData.append('role_id', document.getElementById('role_id').value);
         formData.append('first_name', document.getElementById('first_name').value);
         formData.append('email', document.getElementById('email').value);
         formData.append('password', document.getElementById('password').value);
         formData.append('mobile', document.getElementById('mobile').value);
         formData.append('status', document.getElementById('status').value);
         storeRoute('/dashboard/admin/admins', formData)
     }
 </script>
