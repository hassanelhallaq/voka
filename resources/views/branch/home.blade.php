@extends('branch.parent')
@section('contentFront')
    <div class="col-md-8" id="mainPage">
        <div class="seacr-bar mb-5">
            <form class="d-flex search  justify-content-between" role="search">
                <p>اكتب رقم الطاولة</p>
                <input class="search-input form-control" type="search" aria-label="Search" placeholder="12">
                <button class="btn search-btn">
                    بحث
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <div class="container">
            <div class="filter-btns d-flex mb-2">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="h-filter btn btn-dark" data-ha="all">كل الصالات</button>
                    @foreach ($halles as $item)
                        <button type="button" class="h-filter btn btn-dark"
                            data-ha="hall{{ $item->id }}">{{ $item->name }}</button>
                    @endforeach
                </div>
                <div class="btn-group mx-3" role="group" aria-label="Basic example">
                    <button type="button" class="s-filter btn btn-dark" data-st="all">كل الحالات</button>
                    <button type="button" class="s-filter btn btn-dark" data-st="reserved"> المحجوزة</button>
                    <button type="button" class="s-filter btn btn-dark" data-st="available"> المتاحة</button>
                    <button type="button" class="s-filter btn btn-dark" data-st="in_service"> فى الخدمة</button>
                </div>
                <div class="time-filter">
                    <form action="">
                        <div class="d-flex">
                            <p> متبقى دقائق اقل من </p>
                            <input class="time-input form-control form-control-sm" type="text" placeholder="30"
                                aria-label=".form-control-sm example">
                            <button type="submit" class="apply-time btn btn-dark">تطبيق </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row home-card">
                @foreach ($halles as $item)
                    @foreach ($item->tables as $table)
                        <div class="col-md-3 card-col  d-flex justify-content-center align-items-center"
                            data-tableNumber="{{ $item->name }}" data-start="45" data-updatedTime="45"
                            data-h="hall{{ $item->id }}"
                            @if ($table->status == 'in_service') data-stat="serv" @elseif($table->status == 'available') data-pstat ="available"
                             @elseif ($table->status == 'reserved') data-pstat ="reserved" @endif>


                            <div class="card @if ($table->status == 'in_service')
                                 bg-info
                                 @elseif($table->status == 'available')
                                bg-success text-light
                                @elseif ($table->status == 'reserved')
                                   bg-danger  text-light @endif
                                 text-dark"
                                data-id="table{{ $table->id }}"
                                @if ($table->status == 'in_service') data-stat="serv" @elseif($table->status == 'available')
                                data-pstat ="available" @elseif ($table->status == 'reserved') data-pstat ="reserved" @endif>
                                <div class="card-header primary-bg-color">
                                    <div class="top d-flex justify-content-between ">
                                        <h5 class="card-title"> طاولة رقم {{ $table->name }}</h5>
                                        <span class="start"> </span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="mid d-flex justify-content-between">
                                        <p class="hall-name">{{ $item->name }}</p>
                                        <span class="sta">
                                            @if ($table->status == 'in_service')
                                                فى الخدمة
                                            @elseif($table->status == 'available')
                                                متاحة
                                            @elseif ($table->status == 'reserved')
                                                محجوزة
                                            @endif
                                        </span>
                                    </div>
                                    <div class="body-package d-flex justify-content-between">
                                        <p class="hall-name"> باقة ساعتين</p>
                                        <span class="sta"> 4 اشخاص</span>
                                    </div>
                                    <div class="body-time d-flex justify-content-between">
                                        <p class="hall-name"> 10/8/2012</p>
                                        <span class="sta"> 08:00 PM </span>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p class="hall-name"> الرصيد : 500</p>
                                    <span class="sta"> الرصيد المتبقى : 300</span>
                                </div>

                            </div>
                            <div class="table-side-bar" id="table{{ $table->id }}">
                                <h2 class="text-center mb-4">طاولة رقم 1</h2>
                                <div class="tab-nav-wraper">
                                    <ul class="nav c-nav-tabs d-flex justify-content-between home-tab">
                                        <li class="nav-item">
                                            <a class="nav-link " data-tab="reservations" href="#"> الحجوزات</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-tab="orders" href="#"> الطلبات</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active" data-tab="the-menu" href="#"> القائمة</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- عناصر التاب -->
                                @include('branch._tab_casher')
                            </div>


                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
@endsection
