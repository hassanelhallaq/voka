<x-default-layout>
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="container">

            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('edit_Product_Category') }}
                    </h3>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form method="post" action="{{ route('products.update', [$product->product_id]) }}"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                @if (session('errors'))
                                    @foreach (session('errors')->all() as $error)
                                        <script>
                                            toastr.error('{{ $error }}');
                                        </script>
                                    @endforeach
                                @endif

                                @if (session('success'))
                                    <script>
                                        toastr.success('{{ session('success') }}');
                                    </script>
                                @endif
                                <div class="body">
                                    <div class="row">

                                        <div class="col-lg-6">
                                            <div class="form-group mb-4">
                                                <label for="basic-url">
                                                    <small class="text-danger">*</small> {{ __('Product_Name_Arabic') }}
                                                </label>
                                                <div class="input-group mb-3">

                                                    <input type="text" class="form-control meal_name"
                                                        value="{{ $product->name }}"
                                                        placeholder="{{ __('Product_Name_Arabic') }}" name="name">

                                                </div>

                                                @if ($errors->has('name'))
                                                    <p style="color: red">{{ $errors->first('name') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-4">
                                                <label for="basic-url">
                                                    <small class="text-danger">*</small>
                                                    {{ __('Product_Name_English') }}
                                                </label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control meal_name_english"
                                                        placeholder="{{ __('Product_Name_English') }}"
                                                        name="name_english" value="{{ $product->name_english }}">
                                                </div>
                                                @if ($errors->has('name_english'))
                                                    <p style="color: red">{{ $errors->first('name_english') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group mb-4">
                                                <label for="basic-url">
                                                    <small class="text-danger">*</small>
                                                    {{ __('product_Description_ar') }}
                                                </label>
                                                <div class="input-group mb-3">
                                                    <textarea class="form-control product_desc_arabic" rows="8" placeholder="{{ __('product_Description_ar') }}"
                                                        id="product_desc_arabic" name="desc_arabic" value="{{ $product->desc_arabic }}"> {{ $product->description }}</textarea>
                                                </div>
                                                @if ($errors->has('desc_arabic'))
                                                    <p style="color: red">{{ $errors->first('desc_arabic') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-4">
                                                <label for="basic-url">
                                                    <small class="text-danger">*</small>
                                                    {{ __('product_Description_en') }}
                                                </label>
                                                <div class="input-group mb-3">
                                                    <textarea class="form-control product_desc_english" rows="8" placeholder="{{ __('product_Description_en') }}"
                                                        name="desc_english">{{ $product->description_english }}</textarea>
                                                </div>
                                                @if ($errors->has('desc_english'))
                                                    <p style="color: red">{{ $errors->first('desc_english') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-lg-3">
                                            <div class="form-group mb-4">
                                                <label for="basic-url">
                                                    <small class="text-danger">*</small> {{ __('Product_Price') }}
                                                </label>
                                                <div class="input-group mb-3">

                                                    <input type="number" class="form-control meal_price" name="price"
                                                        id='price' value="{{ $product->price }}">
                                                </div>
                                                @if ($errors->has('price'))
                                                    <p style="color: red">{{ $errors->first('price') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group mb-4">
                                                <label for="basic-url">
                                                    <small class="text-danger">*</small> {{ __('calories') }}
                                                </label>
                                                <div class="input-group mb-3">

                                                    <input type="number" class="form-control meal_price"
                                                        name="calories" id='calories' value="{{ $product->calories }}"
                                                        value="{{ $product->calories }}">
                                                </div>
                                                @if ($errors->has('calories'))
                                                    <p style="color: red">{{ $errors->first('calories') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group mb-4">
                                                <label for="basic-url">
                                                    <small class="text-danger">*</small> {{ __('quantity_stock') }}
                                                </label>
                                                <div class="input-group mb-3">

                                                    <input type="number" class="form-control meal_price"
                                                        name="quantity_stock" id='quantity_stock'
                                                        value="{{ $product->quantity_stock }}">
                                                </div>
                                                @if ($errors->has('quantity_stock'))
                                                    <p style="color: red">{{ $errors->first('quantity_stock') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>{{ __('Branch') }}:</label>
                                            <select class="form-select" multiple data-control="select2"
                                                name="branch_id[]" id="branch_id">
                                                @foreach ($branches as $branch)
                                                    <option
                                                        @foreach ($product->branches as $item)
                                                            @if ($item->id == $branch->id) selected @endif @endforeach
                                                        value="{{ $branch->id }}">
                                                        @if (app()->getLocale() == 'ar')
                                                            {{ $branch->name }}
                                                        @else
                                                            {{ $branch->name_en }}
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('branch_id'))
                                                <p style="color: red">{{ $errors->first('branch_id') }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="basic-url">
                                                <small class="text-danger">*</small> {{ __('Status') }}
                                            </label>
                                            <div class="input-group mb-3">

                                                <select class="form-select" data-control="select2" name="status">
                                                    <option selected value="">{{ __('Choose_Status') }}...
                                                    </option>
                                                    <option @if ($product->status == 1) selected @endif
                                                        value="1">
                                                        {{ __('Active') }}
                                                    </option>
                                                    <option @if ($product->status == 0) selected @endif
                                                        value="0">
                                                        {{ __('Deactive') }}
                                                    </option>
                                                </select>
                                            </div>
                                            @if ($errors->has('status'))
                                                <p style="color: red">{{ $errors->first('status') }}
                                                </p>
                                            @endif
                                        </div>


                                    </div>

                                </div>
                                <hr>
                                <div class="image-section">
                                    <!--image-->
                                    <center>
                                        <!--begin::Image input placeholder-->
                                        <style>
                                            .image-input-placeholder {
                                                background-image: url('svg/avatars/blank.svg');
                                            }

                                            [data-bs-theme="dark"] .image-input-placeholder {
                                                background-image: url('svg/avatars/blank-dark.svg');
                                            }
                                        </style>
                                        <!--end::Image input placeholder-->

                                        <!--begin::Image input-->
                                        <div class="image-input image-input-outline" data-kt-image-input="true"
                                            style="background-image: url({{ $product->getFirstMediaUrl('product', 'thumb') }})">
                                            <!--begin::Image preview wrapper-->
                                            <div class="image-input-wrapper w-125px h-125px"
                                                style="background-image: url({{ $product->getFirstMediaUrl('product', 'thumb') }})">
                                            </div>
                                            <!--end::Image preview wrapper-->

                                            <!--begin::Edit button-->
                                            <label
                                                class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                data-bs-dismiss="click" title="Change avatar">
                                                <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span
                                                        class="path2"></span></i>

                                                <!--begin::Inputs-->
                                                <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                                <input type="hidden" name="avatar_remove" />
                                                <!--end::Inputs-->
                                            </label>
                                            <!--end::Edit button-->

                                            <!--begin::Cancel button-->
                                            <span
                                                class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                data-bs-dismiss="click" title="Cancel avatar">
                                                <i class="ki-outline ki-cross fs-3"></i>
                                            </span>
                                            <!--end::Cancel button-->

                                            <!--begin::Remove button-->
                                            <span
                                                class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                data-bs-dismiss="click" title="Remove avatar">
                                                <i class="ki-outline ki-cross fs-3"></i>
                                            </span>
                                            <!--end::Remove button-->
                                        </div>
                                        @if ($errors->has('avatar'))
                                            <p style="color: red">{{ $errors->first('avatar') }}
                                            </p>
                                        @endif
                                        <!--end::Image input-->
                                    </center>
                                </div>



                                {{-- <div class="newform"></div> --}}
                                <div class="col-12">
                                    <div class="card">
                                        <div class="body">
                                            <div class="input-group d-flex">
                                                <div class="flex-grow-1" id="buttons" style="display: block">
                                                    <button class="m-1  btn btn-success" type="submit"
                                                        value="publish">
                                                        <i class="fa fa-check"></i> {{ __('Create') }}
                                                    </button>

                                                    <a href="" class="m-1 btn btn-danger">
                                                        <i class="fa fa-remove"></i> {{ __('Cancel') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-default-layout>
