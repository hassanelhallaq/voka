 <x-default-layout>

     <div class="card card-custom">
         <div class="card-header flex-wrap border-0 pt-6 pb-0">
             <div class="card-title">
                 <h3 class="card-label"> {{ __('accounts') }}
                     <span class="d-block text-muted pt-2 font-size-sm"> </span>
                 </h3>
             </div>
             {{-- @can('create-admins') --}}

             {{-- @endcan --}}
         </div>
         <div class="card-body">
             <!--begin: Datatable-->
             <table class="table table-separate table-head-custom table-checkable" id="kt_datatable_2">
                 <thead>

                     <tr>

                         <th>{{ __('name') }}</th>
                         <th>{{ __('phone') }}</th>
                         <th>{{ __('Role') }}</th>

                         <th>{{ __('Settings') }}</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($users as $user)
                         <tr>
                             <td>{{ $user->name }}</td>
                             <td>{{ $user->phone }}</td>
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
