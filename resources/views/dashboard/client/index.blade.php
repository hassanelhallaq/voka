        <x-default-layout>
            <div id="kt_app_content_container" class="app-container container-xxl">
                <a data-bs-toggle="modal" data-bs-target="#clients" class="btn btn-sm fw-bold btn-primary"
                    data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">{{ __('Create') }}</a>
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <!--begin::Content container-->

                    @foreach ($clients as $item)
                        <div class="card mb-5 mb-xxl-8">
                            <div class="card-body pt-9 pb-0">
                                <!--begin::Details-->
                                <div class="d-flex flex-wrap flex-sm-nowrap">
                                    <!--begin: Pic-->
                                    <div class="me-7 mb-4">
                                        <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                            <img src="{{ asset('assets/media/avatars/300-1.jpg') }}" alt="image" />
                                            <div
                                                class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px">
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Pic-->
                                    <!--begin::Info-->
                                    <div class="flex-grow-1">
                                        <!--begin::Title-->
                                        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                            <!--begin::User-->
                                            <div class="d-flex flex-column">
                                                <!--begin::Name-->
                                                <div class="d-flex align-items-center mb-2">
                                                    <a href="#"
                                                        class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $item->name }}</a>
                                                    <a href="#">
                                                        <i class="ki-duotone ki-verify fs-1 text-primary">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </a>
                                                </div>
                                                <!--end::Name-->
                                                <!--begin::Info-->
                                                <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">

                                                    <a href="#"
                                                        class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                                        <i class="ki-duotone ki-geolocation fs-4 me-1">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>{{ $item->phone }}</a>
                                                    <a href="#"
                                                        class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                                        <i class="ki-duotone ki-sms fs-4 me-1">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>{{ $item->email }}</a>
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                            <!--end::User-->
                                            <!--begin::Actions-->
                                            <div class="d-flex my-4">

                                                <div class="me-0">
                                                    <button
                                                        class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary"
                                                        data-kt-menu-trigger="click"
                                                        data-kt-menu-placement="bottom-end">
                                                        <i class="ki-solid ki-dots-horizontal fs-2x me-1"></i>
                                                    </button>
                                                    <!--begin::Menu 3-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3"
                                                        data-kt-menu="true">
                                                        <!--begin::Heading-->

                                                        <!--end::Heading-->
                                                        <!--begin::Menu item-->

                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">

                                                            <a href="{{ route('clients.show', [$item->id]) }}"
                                                                class="menu-link px-3">View</a>
                                                            <a data-bs-toggle="modal"
                                                                data-bs-target="#clients_{{ $item->id }}"
                                                                class="menu-link px-3">Edit</a>

                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->

                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->

                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->

                                                        <!--end::Menu item-->
                                                    </div>
                                                    <!--end::Menu 3-->
                                                </div>
                                                <!--end::Menu-->
                                            </div>
                                            <!--end::Actions-->
                                        </div>
                                        <!--end::Title-->
                                        <!--begin::Stats-->
                                        <div class="d-flex flex-wrap flex-stack">
                                            <!--begin::Wrapper-->
                                            <div class="d-flex flex-column flex-grow-1 pe-8">
                                                <!--begin::Stats-->
                                                <div class="d-flex flex-wrap">
                                                    <!--begin::Stat-->
                                                    <div
                                                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                        <!--begin::Number-->
                                                        <div class="d-flex align-items-center">
                                                            <i class="ki-duotone ki-arrow-up fs-3 text-success me-2">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i>
                                                            <div class="fs-2 fw-bold" data-kt-countup="true"
                                                                data-kt-countup-value={{ $item->packages_sum_price }}
                                                                data-kt-countup-prefix="$">0
                                                            </div>
                                                        </div>
                                                        <!--end::Number-->
                                                        <!--begin::Label-->
                                                        <div class="fw-semibold fs-6 text-gray-400">Earnings</div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <!--end::Stat-->
                                                    <!--begin::Stat-->
                                                    <div
                                                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                        <!--begin::Number-->
                                                        <div class="d-flex align-items-center">
                                                            <i class="ki-duotone ki-arrow-down fs-3 text-danger me-2">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i>
                                                            <div class="fs-2 fw-bold" data-kt-countup="true"
                                                                data-kt-countup-value="{{ $item->packages_count }}">
                                                                {{ $item->packages_count }}
                                                            </div>
                                                        </div>
                                                        <!--end::Number-->
                                                        <!--begin::Label-->
                                                        <div class="fw-semibold fs-6 text-gray-400">packages</div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <!--end::Stat-->
                                                    <!--begin::Stat-->
                                                    <div
                                                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                        <!--begin::Number-->
                                                        <div class="d-flex align-items-center">
                                                            <i class="ki-duotone ki-arrow-up fs-3 text-success me-2">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i>
                                                            <div class="fs-2 fw-bold" data-kt-countup="true"
                                                                data-kt-countup-value="{{ $item->orders_count }}">
                                                                {{ $item->orders_count }}
                                                            </div>
                                                        </div>

                                                        <div class="fw-semibold fs-6 text-gray-400">Orders Count</div>
                                                    </div>
                                                    <!--end::Stat-->
                                                    <div
                                                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                        <!--begin::Number-->
                                                        <div class="d-flex align-items-center">
                                                            <i class="ki-duotone ki-arrow-up fs-3 text-success me-2">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i>
                                                            <div class="fs-2 fw-bold" data-kt-countup="true"
                                                                data-kt-countup-value="{{ $item->packages_count }}">
                                                                {{ $item->packages_count }}
                                                            </div>
                                                        </div>

                                                        <div class="fw-semibold fs-6 text-gray-400">Visits Count</div>
                                                    </div>
                                                    <div
                                                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                        <!--begin::Number-->
                                                        <div class="d-flex align-items-center">
                                                            <i class="ki-duotone ki-arrow-up fs-3 text-success me-2">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i>
                                                            <div class="fs-2 fw-bold" data-kt-countup="true"
                                                                data-kt-countup-value="{{ $item->wallet->credit ?? 0 }}">
                                                                {{ $item->wallet->credit ?? 0 }}
                                                            </div>
                                                        </div>

                                                        <div class="fw-semibold fs-6 text-gray-400">wallet points</div>
                                                    </div>

                                                    <div
                                                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                        <!--begin::Number-->
                                                        <div class="d-flex align-items-center">
                                                            <i class="ki-duotone ki-arrow-up fs-3 text-success me-2">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i>
                                                            <div class="fs-2 fw-bold">
                                                                {{ $item->reservation->created_at ?? '' }}
                                                            </div>
                                                        </div>

                                                        <div class="fw-semibold fs-6 text-gray-400">reservation date
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                        <!--begin::Number-->
                                                        <div class="d-flex align-items-center">
                                                            <i class="ki-duotone ki-arrow-up fs-3 text-success me-2">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i>
                                                            <div class="fs-2 fw-bold">
                                                                {{ $item->reservation->package->name ?? '' }}
                                                            </div>
                                                        </div>

                                                        <div class="fw-semibold fs-6 text-gray-400">last package
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                        <!--begin::Number-->
                                                        <div class="d-flex align-items-center">
                                                            <i class="ki-duotone ki-arrow-up fs-3 text-success me-2">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i>
                                                            <div class="fs-2 fw-bold">
                                                                {{ $item->packages->avg('time') ?? '' }}
                                                            </div>
                                                        </div>

                                                        <div class="fw-semibold fs-6 text-gray-400">avarage time
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::Stats-->
                                            </div>

                                        </div>
                                        <!--end::Stats-->
                                    </div>
                                    <!--end::Info-->
                                </div>

                            </div>
                        </div>
                        <div class="modal fade" id="clients_{{ $item->id }}" tabindex="-1" aria-hidden="true">
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
                                                            <input type="text" class="form-control meal_price"
                                                                name="name" required id='name_{{ $item->id }}'
                                                                value="_{{ $item->name }}">
                                                        </div>
                                                        @if ($errors->has('name'))
                                                            <p style="color: red">
                                                                {{ $errors->first('name') }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                    <div class="form-group mb-6">
                                                        <label>{{ __('client phone') }}</label>
                                                        <div class="input-group mb-3">
                                                            <input type="number" class="form-control meal_price"
                                                                name="phone" required
                                                                id='phone_{{ $item->id }}'
                                                                value="_{{ $item->phone }}">
                                                        </div>
                                                        @if ($errors->has('phone'))
                                                            <p style="color: red">
                                                                {{ $errors->first('phone') }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                    <div class="form-group mb-6">
                                                        <label class="col-lg-4 col-form-label"
                                                            for="validationCustom01">{{ __('category') }}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select class="form-select" data-control="select2"
                                                            name="client_category_id_{{ $item->id }}"
                                                            id="client_category_id_{{ $item->id }}" required>
                                                            <option value="0"> .... </option>
                                                            @foreach ($clientCategory as $category)
                                                                <option
                                                                    @if ($item->client_category_id == $category->id) selected @endif
                                                                    value="{{ $category->id }}">
                                                                    {{ $category->name }}

                                                                </option>
                                                            @endforeach
                                                        </select>

                                                        @if ($errors->has('client_category_id'))
                                                            <p style="color: red">
                                                                {{ $errors->first('client_category_id') }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>
                                            <!--end::Scroll-->
                                            <!--begin::Actions-->
                                            <div class="text-center pt-15">
                                                <button type="reset" class="btn btn-light me-3"
                                                    data-bs-dismiss="modal" data-kt-roles-modal-action="cancel">
                                                    {{ __('Discard') }}</button>
                                                <button onclick="performUpdate({{ $item->id }})" type="button"
                                                    class="btn btn-primary">
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
                    <span class="span">
                        {!! $clients->links() !!}
                    </span>
                    <div class="modal fade" id="clients" tabindex="-1" aria-hidden="true">
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
                                                        <input type="text" class="form-control meal_price"
                                                            name="name" required id='name'
                                                            value="{{ old('name') }}">
                                                    </div>
                                                    @if ($errors->has('name'))
                                                        <p style="color: red">
                                                            {{ $errors->first('name') }}
                                                        </p>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-6">
                                                    <label>{{ __('client phone') }}</label>
                                                    <div class="input-group mb-3">
                                                        <input type="number" class="form-control meal_price"
                                                            name="phone" required id='phone'
                                                            value="{{ old('phone') }}">
                                                    </div>
                                                    @if ($errors->has('phone'))
                                                        <p style="color: red">
                                                            {{ $errors->first('phone') }}
                                                        </p>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="col-lg-4 col-form-label"
                                                        for="validationCustom01">{{ __('client category') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <select class="form-select" data-control="select2"
                                                        name="client_category_id" id="client_category_id" required>
                                                        <option value="0"> .... </option>
                                                        @foreach ($clientCategory as $category)
                                                            <option value="{{ $category->id }}">
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    @if ($errors->has('client_category_id'))
                                                        <p style="color: red">
                                                            {{ $errors->first('client_category_id') }}
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
                    <!--end::Navbar-->
                    <!--begin::Row-->

                    <!--end::Row-->
                </div>
                <!--end::Content container-->
            </div>
        </x-default-layout>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="{{ asset('crudjs/crud.js') }}"></script>
        <script>
            function performStore() {
                let formData = new FormData();
                formData.append('name', document.getElementById('name').value);
                formData.append('phone', document.getElementById('phone').value);
                formData.append('client_category_id', document.getElementById('client_category_id').value);
                storeReload('/admin/clients', formData)
            }
        </script>
        <script>
            function performUpdate(id) {
                let formData = new FormData();
                formData.append("_method", "PUT")
                formData.append('name', document.getElementById('name_' + id).value);
                formData.append('phone', document.getElementById('phone_' + id).value);
                formData.append('client_category_id', document.getElementById('client_category_id_' + id).value);
                storeReload('/admin/clients/' + id, formData)
            }
        </script>
