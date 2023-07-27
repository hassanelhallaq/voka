 <x-default-layout>
     <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
         <!--begin::Toolbar container-->
         <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
             <!--begin::Page title-->
             <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                 <!--begin::Title-->
                 <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                     {{ __('Branch') }}</h1>
                 <!--end::Title-->
             </div>
             <a type="button" class="btn btn-primary" href="{{ route('branch.create') }}">
                 {{ __('Add Branch') }}</a>
         </div>
     </div>
     <div id="kt_app_content" class="app-content flex-column-fluid">
         <div id="kt_app_content_container" class="app-container container-xxl">
             <div id="kt_project_users_card_pane" class="tab-pane fade show active">
                 <!--begin::Row-->
                 <div class="row g-6 g-xl-9">
                     @foreach ($branches as $branch)
                         <div class="col-md-6 col-xxl-4">
                             <div class="card">
                                 <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                                     <!--begin::Avatar-->
                                     <div class="symbol symbol-65px symbol-circle mb-5">
                                         <img src="{{ asset('/voka.jpg') }}" alt="image" />
                                     </div>
                                     <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0">
                                         @if (app()->getLocale() == 'ar')
                                             {{ $branch->name }}
                                         @else
                                             {{ $branch->name_en }}
                                         @endif
                                     </a>
                                     <div class="d-flex flex-center flex-wrap">
                                         <div
                                             class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                             <div class="fs-6 fw-bold text-gray-700"> {{ $branch->lounges_count }}</div>
                                             <div class="fw-semibold text-gray-400">
                                                 {{ __('lounges') }}
                                             </div>
                                         </div>
                                         <div
                                             class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                             <div class="fs-6 fw-bold text-gray-700"> {{ $branch->tables_count }}</div>
                                             <div class="fw-semibold text-gray-400"> {{ __('tables') }}</div>
                                         </div>

                                         <div
                                             class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                             <div class="fs-6 fw-bold text-gray-700">
                                                 {{ $branch->reservations->sum('price') }}</div>
                                             <div class="fw-semibold text-gray-400"> {{ __('branch incomes') }}</div>
                                         </div>
                                     </div>
                                     <div class="body text-center">
                                         <a class="btn btn-warning btn-sm" class="text-white"
                                             href="{{ route('branch.edit', [$branch->id]) }}">
                                             {{ __('Edit') }}</a>
                                         <a class="btn btn-danger btn-sm" class="text-white" href="">
                                             {{ __('Delete') }}</a>
                                         <a class="btn btn-primary btn-sm" class="text-white"
                                             href="{{ route('lounge.index', ['id' => $branch->id]) }}">
                                             {{ __('lounge') }}</a>
                                         <a class="btn btn-info btn-sm"
                                             href="{{ route('branch-account.create', ['id' => $branch->id]) }}"
                                             class="text-white">
                                             {{ __('accounts') }}</a>
                                               <a class="btn btn-info btn-sm"
                                             href="{{ route('branch-account.create', ['id' => $branch->id]) }}"
                                             class="text-white">
                                             {{ __('reports') }}</a>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     @endforeach
                 </div>
             </div>

         </div>
     </div>

 </x-default-layout>
