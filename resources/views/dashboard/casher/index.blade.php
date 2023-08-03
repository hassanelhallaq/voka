 <x-default-layout>
     <!--begin::Card-->
     <div class="card card-custom">
         <div class="card-header flex-wrap border-0 pt-6 pb-0">
             <div class="card-title">
                 <h3 class="card-label"> casher
                     <span class="d-block text-muted pt-2 font-size-sm"> </span>
                 </h3>
             </div>

             <div class="card-toolbar">
                 <!--begin::Dropdown-->
                 <a href="{{ route('cashers.create') }}" class="btn btn-primary font-weight-bolder">
                     <i class="la la-plus"></i>
                     create
                 </a>
                 <!--end::Button-->


             </div>

         </div>
         <div class="col-md-12">

             <form action="" method="get" id='showStatus' class="showStatus">

                 <div class="form-group row">

                     <div class="col-lg-4 col-md-9 col-sm-12">
                         <div class="input-group date">
                             <input type="month" name="date" id="date" oninput="dateEnd()"
                                 value="{{ request()->date ?? Carbon\Carbon::now()->format('Y-m') }}"
                                 class="form-control form-control-solid">

                         </div>
                     </div>

                     <div class="col-md-1">
                         <button class="btn btn-danger btn-md" type="submit">بحث</button>
                     </div>
                 </div>

             </form>
         </div>

         <div class="card-body gallery-wrap">



             <table class="table table-separate table-head-custom table-checkable" id="kt_datatable_2">
                 <thead>

                     <tr>

                         <th>Date</th>
                         <th>is Done</th>

                     </tr>
                 </thead>

                 <tbody>
                     @foreach ($cashers as $casher)
                         <tr>

                             <td>
                                 {{ $casher->date }}
                             </td>


                             @if ($casher->is_done == 1)
                                 <td style="background-color:#00FF00">
                                     Done
                                 </td>
                             @else
                                 <td style="background-color:#FF0000">
                                     Not Done
                                 </td>
                             @endif
                             <td>
                                 <a href="{{ route('casher.edit', [$casher->id]) }}" class="btn btn-icon btn-success">
                                     <i class="flaticon-edit"></i>
                                 </a>
                                 <button onclick="performDestroy({{ $casher->id }} , this)"
                                     class="btn btn-icon btn-danger">
                                     <i class="flaticon2-delete"></i>
                                 </button>
                             </td>
                         </tr>
                     @endforeach
                 </tbody>
             </table>



         </div>
     </div>
 </x-default-layout>
 <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>

 <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

 <script src="{{ asset('crudjs/crud.js') }}"></script>
 <script>
     function performDestroy(id, reference) {

         let url = '/dashboard/admin/casher/' + id;

         confirmDestroy(url, reference);

     }
 </script>
