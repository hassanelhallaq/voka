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

                         <th>الفرع</th>
                         <th>التاريخ</th>
                         <th>الشفت</th>
                         <th>الكاش</th>
                         <th>مكينة الدفع</th>
                         <th>دفع الكتروني
                         </th>
                         <th>الرصيد</th>
                         <th>الحالة</th>
                         <th>الاعدادات</th>

                     </tr>
                 </thead>

                 <tbody>
                     @foreach ($cashers as $casher)
                         <tr>
                             <td>
                                 {{ $casher->branch->name }}
                             </td>
                             <td>
                                 {{ $casher->date }}
                             </td>

                             <td>
                                 {{ $casher->shift_type }}
                             </td>
                             <td>
                                 {{ $casher->cash }}
                             </td>
                             <td>
                                 {{ $casher->credit }}
                             </td>
                             <td>
                                 {{ $casher->online }}
                             </td>
                             <td>
                                 {{ $casher->point }}
                             </td>
                             <td>
                                 @if ($casher->status == 'underreview')
                                     قيد المراجعه
                                 @else
                                     تم المراجعة
                                 @endif
                             </td>
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
