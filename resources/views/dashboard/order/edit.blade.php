 <x-default-layout>
     <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
         <div class="container">
             <div class="card">
                 <div class="card-header">
                     <h4 class="card-title"> {{ __('packages') }}</h4>
                 </div>
                 <div class="card-body">
                     <div class="form-validation">
                         <form method="post" action="" class="needs-validation" enctype="multipart/form-data">
                             @method('PUT')
                             @csrf
                             <div class="row">
                                 <div class="form-group col-md-6">
                                     <label class="col-lg-4 col-form-label" for="validationCustom01">
                                         {{ __('Date') }}
                                         <span class="text-danger">*</span>
                                     </label>

                                     <input type="datetime-local" value="{{ $reservation->date }}"
                                         class="form-control mb-3" id="date" name="date"
                                         placeholder="{{ __('Date') }}" required>

                                     @if ($errors->has('date'))
                                         <p style="color: red">{{ $errors->first('date') }}
                                         </p>
                                     @endif

                                 </div>
                                 <div class="form-group col-md-6">
                                     <label class="col-lg-4 col-form-label" for="validationCustom01">
                                         {{ __('price') }}
                                         <span class="text-danger">*</span>
                                     </label>

                                     <input type="text" value="{{ $reservation->price }}" class="form-control mb-3"
                                         id="price" name="price" placeholder="{{ __('price') }}" required>

                                     @if ($errors->has('price'))
                                         <p style="color: red">{{ $errors->first('price') }}
                                         </p>
                                     @endif

                                 </div>
                             </div>
                             <div class="row">
                                 <div class="form-group col-md-6">
                                     <label class="col-lg-4 col-form-label"
                                         for="validationCustom01">{{ __('Packages') }}
                                         <span class="text-danger">*</span>
                                     </label>
                                     <select class="default-select wide form-control mb-3" onchange="table(this.value)""
                                         name="branch_id" id="branch_id" required>
                                         <option value="0"> .... </option>
                                         @foreach ($packages as $package)
                                             <option @if ($reservation->package_id == $package->id) selected @endif
                                                 value="{{ $package->id }}">
                                                 @if (app()->getLocale() == 'ar')
                                                     {{ $package->name }}
                                                 @else
                                                     {{ $package->name_en }}
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
                                         <option value="{{ $reservation->table_id }}" disabled="true">
                                             {{ $reservation->table->name }}
                                         </option>
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
                                         {{ __('time') }}
                                         <span class="text-danger">*</span>
                                     </label>
                                     <input type="number" class="form-control mb-3" id="time"
                                         value="{{ $reservation->time }}" name="time" required>

                                     @if ($errors->has('time'))
                                         <p style="color: red">{{ $errors->first('time') }}
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
                 url: "{{ route('table.available') }}",
                 data: {
                     'id': id,
                     'date': document.getElementById('date').value
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
