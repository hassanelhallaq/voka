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
                                    {{ __('orders') }}</h1>

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
                                                <th>{{ __('Total orders') }}</th>
                                                <th>{{ __('reservation start') }}</th>
                                                <th>{{ __('reservation end') }}</th>

                                            </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">

                                            @foreach ($order as $item)
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

                                                    @php
                                                        $totalSum = $item->products->sum(function ($product) {
                                                            return $product->pivot->price * $product->pivot->quantity;
                                                        });
                                                    @endphp

                                                    <td> {{ $totalSum }}</td>
                                                    <td>
                                                        {{ $item->reservation->date }}
                                                    </td>
                                                    <td>
                                                        {{ $item->reservation->end }}
                                                    </td>
                                                    <td> <a class="btn btn-icon btn-sm btn-success"
                                                            href="{{ route('orders.show', [$item->id]) }}">
                                                            <i class="fa fa-eye"></i></a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <span class="span">
                                            {!! $order->links() !!}
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
