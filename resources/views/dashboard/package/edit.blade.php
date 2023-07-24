 <x-default-layout>
     <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
         <div class="container">
             <div class="card">
                 <div class="card-header">
                     <h4 class="card-title"> {{ __('packages') }}</h4>
                 </div>
                 <div class="card-body">
                     <div class="form-validation">
                         <form method="post" action="{{ route('packages.update', [$package->id]) }}"
                             class="needs-validation" enctype="multipart/form-data">
                             @method('PUT')
                             @csrf
                             <div class="row">
                                 <div class="form-group col-md-6">
                                     <label class="col-lg-4 col-form-label" for="validationCustom01">
                                         {{ __('name') }}
                                         <span class="text-danger">*</span>
                                     </label>

                                     <input type="text" value="{{ $package->name }}" class="form-control mb-3"
                                         id="name" name="name" placeholder="{{ __('name') }}" required>

                                     @if ($errors->has('name'))
                                         <p style="color: red">{{ $errors->first('name') }}
                                         </p>
                                     @endif

                                 </div>
                                 <div class="form-group col-md-6">
                                     <label class="col-lg-4 col-form-label" for="validationCustom01">
                                         {{ __('name_en') }}
                                         <span class="text-danger">*</span>
                                     </label>

                                     <input type="text" value="{{ $package->name_en }}" class="form-control mb-3"
                                         id="name_en" name="name_en" placeholder="{{ __('name_en') }}" required>

                                     @if ($errors->has('name_en'))
                                         <p style="color: red">{{ $errors->first('name_en') }}
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
                                     <select class="default-select wide form-control mb-3" onchange="table(this.value)"
                                         name="branch_id" id="branch_id" required>
                                         <option value="0"> .... </option>
                                         @foreach ($branches as $branche)
                                             <option @if ($package->branch_id == $branche->id) selected @endif
                                                 value="{{ $branche->id }}">
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
                                         for="validationCustom01">{{ __('tables') }}
                                         <span class="text-danger">*</span>
                                     </label>
                                     <select class="form-select" multiple data-control="select2" id="table_id" required
                                         name="table_id[]">

                                         @foreach ($tables as $table)
                                             <option
                                                 @foreach ($package->tables as $item)
                                                 @if ($table->id == $item->id)
                                                     selected @endif @endforeach
                                                 value="0" disabled="true">
                                                 {{ $table->name }}
                                             </option>
                                         @endforeach
                                     </select>
                                     @if ($errors->has('table_id'))
                                         <p style="color: red">{{ $errors->first('table_id') }}
                                         </p>
                                     @endif
                                 </div>
                             </div>
                             <div class="row">

                                 <div class="form-group col-md-6">
                                     <label class="col-lg-4 col-form-label " for="validationCustom01">
                                         {{ __('price') }}
                                         <span class="text-danger">*</span>
                                     </label>
                                     <input type="number" class="form-control mb-3" id="price"
                                         value="{{ $package->price }}" name="price" required>

                                     @if ($errors->has('price'))
                                         <p style="color: red">{{ $errors->first('price') }}
                                         </p>
                                     @endif

                                 </div>
                                 <div class="form-group col-md-6">
                                     <label class="col-lg-4 col-form-label " for="validationCustom01">
                                         {{ __('time') }}
                                         <span class="text-danger">*</span>
                                     </label>
                                     <input type="number" class="form-control mb-3" id="time"
                                         value="{{ $package->time }}" name="time" required>

                                     @if ($errors->has('time'))
                                         <p style="color: red">{{ $errors->first('time') }}
                                         </p>
                                     @endif

                                 </div>

                                 <div class="form-group col-md-6">
                                     <label class="col-lg-4 col-form-label " for="validationCustom01">
                                         {{ __('discount') }}
                                         <span class="text-danger">*</span>
                                     </label>
                                     <input type="number" class="form-control mb-3" id="discount"
                                         value="{{ $package->discount }}" name="discount" required>

                                     @if ($errors->has('discount'))
                                         <p style="color: red">{{ $errors->first('discount') }}
                                         </p>
                                     @endif

                                 </div>
                             </div>
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
                                     @if ($errors->has('avatar'))
                                         <p style="color: red">{{ $errors->first('avatar') }}
                                         </p>
                                     @endif
                                     <!--end::Image input-->
                                 </center>
                             </div>
                             <div class="row" id="schedule-container">
                                 <div class="schedule-item">
                                     <label for="day_of_week_1">{{ __('Day of the Week') }}:</label>
                                     <select name="day_of_week[]"
                                         class="default-select wide form-control mb-3 day-of-week">
                                         <option value="monday">Monday</option>
                                         <option value="tuesday">Tuesday</option>
                                         <option value="wednesday">Wednesday</option>
                                         <option value="thursday">Thursday</option>
                                         <option value="friday">Friday</option>
                                         <option value="saturday">Saturday</option>
                                         <option value="sunday">Sunday</option>
                                     </select>

                                     <label for="start_time_1"> {{ __('Start Time') }}:</label>
                                     <input class="form-control mb-3" type="time" name="start_time[]"
                                         class="start-time">

                                     <label for="end_time_1"> {{ __('End Time') }}:</label>
                                     <input class="form-control mb-3" type="time" name="end_time[]"
                                         class="end-time">
                                 </div>
                             </div>
                             <button type="button" class="btn btn-success" id="add-schedule">
                                 {{ __('Add Schedule') }}</button>


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
     $(document).ready(function() {
         var scheduleCount = 1;

         $('#add-schedule').click(function() {
             var newSchedule = $('.schedule-item:first').clone();

             // Update input names and reset values
             newSchedule.find('.day-of-week').attr('name', 'day_of_week[]');
             newSchedule.find('.start-time').attr('name', 'start_time[]');
             newSchedule.find('.end-time').attr('name', 'end_time[]');
             newSchedule.find('input').val('');

             // Append new schedule item
             $('#schedule-container').append(newSchedule);

             scheduleCount++;
         });
     });

     function table(id) {
         $(document).ready(function() {
             $.ajax({
                 type: 'get',
                 url: "{{ route('table.ajax') }}",
                 data: {
                     'id': id
                 },
                 success: function(data) {

                     @if (app()->getLocale() == 'en')
                         $('#table_id').html(new Option(
                             '{{ __('chose table') }}',
                             '0'));
                     @else
                         $('#table_id').html(new Option('اختر طاولة',
                             '0'));
                     @endif
                     for (var i = 0; i < data.length; i++) {

                         $('#table_id').append(new Option(data[i].name, data[i]
                             .id));



                     }
                 },
                 error: function() {

                 }
             });

         });
     }
 </script>
