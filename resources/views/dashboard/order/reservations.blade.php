        <x-default-layout>
            <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                <!--begin::Content wrapper-->
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
                                    {{ __('reservations') }}</h1>

                            </div>

                        </div>
                        <!--end::Toolbar container-->
                    </div>
                    <!--end::Toolbar-->
                    <!--begin::Content-->
                    <div id="kt_app_content" class="app-content flex-column-fluid">
                        <!--begin::Content container-->
                        <div id="kt_app_content_container" class="app-container container-xxl">
                            <div class="card card-flush">
                                <div class="card-body pt-0">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-dashed fs-6 gy-5"
                                        id="kt_ecommerce_report_customer_orders_table">
                                        <thead>
                                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                <th>{{ __('table') }}</th>
                                                <th>{{ __('client name') }}</th>
                                                <th>{{ __('client phone') }}</th>
                                                <th>{{ __('package name') }}</th>
                                                <th>{{ __('package time') }}</th>
                                                <th>{{ __('package price') }}</th>
                                                <th>{{ __('reservation start') }}</th>
                                                <th>{{ __('reservation end') }}</th>
                                                <th>{{ __('payment type') }}</th>
                                                <th>{{ __('time extend') }}</th>

                                            </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">

                                            @foreach ($reservations as $item)
                                                <tr>
                                                    <td>
                                                        {{ $item->table->name }}
                                                    </td>
                                                    <td>
                                                        {{ $item->client->name }}
                                                    </td>
                                                    <td>
                                                        {{ $item->client->phone }}
                                                    </td>
                                                    <td>
                                                        {{ $item->package->name }}
                                                    </td>
                                                    <td>
                                                        {{ $item->package->time }}
                                                    </td>
                                                    <td>
                                                        {{ $item->package->price }}
                                                    </td>
                                                    <td>
                                                        {{ $item->date }}
                                                    </td>
                                                    <td>
                                                        {{ $item->end }}
                                                    </td>
                                                    <td>
                                                        {{ $item->payment_type }}
                                                    </td>
                                                    <td>
                                                        {{ $item->extend_time == 1 ? 'تمديد اداري' : 'لا يوجد تمديد' }}
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-icon btn-sm btn-success"
                                                            href="{{ route('reservations.now.edit', [$item->id]) }}">
                                                            <i class="fa fa-eye"></i></a>
                                                        <a class="btn btn-icon btn-sm btn-success"
                                                            href="{{ route('backReservation', [$item->id]) }}">
                                                            <i class="fa fa-undo" aria-hidden="true"></i>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <span class="span">
                                            {!! $reservations->links() !!}
                                        </span>
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Products-->
                        </div>
                        <!--end::Content container-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Content wrapper-->
                <!--begin::Footer-->

                <!--end::Footer-->
            </div>
        </x-default-layout>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="{{ asset('crudjs/crud.js') }}"></script>
        <script>
            function performUpdate(id) {
                let formData = new FormData();
                formData.append("_method", "PUT")
                formData.append('time', document.getElementById('time_' + id).value);
                storeReload('/admin/update-reservation-time/' + id, formData)
            }
        </script>
