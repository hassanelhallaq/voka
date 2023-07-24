      <x-default-layout>
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title"></h4>
              </div>
              <div class="d-flex align-items-center gap-2 gap-lg-3">
                  <!--begin::Dropdown-->
                  <a href="{{ route('packages.create') }}" class="btn btn-primary font-weight-bolder">
                      <i class="la la-plus"></i>
                      {{ __('create') }}
                  </a>
                  <!--end::Button-->
              </div>
              <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-responsive-md">
                          <thead>
                              <tr>
                                  <th style="width:80px;"><strong>#</strong></th>
                                  <th><strong> {{ __('name') }}</strong></th>
                                  <th><strong> {{ __('price') }}</strong></th>
                                  <th><strong> {{ __('time') }}</strong></th>
                                  <th><strong>{{ __('discount') }}</strong></th>
                                  <th></th>
                                  <th><strong>{{ __('status') }}</strong></th>
                                  <th><strong>{{ __('image') }}</strong></th>
                                  <th><strong>{{ __('setting') }}</strong></th>

                                  {{-- <th>التفعيل</th> --}}
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($packages as $item)
                                  <tr>
                                      <td class="text-black"><strong>{{ $item->id }}</strong></td>
                                      <td>{{ $item->name }}</td>
                                      <td>{{ $item->price }}</td>
                                      <td>{{ $item->time }}</td>
                                      <td>{{ $item->discount }}</td>
                                      <td>{{ $item->coupon_discount }}</td>
                                      <td>
                                          <div
                                              class="form-check form-check-solid form-switch form-check-custom fv-row ">
                                              <input class="form-check-input toggle-switch w-45px h-30px"
                                                  type="checkbox" id="{{ $item->id }}"
                                                  @if ($item->status == 'ACTIVE') checked="checked"
                                                                    value="ACTIVE"
                                                                    @else
                                                                    value="DEACTIVE" @endif>
                                              <label class="form-check-label"></label>
                                          </div>
                                      </td>
                                      <td>

                                          <img src="{{ $item->getFirstMediaUrl('package', 'thumb') }}"
                                              style="width: 20px;height: 30px">
                                      </td>
                                      <td>
                                          <a class="btn btn-icon btn-sm btn-success"
                                              href="{{ route('packages.edit', [$item->id]) }}">
                                              <i class="fa fa-edit"></i></a>
                                      </td>
                                  </tr>
                              @endforeach
                          </tbody>
                          <span class="span">
                              {!! $packages->links() !!}
                          </span>
                      </table>
                  </div>
              </div>
          </div>
      </x-default-layout>
      <script>
          $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }

          });

          $("input.toggle-switch").change(function() {
              var id = $(this).attr('id');
              var unit_toggle_value = $(this).attr('value');
              if (unit_toggle_value == "ACTIVE") {
                  unit_toggle_value = "DEACTIVE";
              } else {
                  unit_toggle_value = 'ACTIVE';
              }
              $.ajax({

                  url: "{{ route('package.status') }}",
                  type: "POST",
                  cache: false,
                  data: {
                      id: id,
                      unit_toggle_value: unit_toggle_value,
                  },
                  dataType: "json",
                  success: function(response) {}
              });

          });
      </script>
