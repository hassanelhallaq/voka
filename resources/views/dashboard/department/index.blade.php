        <x-default-layout>
            <a data-bs-toggle="modal" data-bs-target="#category" class="btn btn-sm fw-bold btn-primary"
                data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">{{ __('Create') }}</a>
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
                                    {{ __('departments') }}</h1>

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
                                                <th>{{ __('name') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">

                                            @foreach ($categories as $item)
                                                <tr>
                                                    <td>
                                                        {{ $item->name }}
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-icon btn-sm btn-success"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#category_{{ $item->id }}">
                                                            <i class="fa fa-edit"></i></a>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="category_{{ $item->id }}" tabindex="-1"
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
                                                                                <label>{{ __('Name') }}</label>

                                                                                <div class="input-group mb-3">
                                                                                    <input type="text"
                                                                                        class="form-control meal_price"
                                                                                        name="name" required
                                                                                        id='name_{{ $item->id }}'
                                                                                        value="{{ $item->name }}">
                                                                                </div>
                                                                                @if ($errors->has('name'))
                                                                                    <p style="color: red">
                                                                                        {{ $errors->first('name') }}
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
                                                                        <button
                                                                            onclick="performUpdate({{ $item->id }})"
                                                                            type="button" class="btn btn-primary">
                                                                            {{ __('Submit') }}
                                                                        </button>
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
                                            {!! $categories->links() !!}
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

            <div class="modal fade" id="category" tabindex="-1" aria-hidden="true">
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
                                            <label>{{ __('Name') }}</label>

                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control meal_price" name="name"
                                                    required id='name' value="{{ old('name') }}">
                                            </div>
                                            @if ($errors->has('name'))
                                                <p style="color: red">
                                                    {{ $errors->first('name') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!--end::Scroll-->
                                <!--begin::Actions-->
                                <div class="text-center pt-15">
                                    <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal"
                                        data-kt-roles-modal-action="cancel">
                                        {{ __('Discard') }}</button>
                                    <button onclick="performStore()" type="button" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
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
        </x-default-layout>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="{{ asset('crudjs/crud.js') }}"></script>
        <script>
            function performStore() {
                let formData = new FormData();
                formData.append('name', document.getElementById('name').value);
                storeReload('/admin/departments', formData)
            }
        </script>
        <script>
            function performUpdate(id) {
                let formData = new FormData();
                formData.append("_method", "PUT")
                formData.append('name', document.getElementById('name_' + id).value);
                storeReload('/admin/departments/' + id, formData)
            }
        </script>
