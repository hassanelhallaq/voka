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
                                                        {{ $item->reservation->date ??'' }}
                                                    </td>
                                                    <td>
                                                        {{ $item->reservation->end ??'' }}
                                                    </td>
                                                    @if($item->reservation)
                                                    <td>
                                                        <a data-bs-toggle="modal"
                                                            data-bs-target="#time_{{ $item->id }}"
                                                            class="btn btn-sm fw-bold btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#kt_modal_create_app"><i
                                                                class="fa fa-plus"></i></a></a>
                                                        <a class="btn btn-icon btn-sm btn-success"
                                                            href="{{ route('orders.show', [$item->id]) }}">
                                                            <i class="fa fa-eye"></i></a>
                                                    </td>
                                                    @endif
                                                </tr>
                                                <div class="modal fade" id="time_{{ $item->id }}" tabindex="-1"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered mw-750px">
                                                        <div class="modal-content">
                                                            <div class="modal-body scroll-y mx-lg-5 my-7">
                                                                <!--begin::Form-->
                                                                <form id="kt_modal_add_role_form" class="form">
                                                                    @csrf
                                                                    <!--begin::Scroll-->
                                                                    <div class="d-flex flex-column scroll-y me-n7 pe-7">
                                                                        <div class="row">
                                                                            <div class="form-group mb-6">
                                                                                <label>{{ __('time') }}</label>
                                                                                     @if($item->reservation)
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text"
                                                                                        class="form-control meal_price"
                                                                                        name="time" required
                                                                                        id='time_{{ $item->reservation->id }}'
                                                                                        value="{{ old('time') }}">
                                                                                </div>
                                                                                @endif
                                                                                @if ($errors->has('time'))
                                                                                    <p style="color: red">
                                                                                        {{ $errors->first('time') }}
                                                                                    </p>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Scroll-->
                                                                    <!--begin::Actions-->
                                                                    <div class="text-center pt-15">
                                                                        <button type="reset"
                                                                            class="btn btn-light me-3"
                                                                            data-bs-dismiss="modal"
                                                                            data-kt-roles-modal-action="cancel">
                                                                            {{ __('Discard') }}</button>
                                                                            @if($item->reservation)
                                                                        <button
                                                                            onclick="performUpdate({{ $item->reservation->id }})"
                                                                            type="button" class="btn btn-primary">
                                                                            {{ __('Submit') }}
                                                                        </button>
                                                                           @endif
                                                                    </div>
                                                                    <!--end::Actions-->
                                                                </form>
                                                                <!--end::Form-->
                                                            </div>
                                                            <!--end::Modal body-->
                                                        </div>
                                                        <!--end::Modal content-->
                                                    </div>
                                                    <!--end::Modal dialog-->
                                                </div>
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
