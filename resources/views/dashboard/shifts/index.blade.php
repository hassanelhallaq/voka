        <x-default-layout>
            <div class="container">
                <div class="card">
                    <h1>Shift Management</h1>
                    <!-- Your shift management form and table goes here -->
                    <form action="{{ route('shifts.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="row" id="schedule-container">
                                <div class="schedule-item">
                                    <label for="day_of_week_1">{{ __('Day of the Week') }}:</label>
                                    <select name="day" class="default-select wide form-control mb-3 day-of-week">
                                        <option value="Monday">Monday</option>
                                        <option value="Tuesday">Tuesday</option>
                                        <option value="Wednesday">Wednesday</option>
                                        <option value="Thursday">Thursday</option>
                                        <option value="Friday">Friday</option>
                                        <option value="Saturday">Saturday</option>
                                        <option value="Sunday">Sunday</option>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-lg-4 col-form-label " for="validationCustom01">
                                    {{ __('Start Time') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="time" class="form-control mb-3" id="start_time"
                                    value="{{ old('start_time') }}" name="start_time" required>
                                @if ($errors->has('start_time'))
                                    <p style="color: red">{{ $errors->first('start_time') }}
                                    </p>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-lg-4 col-form-label " for="validationCustom01">
                                    {{ __('End Time') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="time" class="form-control mb-3" id="end_time"
                                    value="{{ old('end_time') }}" name="end_time" required>
                                @if ($errors->has('end_time'))
                                    <p style="color: red">{{ $errors->first('end_time') }}
                                    </p>
                                @endif

                            </div>

                        </div>
                        <button class="btn btn-success" type="submit">{{ __('Save_Changes') }}</button>

                    </form>
                    <!--begin::Content container-->
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
                                                {{ $item->day }}
                                            </td>
                                            <td>
                                                {{ $item->start_time }}
                                            </td>
                                            <td>
                                                {{ $item->end_time }}
                                            </td>
                                            <td>
                                                <button onclick="performDestroy({{ $item->id }} , this)"
                                                    class="btn btn-icon btn-danger">
                                                    <i class="flaticon2-delete"></i>
                                                </button>
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
                    <!--end::Content container-->

                </div>
            </div>
        </x-default-layout>
        <script src="{{ asset('crudjs/crud.js') }}"></script>
        <script>
            function performDestroy(id, reference) {

                let url = '/admin/shifts/' + id;

                confirmDestroy(url, reference);

            }
        </script>
