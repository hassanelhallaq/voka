      <x-default-layout>
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title"></h4>
              </div>
              <div class="d-flex align-items-center gap-2 gap-lg-3">
                  <!--begin::Dropdown-->
                  <a href="{{ route('coupons.create') }}" class="btn btn-primary font-weight-bolder">
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
                                  <th><strong> {{ __('coupon name') }}</strong></th>
                                  <th><strong> {{ __('coupon code') }}</strong></th>
                                  <th><strong> {{ __('from') }}</strong></th>
                                  <th><strong>{{ __('to') }}</strong></th>
                                  <th><strong>{{ __('coupon_discount') }}</strong></th>
                                  {{-- <th>التفعيل</th> --}}
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($coupons as $key =>$item)
                                  <tr>
                                      <td class="text-black"><strong>{{ $key }}</strong></td>
                                      <td>{{ $item->name }}</td>
                                      <td>{{ $item->code }}</td>
                                      <td>{{ $item->from }}</td>
                                      <td>{{ $item->to }}</td>
                                      <td>{{ $item->coupon_discount }}</td>
                                      {{-- <td style="display: flex; justify-content: start;">
                                          <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                              <input class="form-check-input w-45px h-30px" type="checkbox"
                                                  id="allowCoupon" checked="checked">
                                              <label class="form-check-label" for="allowCoupon"></label>
                                          </div>
                                      </td> --}}
                                  </tr>
                              @endforeach
                          </tbody>
                          <span class="span">
                              {!! $coupons->links() !!}
                          </span>
                      </table>
                  </div>
              </div>
          </div>
      </x-default-layout>
