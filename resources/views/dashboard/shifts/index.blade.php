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
                                    {{ __('shifts') }}</h1>

                            </div>

                            <div class="d-flex align-items-center gap-2 gap-lg-3">
                                <!--begin::Filter menu-->


                            </div>
                            <!--end::Actions-->
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
                                                <th>{{ __('day') }}</th>
                                                <th>{{ __('start time') }}</th>
                                                <th>{{ __('end time') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">

                                            @foreach ($shifts as $item)
                                                <tr>
                                                    <td>
                                                        {{ $item->date }}
                                                    </td>
                                                    <td>
                                                        {{ $item->start_time }}
                                                    </td>
                                                    <td>
                                                        {{ $item->end_time }}
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <span class="span">
                                            {!! $shifts->links() !!}
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
