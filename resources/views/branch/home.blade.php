@extends('branch.parent')
@section('contentFront')
    <style>
        /*----------------------------------- new design --------------------------------------------*/
        .home-card {
            display: none;
        }

        .home-card:nth-child(1) {
            display: flex;
        }

        .active-salon {
            display: flex;
        }

        .top {
            gap: 20px;
            justify-content: space-between;
            
        }
        .vvip-salon {
            height: 714px;
        }

        .other {
            -webkit-align-content: space-between;
            align-content: space-between;
            gap: 57px;
        }

        .middel {
            position: relative;
        }

        .middel .dine-set {
            position: absolute;
            font-size: 172px;
            color: #1e1e1e;
            font-weight: 900;
            top: 0;
            bottom: 0;
            text-align: center;
            left: 4%;
        }

        .sofa {
            text-align: center;
        }

        .sofa path {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .sofa.active-table .fill {
            fill: var(--orange);
        }

        .sofa.active-table .line {
            fill: var(--white);
        }

        /* .sofa:hover .fill {
                                                        fill: var(--orange);
                                                        }
                                                        .sofa:hover .line {
                                                        fill: var(--white);
                                                        } */

        .sofa svg {
            filter: brightness(1);
            /* تعتيم افتراضي */
            transition: filter 0.3s ease-in-out;
            /* تحويل بسلاسة */
        }

        .sofa:hover svg {
            filter: brightness(1.5);
            /* تعتيم عند التحويم */
        }

        .sofa:hover .text-fill {
            fill: var(--orange);
        }

        /*------ table status ------------*/
        .sofa-serv .fill {
            fill: #0dcaf0;
        }

        .sofa-serv .line {
            fill: #333;
        }

        .sofa-reserved .fill {
            fill: #dc3545;
        }

        .sofa-reserved .line {
            fill: #fff;
        }

        .sofa-available .fill {
            fill: #198754;
        }

        .sofa-available .line {
            fill: #fff;
        }

        .not-selected .fill {
            fill: #222;
        }

        .not-selected .line {
            fill: #3E3F41;
        }
        .div-placeholder {
            font-size: 20px;
            text-align: center;
            border: 1px dashed #b5b5b5;
            padding: 16px 0;
            border-radius: 10px;
        }
    </style>
    <div class="col-md-11" id="mainPage">

        <div class="container-fluid">
            <!--<div class="filter-btns d-flex mb-2">-->
            <!--    <div class="btn-group" role="group" aria-label="Basic example">-->
            <!--        @foreach ($halles as $key => $item)
                             -->
            <!--            <button type="button" class="h-filter btn btn-dark"-->
            <!--                data-salon="#salon{{ $item->id }}">{{ $item->name }}</button>-->
            <!--
                    @endforeach-->
            <!--    </div>-->
            <!--    <div class="btn-group mx-3" role="group" aria-label="Basic example">-->
            <!--        <button type="button" class="s-filter btn btn-dark" data-st="all">كل-->
            <!--            الحالات</button>-->
            <!--        <button type="button" class="s-filter btn btn-dark" data-st="reserved">-->
            <!--            المحجوزة</button>-->
            <!--        <button type="button" class="s-filter btn btn-dark" data-st="available">-->
            <!--            المتاحة</button>-->
            <!--        <button type="button" class="s-filter btn btn-dark" data-st="serv"> فى-->
            <!--            الخدمة</button>-->
            <!--    </div>-->

            <!--</div>-->
            <!-- salone table  -->

            <div class="row home-card mt-2 active-salon" id="salon{{ $item->id }}">
                <div class="col-md-1">
                    <div class="filter-btns d-flex flex-column mb-2">
                        <div class="btn-group mb-5 flex-column" role="group" aria-label="Basic example">
                            <button type="button" class="h-filter btn btn-dark"
                                    data-salon="allsalon">كل الصالات</button>
                            @foreach ($halles as $key => $item)
                                <button type="button" class="h-filter btn btn-dark"
                                    data-salon=".salon{{ $item->id }}">{{ $item->name }}</button>
                            @endforeach
                        </div>
                        <div class="btn-group flex-column" role="group" aria-label="Basic example">
                            <button type="button" class="s-filter btn btn-dark" data-st="all">كل
                                الحالات</button>
                            <button type="button" class="s-filter btn btn-dark" data-st="reserved">
                                المحجوزة</button>
                            <button type="button" class="s-filter btn btn-dark" data-st="available">
                                المتاحة</button>
                            <button type="button" class="s-filter btn btn-dark" data-st="serv"> فى
                                الخدمة</button>
                        </div>
                        <div class="btn-group mt-5 flex-column" role="group" aria-label="Basic example">
                            <a onclick="home()" type="button" class="page-refresh btn btn-primary">
                                <i class="fa-solid fa-arrow-rotate-right"></i>
                                تحديث الصفحة
                            </a>

                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="other d-flex flex-column">
                        <div class="right">
                            <div class="row salon6">

                                @foreach ($firstHalfTwo as $e => $table)
                                    @php
                                        if ($table->reservation) {
                                            $orders = App\Models\Order::where('package_id', $table->reservation->package_id)
                                                ->where('table_id', $table->id)
                                                ->where('is_done', 0)
                                                ->with('products')
                                                ->first();

                                            // Wrap the related products in a collection (even if there's only one result)
                                            if ($orders != null && $orders->products->count() != 0) {
                                                // Calculate total order prices using the map function on the products collection
                                                $totalOrderPrices = $orders->products->sum(function ($product) {
                                                    return $product->pivot->price * $product->pivot->quantity;
                                                });
                                            } else {
                                                $totalOrderPrices = 0;
                                            }
                                        } else {
                                            $orders = null;
                                            $totalOrderPrices = 0;
                                        }
                                    @endphp
                                    <div class="col-md-2">
                                        <div class="sofa  @if ($table->status == 'in_service') sofa-serv
                                                            @elseif($table->status == 'available')
                                                            sofa-available
                                                             @elseif ($table->status == 'reserved')
                                                              sofa-reserved @endif
                                                               {{-- {{ $e === 0 ? '  not-selected' : '' }} --}}
                                                               "
                                            data-id="table{{ $table->id }}" data-stat="serv"
                                            data-bs-toggle="modal" data-bs-target="#modal{{ $table->id }}"
                                            @if ($table->status == 'in_service') data-pstat="serv"
                                                            @elseif($table->status == 'available')
                                                             data-pstat ="available"
                                                             @elseif ($table->status == 'reserved')
                                                              data-pstat ="reserved" @endif
                                            data-h="hall{{ $loungesSortow->id }}">
                                            <div class="table-vip d-flex flex-column align-items-center">
                                                <svg width="93" height="57" viewBox="0 0 93 57" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M68.6647 26.5813L81.6371 26.5813C83.434 26.5813 84.8951 25.1208 84.8951 23.3236L84.8951 5.39102C84.8951 3.59383 83.4337 2.1333 81.6371 2.1333L68.6647 2.1333C66.8657 2.1333 65.4064 3.59383 65.4064 5.39102L65.4064 23.3233C65.4064 25.1208 66.8657 26.5813 68.6647 26.5813Z"
                                                        fill="#212325" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M27.7693 24.1661L27.7693 11.1884C27.7693 9.39123 26.3075 7.93164 24.5106 7.93164L6.579 7.93164C4.78024 7.93164 3.32095 9.39123 3.32095 11.1884L3.32095 24.1661C3.32095 25.9633 4.78055 27.4229 6.579 27.4229L24.5106 27.4229C26.3075 27.4229 27.7693 25.9636 27.7693 24.1661Z"
                                                        fill="#212325" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M6.57907 7.60449L24.5129 7.60449C26.4907 7.60449 28.0981 9.21133 28.0981 11.1894L28.0981 24.1671C28.0981 26.1462 26.491 27.7533 24.5129 27.7533L6.57907 27.7533C4.59908 27.7533 2.99411 26.1462 2.99411 24.1671L2.99411 11.1894C2.9938 9.21133 4.59908 7.60449 6.57907 7.60449ZM6.57907 27.0954L24.5129 27.0954C26.1285 27.0954 27.4402 25.7834 27.4402 24.1671L27.4402 11.1894C27.4402 9.57347 26.1285 8.26113 24.5129 8.26113L6.57907 8.26113C4.96342 8.26113 3.65171 9.57316 3.65171 11.1894L3.65171 24.1671C3.65171 25.7834 4.96342 27.0954 6.57907 27.0954Z"
                                                        fill="#3E3F41" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M49.2177 26.5815L62.1922 26.5815C63.9888 26.5815 65.4484 25.1222 65.4484 23.3247L65.4484 5.39056C65.4484 3.59338 63.9888 2.13379 62.1922 2.13379L49.2177 2.13379C47.4186 2.13379 45.9612 3.59337 45.9612 5.39056L45.9612 23.3247C45.9612 25.1219 47.4186 26.5815 49.2177 26.5815Z"
                                                        fill="#212325" />
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M49.2176 1.80713L62.194 1.80713C64.1718 1.80713 65.7793 3.41302 65.7793 5.39238L65.7793 23.3272C65.7793 25.3046 64.1721 26.9108 62.194 26.9108L49.2176 26.9108C47.2376 26.9108 45.6323 25.3046 45.6323 23.3272L45.6323 5.39207C45.6323 3.4127 47.2376 1.80713 49.2176 1.80713ZM49.2176 26.2539L62.194 26.2539C63.8097 26.2539 65.1214 24.9419 65.1214 23.3272L65.1214 5.39207C65.1214 3.77611 63.8097 2.46503 62.194 2.46503L49.2176 2.46503C47.5997 2.46503 46.2883 3.77611 46.2883 5.39207L46.2883 23.3268C46.288 24.9419 47.5997 26.2539 49.2176 26.2539Z"
                                                        fill="#3E3F41" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M30.1569 26.5813L43.1314 26.5813C44.928 26.5813 46.3876 25.1208 46.3876 23.3236L46.3876 5.39102C46.3876 3.59383 44.928 2.1333 43.1314 2.1333L30.1569 2.1333C28.3578 2.1333 26.8985 3.59383 26.8985 5.39102L26.8985 23.3233C26.8985 25.1208 28.3581 26.5813 30.1569 26.5813Z"
                                                        fill="#212325" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M68.6647 1.80713L81.6371 1.80713C83.6171 1.80713 85.2242 3.41491 85.2242 5.39238L85.2242 23.3246C85.2242 25.3046 83.6171 26.9108 81.6371 26.9108L68.6647 26.9108C66.6847 26.9108 65.0776 25.3046 65.0776 23.3246L65.0776 5.39207C65.0776 3.41491 66.6847 1.80713 68.6647 1.80713ZM68.6647 26.2539L81.6371 26.2539C83.2527 26.2539 84.5682 24.9406 84.5682 23.3243L84.5682 5.39207C84.5682 3.77705 83.2524 2.46503 81.6371 2.46503L68.6647 2.46503C67.0469 2.46503 65.7352 3.77705 65.7352 5.39207L65.7352 23.3243C65.7352 24.9406 67.0469 26.2539 68.6647 26.2539Z"
                                                        fill="#3E3F41" />
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M30.1569 1.80859L43.1314 1.80859C45.1092 1.80859 46.7183 3.4148 46.7183 5.39322L46.7183 23.327C46.7183 25.3045 45.1092 26.9117 43.1314 26.9117L30.1569 26.9117C28.1769 26.9117 26.5697 25.3045 26.5697 23.327L26.5697 5.39322C26.5697 3.4148 28.1772 1.80859 30.1569 1.80859ZM30.1569 26.2547L43.1314 26.2547C44.7449 26.2547 46.0588 24.9417 46.0588 23.327L46.0588 5.39322C46.0588 3.77726 44.7449 2.46492 43.1314 2.46492L30.1569 2.46492C28.5412 2.46492 27.2276 3.77694 27.2276 5.39322L27.2276 23.327C27.2276 24.9417 28.5415 26.2547 30.1569 26.2547Z"
                                                        fill="#3E3F41" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M27.7693 43.2271L27.7693 30.2532C27.7693 28.4563 26.3097 26.9961 24.5128 26.9961L6.579 26.9961C4.78244 26.9961 3.32285 28.4566 3.32285 30.2532L3.32285 43.2271C3.32285 45.0256 4.78244 46.4842 6.579 46.4842L24.5128 46.4842C26.3097 46.4842 27.7693 45.0256 27.7693 43.2271Z"
                                                        fill="#212325" />
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M6.58089 26.667L24.5125 26.667C26.4903 26.667 28.0978 28.2732 28.0978 30.2535L28.0978 43.2287C28.0978 45.2071 26.4906 46.8133 24.5125 46.8133L6.58089 46.8133C4.6009 46.8133 2.99375 45.2071 2.99375 43.2287L2.99375 30.2535C2.99343 28.2732 4.6009 26.667 6.58089 26.667ZM6.58089 46.157L24.5125 46.157C26.1282 46.157 27.4421 44.8434 27.4421 43.2287L27.4421 30.2535C27.4421 28.6369 26.1282 27.3236 24.5125 27.3236L6.58089 27.3236C4.96525 27.3236 3.65134 28.6366 3.65134 30.2535L3.65134 43.2287C3.65134 44.8434 4.96524 46.157 6.58089 46.157Z"
                                                        fill="#3E3F41" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M9.54352 56.0703L24.4732 56.0703C26.2742 56.0703 27.7354 54.6066 27.7354 52.8051L27.7354 49.5281C27.7354 47.7265 26.2739 46.2632 24.4732 46.2632L9.54352 46.2632C7.74255 46.2632 6.27888 47.7269 6.27888 49.5281L6.27888 52.8051C6.27888 54.6066 7.74255 56.0703 9.54352 56.0703Z"
                                                        fill="#212325" />
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M9.54591 45.938L24.4734 45.938C26.4553 45.938 28.0687 47.5473 28.0687 49.5299L28.0687 52.8068C28.0687 54.7902 26.4553 56.4002 24.4734 56.4002L9.54591 56.4002C7.56152 56.4002 5.95247 54.7902 5.95247 52.8068L5.95247 49.5298C5.95247 47.547 7.56152 45.938 9.54591 45.938ZM9.54591 55.7432L24.4734 55.7432C26.0928 55.7432 27.4086 54.4259 27.4086 52.8068L27.4086 49.5299C27.4086 47.9111 26.0928 46.5943 24.4734 46.5943L9.54591 46.5943C7.92618 46.5943 6.61037 47.9111 6.61037 49.5298L6.61037 52.8068C6.61037 54.4259 7.92586 55.7432 9.54591 55.7432Z"
                                                        fill="#3E3F41" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M65.6447 43.2271L65.6447 30.2532C65.6447 28.4563 67.1043 26.9961 68.9011 26.9961L86.8349 26.9961C88.6315 26.9961 90.0911 28.4566 90.0911 30.2532L90.0911 43.2271C90.0911 45.0256 88.6315 46.4842 86.8349 46.4842L68.9011 46.4842C67.1043 46.4842 65.6447 45.0256 65.6447 43.2271Z"
                                                        fill="#212325" />
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M86.8329 26.667L68.9013 26.667C66.9235 26.667 65.316 28.2732 65.316 30.2535L65.316 43.2287C65.316 45.2071 66.9232 46.8133 68.9013 46.8133L86.8329 46.8133C88.8129 46.8133 90.4201 45.2071 90.4201 43.2287L90.4201 30.2535C90.4204 28.2732 88.8129 26.667 86.8329 26.667ZM86.8329 46.157L68.9013 46.157C67.2857 46.157 65.9717 44.8434 65.9717 43.2287L65.9717 30.2535C65.9717 28.6369 67.2857 27.3236 68.9013 27.3236L86.8329 27.3236C88.4486 27.3236 89.7625 28.6366 89.7625 30.2535L89.7625 43.2287C89.7625 44.8434 88.4486 46.157 86.8329 46.157Z"
                                                        fill="#3E3F41" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M83.8701 56.0703L68.9404 56.0703C67.1394 56.0703 65.6782 54.6066 65.6782 52.8051L65.6782 49.5281C65.6782 47.7265 67.1397 46.2632 68.9404 46.2632L83.8701 46.2632C85.671 46.2632 87.1347 47.7269 87.1347 49.5281L87.1347 52.8051C87.1347 54.6066 85.671 56.0703 83.8701 56.0703Z"
                                                        fill="#212325" />
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M83.8679 45.938L68.9404 45.938C66.9585 45.938 65.3451 47.5473 65.3451 49.5299L65.3451 52.8068C65.3451 54.7902 66.9585 56.4002 68.9404 56.4002L83.8679 56.4002C85.8523 56.4002 87.4613 54.7902 87.4613 52.8068L87.4613 49.5299C87.4613 47.547 85.8523 45.938 83.8679 45.938ZM83.8679 55.7432L68.9404 55.7432C67.321 55.7432 66.0052 54.4259 66.0052 52.8068L66.0052 49.5299C66.0052 47.9111 67.321 46.5943 68.9404 46.5943L83.8679 46.5943C85.4876 46.5943 86.8034 47.9111 86.8034 49.5299L86.8034 52.8068C86.8034 54.4259 85.488 55.7432 83.8679 55.7432Z"
                                                        fill="#3E3F41" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M5.0385 0.26318L87.7375 0.26633C90.2276 0.26633 92.2554 2.28943 92.2554 4.78259L92.2554 5.06639C92.2554 7.56112 90.2276 9.58422 87.7375 9.58422L9.83949 9.58421L9.83949 50.5297C9.83949 53.0238 7.81798 55.0482 5.32356 55.0482L5.0385 55.0482C2.54628 55.0482 0.520665 53.0238 0.520665 50.5297L0.520667 4.78195C0.520352 2.28848 2.54628 0.26318 5.0385 0.26318Z"
                                                        fill="#212325" />
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M5.03856 -3.82384e-06L87.7376 0.0031462C90.3755 0.00314632 92.5178 2.14297 92.5178 4.78275L92.5178 5.06655C92.5178 7.70696 90.3752 9.84993 87.7376 9.84993L10.1042 9.84993L10.1042 50.5299C10.1042 53.1687 7.9615 55.3117 5.32392 55.3117L5.03886 55.3117C2.40097 55.3117 0.258939 53.1687 0.258939 50.5299L0.258941 4.78212C0.258312 2.14171 2.40067 -3.93915e-06 5.03856 -3.82384e-06ZM5.03856 54.785L5.32362 54.785C7.67016 54.785 9.57715 52.8768 9.57715 50.5299L9.57715 9.32103L87.7373 9.32103C90.0816 9.32103 91.9886 7.41372 91.9886 5.06655L91.9886 4.78275C91.9886 2.4359 90.0816 0.529844 87.7351 0.529843L5.03823 0.527637C2.69201 0.527637 0.784701 2.43369 0.784701 4.78212L0.784699 50.5296C0.785014 52.8768 2.69202 54.785 5.03856 54.785Z"
                                                        fill="#3E3F41" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M87.7382 0.263187L5.0392 0.26633C2.54918 0.26633 0.521362 2.28943 0.521362 4.78259L0.521362 5.06639C0.521362 7.56112 2.54918 9.58422 5.0392 9.58422L82.9372 9.58422L82.9372 50.5298C82.9372 53.0239 84.9588 55.0482 87.4532 55.0482L87.7382 55.0482C90.2304 55.0482 92.2561 53.0239 92.2561 50.5298L92.2561 4.78196C92.2564 2.28849 90.2304 0.263188 87.7382 0.263187Z"
                                                        fill="#212325" />
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M87.7382 3.82384e-06L5.03914 0.00314662C2.40125 0.00314651 0.258911 2.14297 0.258911 4.78275L0.258911 5.06655C0.258911 7.70696 2.40157 9.84993 5.03914 9.84993L82.6726 9.84994L82.6726 50.5299C82.6726 53.1687 84.8152 55.3117 87.4528 55.3117L87.7379 55.3117C90.3758 55.3117 92.5178 53.1687 92.5178 50.5299L92.5178 4.78213C92.5184 2.14172 90.3761 3.93915e-06 87.7382 3.82384e-06ZM87.7382 54.785L87.4531 54.785C85.1066 54.785 83.1996 52.8768 83.1996 50.5299L83.1996 9.32104L5.03946 9.32103C2.69512 9.32103 0.788118 7.41372 0.788118 5.06655L0.788118 4.78275C0.788118 2.4359 2.69512 0.529844 5.04166 0.529844L87.7385 0.527645C90.0847 0.527645 91.992 2.4337 91.992 4.78213L91.992 50.5296C91.9917 52.8768 90.0847 54.785 87.7382 54.785Z"
                                                        fill="#3E3F41" />
                                                    <path class="text-fill"
                                                        d="M34.1222 33.9091L38.0085 44.929H38.1619L42.0483 33.9091H43.7102L38.9034 47H37.267L32.4602 33.9091H34.1222ZM47.3345 33.9091V47H45.7493V33.9091H47.3345ZM50.513 47V33.9091H54.9363C55.9632 33.9091 56.8027 34.0945 57.4547 34.4652C58.111 34.8317 58.5968 35.3281 58.9121 35.9545C59.2275 36.581 59.3851 37.2798 59.3851 38.0511C59.3851 38.8224 59.2275 39.5234 58.9121 40.1541C58.601 40.7848 58.1195 41.2876 57.4675 41.6626C56.8155 42.0334 55.9803 42.2188 54.9618 42.2188H51.7914V40.8125H54.9107C55.6138 40.8125 56.1784 40.6911 56.6046 40.4482C57.0307 40.2053 57.3397 39.8771 57.5314 39.4638C57.7275 39.0462 57.8255 38.5753 57.8255 38.0511C57.8255 37.527 57.7275 37.0582 57.5314 36.6449C57.3397 36.2315 57.0286 35.9077 56.5982 35.6733C56.1678 35.4347 55.5968 35.3153 54.8851 35.3153H52.0982V47H50.513Z"
                                                        fill="white" />
                                                </svg>
                                                <h4>{{ $table->name }}</h4>
                                            </div>
                                            <div class="modal table-modal fade" id="modal{{ $table->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="card  @if ($table->status == 'in_service') bg-info
                                                 @elseif($table->status == 'available')
                                                bg-success text-light
                                                @elseif ($table->status == 'reserved')
                                                   bg-danger  text-light @endif"
                                                data-id="table1" data-stat="serv">
                                                <div class="modal-header">
                                                    <div
                                                        class="card-header primary-bg-color w-100 d-flex justify-content-between">
                                                        <h3 class="modal-title fs-5" id="exampleModalLabel">
                                                            {{ $table->name }}</h3>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="card-item mid d-flex justify-content-between">
                                                        <p class="hall-name"> الباقة</p>
                                                        <span class="sta">
                                                            {{ $table->reservation != null ? $table->reservation->package->name : 'لا توجد باقة' }}
                                                        </span>
                                                    </div>
                                                    <div class="card-item body-package d-flex justify-content-between">
                                                        <p class="hall-name"> المقاعد</p>
                                                        <span class="sta">
                                                            {{ $table->reservation != null ? $table->reservation->package->count_of_visitors : 0 }}
                                                            اشخاص</span>
                                                    </div>
                                                    <div class="card-item body-time d-flex justify-content-between">
                                                        <p class="hall-name"> الحجز</p>
                                                        <span
                                                            class="sta">{{ $table->reservation != null ? $table->reservation->price : 0 }}
                                                            ريال</span>
                                                    </div>
                                                    <div class="card-item body-time d-flex justify-content-between">
                                                        <p class="hall-name"> المدة</p>
                                                        <span
                                                            class="sta">{{ $table->reservation != null ? $table->reservation->minutes : 0 }}
                                                            ساعة </span>
                                                    </div>
                                                    <div class="card-item body-time d-flex justify-content-between">
                                                        <p class="hall-name"> الحالة</p>
                                                        <span class="sta">
                                                            {{ $table->reservation != null ? $table->reservation->status : 'لا يوجد حجز' }}</span>
                                                    </div>
                                                    <div class="card-item body-time d-flex justify-content-between">
                                                        <p class="hall-name"> الرصيد الحالى</p>
                                                        <span class="sta">
                                                            {{ $table->reservation != null ? $table->reservation->price : 0 }}
                                                            ريال </span>
                                                    </div>
                                                    @php
                                                        if ($table->reservation) {
                                                            $formattedTime = Carbon\Carbon::createFromFormat('g:i A', $table->reservation->time)->format('H:i');
                                                            $reservationDateTime = $table->reservation->date;
                                                        }

                                                    @endphp
                                                    <div class="card-item body-time d-flex justify-content-between">
                                                        <p class="hall-name"> الوقت المنقضى</p>
                                                        <div class="countdown-timer"
                                                            data-start="{{ $table->reservation ? $table->reservation->date : '' }}"
                                                            data-package-time="{{ $table->reservation->package->time ?? 0 }}">
                                                            <!-- Add a span to display the countdown timer -->
                                                            @if ($table->reservation)
                                                                <span class="countdown-timer-text">00:00:00</span>
                                                            @else
                                                                <span>انتهى</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="table-btn my-3 text-center">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-2">
                                                                <button class="table-btn-action btn btn-primary w-100"
                                                                    type="button" data-id="#tableorders">
                                                                    الطلبات
                                                                </button>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <button class="table-btn-action btn btn-primary w-100"
                                                                    type="button" data-id="#tableinfo">
                                                                    استعراض
                                                                </button>
                                                            </div>
                                                            @if ($table->reservation)
                                                                <div class="col-md-6">
                                                                    <button class="table-btn-action btn btn-primary w-100"
                                                                        type="button" disabled data-id="#exampleModal_{{ $table->id }}">
                                                                        تفعيل الحجز
                                                                    </button>
                                                                </div>
                                                            @else
                                                                <div class="col-md-6">
                                                                    <button disabled
                                                                        class="table-btn-action btn btn-primary w-100"
                                                                        type="button" disabled data-id="#exampleModal_{{ $table->id }}">
                                                                        تفعيل الحجز
                                                                    </button>
                                                                     <!-- Modal -->
                                                                            <div class="modal fade"
                                                                                id="exampleModal_{{ $table->id }}"
                                                                                tabindex="-1"
                                                                                aria-labelledby="exampleModalLabel"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h1 class="modal-title fs-5"
                                                                                                id="exampleModalLabel">
                                                                                                تفعيل الحجز</h1>
                                                                                            <button type="button"
                                                                                                class="btn-close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div
                                                                                                class="modal-body text-light">
                                                                                                هل تود تفعيل الحجز
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <a type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-bs-dismiss="modal">اغلاق</a>
                                                                                            <button type="button"
                                                                                                onclick="activeTable({{ $table->id }})"
                                                                                                class="btn btn-primary">تأكيد
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                </div>
                                                            @endif
                                                              
                                                            @if ($table->reservation)
                                                                <div class="col-md-6">
                                                                    <button class="table-btn-action btn btn-primary w-100"
                                                                        type="button" data-id="#tableend">
                                                                        انهاء الحجز
                                                                    </button>
                                                                      <!-- Modal -->
                                                                            <div class="modal fade"
                                                                                id="close_{{ $table->id }}"
                                                                                tabindex="-1"
                                                                                aria-labelledby="exampleModalLabel"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h1 class="modal-title fs-5"
                                                                                                id="exampleModalLabel">
                                                                                                انهاء الحجز</h1>
                                                                                            <button type="button"
                                                                                                class="btn-close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div
                                                                                                class="modal-body text-light">
                                                                                                هل تود انهاء الحجز
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-bs-dismiss="modal">اغلاق</button>
                                                                                            <a type="button"
                                                                                                onclick="closeTable({{ $table->id }})"
                                                                                                class="btn btn-primary">انهاء
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                </div>
                                                            @else
                                                                <div class="col-md-6">
                                                                    <button disabled
                                                                        class="table-btn-action btn btn-primary w-100"
                                                                        type="button" data-id="#tableend">
                                                                        انهاء الحجز
                                                                    </button>
                                                                </div>
                                                            @endif
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                         
                                        </div>
                                    </div>

                                </div>
                                
                                            @if ($table->status == 'in_service')
                                                <div class="table-side-bar" id="table{{ $table->id }}">
                                                    <h2 class="text-center mb-4">طاولة رقم
                                                        {{ $table->name }}</h2>
                                                    <div class="tab-nav-wraper">
                                                        <ul class="nav c-nav-tabs d-flex justify-content-between home-tab">
                                                            <li class="nav-item">
                                                                <a class="nav-link " data-tab="reservations"
                                                                    href="#">
                                                                    الحجوزات</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-tab="orders" href="#">
                                                                    الطلبات</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link active" data-tab="the-menu"
                                                                    href="#">
                                                                    القائمة</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- عناصر التاب -->
                                                    <div class="tab-content">
                                                        <div id="the-menu" class="c-tab-pane active">
                                                            <ol class="list-group list-group-numbered reversed">


                                                                @if ($orders != null && $orders->products->count() != 0)
                                                                    @foreach ($orders->products as $product)
                                                                        <li
                                                                            class="list-group-item d-flex justify-content-between align-items-start">
                                                                            <div class="me-2 ms-auto">
                                                                                <div class="fw-bold">
                                                                                    {{ $product->name }}
                                                                                </div>
                                                                            </div>

                                                                            <span>{{ $product->pivot->price }}
                                                                                ريال</span>
                                                                        </li>
                                                                    @endforeach
                                                                @endif

                                                                <li
                                                                    class="new-menu-li list-group-item d-flex justify-content-center align-items-start">
                                                                    <a onclick="product({{ $table->id }})"
                                                                        class="me-2">
                                                                        <div class="fw-bold">اضف عنصر
                                                                            جديد
                                                                        </div>
                                                                    </a>
                                                                </li>

                                                            </ol>

                                                            <ol class="list-group reversed none  mt-5">
                                                                <li class="list-group-item no-number  ">
                                                                    <div
                                                                        class="sub-total d-flex justify-content-between align-items-start">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold"> حاصل
                                                                                الجمع</div>
                                                                        </div>
                                                                        <span>{{ $table->reservation->package->price ?? 0 }}
                                                                            ريال</span>
                                                                    </div>

                                                                    <div
                                                                        class="tax d-flex justify-content-between align-items-start mt-4">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold"> ضريبة
                                                                            </div>
                                                                        </div>
                                                                        <span>15%</span>
                                                                    </div>
                                                                    <div
                                                                        class="tax d-flex justify-content-between align-items-start mt-4 total">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold">
                                                                                الإجمالى
                                                                            </div>
                                                                        </div>

                                                                        @php
                                                                            $total = $table->reservation->package->price ?? 0 * 0.15;
                                                                        @endphp

                                                                        <span>{{ $total - $totalOrderPrices }}

                                                                            ريال</span>
                                                                    </div>
                                                                    <div class="payment-method">
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <div
                                                                                    class="payment-icon d-flex justify-content-center align-items-center">
                                                                                    <i class="fa-solid fa-sack-dollar"></i>
                                                                                </div>
                                                                                <p class="text-center">
                                                                                    كاش
                                                                                </p>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div
                                                                                    class="payment-icon d-flex justify-content-center align-items-center">
                                                                                    <i class="fa-solid fa-credit-card"></i>
                                                                                </div>
                                                                                <p class="text-center">
                                                                                    بطاقة ائتمان</p>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div
                                                                                    class="payment-icon d-flex justify-content-center align-items-center">
                                                                                    <i class="fa-solid fa-wallet"></i>
                                                                                </div>
                                                                                <p class="text-center">
                                                                                    المحفظة</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="payment-btn my-3 text-center">
                                                                            <div class="btn btn-primary btn-lg w-100"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#exampleModal6">
                                                                                ادفع الآن</div>
                                                                            <!-- Modal -->
                                                                            <div class="modal fade" id="exampleModal6"
                                                                                tabindex="-1"
                                                                                aria-labelledby="exampleModalLabel6"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title"
                                                                                                id="exampleModalLabel">
                                                                                                تأكيد
                                                                                                الدفع
                                                                                            </h5>
                                                                                            <button type="button"
                                                                                                class="btn-close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <p class="consfirm-text">
                                                                                                هل تريد
                                                                                                تأكيد
                                                                                                الدفع
                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button"
                                                                                                class="btn btn-primary">تأكيد</button>
                                                                                            <button type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-bs-dismiss="modal">لا
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>



                                                            </ol>

                                                        </div>
                                                        <div id="orders" class="c-tab-pane ">
                                                            @foreach ($table->reservations as $reservation)
                                                                <ol
                                                                    class="list-group list-group-numbered reversed bill-info">
                                                                    <li
                                                                        class="list-group-item d-flex justify-content-between align-items-start">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold"> طلب
                                                                                باسم
                                                                            </div>
                                                                        </div>
                                                                        <span>{{ $reservation->client->name }}</span>
                                                                    </li>
                                                                    <li
                                                                        class="list-group-item d-flex justify-content-between align-items-start">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold">اسم
                                                                                الباقة
                                                                            </div>
                                                                        </div>
                                                                        <span>
                                                                            {{ $reservation->package->name }}</span>
                                                                    </li>
                                                                    <li
                                                                        class="list-group-item d-flex justify-content-between align-items-start">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold">
                                                                                الرصيد
                                                                            </div>
                                                                        </div>
                                                                        <span>{{ $reservation->package->price }}
                                                                        </span>
                                                                    </li>
                                                                    <li
                                                                        class="list-group-item d-flex justify-content-between align-items-start">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold">
                                                                                الحالة
                                                                            </div>
                                                                        </div>
                                                                        <span class="badge bg-info">تم
                                                                            الدفع </span>
                                                                    </li>
                                                                    <li
                                                                        class="new-menu-li list-group-item d-flex justify-content-center align-items-start">
                                                                        <div class="me-2">
                                                                            <div class="fw-bold"> طباعة
                                                                                الطلب</div>
                                                                        </div>
                                                                    </li>
                                                                </ol>
                                                            @endforeach

                                                        </div>
                                                        <div id="reservations" class="c-tab-pane ">
                                                            <div class="hour-col">
                                                                <div class="body-hour-cel">
                                                                    <div class="row gx-0 p-2 text-center">
                                                                        <div class="col-md-2">
                                                                            <p class="hour mb-0">05:00
                                                                                AM
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            <div class="row gx-0">
                                                                                <div class="col-md-9">
                                                                                    <div
                                                                                        class="d-flex h-100 justify-content-around align-items-center">
                                                                                        <div class="gusts">
                                                                                            <span class="table-gusts px-2">
                                                                                                4</span>
                                                                                            <span> <i
                                                                                                    class="fa-solid fa-users"></i></span>
                                                                                        </div>
                                                                                        <div class="table-res">
                                                                                            طاولة 1
                                                                                        </div>
                                                                                        <span
                                                                                            class="badge bg-secondary">مؤكد</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <span>رصيد متبقى
                                                                                        600</span>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="body-hour-cel">
                                                                    <div class="row gx-0 p-2 text-center">
                                                                        <div class="col-md-2">
                                                                            05:15 AM
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            <div class="row gx-0">
                                                                                <div class="col-md-9">
                                                                                    <div
                                                                                        class="d-flex justify-content-center align-items-center">
                                                                                        <span>لا يوجد
                                                                                            حجز</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <span>لا يوجد
                                                                                        رصيد</span>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="body-hour-cel">
                                                                    <div class="row gx-0 p-2 text-center">
                                                                        <div class="col-md-2">
                                                                            05:30 AM
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            <div class="row gx-0">
                                                                                <div class="col-md-9">
                                                                                    <div
                                                                                        class="d-flex justify-content-center align-items-center">
                                                                                        <span>لا يوجد
                                                                                            حجز</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <span>لا يوجد
                                                                                        رصيد</span>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="body-hour-cel">
                                                                    <div class="row gx-0 p-2 text-center">
                                                                        <div class="col-md-2">
                                                                            05:45 AM
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            <div class="row gx-0">
                                                                                <div class="col-md-9">
                                                                                    <div
                                                                                        class="d-flex justify-content-center align-items-center">
                                                                                        <span>لا يوجد
                                                                                            حجز</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <span>لا يوجد
                                                                                        رصيد</span>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                @can('add_reservation')
                                                    <div class="table-side-bar" id="table{{ $table->id }}"
                                                        data-id="table{{ $table->id }}">
                                                        <ol class="table-list list-group list-group-numbered reversed">
                                                            <li
                                                                class="menu-info-list list-group-item d-flex  flex-column justify-content-center align-items-center text-center p-0">
                                                                <a class="new-reserv-btn btn btn-link w-100"
                                                                    href="{{ route('branch.reservation') }}">
                                                                    <i class="fa-solid fa-plus"></i>
                                                                    <p>انشاء حجز جديد </p>
                                                                </a>
                                                            </li>

                                                        </ol>

                                                    </div>
                                                @endcan
                                            @endif
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <div class="row salon7">

                                @foreach ($firstHalfSilverTwo as $table)
                                    @php
                                        if ($table->reservation) {
                                            $orders = App\Models\Order::where('package_id', $table->reservation->package_id)
                                                ->where('table_id', $table->id)
                                                ->where('is_done', 0)
                                                ->with('products')
                                                ->first();

                                            // Wrap the related products in a collection (even if there's only one result)
                                            if ($orders != null && $orders->products->count() != 0) {
                                                // Calculate total order prices using the map function on the products collection
                                                $totalOrderPrices = $orders->products->sum(function ($product) {
                                                    return $product->pivot->price * $product->pivot->quantity;
                                                });
                                            } else {
                                                $totalOrderPrices = 0;
                                            }
                                        } else {
                                            $orders = null;
                                            $totalOrderPrices = 0;
                                        }
                                    @endphp
                                    <div class="col-md-3">
                                        <div class="sofa @if ($table->status == 'in_service') sofa-serv
                                                            @elseif($table->status == 'available')
                                                            sofa-available
                                                             @elseif ($table->status == 'reserved')
                                                              sofa-reserved @endif"
                                            data-id="table{{ $table->id }}" data-stat="serv"
                                            data-bs-toggle="modal" data-bs-target="#modal{{ $table->id }}"
                                            data-h="hall{{ $loungesSortowSilver->id }}"
                                            @if ($table->status == 'in_service') data-pstat="serv"
                                                            @elseif($table->status == 'available')
                                                             data-pstat ="available"
                                                             @elseif ($table->status == 'reserved')
                                                              data-pstat ="reserved" @endif>
                                            <div class="table-vip d-flex flex-column align-items-center">
                                                <svg width="116" height="57" viewBox="0 0 116 57" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M68.4057 26.9812L81.3781 26.9812C83.1749 26.9812 84.6361 25.5207 84.6361 23.7235L84.6361 5.79092C84.6361 3.99373 83.1746 2.5332 81.3781 2.5332L68.4057 2.5332C66.6066 2.5332 65.1474 3.99373 65.1474 5.79092L65.1474 23.7232C65.1474 25.5207 66.6066 26.9812 68.4057 26.9812Z"
                                                        fill="#212325" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M27.5104 24.566L27.5104 11.5883C27.5104 9.79113 26.0486 8.33154 24.2517 8.33154L6.32009 8.33154C4.52133 8.33154 3.06204 9.79113 3.06204 11.5883L3.06204 24.566C3.06204 26.3632 4.52164 27.8228 6.32009 27.8228L24.2517 27.8228C26.0486 27.8228 27.5104 26.3635 27.5104 24.566Z"
                                                        fill="#212325" />
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M6.32016 8.00439L24.254 8.00439C26.2318 8.00439 27.8392 9.61123 27.8392 11.5893L27.8392 24.567C27.8392 26.5461 26.2321 28.1532 24.254 28.1532L6.32016 28.1532C4.34016 28.1532 2.7352 26.5461 2.7352 24.567L2.7352 11.5893C2.73489 9.61123 4.34017 8.00439 6.32016 8.00439ZM6.32016 27.4953L24.254 27.4953C25.8696 27.4953 27.1813 26.1833 27.1813 24.567L27.1813 11.5893C27.1813 9.97337 25.8696 8.66104 24.254 8.66104L6.32016 8.66104C4.70451 8.66104 3.3928 9.97306 3.3928 11.5893L3.3928 24.567C3.3928 26.1833 4.70451 27.4953 6.32016 27.4953Z"
                                                        fill="#3E3F41" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M48.9587 26.9814L61.9333 26.9814C63.7299 26.9814 65.1895 25.5221 65.1895 23.7246L65.1895 5.79047C65.1895 3.99328 63.7299 2.53369 61.9333 2.53369L48.9587 2.53369C47.1597 2.53369 45.7023 3.99328 45.7023 5.79047L45.7023 23.7246C45.7023 25.5218 47.1597 26.9814 48.9587 26.9814Z"
                                                        fill="#212325" />
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M48.9587 2.20654L61.9351 2.20654C63.9129 2.20654 65.5204 3.81244 65.5204 5.7918L65.5204 23.7266C65.5204 25.704 63.9132 27.3102 61.9351 27.3102L48.9587 27.3102C46.9787 27.3102 45.3734 25.704 45.3734 23.7266L45.3734 5.79148C45.3734 3.81212 46.9787 2.20654 48.9587 2.20654ZM48.9587 26.6533L61.9351 26.6533C63.5508 26.6533 64.8625 25.3413 64.8625 23.7266L64.8625 5.79148C64.8625 4.17552 63.5508 2.86444 61.9351 2.86444L48.9587 2.86444C47.3408 2.86444 46.0294 4.17552 46.0294 5.79148L46.0294 23.7262C46.0291 25.3413 47.3408 26.6533 48.9587 26.6533Z"
                                                        fill="#3E3F41" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M29.8979 26.9812L42.8725 26.9812C44.6691 26.9812 46.1287 25.5207 46.1287 23.7235L46.1287 5.79092C46.1287 3.99373 44.6691 2.5332 42.8725 2.5332L29.898 2.5332C28.0989 2.5332 26.6396 3.99373 26.6396 5.79092L26.6396 23.7232C26.6396 25.5207 28.0992 26.9812 29.8979 26.9812Z"
                                                        fill="#212325" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M68.4058 26.9817L81.3782 26.9817C83.1751 26.9817 84.6362 25.5212 84.6362 23.724L84.6362 5.79141C84.6362 3.99422 83.1748 2.53369 81.3782 2.53369L68.4058 2.53369C66.6067 2.53369 65.1475 3.99422 65.1475 5.79141L65.1475 23.7237C65.1475 25.5212 66.6067 26.9817 68.4058 26.9817Z"
                                                        fill="#212325" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M68.4058 2.20654L81.3782 2.20654C83.3582 2.20654 84.9653 3.81432 84.9653 5.7918L84.9653 23.724C84.9653 25.704 83.3582 27.3102 81.3782 27.3102L68.4058 27.3102C66.4258 27.3102 64.8187 25.704 64.8187 23.724L64.8187 5.79148C64.8187 3.81432 66.4258 2.20654 68.4058 2.20654ZM68.4058 26.6533L81.3782 26.6533C82.9938 26.6533 84.3093 25.34 84.3093 23.7237L84.3093 5.79148C84.3093 4.17647 82.9935 2.86444 81.3782 2.86444L68.4058 2.86444C66.788 2.86444 65.4763 4.17646 65.4763 5.79148L65.4763 23.7237C65.4763 25.34 66.788 26.6533 68.4058 26.6533Z"
                                                        fill="#3E3F41" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M88.0126 26.9817L100.985 26.9817C102.782 26.9817 104.243 25.5212 104.243 23.724L104.243 5.79141C104.243 3.99422 102.782 2.53369 100.985 2.53369L88.0126 2.53369C86.2136 2.53369 84.7543 3.99422 84.7543 5.79141L84.7543 23.7237C84.7543 25.5212 86.2136 26.9817 88.0126 26.9817Z"
                                                        fill="#212325" />
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M88.0126 2.20654L100.985 2.20654C102.965 2.20654 104.572 3.81432 104.572 5.7918L104.572 23.724C104.572 25.704 102.965 27.3102 100.985 27.3102L88.0126 27.3102C86.0326 27.3102 84.4255 25.704 84.4255 23.724L84.4255 5.79148C84.4255 3.81432 86.0326 2.20654 88.0126 2.20654ZM88.0126 26.6533L100.985 26.6533C102.601 26.6533 103.916 25.34 103.916 23.7237L103.916 5.79148C103.916 4.17647 102.6 2.86444 100.985 2.86444L88.0126 2.86444C86.3948 2.86444 85.0831 4.17646 85.0831 5.79148L85.0831 23.7237C85.0831 25.34 86.3948 26.6533 88.0126 26.6533Z"
                                                        fill="#3E3F41" />
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M29.898 2.2085L42.8725 2.2085C44.8503 2.2085 46.4594 3.8147 46.4594 5.79312L46.4593 23.7269C46.4593 25.7044 44.8503 27.3116 42.8725 27.3116L29.898 27.3116C27.918 27.3116 26.3108 25.7044 26.3108 23.7269L26.3108 5.79312C26.3108 3.8147 27.9183 2.2085 29.898 2.2085ZM29.898 26.6546L42.8725 26.6546C44.486 26.6546 45.7999 25.3416 45.7999 23.7269L45.7999 5.79312C45.7999 4.17716 44.486 2.86482 42.8725 2.86482L29.898 2.86482C28.2823 2.86482 26.9687 4.17685 26.9687 5.79312L26.9687 23.7269C26.9687 25.3416 28.2826 26.6546 29.898 26.6546Z"
                                                        fill="#3E3F41" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M27.5104 43.627L27.5104 30.6531C27.5104 28.8562 26.0508 27.396 24.2539 27.396L6.32009 27.396C4.52353 27.396 3.06394 28.8565 3.06394 30.6531L3.06394 43.627C3.06394 45.4255 4.52353 46.8841 6.32009 46.8841L24.2539 46.8841C26.0508 46.8841 27.5104 45.4255 27.5104 43.627Z"
                                                        fill="#212325" />
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M6.32198 27.0669L24.2536 27.0669C26.2314 27.0669 27.8389 28.6731 27.8389 30.6534L27.8389 43.6286C27.8389 45.607 26.2317 47.2132 24.2536 47.2132L6.32198 47.2132C4.34199 47.2132 2.73484 45.607 2.73484 43.6286L2.73484 30.6534C2.73452 28.6731 4.34199 27.0669 6.32198 27.0669ZM6.32198 46.5569L24.2536 46.5569C25.8693 46.5569 27.1832 45.2433 27.1832 43.6286L27.1832 30.6534C27.1832 29.0368 25.8693 27.7235 24.2536 27.7235L6.32198 27.7235C4.70633 27.7235 3.39243 29.0365 3.39243 30.6534L3.39243 43.6286C3.39243 45.2433 4.70633 46.5569 6.32198 46.5569Z"
                                                        fill="#3E3F41" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M9.28461 56.4702L24.2143 56.4702C26.0153 56.4702 27.4764 55.0065 27.4764 53.205L27.4764 49.928C27.4764 48.1264 26.015 46.6631 24.2143 46.6631L9.28461 46.6631C7.48364 46.6631 6.01997 48.1268 6.01997 49.928L6.01997 53.205C6.01997 55.0065 7.48364 56.4702 9.28461 56.4702Z"
                                                        fill="#212325" />
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M9.287 46.3379L24.2145 46.3379C26.1964 46.3379 27.8098 47.9472 27.8098 49.9298L27.8098 53.2067C27.8098 55.1901 26.1964 56.8001 24.2145 56.8001L9.287 56.8001C7.3026 56.8001 5.69356 55.1901 5.69356 53.2067L5.69356 49.9298C5.69356 47.9469 7.3026 46.3379 9.287 46.3379ZM9.287 56.1431L24.2145 56.1431C25.8339 56.1431 27.1497 54.8258 27.1497 53.2067L27.1497 49.9298C27.1497 48.311 25.8339 46.9942 24.2145 46.9942L9.287 46.9942C7.66727 46.9942 6.35146 48.311 6.35146 49.9298L6.35146 53.2067C6.35146 54.8258 7.66695 56.1431 9.287 56.1431Z"
                                                        fill="#3E3F41" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M90.548 43.627L90.548 30.6531C90.548 28.8562 92.0076 27.396 93.8044 27.396L111.738 27.396C113.535 27.396 114.994 28.8565 114.994 30.6531L114.994 43.627C114.994 45.4255 113.535 46.8841 111.738 46.8841L93.8044 46.8841C92.0076 46.8841 90.548 45.4255 90.548 43.627Z"
                                                        fill="#212325" />
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M111.736 27.0669L93.8047 27.0669C91.827 27.0669 90.2195 28.6731 90.2195 30.6534L90.2195 43.6286C90.2195 45.607 91.8266 47.2132 93.8047 47.2132L111.736 47.2132C113.716 47.2132 115.324 45.607 115.324 43.6286L115.324 30.6534C115.324 28.6731 113.716 27.0669 111.736 27.0669ZM111.736 46.5569L93.8047 46.5569C92.1891 46.5569 90.8752 45.2433 90.8752 43.6286L90.8752 30.6534C90.8752 29.0368 92.1891 27.7235 93.8047 27.7235L111.736 27.7235C113.352 27.7235 114.666 29.0365 114.666 30.6534L114.666 43.6286C114.666 45.2433 113.352 46.5569 111.736 46.5569Z"
                                                        fill="#3E3F41" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M108.773 56.4702L93.8438 56.4702C92.0428 56.4702 90.5817 55.0065 90.5817 53.205L90.5817 49.928C90.5817 48.1264 92.0432 46.6631 93.8438 46.6631L108.773 46.6631C110.574 46.6631 112.038 48.1268 112.038 49.928L112.038 53.205C112.038 55.0065 110.574 56.4702 108.773 56.4702Z"
                                                        fill="#212325" />
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M108.771 46.3379L93.8439 46.3379C91.862 46.3379 90.2485 47.9472 90.2485 49.9298L90.2485 53.2067C90.2485 55.1901 91.862 56.8001 93.8439 56.8001L108.771 56.8001C110.756 56.8001 112.365 55.1901 112.365 53.2067L112.365 49.9298C112.365 47.9469 110.756 46.3379 108.771 46.3379ZM108.771 56.1431L93.8439 56.1431C92.2244 56.1431 90.9086 54.8258 90.9086 53.2067L90.9086 49.9298C90.9086 48.311 92.2244 46.9942 93.8439 46.9942L108.771 46.9942C110.391 46.9942 111.707 48.311 111.707 49.9298L111.707 53.2067C111.707 54.8258 110.391 56.1431 108.771 56.1431Z"
                                                        fill="#3E3F41" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M4.77959 0.663082L87.4786 0.666232C89.9686 0.666232 91.9965 2.68933 91.9965 5.18249L91.9965 5.46629C91.9965 7.96102 89.9686 9.98412 87.4786 9.98412L9.58058 9.98411L9.58058 50.9296C9.58058 53.4238 7.55907 55.4481 5.06465 55.4481L4.77959 55.4481C2.28737 55.4481 0.261753 53.4237 0.261753 50.9296L0.261755 5.18186C0.261441 2.68838 2.28737 0.663082 4.77959 0.663082Z"
                                                        fill="#212325" />
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M4.77965 0.399899L87.4787 0.403049C90.1166 0.403049 92.2589 2.54287 92.2589 5.18265L92.2589 5.46645C92.2589 8.10686 90.1163 10.2498 87.4787 10.2498L9.84525 10.2498L9.84525 50.9298C9.84525 53.5686 7.70259 55.7116 5.06501 55.7116L4.77995 55.7116C2.14206 55.7116 2.80177e-05 53.5686 2.8133e-05 50.9298L3.01327e-05 5.18202C-0.00059902 2.54161 2.14176 0.399898 4.77965 0.399899ZM4.77965 55.1849L5.06471 55.1849C7.41125 55.1849 9.31824 53.2767 9.31824 50.9298L9.31824 9.72093L87.4784 9.72094C89.8227 9.72094 91.7297 7.81362 91.7297 5.46645L91.7297 5.18265C91.7297 2.8358 89.8227 0.929746 87.4762 0.929746L4.77932 0.92754C2.4331 0.92754 0.52579 2.83359 0.52579 5.18202L0.525788 50.9295C0.526103 53.2767 2.43311 55.1849 4.77965 55.1849Z"
                                                        fill="#3E3F41" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M109.476 0.66309L13.0247 0.666233C10.1207 0.666232 7.75562 2.68933 7.75562 5.18249L7.75562 5.46629C7.75561 7.96102 10.1206 9.98412 13.0247 9.98412L103.877 9.98412L103.877 50.9297C103.877 53.4238 106.235 55.4481 109.144 55.4481L109.476 55.4481C112.383 55.4481 114.745 53.4238 114.745 50.9297L114.745 5.18186C114.746 2.68839 112.383 0.663091 109.476 0.66309Z"
                                                        fill="#212325" />
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M109.476 0.399907L13.0246 0.403049C9.94806 0.403049 7.44946 2.54287 7.44946 5.18265L7.44946 5.46645C7.44946 8.10686 9.94843 10.2498 13.0246 10.2498L103.568 10.2498L103.568 50.9298C103.568 53.5687 106.067 55.7116 109.143 55.7116L109.476 55.7116C112.552 55.7116 115.051 53.5687 115.051 50.9298L115.051 5.18203C115.051 2.54162 112.553 0.399907 109.476 0.399907ZM109.476 55.1849L109.144 55.1849C106.407 55.1849 104.183 53.2767 104.183 50.9298L104.183 9.72094L13.025 9.72094C10.2908 9.72094 8.06667 7.81362 8.06667 5.46645L8.06667 5.18265C8.06667 2.8358 10.2908 0.929746 13.0276 0.929746L109.476 0.927548C112.213 0.927548 114.437 2.8336 114.437 5.18203L114.437 50.9295C114.437 53.2767 112.213 55.1849 109.476 55.1849Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M45.7727 39.2727C45.7045 38.697 45.428 38.25 44.9432 37.9318C44.4583 37.6136 43.8636 37.4545 43.1591 37.4545C42.6439 37.4545 42.1932 37.5379 41.8068 37.7045C41.4242 37.8712 41.125 38.1004 40.9091 38.392C40.697 38.6837 40.5909 39.0152 40.5909 39.3864C40.5909 39.697 40.6648 39.964 40.8125 40.1875C40.964 40.4072 41.1572 40.5909 41.392 40.7386C41.6269 40.8826 41.8731 41.0019 42.1307 41.0966C42.3883 41.1875 42.625 41.2614 42.8409 41.3182L44.0227 41.6364C44.3258 41.7159 44.6629 41.8258 45.0341 41.9659C45.4091 42.1061 45.767 42.2973 46.108 42.5398C46.4527 42.7784 46.7367 43.0852 46.9602 43.4602C47.1837 43.8352 47.2955 44.2955 47.2955 44.8409C47.2955 45.4697 47.1307 46.0379 46.8011 46.5455C46.4754 47.053 45.9981 47.4564 45.3693 47.7557C44.7443 48.0549 43.9848 48.2045 43.0909 48.2045C42.2576 48.2045 41.536 48.0701 40.9261 47.8011C40.3201 47.5322 39.8428 47.1572 39.4943 46.6761C39.1496 46.1951 38.9545 45.6364 38.9091 45H40.3636C40.4015 45.4394 40.5492 45.803 40.8068 46.0909C41.0682 46.375 41.3977 46.5871 41.7955 46.7273C42.197 46.8636 42.6288 46.9318 43.0909 46.9318C43.6288 46.9318 44.1117 46.8447 44.5398 46.6705C44.9678 46.4924 45.3068 46.2462 45.5568 45.9318C45.8068 45.6136 45.9318 45.2424 45.9318 44.8182C45.9318 44.4318 45.8239 44.1174 45.608 43.875C45.392 43.6326 45.108 43.4356 44.7557 43.2841C44.4034 43.1326 44.0227 43 43.6136 42.8864L42.1818 42.4773C41.2727 42.2159 40.553 41.8428 40.0227 41.358C39.4924 40.8731 39.2273 40.2386 39.2273 39.4545C39.2273 38.803 39.4034 38.2348 39.7557 37.75C40.1117 37.2614 40.589 36.8826 41.1875 36.6136C41.7898 36.3409 42.4621 36.2045 43.2045 36.2045C43.9545 36.2045 44.6212 36.339 45.2045 36.608C45.7879 36.8731 46.25 37.2367 46.5909 37.6989C46.9356 38.161 47.1174 38.6856 47.1364 39.2727H45.7727ZM49.4304 48V39.2727H50.7713V48H49.4304ZM50.1122 37.8182C49.8509 37.8182 49.6255 37.7292 49.4361 37.5511C49.2505 37.3731 49.1577 37.1591 49.1577 36.9091C49.1577 36.6591 49.2505 36.4451 49.4361 36.267C49.6255 36.089 49.8509 36 50.1122 36C50.3736 36 50.5971 36.089 50.7827 36.267C50.9721 36.4451 51.0668 36.6591 51.0668 36.9091C51.0668 37.1591 50.9721 37.3731 50.7827 37.5511C50.5971 37.7292 50.3736 37.8182 50.1122 37.8182ZM54.5682 36.3636V48H53.2273V36.3636H54.5682ZM64.1605 39.2727L60.9332 48H59.5696L56.3423 39.2727H57.7969L60.206 46.2273H60.2969L62.706 39.2727H64.1605ZM69.277 48.1818C68.4361 48.1818 67.7107 47.9962 67.1009 47.625C66.4948 47.25 66.027 46.7273 65.6974 46.0568C65.3717 45.3826 65.2088 44.5985 65.2088 43.7045C65.2088 42.8106 65.3717 42.0227 65.6974 41.3409C66.027 40.6553 66.4853 40.1212 67.0724 39.7386C67.6634 39.3523 68.3527 39.1591 69.1406 39.1591C69.5952 39.1591 70.044 39.2348 70.4872 39.3864C70.9304 39.5379 71.3338 39.7841 71.6974 40.125C72.0611 40.4621 72.3509 40.9091 72.5668 41.4659C72.7827 42.0227 72.8906 42.7083 72.8906 43.5227V44.0909H66.1634V42.9318H71.527C71.527 42.4394 71.4285 42 71.2315 41.6136C71.0384 41.2273 70.7618 40.9223 70.402 40.6989C70.0459 40.4754 69.6255 40.3636 69.1406 40.3636C68.6065 40.3636 68.1444 40.4962 67.7543 40.7614C67.3679 41.0227 67.0705 41.3636 66.8622 41.7841C66.6539 42.2045 66.5497 42.6553 66.5497 43.1364V43.9091C66.5497 44.5682 66.6634 45.1269 66.8906 45.5852C67.1217 46.0398 67.4418 46.3864 67.8509 46.625C68.2599 46.8598 68.7353 46.9773 69.277 46.9773C69.6293 46.9773 69.9474 46.928 70.2315 46.8295C70.5194 46.7273 70.7675 46.5758 70.9759 46.375C71.1842 46.1705 71.3452 45.9167 71.4588 45.6136L72.7543 45.9773C72.6179 46.4167 72.3887 46.803 72.0668 47.1364C71.7448 47.4659 71.3471 47.7235 70.8736 47.9091C70.4001 48.0909 69.8679 48.1818 69.277 48.1818ZM74.9304 48V39.2727H76.2259V40.5909H76.3168C76.4759 40.1591 76.7637 39.8087 77.1804 39.5398C77.5971 39.2708 78.0668 39.1364 78.5895 39.1364C78.688 39.1364 78.8111 39.1383 78.9588 39.142C79.1065 39.1458 79.2183 39.1515 79.294 39.1591V40.5227C79.2486 40.5114 79.1444 40.4943 78.9815 40.4716C78.8224 40.4451 78.6539 40.4318 78.4759 40.4318C78.0516 40.4318 77.6728 40.5208 77.3395 40.6989C77.0099 40.8731 76.7486 41.1155 76.5554 41.4261C76.366 41.733 76.2713 42.0833 76.2713 42.4773V48H74.9304Z"
                                                        fill="white" />
                                                </svg>
                                                <h4>{{ $table->name }}</h4>
                                            </div>
                                            
                                            <div class="modal table-modal fade" id="modal{{ $table->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="card  @if ($table->status == 'in_service') bg-info
                                                 @elseif($table->status == 'available')
                                                bg-success text-light
                                                @elseif ($table->status == 'reserved')
                                                   bg-danger  text-light @endif"
                                                data-id="table1" data-stat="serv">
                                                <div class="modal-header">
                                                    <div
                                                        class="card-header primary-bg-color w-100 d-flex justify-content-between">
                                                        <h3 class="modal-title fs-5" id="exampleModalLabel">
                                                            {{ $table->name }}</h3>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="card-item mid d-flex justify-content-between">
                                                        <p class="hall-name"> الباقة</p>
                                                        <span class="sta">
                                                            {{ $table->reservation != null ? $table->reservation->package->name : 'لا توجد باقة' }}
                                                        </span>
                                                    </div>
                                                    <div class="card-item body-package d-flex justify-content-between">
                                                        <p class="hall-name"> المقاعد</p>
                                                        <span class="sta">
                                                            {{ $table->reservation != null ? $table->reservation->package->count_of_visitors : 0 }}
                                                            اشخاص</span>
                                                    </div>
                                                    <div class="card-item body-time d-flex justify-content-between">
                                                        <p class="hall-name"> الحجز</p>
                                                        <span
                                                            class="sta">{{ $table->reservation != null ? $table->reservation->price : 0 }}
                                                            ريال</span>
                                                    </div>
                                                    <div class="card-item body-time d-flex justify-content-between">
                                                        <p class="hall-name"> المدة</p>
                                                        <span
                                                            class="sta">{{ $table->reservation != null ? $table->reservation->minutes : 0 }}
                                                            ساعة </span>
                                                    </div>
                                                    <div class="card-item body-time d-flex justify-content-between">
                                                        <p class="hall-name"> الحالة</p>
                                                        <span class="sta">
                                                            {{ $table->reservation != null ? $table->reservation->status : 'لا يوجد حجز' }}</span>
                                                    </div>
                                                    <div class="card-item body-time d-flex justify-content-between">
                                                        <p class="hall-name"> الرصيد الحالى</p>
                                                        <span class="sta">
                                                            {{ $table->reservation != null ? $table->reservation->price : 0 }}
                                                            ريال </span>
                                                    </div>
                                                    @php
                                                        if ($table->reservation) {
                                                            $formattedTime = Carbon\Carbon::createFromFormat('g:i A', $table->reservation->time)->format('H:i');
                                                            $reservationDateTime = $table->reservation->date;
                                                        }

                                                    @endphp
                                                    <div class="card-item body-time d-flex justify-content-between">
                                                        <p class="hall-name"> الوقت المنقضى</p>
                                                        <div class="countdown-timer"
                                                            data-start="{{ $table->reservation ? $table->reservation->date : '' }}"
                                                            data-package-time="{{ $table->reservation->package->time ?? 0 }}">
                                                            <!-- Add a span to display the countdown timer -->
                                                            @if ($table->reservation)
                                                                <span class="countdown-timer-text">00:00:00</span>
                                                            @else
                                                                <span>انتهى</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="table-btn my-3 text-center">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-2">
                                                                <button class="table-btn-action btn btn-primary w-100"
                                                                    type="button" data-id="#tableorders">
                                                                    الطلبات
                                                                </button>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <button class="table-btn-action btn btn-primary w-100"
                                                                    type="button" data-id="#tableinfo">
                                                                    استعراض
                                                                </button>
                                                            </div>
                                                            @if ($table->reservation)
                                                                <div class="col-md-6">
                                                                    <button class="table-btn-action btn btn-primary w-100"
                                                                        type="button" disabled data-id="#exampleModal_{{ $table->id }}">
                                                                        تفعيل الحجز
                                                                    </button>
                                                                </div>
                                                            @else
                                                                <div class="col-md-6">
                                                                    <button disabled
                                                                        class="table-btn-action btn btn-primary w-100"
                                                                        type="button" disabled data-id="#exampleModal_{{ $table->id }}">
                                                                        تفعيل الحجز
                                                                    </button>
                                                                     <!-- Modal -->
                                                                            <div class="modal fade"
                                                                                id="exampleModal_{{ $table->id }}"
                                                                                tabindex="-1"
                                                                                aria-labelledby="exampleModalLabel"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h1 class="modal-title fs-5"
                                                                                                id="exampleModalLabel">
                                                                                                تفعيل الحجز</h1>
                                                                                            <button type="button"
                                                                                                class="btn-close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div
                                                                                                class="modal-body text-light">
                                                                                                هل تود تفعيل الحجز
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <a type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-bs-dismiss="modal">اغلاق</a>
                                                                                            <button type="button"
                                                                                                onclick="activeTable({{ $table->id }})"
                                                                                                class="btn btn-primary">تأكيد
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                </div>
                                                            @endif
                                                              
                                                            @if ($table->reservation)
                                                                <div class="col-md-6">
                                                                    <button class="table-btn-action btn btn-primary w-100"
                                                                        type="button" data-id="#tableend">
                                                                        انهاء الحجز
                                                                    </button>
                                                                      <!-- Modal -->
                                                                            <div class="modal fade"
                                                                                id="close_{{ $table->id }}"
                                                                                tabindex="-1"
                                                                                aria-labelledby="exampleModalLabel"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h1 class="modal-title fs-5"
                                                                                                id="exampleModalLabel">
                                                                                                انهاء الحجز</h1>
                                                                                            <button type="button"
                                                                                                class="btn-close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div
                                                                                                class="modal-body text-light">
                                                                                                هل تود انهاء الحجز
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-bs-dismiss="modal">اغلاق</button>
                                                                                            <a type="button"
                                                                                                onclick="closeTable({{ $table->id }})"
                                                                                                class="btn btn-primary">انهاء
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                </div>
                                                            @else
                                                                <div class="col-md-6">
                                                                    <button disabled
                                                                        class="table-btn-action btn btn-primary w-100"
                                                                        type="button" data-id="#tableend">
                                                                        انهاء الحجز
                                                                    </button>
                                                                </div>
                                                            @endif
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>


                                            <!--<div class="modal-body">-->
                                            <!--    <ul class="list-group">-->
                                            <!--        <li class="list-group-item">-->
                                            <!--            <div class="d-flex">-->
                                            <!--                <div class="left t-packagename">VVIP</div>-->
                                            <!--                <div class="right t-statu">{{ $table->status }}</div>-->
                                            <!--            </div>-->
                                            <!--        </li>-->
                                            <!--        <li class="list-group-item">-->
                                            <!--            <div class="d-flex">-->
                                            <!--                <div class="left t-packagepeice">باقة ساعاتان</div>-->
                                            <!--                <div class="right t-capicity">4 أشخاص</div>-->
                                            <!--            </div>-->
                                            <!--        </li>-->
                                            <!--        <li class="list-group-item">-->
                                            <!--            <div class="d-flex">-->
                                            <!--                <div class="left t-packagedate"> 10-8</div>-->
                                            <!--                <div class="right t-time">08:00 </div>-->
                                            <!--            </div>-->
                                            <!--        </li>-->
                                            <!--        <li class="list-group-item">-->
                                            <!--            <div class="d-flex">-->
                                            <!--                <div class="left t-waiter"> أسم الويتر: </div>-->
                                            <!--                <div class="right t-time">أحمد مرزوق </div>-->
                                            <!--            </div>-->
                                            <!--        </li>-->
                                            <!--    </ul>-->
                                            <!--</div>-->
                                            <!--<div class="modal-footer">-->
                                            <!--    <div class="left t-allpoint"> <span class="point">800</span> الرصيد-->
                                            <!--    </div>-->
                                            <!--    <div class="right t-points"> <span class="have-point">200</span> الرصيد-->
                                            <!--        المتبقى </div>-->
                                            <!--</div>-->
                                        </div>
                                    </div>

                                </div>
                                            @if ($table->status == 'in_service')
                                                <div class="table-side-bar" id="table{{ $table->id }}">
                                                    <h2 class="text-center mb-4">طاولة رقم
                                                        {{ $table->name }}</h2>
                                                    <div class="tab-nav-wraper">
                                                        <ul class="nav c-nav-tabs d-flex justify-content-between home-tab">
                                                            <li class="nav-item">
                                                                <a class="nav-link " data-tab="reservations"
                                                                    href="#">
                                                                    الحجوزات</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-tab="orders" href="#">
                                                                    الطلبات</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link active" data-tab="the-menu"
                                                                    href="#">
                                                                    القائمة</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- عناصر التاب -->
                                                    <div class="tab-content">
                                                        <div id="the-menu" class="c-tab-pane active">
                                                            <ol class="list-group list-group-numbered reversed">


                                                                @if ($orders != null && $orders->products->count() != 0)
                                                                    @foreach ($orders->products as $product)
                                                                        <li
                                                                            class="list-group-item d-flex justify-content-between align-items-start">
                                                                            <div class="me-2 ms-auto">
                                                                                <div class="fw-bold">
                                                                                    {{ $product->name }}
                                                                                </div>
                                                                            </div>

                                                                            <span>{{ $product->pivot->price }}
                                                                                ريال</span>
                                                                        </li>
                                                                    @endforeach
                                                                @endif

                                                                <li
                                                                    class="new-menu-li list-group-item d-flex justify-content-center align-items-start">
                                                                    <a onclick="product({{ $table->id }})"
                                                                        class="me-2">
                                                                        <div class="fw-bold">اضف عنصر
                                                                            جديد
                                                                        </div>
                                                                    </a>
                                                                </li>

                                                            </ol>

                                                            <ol class="list-group reversed none  mt-5">
                                                                <li class="list-group-item no-number  ">
                                                                    <div
                                                                        class="sub-total d-flex justify-content-between align-items-start">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold"> حاصل
                                                                                الجمع</div>
                                                                        </div>
                                                                        <span>{{ $table->reservation->package->price ?? 0 }}
                                                                            ريال</span>
                                                                    </div>

                                                                    <div
                                                                        class="tax d-flex justify-content-between align-items-start mt-4">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold"> ضريبة
                                                                            </div>
                                                                        </div>
                                                                        <span>15%</span>
                                                                    </div>
                                                                    <div
                                                                        class="tax d-flex justify-content-between align-items-start mt-4 total">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold">
                                                                                الإجمالى
                                                                            </div>
                                                                        </div>

                                                                        @php
                                                                            $total = $table->reservation->package->price ?? 0 * 0.15;
                                                                        @endphp

                                                                        <span>{{ $total - $totalOrderPrices }}

                                                                            ريال</span>
                                                                    </div>
                                                                    <div class="payment-method">
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <div
                                                                                    class="payment-icon d-flex justify-content-center align-items-center">
                                                                                    <i class="fa-solid fa-sack-dollar"></i>
                                                                                </div>
                                                                                <p class="text-center">
                                                                                    كاش
                                                                                </p>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div
                                                                                    class="payment-icon d-flex justify-content-center align-items-center">
                                                                                    <i class="fa-solid fa-credit-card"></i>
                                                                                </div>
                                                                                <p class="text-center">
                                                                                    بطاقة ائتمان</p>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div
                                                                                    class="payment-icon d-flex justify-content-center align-items-center">
                                                                                    <i class="fa-solid fa-wallet"></i>
                                                                                </div>
                                                                                <p class="text-center">
                                                                                    المحفظة</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="payment-btn my-3 text-center">
                                                                            <div class="btn btn-primary btn-lg w-100"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#exampleModal6">
                                                                                ادفع الآن</div>
                                                                            <!-- Modal -->
                                                                            <div class="modal fade" id="exampleModal6"
                                                                                tabindex="-1"
                                                                                aria-labelledby="exampleModalLabel6"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title"
                                                                                                id="exampleModalLabel">
                                                                                                تأكيد
                                                                                                الدفع
                                                                                            </h5>
                                                                                            <button type="button"
                                                                                                class="btn-close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <p class="consfirm-text">
                                                                                                هل تريد
                                                                                                تأكيد
                                                                                                الدفع
                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button"
                                                                                                class="btn btn-primary">تأكيد</button>
                                                                                            <button type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-bs-dismiss="modal">لا
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>



                                                            </ol>

                                                        </div>
                                                        <div id="orders" class="c-tab-pane ">
                                                            @foreach ($table->reservations as $reservation)
                                                                <ol
                                                                    class="list-group list-group-numbered reversed bill-info">
                                                                    <li
                                                                        class="list-group-item d-flex justify-content-between align-items-start">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold"> طلب
                                                                                باسم
                                                                            </div>
                                                                        </div>
                                                                        <span>{{ $reservation->client->name }}</span>
                                                                    </li>
                                                                    <li
                                                                        class="list-group-item d-flex justify-content-between align-items-start">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold">اسم
                                                                                الباقة
                                                                            </div>
                                                                        </div>
                                                                        <span>
                                                                            {{ $reservation->package->name }}</span>
                                                                    </li>
                                                                    <li
                                                                        class="list-group-item d-flex justify-content-between align-items-start">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold">
                                                                                الرصيد
                                                                            </div>
                                                                        </div>
                                                                        <span>{{ $reservation->package->price }}
                                                                        </span>
                                                                    </li>
                                                                    <li
                                                                        class="list-group-item d-flex justify-content-between align-items-start">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold">
                                                                                الحالة
                                                                            </div>
                                                                        </div>
                                                                        <span class="badge bg-info">تم
                                                                            الدفع </span>
                                                                    </li>
                                                                    <li
                                                                        class="new-menu-li list-group-item d-flex justify-content-center align-items-start">
                                                                        <div class="me-2">
                                                                            <div class="fw-bold"> طباعة
                                                                                الطلب</div>
                                                                        </div>
                                                                    </li>
                                                                </ol>
                                                            @endforeach

                                                        </div>
                                                        <div id="reservations" class="c-tab-pane ">
                                                            <div class="hour-col">
                                                                <div class="body-hour-cel">
                                                                    <div class="row gx-0 p-2 text-center">
                                                                        <div class="col-md-2">
                                                                            <p class="hour mb-0">05:00
                                                                                AM
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            <div class="row gx-0">
                                                                                <div class="col-md-9">
                                                                                    <div
                                                                                        class="d-flex h-100 justify-content-around align-items-center">
                                                                                        <div class="gusts">
                                                                                            <span class="table-gusts px-2">
                                                                                                4</span>
                                                                                            <span> <i
                                                                                                    class="fa-solid fa-users"></i></span>
                                                                                        </div>
                                                                                        <div class="table-res">
                                                                                            طاولة 1
                                                                                        </div>
                                                                                        <span
                                                                                            class="badge bg-secondary">مؤكد</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <span>رصيد متبقى
                                                                                        600</span>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="body-hour-cel">
                                                                    <div class="row gx-0 p-2 text-center">
                                                                        <div class="col-md-2">
                                                                            05:15 AM
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            <div class="row gx-0">
                                                                                <div class="col-md-9">
                                                                                    <div
                                                                                        class="d-flex justify-content-center align-items-center">
                                                                                        <span>لا يوجد
                                                                                            حجز</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <span>لا يوجد
                                                                                        رصيد</span>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="body-hour-cel">
                                                                    <div class="row gx-0 p-2 text-center">
                                                                        <div class="col-md-2">
                                                                            05:30 AM
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            <div class="row gx-0">
                                                                                <div class="col-md-9">
                                                                                    <div
                                                                                        class="d-flex justify-content-center align-items-center">
                                                                                        <span>لا يوجد
                                                                                            حجز</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <span>لا يوجد
                                                                                        رصيد</span>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="body-hour-cel">
                                                                    <div class="row gx-0 p-2 text-center">
                                                                        <div class="col-md-2">
                                                                            05:45 AM
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            <div class="row gx-0">
                                                                                <div class="col-md-9">
                                                                                    <div
                                                                                        class="d-flex justify-content-center align-items-center">
                                                                                        <span>لا يوجد
                                                                                            حجز</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <span>لا يوجد
                                                                                        رصيد</span>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                @can('add_reservation')
                                                    <div class="table-side-bar" id="table{{ $table->id }}">
                                                        <ol class="table-list list-group list-group-numbered reversed">
                                                            <li
                                                                class="menu-info-list list-group-item d-flex  flex-column justify-content-center align-items-center text-center p-0">
                                                                <a class="new-reserv-btn btn btn-link w-100"
                                                                    href="{{ route('branch.reservation') }}">
                                                                    <i class="fa-solid fa-plus"></i>
                                                                    <p>انشاء حجز جديد </p>
                                                                </a>
                                                            </li>

                                                        </ol>

                                                    </div>
                                                @endcan
                                            @endif
                                        </div>
                                    </div>
                                @endforeach



                            </div>
                        </div>
                        <div class="middel salon8">
                            <h1 class="dine-set">DINE SET</h1>
                            <div class="row">
                                @foreach ($loungesSorThree->tables as $table)
                                    @php
                                        if ($table->reservation) {
                                            $orders = App\Models\Order::where('package_id', $table->reservation->package_id)
                                                ->where('table_id', $table->id)
                                                ->where('is_done', 0)
                                                ->with('products')
                                                ->first();

                                            // Wrap the related products in a collection (even if there's only one result)
                                            if ($orders != null && $orders->products->count() != 0) {
                                                // Calculate total order prices using the map function on the products collection
                                                $totalOrderPrices = $orders->products->sum(function ($product) {
                                                    return $product->pivot->price * $product->pivot->quantity;
                                                });
                                            } else {
                                                $totalOrderPrices = 0;
                                            }
                                        } else {
                                            $orders = null;
                                            $totalOrderPrices = 0;
                                        }
                                    @endphp
                                    <div class="col-md-2">
                                        <div class="sofa my-3 @if ($table->status == 'in_service') sofa-serv
                                                            @elseif($table->status == 'available')
                                                            sofa-available
                                                             @elseif ($table->status == 'reserved')
                                                              sofa-reserved @endif"
                                            data-id="table{{ $table->id }}" data-stat="serv"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modal{{ $table->id }}"
                                            data-h="hall{{ $loungesSorThree->id }}"
                                            @if ($table->status == 'in_service') data-pstat="serv"
                                                            @elseif($table->status == 'available')
                                                             data-pstat ="available"
                                                             @elseif ($table->status == 'reserved')
                                                              data-pstat ="reserved" @endif>
                                            <div class="table-dine">
                                                <h4>{{ $table->name }}</h4>
                                                <svg width="53" height="56" viewBox="0 0 53 56" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g opacity="0.3">
                                                        <path
                                                            d="M35.4641 14.5514L34.8813 14.6792L35.8859 19.2202L36.4687 19.0924L35.4641 14.5514Z"
                                                            fill="black" />
                                                        <path
                                                            d="M35.9722 18.47C36.0855 18.681 36.2066 18.9083 36.3273 19.1218L36.4687 19.0907L35.4639 14.5498C35.4639 14.5498 35.4209 17.4435 35.9722 18.47Z"
                                                            fill="black" />
                                                        <path
                                                            d="M41.9729 19.0924L42.5557 19.2202L43.5602 14.6792L42.9774 14.5514L41.9729 19.0924Z"
                                                            fill="black" />
                                                        <path
                                                            d="M42.4709 18.47C42.3576 18.681 42.2365 18.9083 42.1158 19.1218L41.9742 19.0907L42.9791 14.5498C42.9791 14.5498 43.0222 17.4435 42.4709 18.47Z"
                                                            fill="black" />
                                                        <path
                                                            d="M42.3733 17.5425H36.0697C35.4878 17.5425 35.0009 17.9823 34.9444 18.5589L34.3504 24.6263C34.2857 25.288 34.8079 25.8613 35.4758 25.8613H42.9672C43.635 25.8613 44.1573 25.288 44.0925 24.6263L43.4985 18.5589C43.4421 17.9823 42.9553 17.5425 42.3733 17.5425Z"
                                                            fill="black" />
                                                        <path
                                                            d="M34.3832 25.0216C34.5096 25.5007 34.9464 25.8615 35.4759 25.8615H42.9673C43.6352 25.8615 44.1574 25.2883 44.0927 24.6266L43.4987 18.5592C43.4792 18.3603 43.4077 18.1784 43.2995 18.0244C41.3943 22.011 36.003 24.3852 34.3832 25.0216Z"
                                                            fill="black" />
                                                        <path
                                                            d="M35.4758 25.3753C35.2924 25.3753 35.1234 25.3007 35 25.1654C34.8767 25.0302 34.8186 24.8554 34.8366 24.6736L35.4305 18.6063C35.4627 18.2771 35.7374 18.0288 36.0698 18.0288H42.3734C42.7056 18.0288 42.9803 18.2771 43.0128 18.6063L43.6064 24.6736C43.6244 24.8554 43.5663 25.03 43.443 25.1653C43.3197 25.3005 43.1506 25.3751 42.967 25.3751H35.4758V25.3753Z"
                                                            fill="black" />
                                                        <path
                                                            d="M41.9283 17.0024H36.5149C36.2153 17.0024 35.9724 17.2443 35.9724 17.5426H42.471C42.4709 17.2443 42.228 17.0024 41.9283 17.0024Z"
                                                            fill="black" />
                                                        <path
                                                            d="M39.2216 13.9053C37.4711 13.9053 35.7967 14.0494 34.3271 14.3247C33.8911 14.4064 33.5917 14.8076 33.6452 15.2462C33.6821 15.5487 33.9686 15.7547 34.2689 15.6953C35.7389 15.4044 37.4377 15.2516 39.2216 15.2516C41.0056 15.2516 42.7043 15.4044 44.1744 15.6953C44.4747 15.7547 44.7612 15.5487 44.7981 15.2462C44.8515 14.8077 44.5522 14.4064 44.1162 14.3247C42.6464 14.0496 40.972 13.9053 39.2216 13.9053Z"
                                                            fill="black" />
                                                        <path
                                                            d="M43.4431 25.1652C43.5663 25.03 43.6245 24.8554 43.6066 24.6735L43.2826 21.3618C41.8219 25.0643 35.476 25.375 35.476 25.375H42.9673C43.1508 25.375 43.3198 25.3004 43.4431 25.1652Z"
                                                            fill="black" />
                                                        <path
                                                            d="M36.4183 17.0121C36.9347 17.2683 37.9946 17.4443 39.2216 17.4443C40.4487 17.4443 41.5083 17.2681 42.0249 17.0121C41.9935 17.0064 41.9614 17.0024 41.9285 17.0024H36.5151C36.4817 17.0023 36.4497 17.0064 36.4183 17.0121Z"
                                                            fill="black" />
                                                        <path
                                                            d="M44.1744 15.6951C44.4746 15.7545 44.7611 15.5485 44.798 15.246C44.8373 14.924 44.6852 14.6231 44.4295 14.4531C44.4922 14.7639 44.4748 15.0573 44.2254 15.1476C43.6286 15.3636 42.7357 14.8053 39.2216 14.8053C35.7075 14.8053 34.8146 15.3637 34.2178 15.1476C33.9684 15.0573 33.951 14.7637 34.0137 14.4531C33.758 14.6231 33.6059 14.9239 33.6452 15.246C33.6821 15.5485 33.9686 15.7545 34.2688 15.6951C35.7389 15.4042 37.4377 15.2514 39.2216 15.2514C41.0055 15.2516 42.7042 15.4044 44.1744 15.6951Z"
                                                            fill="black" />
                                                    </g>
                                                    <path
                                                        d="M33.7646 12.859L33.1818 12.9868L34.1863 17.5279L34.7691 17.4001L33.7646 12.859Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M34.2725 16.7776C34.3858 16.9887 34.5069 17.2159 34.6276 17.4294L34.769 17.3983L33.7642 12.8574C33.7642 12.8574 33.7212 15.7511 34.2725 16.7776Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M40.2732 17.4L40.856 17.5278L41.8605 12.9868L41.2777 12.859L40.2732 17.4Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M40.7712 16.7776C40.6579 16.9887 40.5368 17.2159 40.4161 17.4294L40.2745 17.3983L41.2794 12.8574C41.2794 12.8574 41.3225 15.7511 40.7712 16.7776Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M40.6736 15.8501H34.37C33.7881 15.8501 33.3012 16.2899 33.2447 16.8666L32.6507 22.9339C32.586 23.5956 33.1082 24.1689 33.7761 24.1689H41.2674C41.9353 24.1689 42.4576 23.5956 42.3928 22.9339L41.7988 16.8666C41.7424 16.2899 41.2555 15.8501 40.6736 15.8501Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M32.6835 23.3293C32.8099 23.8083 33.2467 24.1691 33.7762 24.1691H41.2676C41.9354 24.1691 42.4577 23.5959 42.393 22.9342L41.799 16.8668C41.7795 16.6679 41.708 16.4859 41.5998 16.332C39.6946 20.3186 34.3033 22.6928 32.6835 23.3293Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M33.7761 23.6829C33.5927 23.6829 33.4236 23.6083 33.3003 23.473C33.177 23.3378 33.1189 23.163 33.1369 22.9812L33.7308 16.914C33.763 16.5847 34.0377 16.3364 34.3701 16.3364H40.6737C41.0059 16.3364 41.2806 16.5847 41.3131 16.914L41.9067 22.9812C41.9247 23.163 41.8666 23.3377 41.7433 23.4729C41.6199 23.6081 41.4509 23.6827 41.2673 23.6827H33.7761V23.6829Z"
                                                        fill="#1B1C1E" />
                                                    <path
                                                        d="M40.2286 15.3101H34.8152C34.5156 15.3101 34.2727 15.5519 34.2727 15.8502H40.7713C40.7712 15.5519 40.5282 15.3101 40.2286 15.3101Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M37.5219 12.2129C35.7714 12.2129 34.097 12.357 32.6274 12.6323C32.1913 12.714 31.892 13.1152 31.9455 13.5538C31.9824 13.8563 32.2689 14.0623 32.5691 14.0029C34.0392 13.712 35.738 13.5592 37.5219 13.5592C39.3059 13.5592 41.0046 13.712 42.4747 14.0029C42.775 14.0623 43.0614 13.8563 43.0984 13.5538C43.1518 13.1154 42.8525 12.714 42.4165 12.6323C40.9467 12.3572 39.2723 12.2129 37.5219 12.2129Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M41.7434 23.4728C41.8665 23.3376 41.9248 23.163 41.9069 22.9811L41.5829 19.6694C40.1222 23.3719 33.7762 23.6827 33.7762 23.6827H41.2676C41.451 23.6827 41.6201 23.608 41.7434 23.4728Z"
                                                        fill="#1B1C1E" />
                                                    <path
                                                        d="M34.7186 15.3198C35.235 15.5759 36.2949 15.7519 37.5219 15.7519C38.7489 15.7519 39.8086 15.5758 40.3252 15.3198C40.2938 15.3141 40.2617 15.3101 40.2288 15.3101H34.8154C34.782 15.3099 34.75 15.3141 34.7186 15.3198Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M42.4747 14.0027C42.7749 14.0621 43.0614 13.8561 43.0983 13.5537C43.1376 13.2317 42.9855 12.9307 42.7298 12.7607C42.7925 13.0715 42.7751 13.3649 42.5257 13.4552C41.9289 13.6712 41.036 13.1129 37.5219 13.1129C34.0078 13.1129 33.1149 13.6714 32.5181 13.4552C32.2687 13.3649 32.2513 13.0714 32.314 12.7607C32.0583 12.9307 31.9062 13.2315 31.9455 13.5537C31.9824 13.8561 32.2689 14.0621 32.5691 14.0027C34.0392 13.7118 35.738 13.5591 37.5219 13.5591C39.3058 13.5592 41.0044 13.712 42.4747 14.0027Z"
                                                        fill="#3E3F41" />
                                                    <g opacity="0.3">
                                                        <path
                                                            d="M13.5746 14.5504L12.9918 14.6782L13.9964 19.2193L14.5792 19.0915L13.5746 14.5504Z"
                                                            fill="black" />
                                                        <path
                                                            d="M14.083 18.47C14.1962 18.681 14.3174 18.9083 14.4381 19.1218L14.5794 19.0907L13.5748 14.5498C13.5748 14.5498 13.5317 17.4435 14.083 18.47Z"
                                                            fill="black" />
                                                        <path
                                                            d="M20.084 19.0914L20.6667 19.2192L21.6713 14.6782L21.0885 14.5504L20.084 19.0914Z"
                                                            fill="black" />
                                                        <path
                                                            d="M20.5816 18.47C20.4683 18.681 20.3473 18.9083 20.2265 19.1218L20.085 19.0907L21.0898 14.5498C21.0898 14.5498 21.1329 17.4435 20.5816 18.47Z"
                                                            fill="black" />
                                                        <path
                                                            d="M20.4842 17.5425H14.1806C13.5987 17.5425 13.1118 17.9823 13.0552 18.5589L12.4612 24.6263C12.3965 25.288 12.9188 25.8613 13.5866 25.8613H21.078C21.7458 25.8613 22.2681 25.288 22.2034 24.6263L21.6094 18.5589C21.553 17.9823 21.0661 17.5425 20.4842 17.5425Z"
                                                            fill="black" />
                                                        <path
                                                            d="M12.4939 25.0216C12.6203 25.5007 13.0571 25.8615 13.5867 25.8615H21.078C21.7459 25.8615 22.2681 25.2883 22.2034 24.6266L21.6094 18.5592C21.59 18.3603 21.5184 18.1784 21.4103 18.0244C19.505 22.011 14.1137 24.3852 12.4939 25.0216Z"
                                                            fill="black" />
                                                        <path
                                                            d="M13.5865 25.3753C13.4031 25.3753 13.2341 25.3007 13.1107 25.1654C12.9874 25.0302 12.9293 24.8554 12.9471 24.6736L13.5411 18.6063C13.5732 18.2771 13.848 18.0288 14.1803 18.0288H20.4839C20.8161 18.0288 21.0909 18.2771 21.1233 18.6063L21.717 24.6736C21.7349 24.8554 21.6768 25.03 21.5537 25.1653C21.4304 25.3005 21.2613 25.3751 21.0777 25.3751H13.5865V25.3753Z"
                                                            fill="black" />
                                                        <path
                                                            d="M20.0391 17.0024H14.6255C14.3259 17.0024 14.083 17.2443 14.083 17.5426H20.5816C20.5816 17.2443 20.3387 17.0024 20.0391 17.0024Z"
                                                            fill="black" />
                                                        <path
                                                            d="M17.3322 13.9053C15.5819 13.9053 13.9073 14.0494 12.4377 14.3247C12.0016 14.4064 11.7023 14.8076 11.7558 15.2462C11.7927 15.5487 12.0792 15.7547 12.3794 15.6953C13.8495 15.4044 15.5483 15.2516 17.3322 15.2516C19.1163 15.2516 20.8149 15.4044 22.2852 15.6953C22.5853 15.7547 22.8719 15.5487 22.9087 15.2462C22.9621 14.8077 22.6628 14.4064 22.2268 14.3247C20.7572 14.0496 19.0828 13.9053 17.3322 13.9053Z"
                                                            fill="black" />
                                                        <path
                                                            d="M21.5539 25.1652C21.677 25.03 21.7353 24.8554 21.7172 24.6735L21.3932 21.3618C19.9325 25.0643 13.5865 25.375 13.5865 25.375H21.0779C21.2615 25.375 21.4305 25.3004 21.5539 25.1652Z"
                                                            fill="black" />
                                                        <path
                                                            d="M14.5292 17.0121C15.0456 17.2683 16.1054 17.4443 17.3325 17.4443C18.5595 17.4443 19.6192 17.2681 20.1357 17.0121C20.1044 17.0064 20.0724 17.0024 20.0393 17.0024H14.6257C14.5925 17.0023 14.5605 17.0064 14.5292 17.0121Z"
                                                            fill="black" />
                                                        <path
                                                            d="M22.2852 15.6951C22.5855 15.7545 22.872 15.5485 22.9089 15.246C22.9481 14.924 22.7961 14.6231 22.5404 14.4531C22.6031 14.7639 22.5856 15.0573 22.3362 15.1476C21.7395 15.3636 20.8465 14.8053 17.3324 14.8053C13.8184 14.8053 12.9254 15.3637 12.3287 15.1476C12.0793 15.0573 12.0618 14.7637 12.1245 14.4531C11.8688 14.6231 11.7168 14.9239 11.756 15.246C11.7929 15.5485 12.0794 15.7545 12.3797 15.6951C13.8497 15.4042 15.5485 15.2514 17.3324 15.2514C19.1164 15.2516 20.8152 15.4044 22.2852 15.6951Z"
                                                            fill="black" />
                                                    </g>
                                                    <path
                                                        d="M11.875 12.858L11.2922 12.9858L12.2968 17.5269L12.8796 17.3991L11.875 12.858Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M12.3833 16.7776C12.4965 16.9887 12.6177 17.2159 12.7384 17.4294L12.8797 17.3983L11.8751 12.8574C11.8751 12.8574 11.8319 15.7511 12.3833 16.7776Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M18.3844 17.3991L18.9672 17.5269L19.9717 12.9858L19.3889 12.858L18.3844 17.3991Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M18.8819 16.7776C18.7686 16.9887 18.6476 17.2159 18.5268 17.4294L18.3853 17.3983L19.3901 12.8574C19.3901 12.8574 19.4332 15.7511 18.8819 16.7776Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M18.7845 15.8501H12.4809C11.8989 15.8501 11.4121 16.2899 11.3555 16.8666L10.7615 22.9339C10.6968 23.5956 11.2191 24.1689 11.8869 24.1689H19.3783C20.0461 24.1689 20.5684 23.5956 20.5036 22.9339L19.9097 16.8666C19.8533 16.2899 19.3664 15.8501 18.7845 15.8501Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M10.7942 23.3293C10.9206 23.8083 11.3574 24.1691 11.8869 24.1691H19.3783C20.0462 24.1691 20.5684 23.5959 20.5037 22.9342L19.9097 16.8668C19.8903 16.6679 19.8187 16.4859 19.7106 16.332C17.8053 20.3186 12.414 22.6928 10.7942 23.3293Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M11.8868 23.6829C11.7034 23.6829 11.5343 23.6083 11.411 23.473C11.2877 23.3378 11.2296 23.163 11.2474 22.9812L11.8414 16.914C11.8735 16.5847 12.1482 16.3364 12.4806 16.3364H18.7842C19.1164 16.3364 19.3912 16.5847 19.4236 16.914L20.0173 22.9812C20.0352 23.163 19.9771 23.3377 19.854 23.4729C19.7306 23.6081 19.5616 23.6827 19.378 23.6827H11.8868V23.6829Z"
                                                        fill="#1B1C1E" />
                                                    <path
                                                        d="M18.3394 15.3101H12.9258C12.6262 15.3101 12.3833 15.5519 12.3833 15.8502H18.8819C18.8819 15.5519 18.639 15.3101 18.3394 15.3101Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M15.6325 12.2129C13.8821 12.2129 12.2076 12.357 10.738 12.6323C10.3019 12.714 10.0026 13.1152 10.0561 13.5538C10.093 13.8563 10.3795 14.0623 10.6797 14.0029C12.1498 13.712 13.8486 13.5592 15.6325 13.5592C17.4166 13.5592 19.1152 13.712 20.5855 14.0029C20.8856 14.0623 21.1722 13.8563 21.209 13.5538C21.2624 13.1154 20.9631 12.714 20.5271 12.6323C19.0574 12.3572 17.3831 12.2129 15.6325 12.2129Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M19.8541 23.4728C19.9773 23.3376 20.0356 23.163 20.0175 22.9811L19.6934 19.6694C18.2328 23.3719 11.8868 23.6827 11.8868 23.6827H19.3782C19.5618 23.6827 19.7308 23.608 19.8541 23.4728Z"
                                                        fill="#1B1C1E" />
                                                    <path
                                                        d="M12.8295 15.3198C13.3459 15.5759 14.4057 15.7519 15.6328 15.7519C16.8598 15.7519 17.9195 15.5758 18.436 15.3198C18.4047 15.3141 18.3727 15.3101 18.3396 15.3101H12.926C12.8928 15.3099 12.8608 15.3141 12.8295 15.3198Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M20.5855 14.0027C20.8858 14.0621 21.1722 13.8561 21.2092 13.5537C21.2484 13.2317 21.0964 12.9307 20.8406 12.7607C20.9034 13.0715 20.8859 13.3649 20.6365 13.4552C20.0398 13.6712 19.1468 13.1129 15.6327 13.1129C12.1187 13.1129 11.2257 13.6714 10.629 13.4552C10.3796 13.3649 10.3621 13.0714 10.4248 12.7607C10.1691 12.9307 10.0171 13.2315 10.0563 13.5537C10.0932 13.8561 10.3797 14.0621 10.6799 14.0027C12.15 13.7118 13.8488 13.5591 15.6327 13.5591C17.4167 13.5592 19.1154 13.712 20.5855 14.0027Z"
                                                        fill="#3E3F41" />
                                                    <g opacity="0.3">
                                                        <path
                                                            d="M36.4717 48.0795L35.8889 47.9517L34.8844 52.4927L35.4671 52.6205L36.4717 48.0795Z"
                                                            fill="black" />
                                                        <path
                                                            d="M35.9722 48.7012C36.0855 48.4901 36.2066 48.2629 36.3273 48.0493L36.4687 48.0804L35.4639 52.6213C35.4639 52.6213 35.4209 49.7275 35.9722 48.7012Z"
                                                            fill="black" />
                                                        <path
                                                            d="M42.9804 52.6185L43.5632 52.4907L42.5587 47.9497L41.9759 48.0775L42.9804 52.6185Z"
                                                            fill="black" />
                                                        <path
                                                            d="M42.4709 48.7012C42.3576 48.4901 42.2365 48.2629 42.1158 48.0493L41.9742 48.0804L42.9791 52.6213C42.9791 52.6213 43.0222 49.7275 42.4709 48.7012Z"
                                                            fill="black" />
                                                        <path
                                                            d="M42.3733 49.6283H36.0697C35.4878 49.6283 35.0009 49.1885 34.9444 48.6119L34.3504 42.5445C34.2857 41.8828 34.8079 41.3096 35.4758 41.3096H42.9672C43.635 41.3096 44.1573 41.8828 44.0925 42.5445L43.4985 48.6119C43.4421 49.1885 42.9553 49.6283 42.3733 49.6283Z"
                                                            fill="black" />
                                                        <path
                                                            d="M34.9702 48.7598C35.0883 49.2619 35.539 49.6284 36.0699 49.6284H42.3735C42.9554 49.6284 43.4423 49.1885 43.4989 48.6119L44.0929 42.5445C44.1242 42.2238 44.017 41.9245 43.8228 41.7007C42.3457 45.1691 36.838 47.7928 34.9702 48.7598Z"
                                                            fill="black" />
                                                        <path
                                                            d="M35.4758 41.7959C35.2924 41.7959 35.1234 41.8704 35 42.0056C34.8767 42.141 34.8186 42.3156 34.8366 42.4974L35.4305 48.5647C35.4627 48.8939 35.7374 49.1422 36.0698 49.1422H42.3734C42.7056 49.1422 42.9803 48.8939 43.0128 48.5647L43.6064 42.4974C43.6244 42.3156 43.5663 42.141 43.443 42.0057C43.3197 41.8704 43.1506 41.7959 42.967 41.7959H35.4758Z"
                                                            fill="black" />
                                                        <path
                                                            d="M41.9283 50.1686H36.5149C36.2153 50.1686 35.9724 49.9267 35.9724 49.6284H42.471C42.4709 49.9267 42.228 50.1686 41.9283 50.1686Z"
                                                            fill="black" />
                                                        <path
                                                            d="M39.2216 53.2654C37.4711 53.2654 35.7967 53.1212 34.3271 52.8462C33.8911 52.7646 33.5917 52.3632 33.6452 51.9246C33.6821 51.6222 33.9686 51.4162 34.2689 51.4755C35.7389 51.7663 37.4377 51.9192 39.2216 51.9192C41.0056 51.9192 42.7043 51.7665 44.1744 51.4755C44.4747 51.4162 44.7612 51.6222 44.7981 51.9246C44.8515 52.3631 44.5522 52.7645 44.1162 52.8462C42.6464 53.1212 40.972 53.2654 39.2216 53.2654Z"
                                                            fill="black" />
                                                        <path
                                                            d="M36.4183 50.1587C36.9347 49.9026 37.9946 49.7266 39.2216 49.7266C40.4487 49.7266 41.5083 49.9027 42.0249 50.1587C41.9935 50.1644 41.9614 50.1684 41.9285 50.1684H36.5151C36.4817 50.1684 36.4497 50.1644 36.4183 50.1587Z"
                                                            fill="black" />
                                                        <path
                                                            d="M44.1744 51.4755C44.4746 51.4162 44.7611 51.6222 44.798 51.9246C44.8373 52.2468 44.6852 52.5475 44.4295 52.7175C44.4922 52.4068 44.4748 52.1134 44.2254 52.0231C43.6286 51.8071 42.7357 52.3654 39.2216 52.3654C35.7075 52.3654 34.8146 51.8069 34.2178 52.0231C33.9684 52.1134 33.951 52.4069 34.0137 52.7175C33.758 52.5475 33.6059 52.2468 33.6452 51.9246C33.6821 51.6222 33.9686 51.4162 34.2688 51.4755C35.7389 51.7665 37.4377 51.9192 39.2216 51.9192C41.0055 51.9192 42.7042 51.7665 44.1744 51.4755Z"
                                                            fill="black" />
                                                        <path
                                                            d="M43.0128 48.5647L43.3922 44.6875C41.891 47.2977 39.2503 48.5547 37.3772 49.1423H42.3734C42.7056 49.1424 42.9804 48.8941 43.0128 48.5647Z"
                                                            fill="black" />
                                                    </g>
                                                    <path
                                                        d="M34.7719 46.3871L34.1891 46.2593L33.1845 50.8003L33.7673 50.9281L34.7719 46.3871Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M34.2725 47.0088C34.3858 46.7977 34.5069 46.5705 34.6276 46.3569L34.769 46.388L33.7642 50.9289C33.7642 50.9289 33.7212 48.0351 34.2725 47.0088Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M41.2806 50.9261L41.8634 50.7983L40.8588 46.2573L40.2761 46.3851L41.2806 50.9261Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M40.7712 47.0088C40.6579 46.7977 40.5368 46.5705 40.4161 46.3569L40.2745 46.388L41.2794 50.9289C41.2794 50.9289 41.3225 48.0351 40.7712 47.0088Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M40.6736 47.936H34.37C33.7881 47.936 33.3012 47.4961 33.2447 46.9195L32.6507 40.8521C32.586 40.1904 33.1082 39.6172 33.7761 39.6172H41.2674C41.9353 39.6172 42.4576 40.1904 42.3928 40.8521L41.7988 46.9195C41.7424 47.4961 41.2555 47.936 40.6736 47.936Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M33.2705 47.0674C33.3886 47.5695 33.8393 47.936 34.3702 47.936H40.6738C41.2557 47.936 41.7426 47.4961 41.7992 46.9195L42.3932 40.8521C42.4245 40.5314 42.3173 40.2321 42.1231 40.0083C40.646 43.4768 35.1383 46.1005 33.2705 47.0674Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M33.7761 40.1035C33.5927 40.1035 33.4236 40.178 33.3003 40.3132C33.177 40.4486 33.1189 40.6232 33.1369 40.8051L33.7308 46.8723C33.763 47.2015 34.0377 47.4498 34.3701 47.4498H40.6737C41.0059 47.4498 41.2806 47.2015 41.3131 46.8723L41.9067 40.8051C41.9247 40.6232 41.8666 40.4486 41.7433 40.3134C41.6199 40.178 41.4509 40.1035 41.2673 40.1035H33.7761Z"
                                                        fill="#1B1C1E" />
                                                    <path
                                                        d="M40.2286 48.4762H34.8152C34.5156 48.4762 34.2727 48.2343 34.2727 47.936H40.7713C40.7712 48.2343 40.5282 48.4762 40.2286 48.4762Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M37.5219 51.573C35.7714 51.573 34.097 51.4289 32.6274 51.1538C32.1913 51.0722 31.892 50.6709 31.9455 50.2322C31.9824 49.9298 32.2689 49.7238 32.5691 49.7832C34.0392 50.0739 35.738 50.2269 37.5219 50.2269C39.3059 50.2269 41.0046 50.0741 42.4747 49.7832C42.775 49.7238 43.0614 49.9298 43.0984 50.2322C43.1518 50.6707 42.8525 51.0721 42.4165 51.1538C40.9467 51.4289 39.2723 51.573 37.5219 51.573Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M34.7186 48.4663C35.235 48.2102 36.2949 48.0342 37.5219 48.0342C38.7489 48.0342 39.8086 48.2103 40.3252 48.4663C40.2938 48.472 40.2617 48.476 40.2288 48.476H34.8154C34.782 48.476 34.75 48.472 34.7186 48.4663Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M42.4747 49.7832C42.7749 49.7238 43.0614 49.9298 43.0983 50.2322C43.1376 50.5544 42.9855 50.8552 42.7298 51.0252C42.7925 50.7144 42.7751 50.421 42.5257 50.3307C41.9289 50.1147 41.036 50.673 37.5219 50.673C34.0078 50.673 33.1149 50.1145 32.5181 50.3307C32.2687 50.421 32.2513 50.7146 32.314 51.0252C32.0583 50.8552 31.9062 50.5544 31.9455 50.2322C31.9824 49.9298 32.2689 49.7238 32.5691 49.7832C34.0392 50.0741 35.738 50.2269 37.5219 50.2269C39.3058 50.2269 41.0044 50.0741 42.4747 49.7832Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M41.3131 46.8723L41.6924 42.9951C40.1913 45.6053 37.5506 46.8623 35.6775 47.4499H40.6737C41.0059 47.45 41.2807 47.2017 41.3131 46.8723Z"
                                                        fill="#1B1C1E" />
                                                    <g opacity="0.3">
                                                        <path
                                                            d="M14.5817 48.0804L13.9989 47.9526L12.9943 52.4937L13.5771 52.6215L14.5817 48.0804Z"
                                                            fill="black" />
                                                        <path
                                                            d="M14.083 48.7012C14.1962 48.4901 14.3174 48.2629 14.4381 48.0493L14.5794 48.0804L13.5748 52.6213C13.5748 52.6213 13.5317 49.7275 14.083 48.7012Z"
                                                            fill="black" />
                                                        <path
                                                            d="M21.0915 52.619L21.6743 52.4912L20.6698 47.9502L20.087 48.078L21.0915 52.619Z"
                                                            fill="black" />
                                                        <path
                                                            d="M20.5816 48.7012C20.4683 48.4901 20.3473 48.2629 20.2265 48.0493L20.085 48.0804L21.0898 52.6213C21.0898 52.6213 21.1329 49.7275 20.5816 48.7012Z"
                                                            fill="black" />
                                                        <path
                                                            d="M20.4842 49.6283H14.1806C13.5987 49.6283 13.1118 49.1885 13.0552 48.6119L12.4612 42.5445C12.3965 41.8828 12.9188 41.3096 13.5866 41.3096H21.078C21.7458 41.3096 22.2681 41.8828 22.2034 42.5445L21.6094 48.6119C21.553 49.1885 21.0661 49.6283 20.4842 49.6283Z"
                                                            fill="black" />
                                                        <path
                                                            d="M13.0809 48.7598C13.199 49.2619 13.6496 49.6284 14.1805 49.6284H20.4841C21.066 49.6284 21.5529 49.1885 21.6095 48.6119L22.2034 42.5445C22.2348 42.2238 22.1276 41.9245 21.9333 41.7007C20.4564 45.1691 14.9488 47.7928 13.0809 48.7598Z"
                                                            fill="black" />
                                                        <path
                                                            d="M13.5865 41.7959C13.4031 41.7959 13.2341 41.8704 13.1107 42.0056C12.9874 42.141 12.9293 42.3156 12.9471 42.4974L13.5411 48.5647C13.5732 48.8939 13.848 49.1422 14.1803 49.1422H20.4839C20.8161 49.1422 21.0909 48.8939 21.1233 48.5647L21.717 42.4974C21.7349 42.3156 21.6768 42.141 21.5537 42.0057C21.4304 41.8704 21.2613 41.7959 21.0777 41.7959H13.5865Z"
                                                            fill="black" />
                                                        <path
                                                            d="M20.0391 50.1686H14.6255C14.3259 50.1686 14.083 49.9267 14.083 49.6284H20.5816C20.5816 49.9267 20.3387 50.1686 20.0391 50.1686Z"
                                                            fill="black" />
                                                        <path
                                                            d="M17.3322 53.2654C15.5819 53.2654 13.9073 53.1212 12.4377 52.8462C12.0016 52.7646 11.7023 52.3632 11.7558 51.9246C11.7927 51.6222 12.0792 51.4162 12.3794 51.4755C13.8495 51.7663 15.5483 51.9192 17.3322 51.9192C19.1163 51.9192 20.8149 51.7665 22.2852 51.4755C22.5853 51.4162 22.8719 51.6222 22.9087 51.9246C22.9621 52.3631 22.6628 52.7645 22.2268 52.8462C20.7572 53.1212 19.0828 53.2654 17.3322 53.2654Z"
                                                            fill="black" />
                                                        <path
                                                            d="M14.5292 50.1587C15.0456 49.9026 16.1054 49.7266 17.3325 49.7266C18.5595 49.7266 19.6192 49.9027 20.1357 50.1587C20.1044 50.1644 20.0724 50.1684 20.0393 50.1684H14.6257C14.5925 50.1684 14.5605 50.1644 14.5292 50.1587Z"
                                                            fill="black" />
                                                        <path
                                                            d="M22.2852 51.4755C22.5855 51.4162 22.872 51.6222 22.9089 51.9246C22.9481 52.2468 22.7961 52.5475 22.5404 52.7175C22.6031 52.4068 22.5856 52.1134 22.3362 52.0231C21.7395 51.8071 20.8465 52.3654 17.3324 52.3654C13.8184 52.3654 12.9254 51.8069 12.3287 52.0231C12.0793 52.1134 12.0618 52.4069 12.1245 52.7175C11.8688 52.5475 11.7168 52.2468 11.756 51.9246C11.7929 51.6222 12.0794 51.4162 12.3797 51.4755C13.8497 51.7665 15.5485 51.9192 17.3324 51.9192C19.1164 51.9192 20.8152 51.7665 22.2852 51.4755Z"
                                                            fill="black" />
                                                        <path
                                                            d="M21.1236 48.5647L21.5029 44.6875C20.0018 47.2977 17.361 48.5547 15.4878 49.1423H20.484C20.8164 49.1424 21.0911 48.8941 21.1236 48.5647Z"
                                                            fill="black" />
                                                    </g>
                                                    <path
                                                        d="M12.8819 46.3881L12.2991 46.2603L11.2945 50.8013L11.8773 50.9291L12.8819 46.3881Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M12.3833 47.0088C12.4965 46.7977 12.6177 46.5705 12.7384 46.3569L12.8797 46.388L11.8751 50.9289C11.8751 50.9289 11.8319 48.0351 12.3833 47.0088Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M19.3917 50.9271L19.9745 50.7993L18.9699 46.2583L18.3871 46.3861L19.3917 50.9271Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M18.8819 47.0088C18.7686 46.7977 18.6476 46.5705 18.5268 46.3569L18.3853 46.388L19.3901 50.9289C19.3901 50.9289 19.4332 48.0351 18.8819 47.0088Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M18.7845 47.936H12.4809C11.8989 47.936 11.4121 47.4961 11.3555 46.9195L10.7615 40.8521C10.6968 40.1904 11.2191 39.6172 11.8869 39.6172H19.3783C20.0461 39.6172 20.5684 40.1904 20.5036 40.8521L19.9097 46.9195C19.8533 47.4961 19.3664 47.936 18.7845 47.936Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M11.3812 47.0674C11.4993 47.5695 11.9499 47.936 12.4808 47.936H18.7844C19.3663 47.936 19.8532 47.4961 19.9097 46.9195L20.5037 40.8521C20.5351 40.5314 20.4278 40.2321 20.2336 40.0083C18.7567 43.4768 13.2491 46.1005 11.3812 47.0674Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M11.8868 40.1035C11.7034 40.1035 11.5343 40.178 11.411 40.3132C11.2877 40.4486 11.2296 40.6232 11.2474 40.8051L11.8414 46.8723C11.8735 47.2015 12.1482 47.4498 12.4806 47.4498H18.7842C19.1164 47.4498 19.3912 47.2015 19.4236 46.8723L20.0173 40.8051C20.0352 40.6232 19.9771 40.4486 19.854 40.3134C19.7306 40.178 19.5616 40.1035 19.378 40.1035H11.8868Z"
                                                        fill="#1B1C1E" />
                                                    <path
                                                        d="M18.3394 48.4762H12.9258C12.6262 48.4762 12.3833 48.2343 12.3833 47.936H18.8819C18.8819 48.2343 18.639 48.4762 18.3394 48.4762Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M15.6325 51.573C13.8821 51.573 12.2076 51.4289 10.738 51.1538C10.3019 51.0722 10.0026 50.6709 10.0561 50.2322C10.093 49.9298 10.3795 49.7238 10.6797 49.7832C12.1498 50.0739 13.8486 50.2269 15.6325 50.2269C17.4166 50.2269 19.1152 50.0741 20.5855 49.7832C20.8856 49.7238 21.1722 49.9298 21.209 50.2322C21.2624 50.6707 20.9631 51.0721 20.5271 51.1538C19.0574 51.4289 17.3831 51.573 15.6325 51.573Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M12.8295 48.4663C13.3459 48.2102 14.4057 48.0342 15.6328 48.0342C16.8598 48.0342 17.9195 48.2103 18.436 48.4663C18.4047 48.472 18.3727 48.476 18.3396 48.476H12.926C12.8928 48.476 12.8608 48.472 12.8295 48.4663Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M20.5855 49.7832C20.8858 49.7238 21.1722 49.9298 21.2092 50.2322C21.2484 50.5544 21.0964 50.8552 20.8406 51.0252C20.9034 50.7144 20.8859 50.421 20.6365 50.3307C20.0398 50.1147 19.1468 50.673 15.6327 50.673C12.1187 50.673 11.2257 50.1145 10.629 50.3307C10.3796 50.421 10.3621 50.7146 10.4248 51.0252C10.1691 50.8552 10.0171 50.5544 10.0563 50.2322C10.0932 49.9298 10.3797 49.7238 10.6799 49.7832C12.15 50.0741 13.8488 50.2269 15.6327 50.2269C17.4167 50.2269 19.1154 50.0741 20.5855 49.7832Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M19.4239 46.8723L19.8032 42.9951C18.302 45.6053 15.6613 46.8623 13.7881 47.4499H18.7843C19.1167 47.45 19.3914 47.2017 19.4239 46.8723Z"
                                                        fill="#1B1C1E" />
                                                    <g opacity="0.3">
                                                        <path
                                                            d="M48.8948 20.426L48.8729 20.1219L48.3925 20.108C34.9891 19.7199 21.5646 19.7199 8.16118 20.108L7.68078 20.1219C7.05297 28.6102 7.03907 37.1122 7.63875 45.6012L7.68078 46.1962L8.62072 46.2228C22.0317 46.6025 35.4631 46.5935 48.8729 46.1962L48.8948 45.892C49.508 37.4079 49.508 28.9103 48.8948 20.426Z"
                                                            fill="black" />
                                                        <path
                                                            d="M8.51939 45.3259L7.68066 46.1964L8.6206 46.223C22.0316 46.6027 35.463 46.5938 48.8728 46.1964L48.8947 45.8922C49.5079 37.4079 49.5079 28.9104 48.8947 20.4262L48.8728 20.1221L48.0347 20.9922L8.51939 45.3259Z"
                                                            fill="black" />
                                                        <path
                                                            d="M28.2872 45.6072C21.7669 45.6072 15.1587 45.5137 8.64619 45.3294L8.51948 45.3259C7.95904 37.2516 7.95889 29.0708 8.51871 20.9922C15.0733 20.8056 21.7185 20.7109 28.2769 20.7109C34.835 20.7109 41.4807 20.8056 48.0349 20.9922C48.5951 29.0686 48.5951 37.2499 48.0349 45.3263C41.4812 45.5126 34.8416 45.6071 28.2893 45.6071C28.2882 45.6072 28.288 45.6072 28.2872 45.6072Z"
                                                            fill="black" />
                                                    </g>
                                                    <path
                                                        d="M47.1951 18.7336L47.1732 18.4295L46.6928 18.4156C33.2894 18.0275 19.8649 18.0275 6.46148 18.4156L5.98108 18.4295C5.35327 26.9178 5.33936 35.4198 5.93905 43.9089L5.98108 44.5038L6.92102 44.5304C20.332 44.9101 33.7634 44.9012 47.1732 44.5038L47.1951 44.1996C47.8083 35.7155 47.8083 27.2179 47.1951 18.7336Z"
                                                        fill="#3E3F41" />
                                                    <path
                                                        d="M6.81969 43.6335L5.98096 44.504L6.9209 44.5306C20.3319 44.9103 33.7633 44.9014 47.1731 44.504L47.195 44.1998C47.8082 35.7155 47.8082 27.218 47.195 18.7338L47.1731 18.4297L46.335 19.2998L6.81969 43.6335Z"
                                                        fill="#3E3F41" />
                                                    <path class="fill"
                                                        d="M26.5876 43.9149C20.0672 43.9149 13.459 43.8213 6.9465 43.637L6.8198 43.6335C6.25936 35.5592 6.2592 27.3784 6.81887 19.2998C13.3734 19.1132 20.0186 19.0186 26.5771 19.0186C33.1351 19.0186 39.7809 19.1132 46.3351 19.2998C46.8952 27.3762 46.8952 35.5575 46.3351 43.6339C39.7813 43.8202 33.1418 43.9147 26.5894 43.9147C26.5885 43.9149 26.5883 43.9149 26.5876 43.9149Z"
                                                        fill="#212325" />
                                                </svg>
                                            </div>
                                            
                                            <div class="modal table-modal fade" id="modal{{ $table->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="card  @if ($table->status == 'in_service') bg-info
                                                 @elseif($table->status == 'available')
                                                bg-success text-light
                                                @elseif ($table->status == 'reserved')
                                                   bg-danger  text-light @endif"
                                                data-id="table1" data-stat="serv">
                                                <div class="modal-header">
                                                    <div
                                                        class="card-header primary-bg-color w-100 d-flex justify-content-between">
                                                        <h3 class="modal-title fs-5" id="exampleModalLabel">
                                                            {{ $table->name }}</h3>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="card-item mid d-flex justify-content-between">
                                                        <p class="hall-name"> الباقة</p>
                                                        <span class="sta">
                                                            {{ $table->reservation != null ? $table->reservation->package->name : 'لا توجد باقة' }}
                                                        </span>
                                                    </div>
                                                    <div class="card-item body-package d-flex justify-content-between">
                                                        <p class="hall-name"> المقاعد</p>
                                                        <span class="sta">
                                                            {{ $table->reservation != null ? $table->reservation->package->count_of_visitors : 0 }}
                                                            اشخاص</span>
                                                    </div>
                                                    <div class="card-item body-time d-flex justify-content-between">
                                                        <p class="hall-name"> الحجز</p>
                                                        <span
                                                            class="sta">{{ $table->reservation != null ? $table->reservation->price : 0 }}
                                                            ريال</span>
                                                    </div>
                                                    <div class="card-item body-time d-flex justify-content-between">
                                                        <p class="hall-name"> المدة</p>
                                                        <span
                                                            class="sta">{{ $table->reservation != null ? $table->reservation->minutes : 0 }}
                                                            ساعة </span>
                                                    </div>
                                                    <div class="card-item body-time d-flex justify-content-between">
                                                        <p class="hall-name"> الحالة</p>
                                                        <span class="sta">
                                                            {{ $table->reservation != null ? $table->reservation->status : 'لا يوجد حجز' }}</span>
                                                    </div>
                                                    <div class="card-item body-time d-flex justify-content-between">
                                                        <p class="hall-name"> الرصيد الحالى</p>
                                                        <span class="sta">
                                                            {{ $table->reservation != null ? $table->reservation->price : 0 }}
                                                            ريال </span>
                                                    </div>
                                                    @php
                                                        if ($table->reservation) {
                                                            $formattedTime = Carbon\Carbon::createFromFormat('g:i A', $table->reservation->time)->format('H:i');
                                                            $reservationDateTime = $table->reservation->date;
                                                        }

                                                    @endphp
                                                    <div class="card-item body-time d-flex justify-content-between">
                                                        <p class="hall-name"> الوقت المنقضى</p>
                                                        <div class="countdown-timer"
                                                            data-start="{{ $table->reservation ? $table->reservation->date : '' }}"
                                                            data-package-time="{{ $table->reservation->package->time ?? 0 }}">
                                                            <!-- Add a span to display the countdown timer -->
                                                            @if ($table->reservation)
                                                                <span class="countdown-timer-text">00:00:00</span>
                                                            @else
                                                                <span>انتهى</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="table-btn my-3 text-center">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-2">
                                                                <button class="table-btn-action btn btn-primary w-100"
                                                                    type="button" data-id="#tableorders">
                                                                    الطلبات
                                                                </button>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <button class="table-btn-action btn btn-primary w-100"
                                                                    type="button" data-id="#tableinfo">
                                                                    استعراض
                                                                </button>
                                                            </div>
                                                            @if ($table->reservation)
                                                                <div class="col-md-6">
                                                                    <button class="table-btn-action btn btn-primary w-100"
                                                                        type="button" disabled data-id="#exampleModal_{{ $table->id }}">
                                                                        تفعيل الحجز
                                                                    </button>
                                                                </div>
                                                            @else
                                                                <div class="col-md-6">
                                                                    <button disabled
                                                                        class="table-btn-action btn btn-primary w-100"
                                                                        type="button" disabled data-id="#exampleModal_{{ $table->id }}">
                                                                        تفعيل الحجز
                                                                    </button>
                                                                     <!-- Modal -->
                                                                            <div class="modal fade"
                                                                                id="exampleModal_{{ $table->id }}"
                                                                                tabindex="-1"
                                                                                aria-labelledby="exampleModalLabel"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h1 class="modal-title fs-5"
                                                                                                id="exampleModalLabel">
                                                                                                تفعيل الحجز</h1>
                                                                                            <button type="button"
                                                                                                class="btn-close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div
                                                                                                class="modal-body text-light">
                                                                                                هل تود تفعيل الحجز
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <a type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-bs-dismiss="modal">اغلاق</a>
                                                                                            <button type="button"
                                                                                                onclick="activeTable({{ $table->id }})"
                                                                                                class="btn btn-primary">تأكيد
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                </div>
                                                            @endif
                                                              
                                                            @if ($table->reservation)
                                                                <div class="col-md-6">
                                                                    <button class="table-btn-action btn btn-primary w-100"
                                                                        type="button" data-id="#tableend">
                                                                        انهاء الحجز
                                                                    </button>
                                                                      <!-- Modal -->
                                                                            <div class="modal fade"
                                                                                id="close_{{ $table->id }}"
                                                                                tabindex="-1"
                                                                                aria-labelledby="exampleModalLabel"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h1 class="modal-title fs-5"
                                                                                                id="exampleModalLabel">
                                                                                                انهاء الحجز</h1>
                                                                                            <button type="button"
                                                                                                class="btn-close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div
                                                                                                class="modal-body text-light">
                                                                                                هل تود انهاء الحجز
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-bs-dismiss="modal">اغلاق</button>
                                                                                            <a type="button"
                                                                                                onclick="closeTable({{ $table->id }})"
                                                                                                class="btn btn-primary">انهاء
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                </div>
                                                            @else
                                                                <div class="col-md-6">
                                                                    <button disabled
                                                                        class="table-btn-action btn btn-primary w-100"
                                                                        type="button" data-id="#tableend">
                                                                        انهاء الحجز
                                                                    </button>
                                                                </div>
                                                            @endif
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>


                                            <!--<div class="modal-body">-->
                                            <!--    <ul class="list-group">-->
                                            <!--        <li class="list-group-item">-->
                                            <!--            <div class="d-flex">-->
                                            <!--                <div class="left t-packagename">VVIP</div>-->
                                            <!--                <div class="right t-statu">{{ $table->status }}</div>-->
                                            <!--            </div>-->
                                            <!--        </li>-->
                                            <!--        <li class="list-group-item">-->
                                            <!--            <div class="d-flex">-->
                                            <!--                <div class="left t-packagepeice">باقة ساعاتان</div>-->
                                            <!--                <div class="right t-capicity">4 أشخاص</div>-->
                                            <!--            </div>-->
                                            <!--        </li>-->
                                            <!--        <li class="list-group-item">-->
                                            <!--            <div class="d-flex">-->
                                            <!--                <div class="left t-packagedate"> 10-8</div>-->
                                            <!--                <div class="right t-time">08:00 </div>-->
                                            <!--            </div>-->
                                            <!--        </li>-->
                                            <!--        <li class="list-group-item">-->
                                            <!--            <div class="d-flex">-->
                                            <!--                <div class="left t-waiter"> أسم الويتر: </div>-->
                                            <!--                <div class="right t-time">أحمد مرزوق </div>-->
                                            <!--            </div>-->
                                            <!--        </li>-->
                                            <!--    </ul>-->
                                            <!--</div>-->
                                            <!--<div class="modal-footer">-->
                                            <!--    <div class="left t-allpoint"> <span class="point">800</span> الرصيد-->
                                            <!--    </div>-->
                                            <!--    <div class="right t-points"> <span class="have-point">200</span> الرصيد-->
                                            <!--        المتبقى </div>-->
                                            <!--</div>-->
                                        </div>
                                    </div>

                                </div>

                                            @if ($table->status == 'in_service')
                                                <div class="table-side-bar" id="table{{ $table->id }}">
                                                    <h2 class="text-center mb-4">طاولة رقم
                                                        {{ $table->name }}</h2>
                                                    <div class="tab-nav-wraper">
                                                        <ul class="nav c-nav-tabs d-flex justify-content-between home-tab">
                                                            <li class="nav-item">
                                                                <a class="nav-link " data-tab="reservations"
                                                                    href="#">
                                                                    الحجوزات</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-tab="orders" href="#">
                                                                    الطلبات</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link active" data-tab="the-menu"
                                                                    href="#">
                                                                    القائمة</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- عناصر التاب -->
                                                    <div class="tab-content">
                                                        <div id="the-menu" class="c-tab-pane active">
                                                            <ol class="list-group list-group-numbered reversed">


                                                                @if ($orders != null && $orders->products->count() != 0)
                                                                    @foreach ($orders->products as $product)
                                                                        <li
                                                                            class="list-group-item d-flex justify-content-between align-items-start">
                                                                            <div class="me-2 ms-auto">
                                                                                <div class="fw-bold">
                                                                                    {{ $product->name }}
                                                                                </div>
                                                                            </div>

                                                                            <span>{{ $product->pivot->price }}
                                                                                ريال</span>
                                                                        </li>
                                                                    @endforeach
                                                                @endif

                                                                <li
                                                                    class="new-menu-li list-group-item d-flex justify-content-center align-items-start">
                                                                    <a onclick="product({{ $table->id }})"
                                                                        class="me-2">
                                                                        <div class="fw-bold">اضف عنصر
                                                                            جديد
                                                                        </div>
                                                                    </a>
                                                                </li>

                                                            </ol>

                                                            <ol class="list-group reversed none  mt-5">
                                                                <li class="list-group-item no-number  ">
                                                                    <div
                                                                        class="sub-total d-flex justify-content-between align-items-start">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold"> حاصل
                                                                                الجمع</div>
                                                                        </div>
                                                                        <span>{{ $table->reservation->package->price ?? 0 }}
                                                                            ريال</span>
                                                                    </div>

                                                                    <div
                                                                        class="tax d-flex justify-content-between align-items-start mt-4">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold"> ضريبة
                                                                            </div>
                                                                        </div>
                                                                        <span>15%</span>
                                                                    </div>
                                                                    <div
                                                                        class="tax d-flex justify-content-between align-items-start mt-4 total">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold">
                                                                                الإجمالى
                                                                            </div>
                                                                        </div>

                                                                        @php
                                                                            $total = $table->reservation->package->price ?? 0 * 0.15;
                                                                        @endphp

                                                                        <span>{{ $total - $totalOrderPrices }}

                                                                            ريال</span>
                                                                    </div>
                                                                    <div class="payment-method">
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <div
                                                                                    class="payment-icon d-flex justify-content-center align-items-center">
                                                                                    <i class="fa-solid fa-sack-dollar"></i>
                                                                                </div>
                                                                                <p class="text-center">
                                                                                    كاش
                                                                                </p>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div
                                                                                    class="payment-icon d-flex justify-content-center align-items-center">
                                                                                    <i class="fa-solid fa-credit-card"></i>
                                                                                </div>
                                                                                <p class="text-center">
                                                                                    بطاقة ائتمان</p>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div
                                                                                    class="payment-icon d-flex justify-content-center align-items-center">
                                                                                    <i class="fa-solid fa-wallet"></i>
                                                                                </div>
                                                                                <p class="text-center">
                                                                                    المحفظة</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="payment-btn my-3 text-center">
                                                                            <div class="btn btn-primary btn-lg w-100"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#exampleModal6">
                                                                                ادفع الآن</div>
                                                                            <!-- Modal -->
                                                                            <div class="modal fade" id="exampleModal6"
                                                                                tabindex="-1"
                                                                                aria-labelledby="exampleModalLabel6"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title"
                                                                                                id="exampleModalLabel">
                                                                                                تأكيد
                                                                                                الدفع
                                                                                            </h5>
                                                                                            <button type="button"
                                                                                                class="btn-close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <p class="consfirm-text">
                                                                                                هل تريد
                                                                                                تأكيد
                                                                                                الدفع
                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button"
                                                                                                class="btn btn-primary">تأكيد</button>
                                                                                            <button type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-bs-dismiss="modal">لا
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>



                                                            </ol>

                                                        </div>
                                                        <div id="orders" class="c-tab-pane ">
                                                            @foreach ($table->reservations as $reservation)
                                                                <ol
                                                                    class="list-group list-group-numbered reversed bill-info">
                                                                    <li
                                                                        class="list-group-item d-flex justify-content-between align-items-start">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold"> طلب
                                                                                باسم
                                                                            </div>
                                                                        </div>
                                                                        <span>{{ $reservation->client->name }}</span>
                                                                    </li>
                                                                    <li
                                                                        class="list-group-item d-flex justify-content-between align-items-start">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold">اسم
                                                                                الباقة
                                                                            </div>
                                                                        </div>
                                                                        <span>
                                                                            {{ $reservation->package->name }}</span>
                                                                    </li>
                                                                    <li
                                                                        class="list-group-item d-flex justify-content-between align-items-start">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold">
                                                                                الرصيد
                                                                            </div>
                                                                        </div>
                                                                        <span>{{ $reservation->package->price }}
                                                                        </span>
                                                                    </li>
                                                                    <li
                                                                        class="list-group-item d-flex justify-content-between align-items-start">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold">
                                                                                الحالة
                                                                            </div>
                                                                        </div>
                                                                        <span class="badge bg-info">تم
                                                                            الدفع </span>
                                                                    </li>
                                                                    <li
                                                                        class="new-menu-li list-group-item d-flex justify-content-center align-items-start">
                                                                        <div class="me-2">
                                                                            <div class="fw-bold"> طباعة
                                                                                الطلب</div>
                                                                        </div>
                                                                    </li>
                                                                </ol>
                                                            @endforeach

                                                        </div>
                                                        <div id="reservations" class="c-tab-pane ">
                                                            <div class="hour-col">
                                                                <div class="body-hour-cel">
                                                                    <div class="row gx-0 p-2 text-center">
                                                                        <div class="col-md-2">
                                                                            <p class="hour mb-0">05:00
                                                                                AM
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            <div class="row gx-0">
                                                                                <div class="col-md-9">
                                                                                    <div
                                                                                        class="d-flex h-100 justify-content-around align-items-center">
                                                                                        <div class="gusts">
                                                                                            <span class="table-gusts px-2">
                                                                                                4</span>
                                                                                            <span> <i
                                                                                                    class="fa-solid fa-users"></i></span>
                                                                                        </div>
                                                                                        <div class="table-res">
                                                                                            طاولة 1
                                                                                        </div>
                                                                                        <span
                                                                                            class="badge bg-secondary">مؤكد</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <span>رصيد متبقى
                                                                                        600</span>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="body-hour-cel">
                                                                    <div class="row gx-0 p-2 text-center">
                                                                        <div class="col-md-2">
                                                                            05:15 AM
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            <div class="row gx-0">
                                                                                <div class="col-md-9">
                                                                                    <div
                                                                                        class="d-flex justify-content-center align-items-center">
                                                                                        <span>لا يوجد
                                                                                            حجز</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <span>لا يوجد
                                                                                        رصيد</span>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="body-hour-cel">
                                                                    <div class="row gx-0 p-2 text-center">
                                                                        <div class="col-md-2">
                                                                            05:30 AM
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            <div class="row gx-0">
                                                                                <div class="col-md-9">
                                                                                    <div
                                                                                        class="d-flex justify-content-center align-items-center">
                                                                                        <span>لا يوجد
                                                                                            حجز</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <span>لا يوجد
                                                                                        رصيد</span>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="body-hour-cel">
                                                                    <div class="row gx-0 p-2 text-center">
                                                                        <div class="col-md-2">
                                                                            05:45 AM
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            <div class="row gx-0">
                                                                                <div class="col-md-9">
                                                                                    <div
                                                                                        class="d-flex justify-content-center align-items-center">
                                                                                        <span>لا يوجد
                                                                                            حجز</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <span>لا يوجد
                                                                                        رصيد</span>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                @can('add_reservation')
                                                    <div class="table-side-bar" id="table{{ $table->id }}">
                                                        <ol class="table-list list-group list-group-numbered reversed">
                                                            <li
                                                                class="menu-info-list list-group-item d-flex  flex-column justify-content-center align-items-center text-center p-0">
                                                                <a class="new-reserv-btn btn btn-link w-100"
                                                                    href="{{ route('branch.reservation') }}">
                                                                    <i class="fa-solid fa-plus"></i>
                                                                    <p>انشاء حجز جديد </p>
                                                                </a>
                                                            </li>

                                                        </ol>

                                                    </div>
                                                @endcan
                                            @endif
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                        </div>
                        <div class="left">
                            <div class="row salon7">
                                @foreach ($secondHalfSilverTwo as $table)
                                    @php
                                        if ($table->reservation) {
                                            $orders = App\Models\Order::where('package_id', $table->reservation->package_id)
                                                ->where('table_id', $table->id)
                                                ->where('is_done', 0)
                                                ->with('products')
                                                ->first();

                                            // Wrap the related products in a collection (even if there's only one result)
                                            if ($orders != null && $orders->products->count() != 0) {
                                                // Calculate total order prices using the map function on the products collection
                                                $totalOrderPrices = $orders->products->sum(function ($product) {
                                                    return $product->pivot->price * $product->pivot->quantity;
                                                });
                                            } else {
                                                $totalOrderPrices = 0;
                                            }
                                        } else {
                                            $orders = null;
                                            $totalOrderPrices = 0;
                                        }
                                    @endphp
                                    <div class="col-md-3">
                                        <div class="sofa @if ($table->status == 'in_service') sofa-serv
                                                            @elseif($table->status == 'available')
                                                            sofa-available
                                                             @elseif ($table->status == 'reserved')
                                                              sofa-reserved @endif"
                                            data-id="table{{ $table->id }}" data-stat="serv"
                                            data-bs-toggle="modal" data-bs-target="#modal{{ $table->id }}"
                                            data-h="hall{{ $loungesSortowSilver->id }}"
                                            @if ($table->status == 'in_service') data-pstat="serv"
                                                            @elseif($table->status == 'available')
                                                             data-pstat ="available"
                                                             @elseif ($table->status == 'reserved')
                                                              data-pstat ="reserved" @endif>
                                            <div class="table-vip d-flex flex-column align-items-center">
                                                <h4>{{ $table->name }}</h4>
                                                <svg width="116" height="57" viewBox="0 0 116 57" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M69.0822 29.8186L82.0546 29.8186C83.8515 29.8186 85.3126 31.2791 85.3126 33.0763L85.3126 51.0089C85.3126 52.8061 83.8511 54.2666 82.0546 54.2666L69.0822 54.2666C67.2831 54.2666 65.8239 52.8061 65.8239 51.0089L65.8239 33.0766C65.8239 31.2791 67.2831 29.8186 69.0822 29.8186Z"
                                                        fill="#212325" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M28.1869 32.2338L28.1869 45.2115C28.1869 47.0087 26.7251 48.4683 24.9282 48.4683L6.99661 48.4683C5.19784 48.4683 3.73856 47.0087 3.73856 45.2115L3.73856 32.2338C3.73856 30.4366 5.19816 28.977 6.9966 28.977L24.9282 28.977C26.7251 28.977 28.1869 30.4363 28.1869 32.2338Z"
                                                        fill="#212325" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M6.99667 48.7954L24.9305 48.7954C26.9083 48.7954 28.5157 47.1886 28.5157 45.2105L28.5157 32.2328C28.5157 30.2537 26.9086 28.6466 24.9305 28.6466L6.99667 28.6466C5.01668 28.6466 3.41172 30.2537 3.41172 32.2328L3.41172 45.2105C3.4114 47.1886 5.01668 48.7954 6.99667 48.7954ZM6.99667 29.3045L24.9305 29.3045C26.5461 29.3045 27.8578 30.6165 27.8578 32.2328L27.8578 45.2105C27.8578 46.8264 26.5461 48.1388 24.9305 48.1388L6.99667 48.1388C5.38103 48.1388 4.06931 46.8267 4.06931 45.2105L4.06931 32.2328C4.06931 30.6165 5.38102 29.3045 6.99667 29.3045Z"
                                                        fill="#3E3F41" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M49.6353 29.8184L62.6098 29.8184C64.4064 29.8184 65.866 31.2777 65.866 33.0752L65.866 51.0093C65.866 52.8065 64.4064 54.2661 62.6098 54.2661L49.6353 54.2661C47.8362 54.2661 46.3788 52.8065 46.3788 51.0093L46.3788 33.0752C46.3788 31.278 47.8362 29.8184 49.6353 29.8184Z"
                                                        fill="#212325" />
                                                    <path class="line"fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M49.6352 54.5933L62.6116 54.5933C64.5894 54.5933 66.1969 52.9874 66.1969 51.008L66.1969 33.0732C66.1969 31.0958 64.5897 29.4896 62.6116 29.4896L49.6352 29.4896C47.6552 29.4896 46.0499 31.0958 46.0499 33.0732L46.0499 51.0083C46.0499 52.9877 47.6552 54.5933 49.6352 54.5933ZM49.6352 30.1465L62.6116 30.1465C64.2273 30.1465 65.539 31.4585 65.539 33.0732L65.539 51.0083C65.539 52.6243 64.2273 53.9354 62.6116 53.9354L49.6352 53.9354C48.0173 53.9354 46.706 52.6243 46.706 51.0083L46.706 33.0736C46.7056 31.4585 48.0173 30.1465 49.6352 30.1465Z"
                                                        fill="#3E3F41" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M30.5745 29.8186L43.549 29.8186C45.3456 29.8186 46.8052 31.2791 46.8052 33.0763L46.8052 51.0089C46.8052 52.8061 45.3456 54.2666 43.549 54.2666L30.5745 54.2666C28.7754 54.2666 27.3161 52.8061 27.3161 51.0089L27.3161 33.0766C27.3161 31.2791 28.7757 29.8186 30.5745 29.8186Z"
                                                        fill="#212325" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M69.0825 29.8181L82.0548 29.8181C83.8517 29.8181 85.3129 31.2786 85.3129 33.0758L85.3129 51.0084C85.3129 52.8056 83.8514 54.2661 82.0548 54.2661L69.0825 54.2661C67.2834 54.2661 65.8241 52.8056 65.8241 51.0084L65.8241 33.0761C65.8241 31.2786 67.2834 29.8181 69.0825 29.8181Z"
                                                        fill="#212325" />
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M69.0823 54.5933L82.0547 54.5933C84.0347 54.5933 85.6418 52.9855 85.6418 51.008L85.6418 33.0758C85.6418 31.0958 84.0347 29.4896 82.0547 29.4896L69.0823 29.4896C67.1023 29.4896 65.4952 31.0958 65.4952 33.0758L65.4952 51.0083C65.4952 52.9855 67.1023 54.5933 69.0823 54.5933ZM69.0823 30.1465L82.0547 30.1465C83.6703 30.1465 84.9858 31.4598 84.9858 33.0761L84.9858 51.0083C84.9858 52.6233 83.67 53.9354 82.0547 53.9354L69.0823 53.9354C67.4645 53.9354 66.1528 52.6233 66.1528 51.0083L66.1528 33.0761C66.1528 31.4598 67.4645 30.1465 69.0823 30.1465Z"
                                                        fill="#3E3F41" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M88.6891 29.8181L101.662 29.8181C103.458 29.8181 104.92 31.2786 104.92 33.0758L104.92 51.0084C104.92 52.8056 103.458 54.2661 101.662 54.2661L88.6892 54.2661C86.8901 54.2661 85.4308 52.8056 85.4308 51.0084L85.4308 33.0761C85.4308 31.2786 86.8901 29.8181 88.6891 29.8181Z"
                                                        fill="#212325" />
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M88.6891 54.5933L101.662 54.5933C103.642 54.5933 105.249 52.9855 105.249 51.008L105.249 33.0758C105.249 31.0958 103.642 29.4896 101.662 29.4896L88.6891 29.4896C86.7092 29.4896 85.102 31.0958 85.102 33.0758L85.102 51.0083C85.102 52.9855 86.7092 54.5933 88.6891 54.5933ZM88.6891 30.1465L101.662 30.1465C103.277 30.1465 104.593 31.4598 104.593 33.0761L104.593 51.0083C104.593 52.6233 103.277 53.9354 101.662 53.9354L88.6891 53.9354C87.0713 53.9354 85.7596 52.6233 85.7596 51.0083L85.7596 33.0761C85.7596 31.4598 87.0713 30.1465 88.6891 30.1465Z"
                                                        fill="#3E3F41" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M30.5745 54.5913L43.549 54.5913C45.5268 54.5913 47.1359 52.9851 47.1359 51.0067L47.1359 33.0729C47.1359 31.0954 45.5268 29.4882 43.549 29.4882L30.5745 29.4882C28.5945 29.4882 26.9873 31.0954 26.9873 33.0729L26.9873 51.0067C26.9873 52.9851 28.5948 54.5913 30.5745 54.5913ZM30.5745 30.1452L43.549 30.1452C45.1625 30.1452 46.4764 31.4582 46.4764 33.0729L46.4764 51.0067C46.4764 52.6226 45.1625 53.935 43.549 53.935L30.5745 53.935C28.9588 53.935 27.6452 52.623 27.6452 51.0067L27.6452 33.0729C27.6452 31.4582 28.9591 30.1452 30.5745 30.1452Z"
                                                        fill="#3E3F41" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M28.1868 13.1728L28.1868 26.1467C28.1868 27.9436 26.7272 29.4038 24.9303 29.4038L6.99648 29.4038C5.19992 29.4038 3.74033 27.9433 3.74033 26.1467L3.74033 13.1728C3.74033 11.3743 5.19992 9.91569 6.99648 9.91569L24.9303 9.91569C26.7272 9.91569 28.1868 11.3743 28.1868 13.1728Z"
                                                        fill="#212325" />
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M6.99849 29.7329L24.9301 29.7329C26.9079 29.7329 28.5154 28.1267 28.5154 26.1464L28.5154 13.1712C28.5154 11.1928 26.9082 9.58658 24.9301 9.58658L6.99849 9.58658C5.0185 9.58658 3.41135 11.1928 3.41135 13.1712L3.41135 26.1464C3.41104 28.1267 5.0185 29.7329 6.99849 29.7329ZM6.99849 10.2429L24.9301 10.2429C26.5458 10.2429 27.8597 11.5565 27.8597 13.1712L27.8597 26.1464C27.8597 27.763 26.5458 29.0763 24.9301 29.0763L6.99849 29.0763C5.38285 29.0763 4.06894 27.7633 4.06894 26.1464L4.06894 13.1712C4.06894 11.5565 5.38285 10.2429 6.99849 10.2429Z"
                                                        fill="#3E3F41" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M9.96112 0.329578L24.8908 0.329578C26.6918 0.329578 28.153 1.79326 28.153 3.59485L28.153 6.87176C28.153 8.67336 26.6915 10.1367 24.8908 10.1367L9.96112 10.1367C8.16015 10.1367 6.69648 8.67304 6.69648 6.87176L6.69648 3.59485C6.69648 1.79326 8.16015 0.329579 9.96112 0.329578Z"
                                                        fill="#212325" />
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M9.96352 10.4619L24.891 10.4619C26.8729 10.4619 28.4863 8.85256 28.4863 6.87005L28.4863 3.59314C28.4863 1.60969 26.8729 -0.000296124 24.891 -0.000296037L9.96352 -0.000295385C7.97912 -0.000295298 6.37007 1.60969 6.37007 3.59314L6.37007 6.87005C6.37007 8.85288 7.97912 10.4619 9.96352 10.4619ZM9.96352 0.65666L24.891 0.656659C26.5104 0.656659 27.8262 1.97403 27.8262 3.59314L27.8262 6.87005C27.8262 8.48884 26.5104 9.80559 24.891 9.80559L9.96352 9.80559C8.34378 9.80559 7.02797 8.48884 7.02797 6.87005L7.02797 3.59314C7.02797 1.97403 8.34346 0.65666 9.96352 0.65666Z"
                                                        fill="#3E3F41" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M91.2246 13.1728L91.2246 26.1467C91.2246 27.9436 92.6842 29.4038 94.4811 29.4038L112.415 29.4038C114.211 29.4038 115.671 27.9433 115.671 26.1467L115.671 13.1728C115.671 11.3743 114.211 9.91569 112.415 9.91569L94.4811 9.91569C92.6842 9.91569 91.2246 11.3743 91.2246 13.1728Z"
                                                        fill="#212325" />
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M112.413 29.7329L94.4813 29.7329C92.5035 29.7329 90.896 28.1267 90.896 26.1464L90.896 13.1712C90.896 11.1928 92.5032 9.58658 94.4813 9.58658L112.413 9.58658C114.393 9.58658 116 11.1928 116 13.1712L116 26.1464C116 28.1267 114.393 29.7329 112.413 29.7329ZM112.413 10.2429L94.4813 10.2429C92.8656 10.2429 91.5517 11.5565 91.5517 13.1712L91.5517 26.1464C91.5517 27.763 92.8656 29.0763 94.4813 29.0763L112.413 29.0763C114.029 29.0763 115.342 27.7633 115.342 26.1464L115.342 13.1712C115.342 11.5565 114.029 10.2429 112.413 10.2429Z"
                                                        fill="#3E3F41" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M109.45 0.329577L94.5204 0.329578C92.7195 0.329578 91.2583 1.79326 91.2583 3.59485L91.2583 6.87176C91.2583 8.67336 92.7198 10.1367 94.5204 10.1367L109.45 10.1367C111.251 10.1367 112.715 8.67304 112.715 6.87176L112.715 3.59485C112.715 1.79326 111.251 0.329577 109.45 0.329577Z"
                                                        fill="#212325" />
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M109.448 10.4619L94.5205 10.4619C92.5386 10.4619 90.9252 8.85256 90.9252 6.87005L90.9252 3.59314C90.9252 1.60969 92.5386 -0.000296265 94.5205 -0.000296352L109.448 -0.000297004C111.432 -0.000297091 113.041 1.60969 113.041 3.59314L113.041 6.87005C113.041 8.85287 111.432 10.4619 109.448 10.4619ZM109.448 0.656658L94.5205 0.656659C92.9011 0.656659 91.5853 1.97403 91.5853 3.59314L91.5853 6.87005C91.5853 8.48884 92.9011 9.80559 94.5205 9.80559L109.448 9.80559C111.068 9.80559 112.384 8.48884 112.384 6.87005L112.384 3.59314C112.384 1.97403 111.068 0.656658 109.448 0.656658Z"
                                                        fill="#3E3F41" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M5.4561 56.1367L88.1551 56.1336C90.6452 56.1336 92.673 54.1105 92.673 51.6173L92.673 51.3335C92.673 48.8388 90.6452 46.8157 88.1551 46.8157L10.2571 46.8157L10.2571 5.87016C10.2571 3.37605 8.23558 1.3517 5.74116 1.3517L5.4561 1.3517C2.96388 1.3517 0.938267 3.37605 0.938267 5.87016L0.938269 51.6179C0.937955 54.1114 2.96389 56.1367 5.4561 56.1367Z"
                                                        fill="#212325" />
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M5.45616 56.3999L88.1552 56.3968C90.7931 56.3968 92.9354 54.2569 92.9354 51.6172L92.9354 51.3334C92.9354 48.6929 90.7928 46.55 88.1552 46.55L10.5218 46.55L10.5218 5.87C10.5218 3.23116 8.3791 1.08819 5.74153 1.08819L5.45647 1.08819C2.81858 1.08819 0.676542 3.23116 0.676542 5.87L0.676544 51.6178C0.675915 54.2582 2.81827 56.3999 5.45616 56.3999ZM5.45616 1.61489L5.74122 1.61489C8.08776 1.61489 9.99475 3.52314 9.99475 5.87L9.99475 47.0789L88.1549 47.0789C90.4992 47.0789 92.4062 48.9862 92.4062 51.3334L92.4062 51.6172C92.4062 53.964 90.4992 55.8701 88.1527 55.8701L5.45584 55.8723C3.10961 55.8723 1.2023 53.9662 1.2023 51.6178L1.2023 5.87031C1.20262 3.52314 3.10962 1.61489 5.45616 1.61489Z"
                                                        fill="#3E3F41" />
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M110.153 56.1367L13.7011 56.1336C10.797 56.1336 8.43201 54.1105 8.43201 51.6173L8.43201 51.3335C8.43201 48.8388 10.797 46.8157 13.7011 46.8157L104.553 46.8157L104.553 5.87015C104.553 3.37605 106.911 1.35169 109.82 1.35169L110.153 1.35169C113.059 1.35169 115.422 3.37605 115.422 5.87015L115.422 51.6179C115.422 54.1114 113.059 56.1367 110.153 56.1367Z"
                                                        fill="#212325" />
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M110.153 56.3999L13.7011 56.3968C10.6246 56.3968 8.12598 54.2569 8.12598 51.6172L8.12598 51.3334C8.12598 48.6929 10.6249 46.55 13.7011 46.55L104.245 46.55L104.245 5.86999C104.245 3.23115 106.744 1.08818 109.82 1.08818L110.152 1.08818C113.229 1.08818 115.727 3.23115 115.727 5.86999L115.727 51.6178C115.728 54.2582 113.229 56.3999 110.153 56.3999ZM110.153 1.61488L109.82 1.61488C107.083 1.61488 104.859 3.52313 104.859 5.86999L104.859 47.0789L13.7015 47.0789C10.9673 47.0789 8.74319 48.9862 8.74319 51.3334L8.74319 51.6172C8.74319 53.964 10.9673 55.8701 13.7041 55.8701L110.153 55.8723C112.889 55.8723 115.114 53.9662 115.114 51.6178L115.114 5.87031C115.113 3.52314 112.889 1.61488 110.153 1.61488Z"
                                                        fill="#3E3F41" />
                                                    <path class="text-fill"
                                                        d="M46.7727 11.2727C46.7045 10.697 46.428 10.25 45.9432 9.93182C45.4583 9.61364 44.8636 9.45455 44.1591 9.45455C43.6439 9.45455 43.1932 9.53788 42.8068 9.70455C42.4242 9.87121 42.125 10.1004 41.9091 10.392C41.697 10.6837 41.5909 11.0152 41.5909 11.3864C41.5909 11.697 41.6648 11.964 41.8125 12.1875C41.964 12.4072 42.1572 12.5909 42.392 12.7386C42.6269 12.8826 42.8731 13.0019 43.1307 13.0966C43.3883 13.1875 43.625 13.2614 43.8409 13.3182L45.0227 13.6364C45.3258 13.7159 45.6629 13.8258 46.0341 13.9659C46.4091 14.1061 46.767 14.2973 47.108 14.5398C47.4527 14.7784 47.7367 15.0852 47.9602 15.4602C48.1837 15.8352 48.2955 16.2955 48.2955 16.8409C48.2955 17.4697 48.1307 18.0379 47.8011 18.5455C47.4754 19.053 46.9981 19.4564 46.3693 19.7557C45.7443 20.0549 44.9848 20.2045 44.0909 20.2045C43.2576 20.2045 42.536 20.0701 41.9261 19.8011C41.3201 19.5322 40.8428 19.1572 40.4943 18.6761C40.1496 18.1951 39.9545 17.6364 39.9091 17H41.3636C41.4015 17.4394 41.5492 17.803 41.8068 18.0909C42.0682 18.375 42.3977 18.5871 42.7955 18.7273C43.197 18.8636 43.6288 18.9318 44.0909 18.9318C44.6288 18.9318 45.1117 18.8447 45.5398 18.6705C45.9678 18.4924 46.3068 18.2462 46.5568 17.9318C46.8068 17.6136 46.9318 17.2424 46.9318 16.8182C46.9318 16.4318 46.8239 16.1174 46.608 15.875C46.392 15.6326 46.108 15.4356 45.7557 15.2841C45.4034 15.1326 45.0227 15 44.6136 14.8864L43.1818 14.4773C42.2727 14.2159 41.553 13.8428 41.0227 13.358C40.4924 12.8731 40.2273 12.2386 40.2273 11.4545C40.2273 10.803 40.4034 10.2348 40.7557 9.75C41.1117 9.26136 41.589 8.88258 42.1875 8.61364C42.7898 8.34091 43.4621 8.20455 44.2045 8.20455C44.9545 8.20455 45.6212 8.33901 46.2045 8.60795C46.7879 8.87311 47.25 9.23674 47.5909 9.69886C47.9356 10.161 48.1174 10.6856 48.1364 11.2727H46.7727ZM50.4304 20V11.2727H51.7713V20H50.4304ZM51.1122 9.81818C50.8509 9.81818 50.6255 9.72917 50.4361 9.55114C50.2505 9.37311 50.1577 9.15909 50.1577 8.90909C50.1577 8.65909 50.2505 8.44508 50.4361 8.26705C50.6255 8.08902 50.8509 8 51.1122 8C51.3736 8 51.5971 8.08902 51.7827 8.26705C51.9721 8.44508 52.0668 8.65909 52.0668 8.90909C52.0668 9.15909 51.9721 9.37311 51.7827 9.55114C51.5971 9.72917 51.3736 9.81818 51.1122 9.81818ZM55.5682 8.36364V20H54.2273V8.36364H55.5682ZM65.1605 11.2727L61.9332 20H60.5696L57.3423 11.2727H58.7969L61.206 18.2273H61.2969L63.706 11.2727H65.1605ZM70.277 20.1818C69.4361 20.1818 68.7107 19.9962 68.1009 19.625C67.4948 19.25 67.027 18.7273 66.6974 18.0568C66.3717 17.3826 66.2088 16.5985 66.2088 15.7045C66.2088 14.8106 66.3717 14.0227 66.6974 13.3409C67.027 12.6553 67.4853 12.1212 68.0724 11.7386C68.6634 11.3523 69.3527 11.1591 70.1406 11.1591C70.5952 11.1591 71.044 11.2348 71.4872 11.3864C71.9304 11.5379 72.3338 11.7841 72.6974 12.125C73.0611 12.4621 73.3509 12.9091 73.5668 13.4659C73.7827 14.0227 73.8906 14.7083 73.8906 15.5227V16.0909H67.1634V14.9318H72.527C72.527 14.4394 72.4285 14 72.2315 13.6136C72.0384 13.2273 71.7618 12.9223 71.402 12.6989C71.0459 12.4754 70.6255 12.3636 70.1406 12.3636C69.6065 12.3636 69.1444 12.4962 68.7543 12.7614C68.3679 13.0227 68.0705 13.3636 67.8622 13.7841C67.6539 14.2045 67.5497 14.6553 67.5497 15.1364V15.9091C67.5497 16.5682 67.6634 17.1269 67.8906 17.5852C68.1217 18.0398 68.4418 18.3864 68.8509 18.625C69.2599 18.8598 69.7353 18.9773 70.277 18.9773C70.6293 18.9773 70.9474 18.928 71.2315 18.8295C71.5194 18.7273 71.7675 18.5758 71.9759 18.375C72.1842 18.1705 72.3452 17.9167 72.4588 17.6136L73.7543 17.9773C73.6179 18.4167 73.3887 18.803 73.0668 19.1364C72.7448 19.4659 72.3471 19.7235 71.8736 19.9091C71.4001 20.0909 70.8679 20.1818 70.277 20.1818ZM75.9304 20V11.2727H77.2259V12.5909H77.3168C77.4759 12.1591 77.7637 11.8087 78.1804 11.5398C78.5971 11.2708 79.0668 11.1364 79.5895 11.1364C79.688 11.1364 79.8111 11.1383 79.9588 11.142C80.1065 11.1458 80.2183 11.1515 80.294 11.1591V12.5227C80.2486 12.5114 80.1444 12.4943 79.9815 12.4716C79.8224 12.4451 79.6539 12.4318 79.4759 12.4318C79.0516 12.4318 78.6728 12.5208 78.3395 12.6989C78.0099 12.8731 77.7486 13.1155 77.5554 13.4261C77.366 13.733 77.2713 14.0833 77.2713 14.4773V20H75.9304Z"
                                                        fill="white" />
                                                </svg>
                                            </div>
                                            
                                            <div class="modal table-modal fade" id="modal{{ $table->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="card  @if ($table->status == 'in_service') bg-info
                                                 @elseif($table->status == 'available')
                                                bg-success text-light
                                                @elseif ($table->status == 'reserved')
                                                   bg-danger  text-light @endif"
                                                data-id="table1" data-stat="serv">
                                                <div class="modal-header">
                                                    <div
                                                        class="card-header primary-bg-color w-100 d-flex justify-content-between">
                                                        <h3 class="modal-title fs-5" id="exampleModalLabel">
                                                            {{ $table->name }}</h3>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="card-item mid d-flex justify-content-between">
                                                        <p class="hall-name"> الباقة</p>
                                                        <span class="sta">
                                                            {{ $table->reservation != null ? $table->reservation->package->name : 'لا توجد باقة' }}
                                                        </span>
                                                    </div>
                                                    <div class="card-item body-package d-flex justify-content-between">
                                                        <p class="hall-name"> المقاعد</p>
                                                        <span class="sta">
                                                            {{ $table->reservation != null ? $table->reservation->package->count_of_visitors : 0 }}
                                                            اشخاص</span>
                                                    </div>
                                                    <div class="card-item body-time d-flex justify-content-between">
                                                        <p class="hall-name"> الحجز</p>
                                                        <span
                                                            class="sta">{{ $table->reservation != null ? $table->reservation->price : 0 }}
                                                            ريال</span>
                                                    </div>
                                                    <div class="card-item body-time d-flex justify-content-between">
                                                        <p class="hall-name"> المدة</p>
                                                        <span
                                                            class="sta">{{ $table->reservation != null ? $table->reservation->minutes : 0 }}
                                                            ساعة </span>
                                                    </div>
                                                    <div class="card-item body-time d-flex justify-content-between">
                                                        <p class="hall-name"> الحالة</p>
                                                        <span class="sta">
                                                            {{ $table->reservation != null ? $table->reservation->status : 'لا يوجد حجز' }}</span>
                                                    </div>
                                                    <div class="card-item body-time d-flex justify-content-between">
                                                        <p class="hall-name"> الرصيد الحالى</p>
                                                        <span class="sta">
                                                            {{ $table->reservation != null ? $table->reservation->price : 0 }}
                                                            ريال </span>
                                                    </div>
                                                    @php
                                                        if ($table->reservation) {
                                                            $formattedTime = Carbon\Carbon::createFromFormat('g:i A', $table->reservation->time)->format('H:i');
                                                            $reservationDateTime = $table->reservation->date;
                                                        }

                                                    @endphp
                                                    <div class="card-item body-time d-flex justify-content-between">
                                                        <p class="hall-name"> الوقت المنقضى</p>
                                                        <div class="countdown-timer"
                                                            data-start="{{ $table->reservation ? $table->reservation->date : '' }}"
                                                            data-package-time="{{ $table->reservation->package->time ?? 0 }}">
                                                            <!-- Add a span to display the countdown timer -->
                                                            @if ($table->reservation)
                                                                <span class="countdown-timer-text">00:00:00</span>
                                                            @else
                                                                <span>انتهى</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="table-btn my-3 text-center">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-2">
                                                                <button class="table-btn-action btn btn-primary w-100"
                                                                    type="button" data-id="#tableorders">
                                                                    الطلبات
                                                                </button>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <button class="table-btn-action btn btn-primary w-100"
                                                                    type="button" data-id="#tableinfo">
                                                                    استعراض
                                                                </button>
                                                            </div>
                                                            @if ($table->reservation)
                                                                <div class="col-md-6">
                                                                    <button class="table-btn-action btn btn-primary w-100"
                                                                        type="button" disabled data-id="#exampleModal_{{ $table->id }}">
                                                                        تفعيل الحجز
                                                                    </button>
                                                                </div>
                                                            @else
                                                                <div class="col-md-6">
                                                                    <button disabled
                                                                        class="table-btn-action btn btn-primary w-100"
                                                                        type="button" disabled data-id="#exampleModal_{{ $table->id }}">
                                                                        تفعيل الحجز
                                                                    </button>
                                                                     <!-- Modal -->
                                                                            <div class="modal fade"
                                                                                id="exampleModal_{{ $table->id }}"
                                                                                tabindex="-1"
                                                                                aria-labelledby="exampleModalLabel"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h1 class="modal-title fs-5"
                                                                                                id="exampleModalLabel">
                                                                                                تفعيل الحجز</h1>
                                                                                            <button type="button"
                                                                                                class="btn-close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div
                                                                                                class="modal-body text-light">
                                                                                                هل تود تفعيل الحجز
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <a type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-bs-dismiss="modal">اغلاق</a>
                                                                                            <button type="button"
                                                                                                onclick="activeTable({{ $table->id }})"
                                                                                                class="btn btn-primary">تأكيد
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                </div>
                                                            @endif
                                                              
                                                            @if ($table->reservation)
                                                                <div class="col-md-6">
                                                                    <button class="table-btn-action btn btn-primary w-100"
                                                                        type="button" data-id="#tableend">
                                                                        انهاء الحجز
                                                                    </button>
                                                                      <!-- Modal -->
                                                                            <div class="modal fade"
                                                                                id="close_{{ $table->id }}"
                                                                                tabindex="-1"
                                                                                aria-labelledby="exampleModalLabel"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h1 class="modal-title fs-5"
                                                                                                id="exampleModalLabel">
                                                                                                انهاء الحجز</h1>
                                                                                            <button type="button"
                                                                                                class="btn-close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div
                                                                                                class="modal-body text-light">
                                                                                                هل تود انهاء الحجز
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-bs-dismiss="modal">اغلاق</button>
                                                                                            <a type="button"
                                                                                                onclick="closeTable({{ $table->id }})"
                                                                                                class="btn btn-primary">انهاء
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                </div>
                                                            @else
                                                                <div class="col-md-6">
                                                                    <button disabled
                                                                        class="table-btn-action btn btn-primary w-100"
                                                                        type="button" data-id="#tableend">
                                                                        انهاء الحجز
                                                                    </button>
                                                                </div>
                                                            @endif
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>


                                            <!--<div class="modal-body">-->
                                            <!--    <ul class="list-group">-->
                                            <!--        <li class="list-group-item">-->
                                            <!--            <div class="d-flex">-->
                                            <!--                <div class="left t-packagename">VVIP</div>-->
                                            <!--                <div class="right t-statu">{{ $table->status }}</div>-->
                                            <!--            </div>-->
                                            <!--        </li>-->
                                            <!--        <li class="list-group-item">-->
                                            <!--            <div class="d-flex">-->
                                            <!--                <div class="left t-packagepeice">باقة ساعاتان</div>-->
                                            <!--                <div class="right t-capicity">4 أشخاص</div>-->
                                            <!--            </div>-->
                                            <!--        </li>-->
                                            <!--        <li class="list-group-item">-->
                                            <!--            <div class="d-flex">-->
                                            <!--                <div class="left t-packagedate"> 10-8</div>-->
                                            <!--                <div class="right t-time">08:00 </div>-->
                                            <!--            </div>-->
                                            <!--        </li>-->
                                            <!--        <li class="list-group-item">-->
                                            <!--            <div class="d-flex">-->
                                            <!--                <div class="left t-waiter"> أسم الويتر: </div>-->
                                            <!--                <div class="right t-time">أحمد مرزوق </div>-->
                                            <!--            </div>-->
                                            <!--        </li>-->
                                            <!--    </ul>-->
                                            <!--</div>-->
                                            <!--<div class="modal-footer">-->
                                            <!--    <div class="left t-allpoint"> <span class="point">800</span> الرصيد-->
                                            <!--    </div>-->
                                            <!--    <div class="right t-points"> <span class="have-point">200</span> الرصيد-->
                                            <!--        المتبقى </div>-->
                                            <!--</div>-->
                                        </div>
                                    </div>

                                </div>


                                            @if ($table->status == 'in_service')
                                                <div class="table-side-bar" id="table{{ $table->id }}">
                                                    <h2 class="text-center mb-4">طاولة رقم
                                                        {{ $table->name }}</h2>
                                                    <div class="tab-nav-wraper">
                                                        <ul
                                                            class="nav c-nav-tabs d-flex justify-content-between home-tab">
                                                            <li class="nav-item">
                                                                <a class="nav-link " data-tab="reservations"
                                                                    href="#">
                                                                    الحجوزات</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-tab="orders" href="#">
                                                                    الطلبات</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link active" data-tab="the-menu"
                                                                    href="#">
                                                                    القائمة</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- عناصر التاب -->
                                                    <div class="tab-content">
                                                        <div id="the-menu" class="c-tab-pane active">
                                                            <ol class="list-group list-group-numbered reversed">


                                                                @if ($orders != null && $orders->products->count() != 0)
                                                                    @foreach ($orders->products as $product)
                                                                        <li
                                                                            class="list-group-item d-flex justify-content-between align-items-start">
                                                                            <div class="me-2 ms-auto">
                                                                                <div class="fw-bold">
                                                                                    {{ $product->name }}
                                                                                </div>
                                                                            </div>

                                                                            <span>{{ $product->pivot->price }}
                                                                                ريال</span>
                                                                        </li>
                                                                    @endforeach
                                                                @endif

                                                                <li
                                                                    class="new-menu-li list-group-item d-flex justify-content-center align-items-start">
                                                                    <a onclick="product({{ $table->id }})"
                                                                        class="me-2">
                                                                        <div class="fw-bold">اضف عنصر
                                                                            جديد
                                                                        </div>
                                                                    </a>
                                                                </li>

                                                            </ol>

                                                            <ol class="list-group reversed none  mt-5">
                                                                <li class="list-group-item no-number  ">
                                                                    <div
                                                                        class="sub-total d-flex justify-content-between align-items-start">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold"> حاصل
                                                                                الجمع</div>
                                                                        </div>
                                                                        <span>{{ $table->reservation->package->price ?? 0 }}
                                                                            ريال</span>
                                                                    </div>

                                                                    <div
                                                                        class="tax d-flex justify-content-between align-items-start mt-4">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold"> ضريبة
                                                                            </div>
                                                                        </div>
                                                                        <span>15%</span>
                                                                    </div>
                                                                    <div
                                                                        class="tax d-flex justify-content-between align-items-start mt-4 total">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold">
                                                                                الإجمالى
                                                                            </div>
                                                                        </div>

                                                                        @php
                                                                            $total = $table->reservation->package->price ?? 0 * 0.15;
                                                                        @endphp

                                                                        <span>{{ $total - $totalOrderPrices }}

                                                                            ريال</span>
                                                                    </div>
                                                                    <div class="payment-method">
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <div
                                                                                    class="payment-icon d-flex justify-content-center align-items-center">
                                                                                    <i
                                                                                        class="fa-solid fa-sack-dollar"></i>
                                                                                </div>
                                                                                <p class="text-center">
                                                                                    كاش
                                                                                </p>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div
                                                                                    class="payment-icon d-flex justify-content-center align-items-center">
                                                                                    <i
                                                                                        class="fa-solid fa-credit-card"></i>
                                                                                </div>
                                                                                <p class="text-center">
                                                                                    بطاقة ائتمان</p>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div
                                                                                    class="payment-icon d-flex justify-content-center align-items-center">
                                                                                    <i class="fa-solid fa-wallet"></i>
                                                                                </div>
                                                                                <p class="text-center">
                                                                                    المحفظة</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="payment-btn my-3 text-center">
                                                                            <div class="btn btn-primary btn-lg w-100"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#exampleModal6">
                                                                                ادفع الآن</div>
                                                                            <!-- Modal -->
                                                                            <div class="modal fade" id="exampleModal6"
                                                                                tabindex="-1"
                                                                                aria-labelledby="exampleModalLabel6"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title"
                                                                                                id="exampleModalLabel">
                                                                                                تأكيد
                                                                                                الدفع
                                                                                            </h5>
                                                                                            <button type="button"
                                                                                                class="btn-close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <p class="consfirm-text">
                                                                                                هل تريد
                                                                                                تأكيد
                                                                                                الدفع
                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button"
                                                                                                class="btn btn-primary">تأكيد</button>
                                                                                            <button type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-bs-dismiss="modal">لا
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>



                                                            </ol>

                                                        </div>
                                                        <div id="orders" class="c-tab-pane ">
                                                            @foreach ($table->reservations as $reservation)
                                                                <ol
                                                                    class="list-group list-group-numbered reversed bill-info">
                                                                    <li
                                                                        class="list-group-item d-flex justify-content-between align-items-start">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold"> طلب
                                                                                باسم
                                                                            </div>
                                                                        </div>
                                                                        <span>{{ $reservation->client->name }}</span>
                                                                    </li>
                                                                    <li
                                                                        class="list-group-item d-flex justify-content-between align-items-start">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold">اسم
                                                                                الباقة
                                                                            </div>
                                                                        </div>
                                                                        <span>
                                                                            {{ $reservation->package->name }}</span>
                                                                    </li>
                                                                    <li
                                                                        class="list-group-item d-flex justify-content-between align-items-start">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold">
                                                                                الرصيد
                                                                            </div>
                                                                        </div>
                                                                        <span>{{ $reservation->package->price }}
                                                                        </span>
                                                                    </li>
                                                                    <li
                                                                        class="list-group-item d-flex justify-content-between align-items-start">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold">
                                                                                الحالة
                                                                            </div>
                                                                        </div>
                                                                        <span class="badge bg-info">تم
                                                                            الدفع </span>
                                                                    </li>
                                                                    <li
                                                                        class="new-menu-li list-group-item d-flex justify-content-center align-items-start">
                                                                        <div class="me-2">
                                                                            <div class="fw-bold"> طباعة
                                                                                الطلب</div>
                                                                        </div>
                                                                    </li>
                                                                </ol>
                                                            @endforeach

                                                        </div>
                                                        <div id="reservations" class="c-tab-pane ">
                                                            <div class="hour-col">
                                                                <div class="body-hour-cel">
                                                                    <div class="row gx-0 p-2 text-center">
                                                                        <div class="col-md-2">
                                                                            <p class="hour mb-0">05:00
                                                                                AM
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            <div class="row gx-0">
                                                                                <div class="col-md-9">
                                                                                    <div
                                                                                        class="d-flex h-100 justify-content-around align-items-center">
                                                                                        <div class="gusts">
                                                                                            <span
                                                                                                class="table-gusts px-2">
                                                                                                4</span>
                                                                                            <span> <i
                                                                                                    class="fa-solid fa-users"></i></span>
                                                                                        </div>
                                                                                        <div class="table-res">
                                                                                            طاولة 1
                                                                                        </div>
                                                                                        <span
                                                                                            class="badge bg-secondary">مؤكد</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <span>رصيد متبقى
                                                                                        600</span>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="body-hour-cel">
                                                                    <div class="row gx-0 p-2 text-center">
                                                                        <div class="col-md-2">
                                                                            05:15 AM
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            <div class="row gx-0">
                                                                                <div class="col-md-9">
                                                                                    <div
                                                                                        class="d-flex justify-content-center align-items-center">
                                                                                        <span>لا يوجد
                                                                                            حجز</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <span>لا يوجد
                                                                                        رصيد</span>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="body-hour-cel">
                                                                    <div class="row gx-0 p-2 text-center">
                                                                        <div class="col-md-2">
                                                                            05:30 AM
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            <div class="row gx-0">
                                                                                <div class="col-md-9">
                                                                                    <div
                                                                                        class="d-flex justify-content-center align-items-center">
                                                                                        <span>لا يوجد
                                                                                            حجز</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <span>لا يوجد
                                                                                        رصيد</span>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="body-hour-cel">
                                                                    <div class="row gx-0 p-2 text-center">
                                                                        <div class="col-md-2">
                                                                            05:45 AM
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            <div class="row gx-0">
                                                                                <div class="col-md-9">
                                                                                    <div
                                                                                        class="d-flex justify-content-center align-items-center">
                                                                                        <span>لا يوجد
                                                                                            حجز</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <span>لا يوجد
                                                                                        رصيد</span>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                @can('add_reservation')
                                                    <div class="table-side-bar" id="table{{ $table->id }}">
                                                        <ol class="table-list list-group list-group-numbered reversed">
                                                            <li
                                                                class="menu-info-list list-group-item d-flex  flex-column justify-content-center align-items-center text-center p-0">
                                                                <a class="new-reserv-btn btn btn-link w-100"
                                                                    href="{{ route('branch.reservation') }}">
                                                                    <i class="fa-solid fa-plus"></i>
                                                                    <p>انشاء حجز جديد </p>
                                                                </a>
                                                            </li>

                                                        </ol>

                                                    </div>
                                                @endcan
                                            @endif
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                            <div class="row salon6">
                                @foreach ($secondHalfTwo as $table)
                                    @php
                                        if ($table->reservation) {
                                            $orders = App\Models\Order::where('package_id', $table->reservation->package_id)
                                                ->where('table_id', $table->id)
                                                ->where('is_done', 0)
                                                ->with('products')
                                                ->first();

                                            // Wrap the related products in a collection (even if there's only one result)
                                            if ($orders != null && $orders->products->count() != 0) {
                                                // Calculate total order prices using the map function on the products collection
                                                $totalOrderPrices = $orders->products->sum(function ($product) {
                                                    return $product->pivot->price * $product->pivot->quantity;
                                                });
                                            } else {
                                                $totalOrderPrices = 0;
                                            }
                                        } else {
                                            $orders = null;
                                            $totalOrderPrices = 0;
                                        }
                                    @endphp
                                    <div class="col-md-2">
                                        <div class="sofa @if ($table->status == 'in_service') sofa-serv
                                                            @elseif($table->status == 'available')
                                                            sofa-available
                                                             @elseif ($table->status == 'reserved')
                                                              sofa-reserved @endif"
                                            data-id="table{{ $table->id }}" data-stat="serv"
                                            data-bs-toggle="modal" data-bs-target="#modal{{ $table->id }}"
                                            data-h="hall{{ $loungesSortow->id }}"
                                            @if ($table->status == 'in_service') data-pstat="serv"
                                                            @elseif($table->status == 'available')
                                                             data-pstat ="available"
                                                             @elseif ($table->status == 'reserved')
                                                              data-pstat ="reserved" @endif>
                                            <div class="table-vip d-flex flex-column align-items-center">
                                                <h4>{{ $table->name }}</h4>
                                                <svg width="93" height="57" viewBox="0 0 93 57"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M68.7003 30.2185L81.6726 30.2185C83.4695 30.2185 84.9307 31.679 84.9307 33.4762L84.9307 51.4088C84.9307 53.206 83.4692 54.6665 81.6726 54.6665L68.7003 54.6665C66.9012 54.6665 65.4419 53.206 65.4419 51.4088L65.4419 33.4765C65.4419 31.679 66.9012 30.2185 68.7003 30.2185Z"
                                                        fill="#212325"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M27.8048 32.6337L27.8048 45.6114C27.8048 47.4086 26.343 48.8682 24.5461 48.8682L6.61452 48.8682C4.81576 48.8682 3.35648 47.4086 3.35648 45.6114L3.35648 32.6337C3.35648 30.8365 4.81608 29.3769 6.61452 29.3769L24.5461 29.3769C26.343 29.3769 27.8048 30.8362 27.8048 32.6337Z"
                                                        fill="#212325" class="fill"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M6.61459 49.1953L24.5484 49.1953C26.5262 49.1953 28.1337 47.5885 28.1337 45.6104L28.1337 32.6327C28.1337 30.6536 26.5265 29.0465 24.5484 29.0465L6.61459 29.0465C4.6346 29.0465 3.02964 30.6536 3.02964 32.6327L3.02964 45.6104C3.02932 47.5885 4.6346 49.1953 6.61459 49.1953ZM6.61459 29.7044L24.5484 29.7044C26.1641 29.7044 27.4758 31.0164 27.4758 32.6327L27.4758 45.6104C27.4758 47.2263 26.1641 48.5387 24.5484 48.5387L6.61459 48.5387C4.99895 48.5387 3.68723 47.2266 3.68723 45.6104L3.68723 32.6327C3.68723 31.0164 4.99894 29.7044 6.61459 29.7044Z"
                                                        fill="#3E3F41" class="line"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M49.2532 30.2183L62.2277 30.2183C64.0243 30.2183 65.4839 31.6776 65.4839 33.4751L65.4839 51.4092C65.4839 53.2064 64.0243 54.666 62.2277 54.666L49.2532 54.666C47.4541 54.666 45.9967 53.2064 45.9967 51.4092L45.9967 33.4751C45.9967 31.6779 47.4541 30.2183 49.2532 30.2183Z"
                                                        fill="#212325" class="fill"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M49.2531 54.9927L62.2296 54.9927C64.2073 54.9927 65.8148 53.3868 65.8148 51.4074L65.8148 33.4727C65.8148 31.4952 64.2077 29.889 62.2296 29.889L49.2531 29.889C47.2731 29.889 45.6679 31.4952 45.6679 33.4727L45.6679 51.4077C45.6679 53.3871 47.2731 54.9927 49.2531 54.9927ZM49.2531 30.5459L62.2296 30.5459C63.8452 30.5459 65.1569 31.858 65.1569 33.4727L65.1569 51.4077C65.1569 53.0237 63.8452 54.3348 62.2296 54.3348L49.2531 54.3348C47.6353 54.3348 46.3239 53.0237 46.3239 51.4077L46.3239 33.473C46.3236 31.858 47.6353 30.5459 49.2531 30.5459Z"
                                                        fill="#3E3F41" class="line"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M30.1924 30.2185L43.1669 30.2185C44.9635 30.2185 46.4231 31.679 46.4231 33.4762L46.4231 51.4088C46.4231 53.206 44.9635 54.6665 43.1669 54.6665L30.1924 54.6665C28.3933 54.6665 26.934 53.206 26.934 51.4088L26.934 33.4765C26.934 31.679 28.3936 30.2185 30.1924 30.2185Z"
                                                        fill="#212325" class="fill"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M68.7003 54.9927L81.6726 54.9927C83.6526 54.9927 85.2598 53.3849 85.2598 51.4074L85.2598 33.4752C85.2598 31.4952 83.6526 29.889 81.6726 29.889L68.7003 29.889C66.7203 29.889 65.1131 31.4952 65.1131 33.4752L65.1131 51.4077C65.1131 53.3849 66.7203 54.9927 68.7003 54.9927ZM68.7003 30.5459L81.6726 30.5459C83.2883 30.5459 84.6038 31.8592 84.6038 33.4755L84.6038 51.4077C84.6038 53.0228 83.288 54.3348 81.6726 54.3348L68.7003 54.3348C67.0824 54.3348 65.7707 53.0228 65.7707 51.4077L65.7707 33.4755C65.7707 31.8592 67.0824 30.5459 68.7003 30.5459Z"
                                                        fill="#3E3F41" class="line"></path>
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M30.1924 54.9912L43.1669 54.9912C45.1447 54.9912 46.7538 53.385 46.7538 51.4066L46.7538 33.4728C46.7538 31.4953 45.1447 29.8881 43.1669 29.8881L30.1924 29.8881C28.2124 29.8881 26.6052 31.4953 26.6052 33.4728L26.6052 51.4066C26.6052 53.385 28.2127 54.9912 30.1924 54.9912ZM30.1924 30.5451L43.1669 30.5451C44.7804 30.5451 46.0943 31.8581 46.0943 33.4728L46.0943 51.4066C46.0943 53.0225 44.7804 54.3349 43.1669 54.3349L30.1924 54.3349C28.5767 54.3349 27.2631 53.0229 27.2631 51.4066L27.2631 33.4728C27.2631 31.8581 28.5771 30.5451 30.1924 30.5451Z"
                                                        fill="#3E3F41"></path>
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M27.8048 13.5727L27.8048 26.5466C27.8048 28.3435 26.3452 29.8037 24.5483 29.8037L6.61452 29.8037C4.81796 29.8037 3.35838 28.3432 3.35838 26.5466L3.35837 13.5727C3.35837 11.7742 4.81796 10.3156 6.61452 10.3156L24.5483 10.3156C26.3452 10.3156 27.8048 11.7742 27.8048 13.5727Z"
                                                        fill="#212325"></path>
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M6.61641 30.1328L24.548 30.1328C26.5258 30.1328 28.1333 28.5266 28.1333 26.5463L28.1333 13.5711C28.1333 11.5927 26.5261 9.98648 24.548 9.98648L6.61641 9.98648C4.63642 9.98648 3.02927 11.5927 3.02927 13.5711L3.02927 26.5463C3.02896 28.5266 4.63642 30.1328 6.61641 30.1328ZM6.61641 10.6428L24.548 10.6428C26.1637 10.6428 27.4776 11.9564 27.4776 13.5711L27.4776 26.5463C27.4776 28.1629 26.1637 29.4762 24.548 29.4762L6.61641 29.4762C5.00077 29.4762 3.68686 28.1632 3.68686 26.5463L3.68686 13.5711C3.68686 11.9564 5.00077 10.6428 6.61641 10.6428Z"
                                                        fill="#3E3F41"></path>
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M9.57916 0.729481L24.5089 0.72948C26.3098 0.72948 27.771 2.19316 27.771 3.99475L27.771 7.27166C27.771 9.07326 26.3095 10.5366 24.5089 10.5366L9.57916 10.5366C7.7782 10.5366 6.31453 9.07295 6.31453 7.27167L6.31453 3.99475C6.31453 2.19316 7.7782 0.729481 9.57916 0.729481Z"
                                                        fill="#212325"></path>
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M9.58144 10.8618L24.5089 10.8618C26.4908 10.8618 28.1042 9.25246 28.1042 7.26995L28.1042 3.99304C28.1042 2.00959 26.4908 0.399606 24.5089 0.399606L9.58144 0.399607C7.59704 0.399607 5.98799 2.00959 5.98799 3.99304L5.98799 7.26996C5.98799 9.25278 7.59704 10.8618 9.58144 10.8618ZM9.58144 1.05656L24.5089 1.05656C26.1283 1.05656 27.4442 2.37394 27.4442 3.99304L27.4442 7.26995C27.4442 8.88875 26.1283 10.2055 24.5089 10.2055L9.58144 10.2055C7.9617 10.2055 6.64589 8.88875 6.64589 7.26996L6.64589 3.99304C6.64589 2.37394 7.96138 1.05656 9.58144 1.05656Z"
                                                        fill="#3E3F41"></path>
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M65.6802 13.5727L65.6802 26.5466C65.6802 28.3435 67.1398 29.8037 68.9366 29.8037L86.8705 29.8037C88.667 29.8037 90.1266 28.3432 90.1266 26.5466L90.1266 13.5727C90.1266 11.7742 88.667 10.3156 86.8705 10.3156L68.9366 10.3156C67.1398 10.3156 65.6802 11.7742 65.6802 13.5727Z"
                                                        fill="#212325"></path>
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M86.8684 30.1328L68.9368 30.1328C66.959 30.1328 65.3516 28.5266 65.3516 26.5463L65.3516 13.5711C65.3516 11.5927 66.9587 9.98648 68.9368 9.98648L86.8684 9.98648C88.8484 9.98648 90.4556 11.5927 90.4556 13.5711L90.4556 26.5463C90.4559 28.5266 88.8484 30.1328 86.8684 30.1328ZM86.8684 10.6428L68.9368 10.6428C67.3212 10.6428 66.0073 11.9564 66.0073 13.5711L66.0073 26.5463C66.0073 28.1629 67.3212 29.4762 68.9368 29.4762L86.8684 29.4762C88.4841 29.4762 89.798 28.1632 89.798 26.5463L89.798 13.5711C89.798 11.9564 88.4841 10.6428 86.8684 10.6428Z"
                                                        fill="#3E3F41"></path>
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M83.9057 0.729479L68.976 0.72948C67.175 0.72948 65.7139 2.19316 65.7139 3.99475L65.7139 7.27166C65.7139 9.07326 67.1754 10.5366 68.976 10.5366L83.9057 10.5366C85.7067 10.5366 87.1703 9.07294 87.1703 7.27166L87.1703 3.99475C87.1703 2.19316 85.7067 0.729479 83.9057 0.729479Z"
                                                        fill="#212325"></path>
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M83.9035 10.8618L68.9761 10.8618C66.9942 10.8618 65.3807 9.25246 65.3807 7.26995L65.3807 3.99304C65.3807 2.00959 66.9942 0.399606 68.9761 0.399606L83.9035 0.399605C85.8879 0.399605 87.497 2.00959 87.497 3.99304L87.497 7.26995C87.497 9.25278 85.8879 10.8618 83.9035 10.8618ZM83.9035 1.05656L68.9761 1.05656C67.3566 1.05656 66.0408 2.37394 66.0408 3.99304L66.0408 7.26995C66.0408 8.88875 67.3566 10.2055 68.9761 10.2055L83.9035 10.2055C85.5233 10.2055 86.8391 8.88875 86.8391 7.26995L86.8391 3.99304C86.8391 2.37394 85.5236 1.05656 83.9035 1.05656Z"
                                                        fill="#3E3F41"></path>
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M5.07402 56.5366L87.7731 56.5335C90.2631 56.5335 92.2909 54.5104 92.2909 52.0172L92.2909 51.7334C92.2909 49.2387 90.2631 47.2156 87.7731 47.2156L9.87501 47.2156L9.87501 6.27006C9.87501 3.77596 7.8535 1.7516 5.35908 1.7516L5.07402 1.7516C2.5818 1.7516 0.556187 3.77596 0.556187 6.27006L0.556189 52.0179C0.555875 54.5113 2.58181 56.5366 5.07402 56.5366Z"
                                                        fill="#212325"></path>
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M5.07408 56.7998L87.7731 56.7967C90.411 56.7967 92.5533 54.6568 92.5533 52.0171L92.5533 51.7333C92.5533 49.0928 90.4107 46.9499 87.7731 46.9499L10.1397 46.9499L10.1397 6.2699C10.1397 3.63106 7.99702 1.48809 5.35945 1.48809L5.07439 1.48809C2.4365 1.48809 0.294462 3.63106 0.294462 6.2699L0.294464 52.0177C0.293835 54.6581 2.43619 56.7998 5.07408 56.7998ZM5.07408 2.01479L5.35914 2.01479C7.70568 2.01479 9.61267 3.92304 9.61267 6.2699L9.61267 47.4788L87.7728 47.4788C90.1171 47.4788 92.0241 49.3861 92.0241 51.7333L92.0241 52.0171C92.0241 54.3639 90.1171 56.27 87.7706 56.27L5.07376 56.2722C2.72753 56.2722 0.820224 54.3661 0.820224 52.0177L0.820222 6.27022C0.820536 3.92305 2.72754 2.01479 5.07408 2.01479Z"
                                                        fill="#3E3F41"></path>
                                                    <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M87.7738 56.5366L5.07472 56.5335C2.5847 56.5335 0.556885 54.5104 0.556885 52.0172L0.556885 51.7334C0.556884 49.2387 2.5847 47.2156 5.07472 47.2156L82.9728 47.2156L82.9728 6.27005C82.9728 3.77595 84.9943 1.7516 87.4887 1.7516L87.7738 1.7516C90.266 1.7516 92.2916 3.77595 92.2916 6.27005L92.2916 52.0178C92.2919 54.5113 90.266 56.5366 87.7738 56.5366Z"
                                                        fill="#212325"></path>
                                                    <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M87.7737 56.7998L5.07467 56.7967C2.43677 56.7967 0.294434 54.6568 0.294433 52.0171L0.294433 51.7333C0.294433 49.0928 2.43709 46.9499 5.07467 46.9499L82.7081 46.9499L82.7081 6.26989C82.7081 3.63106 84.8507 1.48808 87.4883 1.48808L87.7734 1.48808C90.4113 1.48808 92.5533 3.63106 92.5533 6.26989L92.5533 52.0177C92.5539 54.6581 90.4116 56.7998 87.7737 56.7998ZM87.7737 2.01478L87.4886 2.01478C85.1421 2.01478 83.2351 3.92304 83.2351 6.26989L83.2351 47.4788L5.07498 47.4788C2.73064 47.4788 0.82364 49.3861 0.82364 51.7333L0.82364 52.0171C0.82364 54.3639 2.73064 56.27 5.07718 56.27L87.774 56.2722C90.1202 56.2722 92.0276 54.3661 92.0276 52.0177L92.0276 6.27021C92.0272 3.92304 90.1202 2.01478 87.7737 2.01478Z"
                                                        fill="#3E3F41"></path>
                                                    <path class="text-fill"
                                                        d="M34.1222 6.90909L38.0085 17.929H38.1619L42.0483 6.90909H43.7102L38.9034 20H37.267L32.4602 6.90909H34.1222ZM47.3345 6.90909V20H45.7493V6.90909H47.3345ZM50.513 20V6.90909H54.9363C55.9632 6.90909 56.8027 7.09446 57.4547 7.4652C58.111 7.83168 58.5968 8.32812 58.9121 8.95455C59.2275 9.58097 59.3851 10.2798 59.3851 11.0511C59.3851 11.8224 59.2275 12.5234 58.9121 13.1541C58.601 13.7848 58.1195 14.2876 57.4675 14.6626C56.8155 15.0334 55.9803 15.2188 54.9618 15.2188H51.7914V13.8125H54.9107C55.6138 13.8125 56.1784 13.6911 56.6046 13.4482C57.0307 13.2053 57.3397 12.8771 57.5314 12.4638C57.7275 12.0462 57.8255 11.5753 57.8255 11.0511C57.8255 10.527 57.7275 10.0582 57.5314 9.64489C57.3397 9.23153 57.0286 8.90767 56.5982 8.6733C56.1678 8.43466 55.5968 8.31534 54.8851 8.31534H52.0982V20H50.513Z"
                                                        fill="white"></path>
                                                </svg>
                                            </div>
                                            
                                            <div class="modal table-modal fade" id="modal{{ $table->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="card  @if ($table->status == 'in_service') bg-info
                                                 @elseif($table->status == 'available')
                                                bg-success text-light
                                                @elseif ($table->status == 'reserved')
                                                   bg-danger  text-light @endif"
                                                data-id="table1" data-stat="serv">
                                                <div class="modal-header">
                                                    <div
                                                        class="card-header primary-bg-color w-100 d-flex justify-content-between">
                                                        <h3 class="modal-title fs-5" id="exampleModalLabel">
                                                            {{ $table->name }}</h3>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="card-item mid d-flex justify-content-between">
                                                        <p class="hall-name"> الباقة</p>
                                                        <span class="sta">
                                                            {{ $table->reservation != null ? $table->reservation->package->name : 'لا توجد باقة' }}
                                                        </span>
                                                    </div>
                                                    <div class="card-item body-package d-flex justify-content-between">
                                                        <p class="hall-name"> المقاعد</p>
                                                        <span class="sta">
                                                            {{ $table->reservation != null ? $table->reservation->package->count_of_visitors : 0 }}
                                                            اشخاص</span>
                                                    </div>
                                                    <div class="card-item body-time d-flex justify-content-between">
                                                        <p class="hall-name"> الحجز</p>
                                                        <span
                                                            class="sta">{{ $table->reservation != null ? $table->reservation->price : 0 }}
                                                            ريال</span>
                                                    </div>
                                                    <div class="card-item body-time d-flex justify-content-between">
                                                        <p class="hall-name"> المدة</p>
                                                        <span
                                                            class="sta">{{ $table->reservation != null ? $table->reservation->minutes : 0 }}
                                                            ساعة </span>
                                                    </div>
                                                    <div class="card-item body-time d-flex justify-content-between">
                                                        <p class="hall-name"> الحالة</p>
                                                        <span class="sta">
                                                            {{ $table->reservation != null ? $table->reservation->status : 'لا يوجد حجز' }}</span>
                                                    </div>
                                                    <div class="card-item body-time d-flex justify-content-between">
                                                        <p class="hall-name"> الرصيد الحالى</p>
                                                        <span class="sta">
                                                            {{ $table->reservation != null ? $table->reservation->price : 0 }}
                                                            ريال </span>
                                                    </div>
                                                    @php
                                                        if ($table->reservation) {
                                                            $formattedTime = Carbon\Carbon::createFromFormat('g:i A', $table->reservation->time)->format('H:i');
                                                            $reservationDateTime = $table->reservation->date;
                                                        }

                                                    @endphp
                                                    <div class="card-item body-time d-flex justify-content-between">
                                                        <p class="hall-name"> الوقت المنقضى</p>
                                                        <div class="countdown-timer"
                                                            data-start="{{ $table->reservation ? $table->reservation->date : '' }}"
                                                            data-package-time="{{ $table->reservation->package->time ?? 0 }}">
                                                            <!-- Add a span to display the countdown timer -->
                                                            @if ($table->reservation)
                                                                <span class="countdown-timer-text">00:00:00</span>
                                                            @else
                                                                <span>انتهى</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="table-btn my-3 text-center">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-2">
                                                                <button class="table-btn-action btn btn-primary w-100"
                                                                    type="button" data-id="#tableorders">
                                                                    الطلبات
                                                                </button>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <button class="table-btn-action btn btn-primary w-100"
                                                                    type="button" data-id="#tableinfo">
                                                                    استعراض
                                                                </button>
                                                            </div>
                                                            @if ($table->reservation)
                                                                <div class="col-md-6">
                                                                    <button class="table-btn-action btn btn-primary w-100"
                                                                        type="button" disabled data-id="#exampleModal_{{ $table->id }}">
                                                                        تفعيل الحجز
                                                                    </button>
                                                                </div>
                                                            @else
                                                                <div class="col-md-6">
                                                                    <button disabled
                                                                        class="table-btn-action btn btn-primary w-100"
                                                                        type="button" disabled data-id="#exampleModal_{{ $table->id }}">
                                                                        تفعيل الحجز
                                                                    </button>
                                                                     <!-- Modal -->
                                                                            <div class="modal fade"
                                                                                id="exampleModal_{{ $table->id }}"
                                                                                tabindex="-1"
                                                                                aria-labelledby="exampleModalLabel"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h1 class="modal-title fs-5"
                                                                                                id="exampleModalLabel">
                                                                                                تفعيل الحجز</h1>
                                                                                            <button type="button"
                                                                                                class="btn-close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div
                                                                                                class="modal-body text-light">
                                                                                                هل تود تفعيل الحجز
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <a type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-bs-dismiss="modal">اغلاق</a>
                                                                                            <button type="button"
                                                                                                onclick="activeTable({{ $table->id }})"
                                                                                                class="btn btn-primary">تأكيد
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                </div>
                                                            @endif
                                                              
                                                            @if ($table->reservation)
                                                                <div class="col-md-6">
                                                                    <button class="table-btn-action btn btn-primary w-100"
                                                                        type="button" data-id="#tableend">
                                                                        انهاء الحجز
                                                                    </button>
                                                                      <!-- Modal -->
                                                                            <div class="modal fade"
                                                                                id="close_{{ $table->id }}"
                                                                                tabindex="-1"
                                                                                aria-labelledby="exampleModalLabel"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h1 class="modal-title fs-5"
                                                                                                id="exampleModalLabel">
                                                                                                انهاء الحجز</h1>
                                                                                            <button type="button"
                                                                                                class="btn-close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div
                                                                                                class="modal-body text-light">
                                                                                                هل تود انهاء الحجز
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-bs-dismiss="modal">اغلاق</button>
                                                                                            <a type="button"
                                                                                                onclick="closeTable({{ $table->id }})"
                                                                                                class="btn btn-primary">انهاء
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                </div>
                                                            @else
                                                                <div class="col-md-6">
                                                                    <button disabled
                                                                        class="table-btn-action btn btn-primary w-100"
                                                                        type="button" data-id="#tableend">
                                                                        انهاء الحجز
                                                                    </button>
                                                                </div>
                                                            @endif
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>


                                            <!--<div class="modal-body">-->
                                            <!--    <ul class="list-group">-->
                                            <!--        <li class="list-group-item">-->
                                            <!--            <div class="d-flex">-->
                                            <!--                <div class="left t-packagename">VVIP</div>-->
                                            <!--                <div class="right t-statu">{{ $table->status }}</div>-->
                                            <!--            </div>-->
                                            <!--        </li>-->
                                            <!--        <li class="list-group-item">-->
                                            <!--            <div class="d-flex">-->
                                            <!--                <div class="left t-packagepeice">باقة ساعاتان</div>-->
                                            <!--                <div class="right t-capicity">4 أشخاص</div>-->
                                            <!--            </div>-->
                                            <!--        </li>-->
                                            <!--        <li class="list-group-item">-->
                                            <!--            <div class="d-flex">-->
                                            <!--                <div class="left t-packagedate"> 10-8</div>-->
                                            <!--                <div class="right t-time">08:00 </div>-->
                                            <!--            </div>-->
                                            <!--        </li>-->
                                            <!--        <li class="list-group-item">-->
                                            <!--            <div class="d-flex">-->
                                            <!--                <div class="left t-waiter"> أسم الويتر: </div>-->
                                            <!--                <div class="right t-time">أحمد مرزوق </div>-->
                                            <!--            </div>-->
                                            <!--        </li>-->
                                            <!--    </ul>-->
                                            <!--</div>-->
                                            <!--<div class="modal-footer">-->
                                            <!--    <div class="left t-allpoint"> <span class="point">800</span> الرصيد-->
                                            <!--    </div>-->
                                            <!--    <div class="right t-points"> <span class="have-point">200</span> الرصيد-->
                                            <!--        المتبقى </div>-->
                                            <!--</div>-->
                                        </div>
                                    </div>

                                </div>
                                
                                            @if ($table->status == 'in_service')
                                                <div class="table-side-bar" id="table{{ $table->id }}">
                                                    <h2 class="text-center mb-4">طاولة رقم
                                                        {{ $table->name }}</h2>
                                                    <div class="tab-nav-wraper">
                                                        <ul
                                                            class="nav c-nav-tabs d-flex justify-content-between home-tab">
                                                            <li class="nav-item">
                                                                <a class="nav-link " data-tab="reservations"
                                                                    href="#">
                                                                    الحجوزات</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-tab="orders" href="#">
                                                                    الطلبات</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link active" data-tab="the-menu"
                                                                    href="#">
                                                                    القائمة</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- عناصر التاب -->
                                                    <div class="tab-content">
                                                        <div id="the-menu" class="c-tab-pane active">
                                                            <ol class="list-group list-group-numbered reversed">


                                                                @if ($orders != null && $orders->products->count() != 0)
                                                                    @foreach ($orders->products as $product)
                                                                        <li
                                                                            class="list-group-item d-flex justify-content-between align-items-start">
                                                                            <div class="me-2 ms-auto">
                                                                                <div class="fw-bold">
                                                                                    {{ $product->name }}
                                                                                </div>
                                                                            </div>

                                                                            <span>{{ $product->pivot->price }}
                                                                                ريال</span>
                                                                        </li>
                                                                    @endforeach
                                                                @endif

                                                                <li
                                                                    class="new-menu-li list-group-item d-flex justify-content-center align-items-start">
                                                                    <a onclick="product({{ $table->id }})"
                                                                        class="me-2">
                                                                        <div class="fw-bold">اضف عنصر
                                                                            جديد
                                                                        </div>
                                                                    </a>
                                                                </li>

                                                            </ol>

                                                            <ol class="list-group reversed none  mt-5">
                                                                <li class="list-group-item no-number  ">
                                                                    <div
                                                                        class="sub-total d-flex justify-content-between align-items-start">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold"> حاصل
                                                                                الجمع</div>
                                                                        </div>
                                                                        <span>{{ $table->reservation->package->price ?? 0 }}
                                                                            ريال</span>
                                                                    </div>

                                                                    <div
                                                                        class="tax d-flex justify-content-between align-items-start mt-4">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold"> ضريبة
                                                                            </div>
                                                                        </div>
                                                                        <span>15%</span>
                                                                    </div>
                                                                    <div
                                                                        class="tax d-flex justify-content-between align-items-start mt-4 total">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold">
                                                                                الإجمالى
                                                                            </div>
                                                                        </div>

                                                                        @php
                                                                            $total = $table->reservation->package->price ?? 0 * 0.15;
                                                                        @endphp

                                                                        <span>{{ $total - $totalOrderPrices }}

                                                                            ريال</span>
                                                                    </div>
                                                                    <div class="payment-method">
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <div
                                                                                    class="payment-icon d-flex justify-content-center align-items-center">
                                                                                    <i
                                                                                        class="fa-solid fa-sack-dollar"></i>
                                                                                </div>
                                                                                <p class="text-center">
                                                                                    كاش
                                                                                </p>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div
                                                                                    class="payment-icon d-flex justify-content-center align-items-center">
                                                                                    <i
                                                                                        class="fa-solid fa-credit-card"></i>
                                                                                </div>
                                                                                <p class="text-center">
                                                                                    بطاقة ائتمان</p>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div
                                                                                    class="payment-icon d-flex justify-content-center align-items-center">
                                                                                    <i class="fa-solid fa-wallet"></i>
                                                                                </div>
                                                                                <p class="text-center">
                                                                                    المحفظة</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="payment-btn my-3 text-center">
                                                                            <div class="btn btn-primary btn-lg w-100"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#exampleModal6">
                                                                                ادفع الآن</div>
                                                                            <!-- Modal -->
                                                                            <div class="modal fade" id="exampleModal6"
                                                                                tabindex="-1"
                                                                                aria-labelledby="exampleModalLabel6"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title"
                                                                                                id="exampleModalLabel">
                                                                                                تأكيد
                                                                                                الدفع
                                                                                            </h5>
                                                                                            <button type="button"
                                                                                                class="btn-close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <p class="consfirm-text">
                                                                                                هل تريد
                                                                                                تأكيد
                                                                                                الدفع
                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button"
                                                                                                class="btn btn-primary">تأكيد</button>
                                                                                            <button type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-bs-dismiss="modal">لا
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>



                                                            </ol>

                                                        </div>
                                                        <div id="orders" class="c-tab-pane ">
                                                            @foreach ($table->reservations as $reservation)
                                                                <ol
                                                                    class="list-group list-group-numbered reversed bill-info">
                                                                    <li
                                                                        class="list-group-item d-flex justify-content-between align-items-start">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold"> طلب
                                                                                باسم
                                                                            </div>
                                                                        </div>
                                                                        <span>{{ $reservation->client->name }}</span>
                                                                    </li>
                                                                    <li
                                                                        class="list-group-item d-flex justify-content-between align-items-start">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold">اسم
                                                                                الباقة
                                                                            </div>
                                                                        </div>
                                                                        <span>
                                                                            {{ $reservation->package->name }}</span>
                                                                    </li>
                                                                    <li
                                                                        class="list-group-item d-flex justify-content-between align-items-start">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold">
                                                                                الرصيد
                                                                            </div>
                                                                        </div>
                                                                        <span>{{ $reservation->package->price }}
                                                                        </span>
                                                                    </li>
                                                                    <li
                                                                        class="list-group-item d-flex justify-content-between align-items-start">
                                                                        <div class="me-2 ms-auto">
                                                                            <div class="fw-bold">
                                                                                الحالة
                                                                            </div>
                                                                        </div>
                                                                        <span class="badge bg-info">تم
                                                                            الدفع </span>
                                                                    </li>
                                                                    <li
                                                                        class="new-menu-li list-group-item d-flex justify-content-center align-items-start">
                                                                        <div class="me-2">
                                                                            <div class="fw-bold"> طباعة
                                                                                الطلب</div>
                                                                        </div>
                                                                    </li>
                                                                </ol>
                                                            @endforeach

                                                        </div>
                                                        <div id="reservations" class="c-tab-pane ">
                                                            <div class="hour-col">
                                                                <div class="body-hour-cel">
                                                                    <div class="row gx-0 p-2 text-center">
                                                                        <div class="col-md-2">
                                                                            <p class="hour mb-0">05:00
                                                                                AM
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            <div class="row gx-0">
                                                                                <div class="col-md-9">
                                                                                    <div
                                                                                        class="d-flex h-100 justify-content-around align-items-center">
                                                                                        <div class="gusts">
                                                                                            <span
                                                                                                class="table-gusts px-2">
                                                                                                4</span>
                                                                                            <span> <i
                                                                                                    class="fa-solid fa-users"></i></span>
                                                                                        </div>
                                                                                        <div class="table-res">
                                                                                            طاولة 1
                                                                                        </div>
                                                                                        <span
                                                                                            class="badge bg-secondary">مؤكد</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <span>رصيد متبقى
                                                                                        600</span>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="body-hour-cel">
                                                                    <div class="row gx-0 p-2 text-center">
                                                                        <div class="col-md-2">
                                                                            05:15 AM
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            <div class="row gx-0">
                                                                                <div class="col-md-9">
                                                                                    <div
                                                                                        class="d-flex justify-content-center align-items-center">
                                                                                        <span>لا يوجد
                                                                                            حجز</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <span>لا يوجد
                                                                                        رصيد</span>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="body-hour-cel">
                                                                    <div class="row gx-0 p-2 text-center">
                                                                        <div class="col-md-2">
                                                                            05:30 AM
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            <div class="row gx-0">
                                                                                <div class="col-md-9">
                                                                                    <div
                                                                                        class="d-flex justify-content-center align-items-center">
                                                                                        <span>لا يوجد
                                                                                            حجز</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <span>لا يوجد
                                                                                        رصيد</span>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="body-hour-cel">
                                                                    <div class="row gx-0 p-2 text-center">
                                                                        <div class="col-md-2">
                                                                            05:45 AM
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            <div class="row gx-0">
                                                                                <div class="col-md-9">
                                                                                    <div
                                                                                        class="d-flex justify-content-center align-items-center">
                                                                                        <span>لا يوجد
                                                                                            حجز</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <span>لا يوجد
                                                                                        رصيد</span>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                @can('add_reservation')
                                                    <div class="table-side-bar" id="table{{ $table->id }}">
                                                        <ol class="table-list list-group list-group-numbered reversed">
                                                            <li
                                                                class="menu-info-list list-group-item d-flex  flex-column justify-content-center align-items-center text-center p-0">
                                                                <a class="new-reserv-btn btn btn-link w-100"
                                                                    href="{{ route('branch.reservation') }}">
                                                                    <i class="fa-solid fa-plus"></i>
                                                                    <p>انشاء حجز جديد </p>
                                                                </a>
                                                            </li>

                                                        </ol>

                                                    </div>
                                                @endcan
                                            @endif
                                        </div>
                                    </div>
                                @endforeach




                            </div>
                        </div>
                    </div>

                </div>
                <!-- VVIP tables  -->
                <div class="col-md-2 salon5">
                    <div class="top vvip-salon d-flex flex-column">
                        @foreach ($loungesSortOne->tables as $table)
                            @php
                                if ($table->reservation) {
                                    $orders = App\Models\Order::where('package_id', $table->reservation->package_id)
                                        ->where('table_id', $table->id)
                                        ->where('is_done', 0)
                                        ->with('products')
                                        ->first();

                                    // Wrap the related products in a collection (even if there's only one result)
                                    if ($orders != null && $orders->products->count() != 0) {
                                        // Calculate total order prices using the map function on the products collection
                                        $totalOrderPrices = $orders->products->sum(function ($product) {
                                            return $product->pivot->price * $product->pivot->quantity;
                                        });
                                    } else {
                                        $totalOrderPrices = 0;
                                    }
                                } else {
                                    $orders = null;
                                    $totalOrderPrices = 0;
                                }
                            @endphp
                            <div class="sofa @if ($table->status == 'in_service') sofa-serv
                                                            @elseif($table->status == 'available')
                                                            sofa-available
                                                             @elseif ($table->status == 'reserved')
                                                              sofa-reserved @endif"
                                data-id="table{{ $table->id }}" data-stat="serv" data-bs-toggle="modal"
                                data-bs-target="#modal{{ $table->id }}" data-h="hall{{ $loungesSortOne->id }}"
                                @if ($table->status == 'in_service') data-pstat="serv"
                                                            @elseif($table->status == 'available')
                                                             data-pstat ="available"
                                                             @elseif ($table->status == 'reserved')
                                                              data-pstat ="reserved" @endif>
                                <div class="table-vvip d-flex align-items-center">
                                    <h2>{{ $table->name }}</h2>
                                    <svg width="93" height="181" viewBox="0 0 93 181" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M29.594 139.438H13.7014C11.5006 139.438 9.71313 141.785 9.71313 144.67V173.461C9.71313 176.349 11.5006 178.692 13.7014 178.692H29.594C31.7948 178.692 33.5822 176.348 33.5822 173.461V144.67C33.5822 141.785 31.7952 139.438 29.594 139.438Z"
                                            fill="#212325" />
                                        <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M9.31226 173.46V144.666C9.31226 141.49 11.28 138.909 13.7024 138.909H29.595C32.0185 138.909 33.9866 141.49 33.9866 144.666V173.46C33.9866 176.639 32.0185 179.216 29.595 179.216H13.7024C11.28 179.217 9.31226 176.639 9.31226 173.46ZM33.181 173.46V144.666C33.181 142.072 31.5743 139.966 29.595 139.966H13.7024C11.7235 139.966 10.1164 142.072 10.1164 144.666V173.46C10.1164 176.054 11.7231 178.161 13.7024 178.161H29.595C31.5743 178.161 33.181 176.054 33.181 173.46Z"
                                            fill="#3E3F41" />
                                        <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M32.5523 69.523V48.691C32.5523 45.8064 30.7653 43.4629 28.564 43.4629H6.60179C4.40094 43.4629 2.61353 45.8064 2.61353 48.691V69.523C2.61353 72.4116 4.40094 74.7516 6.60179 74.7516H28.564C30.7649 74.7516 32.5523 72.4116 32.5523 69.523Z"
                                            fill="#212325" />
                                        <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.2124 69.5232V48.6882C2.2124 45.5126 4.17899 42.9316 6.60292 42.9316H28.5659C30.9876 42.9316 32.9545 45.5121 32.9545 48.6882V69.5232C32.9545 72.7023 30.9876 75.2797 28.5659 75.2797H6.60254C4.1786 75.2797 2.2124 72.7023 2.2124 69.5232ZM32.15 69.5232V48.6882C32.15 46.0941 30.5433 43.988 28.5659 43.988H6.60254C4.62362 43.988 3.01807 46.0941 3.01807 48.6882V69.5232C3.01807 72.1209 4.62362 74.2264 6.60254 74.2264H28.5655C30.5433 74.2269 32.15 72.1209 32.15 69.5232Z"
                                            fill="#3E3F41" />
                                        <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M32.5522 38.2989V17.4704C32.5522 14.5853 30.7636 12.2393 28.5628 12.2393H6.60246C4.40161 12.2393 2.61304 14.5858 2.61304 17.4704V38.2989C2.61304 41.1875 4.40161 43.5305 6.60246 43.5305H28.5624C30.7636 43.5305 32.5522 41.1875 32.5522 38.2989Z"
                                            fill="#212325" />
                                        <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.2124 38.2985V17.47C2.2124 14.2909 4.1813 11.7104 6.60292 11.7104H28.5628C30.9876 11.7104 32.9545 14.2909 32.9545 17.47V38.2985C32.9545 41.4776 30.9876 44.058 28.5628 44.058H6.60254C4.1813 44.058 2.2124 41.4776 2.2124 38.2985ZM32.15 38.2985V17.47C32.15 14.8759 30.5418 12.7637 28.5625 12.7637H6.60254C4.62478 12.7637 3.01807 14.8764 3.01807 17.47V38.2985C3.01807 40.8961 4.62478 43.0022 6.60254 43.0022H28.5625C30.5418 43.0022 32.15 40.8961 32.15 38.2985Z"
                                            fill="#3E3F41" />
                                        <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M32.5522 100.127V79.295C32.5522 76.4104 30.7636 74.0669 28.5628 74.0669H6.60246C4.40161 74.0669 2.61304 76.4104 2.61304 79.295V100.127C2.61304 103.016 4.40161 105.359 6.60246 105.359H28.5624C30.7636 105.359 32.5522 103.015 32.5522 100.127Z"
                                            fill="#212325" />
                                        <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.21436 100.128V79.2957C2.21436 76.1201 4.18132 73.5366 6.60411 73.5366H28.566C30.9876 73.5366 32.9557 76.1201 32.9557 79.2957V100.128C32.9557 103.307 30.9876 105.887 28.566 105.887H6.60411C4.18132 105.887 2.21436 103.306 2.21436 100.128ZM32.1512 100.128V79.2957C32.1512 76.7051 30.5433 74.5955 28.566 74.5955H6.60411C4.62519 74.5955 3.0181 76.7051 3.0181 79.2957V100.128C3.0181 102.722 4.62481 104.831 6.60411 104.831H28.566C30.5433 104.831 32.1512 102.721 32.1512 100.128Z"
                                            fill="#3E3F41" />
                                        <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M32.5522 132.426V111.594C32.5522 108.71 30.7636 106.366 28.5628 106.366H6.60246C4.40161 106.366 2.61304 108.71 2.61304 111.594V132.426C2.61304 135.315 4.40161 137.658 6.60246 137.658H28.5624C30.7636 137.658 32.5522 135.314 32.5522 132.426Z"
                                            fill="#212325" />
                                        <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.21436 132.427V111.594C2.21436 108.419 4.18132 105.835 6.60411 105.835H28.566C30.9876 105.835 32.9557 108.419 32.9557 111.594V132.427C32.9557 135.606 30.9876 138.186 28.566 138.186H6.60411C4.18132 138.186 2.21436 135.605 2.21436 132.427ZM32.1512 132.427V111.594C32.1512 109.004 30.5433 106.894 28.566 106.894H6.60411C4.62519 106.894 3.0181 109.004 3.0181 111.594V132.427C3.0181 135.021 4.62481 137.13 6.60411 137.13H28.566C30.5433 137.13 32.1512 135.02 32.1512 132.427Z"
                                            fill="#3E3F41" />
                                        <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M74.9342 139.438H59.0463C56.8458 139.438 55.0576 141.781 55.0576 144.666V173.461C55.0576 176.345 56.8462 178.689 59.0463 178.689H74.9342C77.1366 178.689 78.9229 176.345 78.9229 173.461V144.666C78.9229 141.781 77.1366 139.438 74.9342 139.438Z"
                                            fill="#212325" />
                                        <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M54.655 173.457V144.666C54.655 141.491 56.622 138.91 59.0471 138.91H74.9366C77.3594 138.91 79.3263 141.49 79.3263 144.666V173.457C79.3263 176.636 77.3594 179.217 74.9366 179.217H59.0471C56.622 179.217 54.655 176.636 54.655 173.457ZM78.5226 173.457V144.666C78.5226 142.072 76.9139 139.962 74.9366 139.962H59.0471C57.0674 139.962 55.4592 142.072 55.4592 144.666V173.457C55.4592 176.051 57.067 178.161 59.0471 178.161H74.9366C76.9139 178.161 78.5226 176.051 78.5226 173.457Z"
                                            fill="#3E3F41" />
                                        <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M51.3905 139.438H35.5026C33.3021 139.438 31.5139 141.781 31.5139 144.666V173.461C31.5139 176.345 33.3025 178.689 35.5026 178.689H51.3905C53.5929 178.689 55.3792 176.345 55.3792 173.461V144.666C55.3792 141.781 53.5929 139.438 51.3905 139.438Z"
                                            fill="#212325" />
                                        <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M31.1113 173.457V144.666C31.1113 141.491 33.0783 138.91 35.5034 138.91H51.3929C53.8157 138.91 55.7826 141.49 55.7826 144.666V173.457C55.7826 176.636 53.8157 179.217 51.3929 179.217H35.5034C33.0783 179.217 31.1113 176.636 31.1113 173.457ZM54.9789 173.457V144.666C54.9789 142.072 53.3702 139.962 51.3929 139.962H35.5034C33.5237 139.962 31.9155 142.072 31.9155 144.666V173.457C31.9155 176.051 33.5233 178.161 35.5034 178.161H51.3929C53.3702 178.161 54.9789 176.051 54.9789 173.457Z"
                                            fill="#3E3F41" />
                                        <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M90.6627 168.701V144.73C90.6627 141.838 88.8703 139.492 86.664 139.492H82.6511C80.4449 139.492 78.6528 141.839 78.6528 144.73V168.701C78.6528 171.593 80.4453 173.943 82.6511 173.943H86.664C88.8703 173.943 90.6627 171.593 90.6627 168.701Z"
                                            fill="#212325" />
                                        <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M78.2539 168.697V144.729C78.2539 141.547 80.2247 138.957 82.6525 138.957H86.6654C89.0944 138.957 91.066 141.547 91.066 144.729V168.697C91.066 171.883 89.0944 174.467 86.6654 174.467H82.6525C80.2243 174.467 78.2539 171.883 78.2539 168.697ZM90.2615 168.697V144.729C90.2615 142.129 88.6482 140.016 86.6654 140.016H82.6525C80.6701 140.016 79.0576 142.129 79.0576 144.729V168.697C79.0576 171.298 80.6701 173.41 82.6525 173.41H86.6654C88.6482 173.41 90.2615 171.298 90.2615 168.697Z"
                                            fill="#3E3F41" />
                                        <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M74.9342 43.1475H59.0463C56.8458 43.1475 55.0576 40.8039 55.0576 37.9188V9.12419C55.0576 6.23962 56.8462 3.8961 59.0463 3.8961H74.9342C77.1366 3.8961 78.9229 6.23962 78.9229 9.12419V37.9188C78.9229 40.8039 77.1366 43.1475 74.9342 43.1475Z"
                                            fill="#212325" />
                                        <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M54.655 9.12715V37.9183C54.655 41.0938 56.622 43.6748 59.0471 43.6748H74.9366C77.3594 43.6748 79.3263 41.0943 79.3263 37.9183V9.12715C79.3263 5.94806 77.3594 3.36761 74.9366 3.36761H59.0471C56.622 3.3671 54.655 5.94806 54.655 9.12715ZM78.5226 9.12715V37.9183C78.5226 40.5124 76.9139 42.622 74.9366 42.622H59.0471C57.0674 42.622 55.4592 40.5124 55.4592 37.9183V9.12715C55.4592 6.53306 57.067 4.42345 59.0471 4.42345H74.9366C76.9139 4.42345 78.5226 6.53306 78.5226 9.12715Z"
                                            fill="#3E3F41" />
                                        <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M52.2313 43.1475H36.3434C34.1429 43.1475 32.3547 40.8039 32.3547 37.9188V9.12419C32.3547 6.23962 34.1433 3.8961 36.3434 3.8961H52.2313C54.4337 3.8961 56.22 6.23962 56.22 9.12419V37.9188C56.22 40.8039 54.4337 43.1475 52.2313 43.1475Z"
                                            fill="#212325" />
                                        <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M31.9521 9.12715V37.9183C31.9521 41.0938 33.9191 43.6748 36.3442 43.6748H52.2337C54.6565 43.6748 56.6234 41.0943 56.6234 37.9183V9.12715C56.6234 5.94806 54.6565 3.36761 52.2337 3.36761H36.3442C33.9191 3.3671 31.9521 5.94806 31.9521 9.12715ZM55.8197 9.12715V37.9183C55.8197 40.5124 54.2111 42.622 52.2337 42.622H36.3442C34.3645 42.622 32.7563 40.5124 32.7563 37.9183V9.12715C32.7563 6.53306 34.3641 4.42345 36.3442 4.42345H52.2337C54.2111 4.42345 55.8197 6.53306 55.8197 9.12715Z"
                                            fill="#3E3F41" />
                                        <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M90.6627 13.8834V37.8546C90.6627 40.7462 88.8703 43.0923 86.664 43.0923H82.6511C80.4449 43.0923 78.6528 40.7457 78.6528 37.8546V13.8834C78.6528 10.9917 80.4453 8.64163 82.6511 8.64163H86.664C88.8703 8.64163 90.6627 10.9917 90.6627 13.8834Z"
                                            fill="#212325" />
                                        <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M78.2539 13.8876V37.8553C78.2539 41.0374 80.2247 43.6279 82.6525 43.6279H86.6654C89.0944 43.6279 91.066 41.0374 91.066 37.8553V13.8876C91.066 10.7014 89.0944 8.11793 86.6654 8.11793H82.6525C80.2243 8.11793 78.2539 10.7014 78.2539 13.8876ZM90.2615 13.8876V37.8553C90.2615 40.4554 88.6482 42.5681 86.6654 42.5681H82.6525C80.6701 42.5681 79.0576 40.4554 79.0576 37.8553V13.8876C79.0576 11.2869 80.6701 9.17426 82.6525 9.17426H86.6654C88.6482 9.17426 90.2615 11.2864 90.2615 13.8876Z"
                                            fill="#3E3F41" />
                                        <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0.32251 172.429L0.326363 39.6464C0.326363 35.6485 2.80386 32.3926 5.85699 32.3926H6.20454C9.2596 32.3926 11.7371 35.6485 11.7371 39.6464V164.72H86.1191C89.1733 164.72 91.6524 167.966 91.6524 171.971V172.429C91.6524 176.43 89.1733 179.682 86.1191 179.682H5.85622C2.8027 179.683 0.32251 176.43 0.32251 172.429Z"
                                            fill="#212325" />
                                        <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0 172.428L0.00385311 39.6464C0.00385311 35.4109 2.62429 31.9712 5.85698 31.9712H6.20452C9.43798 31.9712 12.0623 35.4115 12.0623 39.6464V164.295H86.217C89.4485 164.295 92.0728 167.735 92.0728 171.97V172.428C92.0728 176.663 89.4485 180.103 86.217 180.103H5.85621C2.62275 180.104 0 176.664 0 172.428ZM91.4278 172.428V171.971C91.4278 168.203 89.0909 165.141 86.217 165.141H11.4146V39.6469C11.4146 35.8828 9.07888 32.8209 6.20452 32.8209H5.85698C2.98301 32.8209 0.648849 35.8828 0.648849 39.6504L0.646152 172.429C0.646152 176.196 2.98031 179.259 5.85621 179.259H86.2166C89.0909 179.258 91.4278 176.196 91.4278 172.428Z"
                                            fill="#3E3F41" />
                                        <path class="fill" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0.32251 9.30922L0.326363 170.389C0.326363 175.239 2.80386 179.188 5.85699 179.188H6.20454C9.2596 179.188 11.7371 175.239 11.7371 170.389V18.6605H85.6986C88.7529 18.6605 91.232 14.723 91.232 9.86445V9.30922C91.232 4.45493 88.7529 0.50947 85.6986 0.50947H5.85622C2.8027 0.508857 0.32251 4.45493 0.32251 9.30922Z"
                                            fill="#212325" />
                                        <path class="line" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0 9.30936L0.00385311 170.389C0.00385311 175.527 2.62429 179.7 5.85698 179.7H6.20452C9.43798 179.7 12.0623 175.526 12.0623 170.389V19.176H85.6007C88.8322 19.176 91.4565 15.0026 91.4565 9.86519V9.30996C91.4565 4.17193 88.8322 -0.000283732 85.6007 -0.000283732H5.85621C2.62275 -0.00150941 0 4.17133 0 9.30936ZM90.8115 9.30936V9.86459C90.8115 14.4351 88.4747 18.1495 85.6007 18.1495H11.4146V170.388C11.4146 174.955 9.07888 178.669 6.20452 178.669H5.85698C2.98301 178.669 0.648849 174.955 0.648849 170.384L0.646152 9.30872C0.646152 4.73879 2.98031 1.02378 5.85621 1.02378H85.6003C88.4747 1.02439 90.8115 4.73881 90.8115 9.30936Z"
                                            fill="#3E3F41" />
                                        <path class="text-fill"
                                            d="M49.8598 111.546L62.6048 107.051L62.6048 106.873L49.8598 102.379L49.8598 100.457L65 106.016L65 107.908L49.8598 113.468L49.8598 111.546ZM49.8598 97.4773L62.6048 92.9826L62.6048 92.8052L49.8598 88.3104L49.8598 86.3883L65 91.9476L65 93.8401L49.8598 99.3994L49.8598 97.4773ZM49.8598 82.1967L65 82.1967L65 84.0301L49.8598 84.0301L49.8598 82.1967ZM65 78.5207L49.8598 78.5207L49.8598 73.4049C49.8598 72.2172 50.0742 71.2463 50.5029 70.4922C50.9268 69.7332 51.501 69.1714 52.2254 68.8067C52.9499 68.442 53.7582 68.2596 54.6502 68.2596C55.5423 68.2596 56.353 68.442 57.0824 68.8067C57.8118 69.1664 58.3934 69.7234 58.8271 70.4774C59.2559 71.2315 59.4703 72.1974 59.4703 73.3753L59.4703 77.0421L57.8439 77.0421L57.8439 73.4345C57.8439 72.6213 57.7034 71.9683 57.4225 71.4754C57.1416 70.9826 56.7621 70.6253 56.284 70.4035C55.801 70.1768 55.2564 70.0634 54.6502 70.0634C54.044 70.0634 53.5019 70.1768 53.0238 70.4035C52.5458 70.6253 52.1712 70.985 51.9002 71.4828C51.6242 71.9806 51.4862 72.641 51.4862 73.4641L51.4862 76.6873L65 76.6873L65 78.5207Z"
                                            fill="white" />
                                    </svg>
                                </div>

                                <div class="modal table-modal fade" id="modal{{ $table->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="card  @if ($table->status == 'in_service') bg-info
                                                 @elseif($table->status == 'available')
                                                bg-success text-light
                                                @elseif ($table->status == 'reserved')
                                                   bg-danger  text-light @endif"
                                                data-id="table1" data-stat="serv">
                                                <div class="modal-header">
                                                    <div
                                                        class="card-header primary-bg-color w-100 d-flex justify-content-between">
                                                        <h3 class="modal-title fs-5" id="exampleModalLabel">
                                                            {{ $table->name }}</h3>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="card-item mid d-flex justify-content-between">
                                                        <p class="hall-name"> الباقة</p>
                                                        <span class="sta">
                                                            {{ $table->reservation != null ? $table->reservation->package->name : 'لا توجد باقة' }}
                                                        </span>
                                                    </div>
                                                    <div class="card-item body-package d-flex justify-content-between">
                                                        <p class="hall-name"> المقاعد</p>
                                                        <span class="sta">
                                                            {{ $table->reservation != null ? $table->reservation->package->count_of_visitors : 0 }}
                                                            اشخاص</span>
                                                    </div>
                                                    <div class="card-item body-time d-flex justify-content-between">
                                                        <p class="hall-name"> الحجز</p>
                                                        <span
                                                            class="sta">{{ $table->reservation != null ? $table->reservation->price : 0 }}
                                                            ريال</span>
                                                    </div>
                                                    <div class="card-item body-time d-flex justify-content-between">
                                                        <p class="hall-name"> المدة</p>
                                                        <span
                                                            class="sta">{{ $table->reservation != null ? $table->reservation->minutes : 0 }}
                                                            ساعة </span>
                                                    </div>
                                                    <div class="card-item body-time d-flex justify-content-between">
                                                        <p class="hall-name"> الحالة</p>
                                                        <span class="sta">
                                                            {{ $table->reservation != null ? $table->reservation->status : 'لا يوجد حجز' }}</span>
                                                    </div>
                                                    <div class="card-item body-time d-flex justify-content-between">
                                                        <p class="hall-name"> الرصيد الحالى</p>
                                                        <span class="sta">
                                                            {{ $table->reservation != null ? $table->reservation->price : 0 }}
                                                            ريال </span>
                                                    </div>
                                                    @php
                                                        if ($table->reservation) {
                                                            $formattedTime = Carbon\Carbon::createFromFormat('g:i A', $table->reservation->time)->format('H:i');
                                                            $reservationDateTime = $table->reservation->date;
                                                        }

                                                    @endphp
                                                    <div class="card-item body-time d-flex justify-content-between">
                                                        <p class="hall-name"> الوقت المنقضى</p>
                                                        <div class="countdown-timer"
                                                            data-start="{{ $table->reservation ? $table->reservation->date : '' }}"
                                                            data-package-time="{{ $table->reservation->package->time ?? 0 }}">
                                                            <!-- Add a span to display the countdown timer -->
                                                            @if ($table->reservation)
                                                                <span class="countdown-timer-text">00:00:00</span>
                                                            @else
                                                                <span>انتهى</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="table-btn my-3 text-center">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-2">
                                                                <button class="table-btn-orders btn btn-primary w-100"
                                                                    type="button" data-id="#tableorders{{ $table->id }}">
                                                                    الطلبات
                                                                </button>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <button class="table-btn-info btn btn-primary w-100"
                                                                    type="button" data-id="#tableinfo{{ $table->id }}">
                                                                    استعراض
                                                                </button>
                                                            </div>
                                                             <!--بيانات كل طاولة  فى السايد بار -->
                                                             <div class="table-side-bar side-bar-info"
                                                            id="tableinfo{{ $table->id }}">
                                                            <div class="tablebrowse">
                                                                <div class="tab-nav-wraper">
                                                                    <div
                                                                        class="nav-btns d-flex justify-content-around align-items-center">
                                                                        <div class="home-btn btn btn-dark" data-tab="rev">
                                                                            الحجوزات</div>
                                                                        <div class="home-btn btn btn-dark" data-tab="waitings">
                                                                            الأنتظار</div>
                                                                    </div>
                                                                    <form action="">
                                                                        <input
                                                                            class="form-control bg-dark text-light text-center"
                                                                            type="text" placeholder="ابحث عن ضيف"
                                                                            aria-label="default input example">
                                                                    </form>
                                                                </div>
                                                                <!-- عناصر التاب -->
                                                                <div class="side-tab-content">
                                                                    <div id="rev"
                                                                        class="home-table-bar-info reversation-side-bar rev active-tab">
                                                                        <div
                                                                            class="first-tabb d-flex justify-content-between align-items-start">
                                                                            <p>حجوزات الطاولة</p>
                                                                            <span> 3 <i
                                                                                    class="fa-solid fa-stopwatch-20 ml-1"></i></span>
                                                                        </div>
                                                                        <ol
                                                                            class="list-group list-group-numbered reversed bill-info">
                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between align-items-start w-100">
                                                                                <a href="{{ route('branch.reservation') }}"
                                                                                    class="btn btn-primary w-100 mb-3">اضافة
                                                                                    حجز </a>
                                                                            </li>
                                                                            @if ($table->reservation)
                                                                                <li
                                                                                    class="list-group-item d-flex justify-content-between align-items-start">
                                                                                    <div
                                                                                        class="rev-item d-flex w-100  align-items-start">
                                                                                        @php
                                                                                            $dateString = $table->reservation->date;

                                                                                            // Create a DateTime object from the date string
                                                                                            $date = new DateTime($dateString);

                                                                                            // Format the time as desired (e.g., "H:i")
                                                                                            $formattedTime = $date->format('h:i A');
                                                                                        @endphp
                                                                                        <div
                                                                                            class="rev-time text-center">
                                                                                            <span>{{ $formattedTime }}</span>
                                                                                            <br>
                                                                                            {{-- <span>PM</span> --}}
                                                                                        </div>
                                                                                        <div class="rev-info">
                                                                                            <h4>{{ $table->reservation->client->name }}
                                                                                            </h4>
                                                                                            <p>{{ $table->reservation->client->phone }}
                                                                                            </p>
                                                                                            <p><span>{{ $table->reservation->package->count_of_visitors }}
                                                                                                    اشخاص</span><span>/باقة
                                                                                                    {{ $table->reservation->package->name }}</span>
                                                                                            </p>
                                                                                        </div>
                                                                                        <div
                                                                                            class="rev-statu text-center">
                                                                                            <p>{{ $table->reservation->package->name }}
                                                                                            </p>
                                                                                            <span>{{ $table->status }}</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            @endif
                                                                            @php
                                                                                $now = Carbon\Carbon::now();

                                                                                // Query to get all reservations for today
                                                                                $reservations = App\Models\Reservation::where('table_id', $table->id)
                                                                                    ->where(function ($query) use ($now) {
                                                                                        $query->whereDate('date', $now->toDateString())->whereTime('date', '>=', $now->toTimeString());
                                                                                    })
                                                                                    ->orderBy('date')
                                                                                    ->get();

                                                                                $packages = $table->packages;
                                                                                foreach ($packages as $key => $package) {
                                                                                    # code...

                                                                                    $package = App\Models\Package::find($package->id);
                                                                                    $minutesPerPackage = $package->time;

                                                                                    // Generate time slots based on the package minutes
                                                                                    $startTime = Carbon\Carbon::createFromTime(0, 0, 0);
                                                                                    $endTime = Carbon\Carbon::createFromTime(23, 59, 59);
                                                                                    $timeSlots = [];

                                                                                    $currentTime = clone $startTime;
                                                                                    while ($currentTime->lte($endTime)) {
                                                                                        $endTimeSlot = clone $currentTime;
                                                                                        $endTimeSlot->addMinutes($minutesPerPackage);

                                                                                        // Check if the time slot is in the past
                                                                                        if ($endTimeSlot->isFuture()) {
                                                                                            $timeSlots[] = [
                                                                                                'start' => $currentTime->format('g:i A'),
                                                                                                'end' => $endTimeSlot->format('g:i A'),
                                                                                            ];
                                                                                        }

                                                                                        $currentTime->addMinutes($minutesPerPackage);
                                                                                    }
                                                                                    // Calculate the available and unavailable time slots
                                                                                    $availableSlots = [];
                                                                                    $unavailableSlots = [];

                                                                                    $prevEndTime = $startTime;
                                                                                    foreach ($reservations as $reservation) {
                                                                                        $start = Carbon\Carbon::parse($reservation->date);
                                                                                        $end = Carbon\Carbon::parse($reservation->end);

                                                                                        if ($prevEndTime->lt($start)) {
                                                                                            $availableSlots[] = [
                                                                                                'start' => $prevEndTime->format('g:i A'),
                                                                                                'end' => $start->format('g:i A'),
                                                                                            ];
                                                                                        }
                                                                                        $unavailableSlots[] = [
                                                                                            'start' => $start->format('g:i A'),
                                                                                            'end' => $end->format('g:i A'),
                                                                                        ];

                                                                                        $prevEndTime = $end;
                                                                                    }
                                                                                    if ($prevEndTime->lt($endTime)) {
                                                                                        $availableSlots[] = [
                                                                                            'start' => $prevEndTime->format('g:i A'),
                                                                                            'end' => $endTime->format('g:i A'),
                                                                                        ];
                                                                                    }
                                                                                }
                                                                            @endphp
                                                                            @foreach ($timeSlots as $slot)
                                                                                @php
                                                                                    $slotClosed = false;
                                                                                    foreach ($unavailableSlots as $unavailableSlot) {
                                                                                        if ($slot['start'] === $unavailableSlot['start'] && $slot['end'] === $unavailableSlot['end']) {
                                                                                            $slotClosed = true;
                                                                                            break;
                                                                                        }
                                                                                    }
                                                                                @endphp
                                                                                <li
                                                                                    class="list-group-item d-flex justify-content-between align-items-start">
                                                                                    <div
                                                                                        class="rev-item d-flex w-100 align-items-start">

                                                                                        @if ($slotClosed)
                                                                                        @else
                                                                                            <div
                                                                                                class="rev-time text-center">
                                                                                                <span>{{ $slot['start'] }}</span>
                                                                                                <br>
                                                                                                <span>{{ $slot['end'] }}</span>
                                                                                            </div>
                                                                                        @endif
                                                                                        <div class="rev-info">
                                                                                            <a href="{{ route('branch.reservation') }}"
                                                                                                class="btn btn-primary">احجز
                                                                                                الآن</a>
                                                                                        </div>
                                                                                        <div
                                                                                            class="rev-statu text-center">
                                                                                            <p>VVIP-1</p>
                                                                                            <span>شاغرة</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            @endforeach

                                                                        </ol>
                                                                    </div>
                                                                    <div id="waithings"
                                                                        class="home-table-bar-info waitings-side-bar waitings hidden-tab">
                                                                        <ol
                                                                            class="list-group list-group-numbered reversed bill-info">
                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                                <div
                                                                                    class="rev-item d-flex w-100  align-items-start">
                                                                                    <div class="rev-time text-center">
                                                                                        <span>1</span>
                                                                                    </div>
                                                                                    <div class="rev-info">
                                                                                        <h4>محمد عبدالعزيز</h4>
                                                                                        <p>012586439</p>
                                                                                        <p><span>4
                                                                                                اشخاص</span><span>/باقة
                                                                                                vip</span></p>
                                                                                    </div>
                                                                                    <div class="rev-statu text-center">
                                                                                        <a
                                                                                            class="btn btn-primary">تفعيل</a>
                                                                                        <br />
                                                                                        <span class="s-time">
                                                                                            1:20:00</span>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                                <div
                                                                                    class="rev-item d-flex w-100  align-items-start">
                                                                                    <div class="rev-time text-center">
                                                                                        <span>2</span>
                                                                                    </div>
                                                                                    <div class="rev-info">
                                                                                        <h4>محمد عبدالعزيز</h4>
                                                                                        <p>012586439</p>
                                                                                        <p><span>4
                                                                                                اشخاص</span><span>/باقة
                                                                                                vip</span></p>
                                                                                    </div>
                                                                                    <div class="rev-statu text-center">
                                                                                        <a href=""
                                                                                            class="btn btn-primary">تفعيل</a>
                                                                                        <br />
                                                                                        <span class="s-time">
                                                                                            1:20:00</span>
                                                                                    </div>
                                                                                </div>
                                                                            </li>

                                                                        </ol>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>
                                                        @php
                                                            if ($table->reservation) {
                                                                $orders = App\Models\Order::where('package_id', $table->reservation->package_id)
                                                                    ->where('table_id', $table->id)
                                                                    ->where('is_done', 0)
                                                                    ->with('products')
                                                                    ->first();

                                                                // Wrap the related products in a collection (even if there's only one result)
                                                                if ($orders != null && $orders->products->count() != 0) {
                                                                    // Calculate total order prices using the map function on the products collection
                                                                    $totalOrderPrices = $orders->products->sum(function ($product) {
                                                                        return $product->pivot->price * $product->pivot->quantity;
                                                                    });
                                                                } else {
                                                                    $totalOrderPrices = 0;
                                                                }
                                                            } else {
                                                                $orders = null;
                                                                $totalOrderPrices = 0;
                                                            }
                                                        @endphp
                                                        <div class="table-side-bar side-bar-orders"
                                                            id="tableorders{{ $table->id }}">
                                                            <div class="tablebrowse">
                                                                <div class="tab-nav-wraper">
                                                                    <div
                                                                        class="nav-btns d-flex justify-content-around align-items-center">
                                                                        <div class="btn btn-dark"
                                                                            data-tab="newOrders">
                                                                            الطلبات</div>
                                                                        <a onclick="product({{ $table->id }})"
                                                                            class="btn btn-primary  mb-1"> طلب جديد</a>
                                                                    </div>
                                                                </div>
                                                                <!-- عناصر التاب -->
                                                                <div class="side-tab-content">
                                                                    <div id="rev"
                                                                        class="table-bar-info reversation-side-bar rev active-tab">
                                                                        <ol
                                                                            class="list-group list-group-numbered reversed bill-info">
                                                                            @if ($orders != null && $orders->products->count() != 0)
                                                                                @foreach ($orders->products as $product)
                                                                                    <li
                                                                                        class="list-group-item d-flex justify-content-between align-items-start">
                                                                                        <div class="me-2 ms-auto">
                                                                                            <div class="fw-bold">
                                                                                                {{ $product->name }}
                                                                                            </div>
                                                                                        </div>

                                                                                        <span>{{ $product->pivot->price }}
                                                                                            ريال</span>
                                                                                    </li>
                                                                                @endforeach
                                                                            @endif
                                                                        </ol>
                                                                    </div>
                                                                    <div id="waithings"
                                                                        class="table-bar-info waitings-side-bar waitings hidden-tab">
                                                                        <ol
                                                                            class="list-group list-group-numbered reversed bill-info">

                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                                <div
                                                                                    class="rev-item d-flex w-100  align-items-start">
                                                                                    <div class="rev-time text-center">
                                                                                        <span>1</span>
                                                                                    </div>
                                                                                    <div class="rev-info">
                                                                                        <h4>محمد عبدالعزيز</h4>
                                                                                        <p>012586439</p>
                                                                                        <p><span>4
                                                                                                اشخاص</span><span>/باقة
                                                                                                vip</span></p>
                                                                                    </div>
                                                                                    <div class="rev-statu text-center">
                                                                                        <a href=""
                                                                                            class="btn btn-primary">تفعيل</a>
                                                                                        <br />
                                                                                        <span class="s-time">
                                                                                            1:20:00</span>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                                <div
                                                                                    class="rev-item d-flex w-100  align-items-start">
                                                                                    <div class="rev-time text-center">
                                                                                        <span>2</span>
                                                                                    </div>
                                                                                    <div class="rev-info">
                                                                                        <h4>محمد عبدالعزيز</h4>
                                                                                        <p>012586439</p>
                                                                                        <p><span>4
                                                                                                اشخاص</span><span>/باقة
                                                                                                vip</span></p>
                                                                                    </div>
                                                                                    <div class="rev-statu text-center">
                                                                                        <a href=""
                                                                                            class="btn btn-primary">تفعيل</a>
                                                                                        <br />
                                                                                        <span class="s-time">
                                                                                            1:20:00</span>
                                                                                    </div>
                                                                                </div>
                                                                            </li>

                                                                        </ol>
                                                                    </div>
                                                                    <div id="newOrders"
                                                                        class="table-bar-info newOrders-side-bar newOrders active-tab">
                                                                        <div id="tab1"
                                                                            class="tab-pane fade show active">
                                                                            <ol
                                                                                class="table-list list-group list-group-numbered reversed food-items pr-0">
                                                                                @if ($orders != null && $orders->products->count() != 0)
                                                                                    @foreach ($orders->products as $product)
                                                                                        <li class="list-group-item drag d-flex justify-content-between align-items-start"
                                                                                            draggable="true">
                                                                                            <div class="me-2 ms-auto">
                                                                                                <div class="fw-bold">
                                                                                                    <span
                                                                                                        class="title">
                                                                                                        {{ $product->name }}</span><span
                                                                                                        class="count-wrap mr-2"><i
                                                                                                            class="fa-solid fa-x"></i><span
                                                                                                            class="count">3</span></span>
                                                                                                </div>
                                                                                            </div><span
                                                                                                class="list-price">{{ $product->pivot->price }}
                                                                                                ريال</span><button
                                                                                                class="order-remove btn btn-danger"
                                                                                                type="button"><i
                                                                                                    class="fa-solid fa-trash-can"></i></button>
                                                                                        </li>
                                                                                    @endforeach
                                                                                @endif
                                                                            </ol>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>
                                                        
                                                             <!--بيانات كل طاولة  فى السايد بار -->

                                                            
                                                            
                                                            @if ($table->reservation)
                                                                <div class="col-md-6">
                                                                    <button class="table-btn-action btn btn-primary w-100"
                                                                        type="button" disabled data-id="#exampleModal_{{ $table->id }}">
                                                                        تفعيل الحجز
                                                                    </button>
                                                                </div>
                                                            @else
                                                                <div class="col-md-6">
                                                                    <button disabled
                                                                        class="table-btn-action btn btn-primary w-100"
                                                                        type="button" disabled data-id="#exampleModal_{{ $table->id }}">
                                                                        تفعيل الحجز
                                                                    </button>
                                                                     <!-- Modal -->
                                                                            <div class="modal fade"
                                                                                id="exampleModal_{{ $table->id }}"
                                                                                tabindex="-1"
                                                                                aria-labelledby="exampleModalLabel"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h1 class="modal-title fs-5"
                                                                                                id="exampleModalLabel">
                                                                                                تفعيل الحجز</h1>
                                                                                            <button type="button"
                                                                                                class="btn-close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div
                                                                                                class="modal-body text-light">
                                                                                                هل تود تفعيل الحجز
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <a type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-bs-dismiss="modal">اغلاق</a>
                                                                                            <button type="button"
                                                                                                onclick="activeTable({{ $table->id }})"
                                                                                                class="btn btn-primary">تأكيد
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                </div>
                                                            @endif
                                                              
                                                            @if ($table->reservation)
                                                                <div class="col-md-6">
                                                                    <button class="table-btn-action btn btn-primary w-100"
                                                                        type="button" data-id="#tableend">
                                                                        انهاء الحجز
                                                                    </button>
                                                                      <!-- Modal -->
                                                                            <div class="modal fade"
                                                                                id="close_{{ $table->id }}"
                                                                                tabindex="-1"
                                                                                aria-labelledby="exampleModalLabel"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h1 class="modal-title fs-5"
                                                                                                id="exampleModalLabel">
                                                                                                انهاء الحجز</h1>
                                                                                            <button type="button"
                                                                                                class="btn-close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div
                                                                                                class="modal-body text-light">
                                                                                                هل تود انهاء الحجز
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-bs-dismiss="modal">اغلاق</button>
                                                                                            <a type="button"
                                                                                                onclick="closeTable({{ $table->id }})"
                                                                                                class="btn btn-primary">انهاء
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                </div>
                                                            @else
                                                                <div class="col-md-6">
                                                                    <button disabled
                                                                        class="table-btn-action btn btn-primary w-100"
                                                                        type="button" data-id="#tableend">
                                                                        انهاء الحجز
                                                                    </button>
                                                                </div>
                                                            @endif
                                                            
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>



                                @if ($table->status == 'in_service')
                                    <div class="table-side-bar" id="tableee{{ $table->id }}">
                                        <h2 class="text-center mb-4">طاولة رقم
                                            {{ $table->name }}</h2>
                                        <div class="tab-nav-wraper">
                                            <ul class="nav c-nav-tabs d-flex justify-content-between home-tab">
                                                <li class="nav-item">
                                                    <a class="nav-link " data-tab="reservations" href="#">
                                                        الحجوزات</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-tab="orders" href="#"> الطلبات</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-tab="the-menu" href="#">
                                                        القائمة</a>
                                                </li>
                                            </ul>
                                        </div>
                                        عناصر التاب
                                        <div class="tab-content">
                                            <div id="the-menu" class="c-tab-pane active">
                                                <ol class="list-group list-group-numbered reversed">


                                                    @if ($orders != null && $orders->products->count() != 0)
                                                        @foreach ($orders->products as $product)
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                <div class="me-2 ms-auto">
                                                                    <div class="fw-bold">
                                                                        {{ $product->name }}
                                                                    </div>
                                                                </div>

                                                                <span>{{ $product->pivot->price }}
                                                                    ريال</span>
                                                            </li>
                                                        @endforeach
                                                    @endif

                                                    <li
                                                        class="new-menu-li list-group-item d-flex justify-content-center align-items-start">
                                                        <a onclick="product({{ $table->id }})" class="me-2">
                                                            <div class="fw-bold">اضف عنصر
                                                                جديد
                                                            </div>
                                                        </a>
                                                    </li>

                                                </ol>

                                                <ol class="list-group reversed none  mt-5">
                                                    <li class="list-group-item no-number  ">
                                                        <div
                                                            class="sub-total d-flex justify-content-between align-items-start">
                                                            <div class="me-2 ms-auto">
                                                                <div class="fw-bold"> حاصل
                                                                    الجمع</div>
                                                            </div>
                                                            <span>{{ $table->reservation->package->price ?? 0 }}
                                                                ريال</span>
                                                        </div>

                                                        <div
                                                            class="tax d-flex justify-content-between align-items-start mt-4">
                                                            <div class="me-2 ms-auto">
                                                                <div class="fw-bold"> ضريبة
                                                                </div>
                                                            </div>
                                                            <span>15%</span>
                                                        </div>
                                                        <div
                                                            class="tax d-flex justify-content-between align-items-start mt-4 total">
                                                            <div class="me-2 ms-auto">
                                                                <div class="fw-bold">
                                                                    الإجمالى
                                                                </div>
                                                            </div>

                                                            @php
                                                                $total = $table->reservation->package->price ?? 0 * 0.15;
                                                            @endphp

                                                            <span>{{ $total - $totalOrderPrices }}

                                                                ريال</span>
                                                        </div>
                                                        <div class="payment-method">
                                                            <div class="row">
                                                                <div class="col-4">
                                                                    <div
                                                                        class="payment-icon d-flex justify-content-center align-items-center">
                                                                        <i class="fa-solid fa-sack-dollar"></i>
                                                                    </div>
                                                                    <p class="text-center">
                                                                        كاش
                                                                    </p>
                                                                </div>
                                                                <div class="col-4">
                                                                    <div
                                                                        class="payment-icon d-flex justify-content-center align-items-center">
                                                                        <i class="fa-solid fa-credit-card"></i>
                                                                    </div>
                                                                    <p class="text-center">
                                                                        بطاقة ائتمان</p>
                                                                </div>
                                                                <div class="col-4">
                                                                    <div
                                                                        class="payment-icon d-flex justify-content-center align-items-center">
                                                                        <i class="fa-solid fa-wallet"></i>
                                                                    </div>
                                                                    <p class="text-center">
                                                                        المحفظة</p>
                                                                </div>
                                                            </div>
                                                            <div class="payment-btn my-3 text-center">
                                                                <div class="btn btn-primary btn-lg w-100"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModal6">
                                                                    ادفع الآن</div>
                                                                Modal
                                                                <div class="modal fade" id="exampleModal6"
                                                                    tabindex="-1" aria-labelledby="exampleModalLabel6"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="exampleModalLabel">
                                                                                    تأكيد
                                                                                    الدفع
                                                                                </h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p class="consfirm-text">
                                                                                    هل تريد
                                                                                    تأكيد
                                                                                    الدفع
                                                                                </p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-primary">تأكيد</button>
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">لا
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>



                                                </ol>

                                            </div>
                                            <div id="orders" class="c-tab-pane ">
                                                @foreach ($table->reservations as $reservation)
                                                    <ol class="list-group list-group-numbered reversed bill-info">
                                                        <li
                                                            class="list-group-item d-flex justify-content-between align-items-start">
                                                            <div class="me-2 ms-auto">
                                                                <div class="fw-bold"> طلب
                                                                    باسم
                                                                </div>
                                                            </div>
                                                            <span>{{ $reservation->client->name }}</span>
                                                        </li>
                                                        <li
                                                            class="list-group-item d-flex justify-content-between align-items-start">
                                                            <div class="me-2 ms-auto">
                                                                <div class="fw-bold">اسم
                                                                    الباقة
                                                                </div>
                                                            </div>
                                                            <span>
                                                                {{ $reservation->package->name }}</span>
                                                        </li>
                                                        <li
                                                            class="list-group-item d-flex justify-content-between align-items-start">
                                                            <div class="me-2 ms-auto">
                                                                <div class="fw-bold">
                                                                    الرصيد
                                                                </div>
                                                            </div>
                                                            <span>{{ $reservation->package->price }}
                                                            </span>
                                                        </li>
                                                        <li
                                                            class="list-group-item d-flex justify-content-between align-items-start">
                                                            <div class="me-2 ms-auto">
                                                                <div class="fw-bold">
                                                                    الحالة
                                                                </div>
                                                            </div>
                                                            <span class="badge bg-info">تم
                                                                الدفع </span>
                                                        </li>
                                                        <li
                                                            class="new-menu-li list-group-item d-flex justify-content-center align-items-start">
                                                            <div class="me-2">
                                                                <div class="fw-bold"> طباعة
                                                                    الطلب</div>
                                                            </div>
                                                        </li>
                                                    </ol>
                                                @endforeach

                                            </div>
                                            <div id="reservations" class="c-tab-pane ">
                                                <div class="hour-col">
                                                    <div class="body-hour-cel">
                                                        <div class="row gx-0 p-2 text-center">
                                                            <div class="col-md-2">
                                                                <p class="hour mb-0">05:00
                                                                    AM
                                                                </p>
                                                            </div>
                                                            <div class="col-md-10">
                                                                <div class="row gx-0">
                                                                    <div class="col-md-9">
                                                                        <div
                                                                            class="d-flex h-100 justify-content-around align-items-center">
                                                                            <div class="gusts">
                                                                                <span class="table-gusts px-2">
                                                                                    4</span>
                                                                                <span> <i
                                                                                        class="fa-solid fa-users"></i></span>
                                                                            </div>
                                                                            <div class="table-res">
                                                                                طاولة 1
                                                                            </div>
                                                                            <span class="badge bg-secondary">مؤكد</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <span>رصيد متبقى
                                                                            600</span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="body-hour-cel">
                                                        <div class="row gx-0 p-2 text-center">
                                                            <div class="col-md-2">
                                                                05:15 AM
                                                            </div>
                                                            <div class="col-md-10">
                                                                <div class="row gx-0">
                                                                    <div class="col-md-9">
                                                                        <div
                                                                            class="d-flex justify-content-center align-items-center">
                                                                            <span>لا يوجد
                                                                                حجز</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <span>لا يوجد
                                                                            رصيد</span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="body-hour-cel">
                                                        <div class="row gx-0 p-2 text-center">
                                                            <div class="col-md-2">
                                                                05:30 AM
                                                            </div>
                                                            <div class="col-md-10">
                                                                <div class="row gx-0">
                                                                    <div class="col-md-9">
                                                                        <div
                                                                            class="d-flex justify-content-center align-items-center">
                                                                            <span>لا يوجد
                                                                                حجز</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <span>لا يوجد
                                                                            رصيد</span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="body-hour-cel">
                                                        <div class="row gx-0 p-2 text-center">
                                                            <div class="col-md-2">
                                                                05:45 AM
                                                            </div>
                                                            <div class="col-md-10">
                                                                <div class="row gx-0">
                                                                    <div class="col-md-9">
                                                                        <div
                                                                            class="d-flex justify-content-center align-items-center">
                                                                            <span>لا يوجد
                                                                                حجز</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <span>لا يوجد
                                                                            رصيد</span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    @can('add_reservation')
                                        <div class="table-side-bar" id="table{{ $table->id }}">
                                            <ol class="table-list list-group list-group-numbered reversed">
                                                <li
                                                    class="menu-info-list list-group-item d-flex  flex-column justify-content-center align-items-center text-center p-0">
                                                    <a class="new-reserv-btn btn btn-link w-100"
                                                        href="{{ route('branch.reservation') }}">
                                                        <i class="fa-solid fa-plus"></i>
                                                        <p>انشاء حجز جديد </p>
                                                    </a>
                                                </li>

                                            </ol>

                                        </div>
                                    @endcan
                                @endif

                            </div>
                 @endforeach
                    </div>
                </div>
                 <div class="col-md-3">
                     <div class="home-side-place">
                         <h2 class="div-placeholder">الرجاء اختيار طاولة</h2>
                     </div>
                 </div>

            </div>

        </div>
    </div>
@endsection
<script src="{{ asset('front/js/jquery.js') }}"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
<script>
    $(document).ready(function() {

        // فلتر الحالات للصفحة الرئيسية
        $('.s-filter').on('click', function() {
            var key = $(this).data('st');
            if (key === 'all') {
                $('.sofa').removeClass('not-selected');
            } else {
                $('.sofa').addClass('not-selected'); // إخفاء جميع العناصر
                // إظهار العناصر التي تحمل قيمة مطابقة لـ data-pstat
                $('.sofa[data-pstat="' + key + '"]').removeClass('not-selected');
            }
        });
        // فلتر الصالات 
        $('.h-filter').on('click', function() {
            var key = $(this).data('salon');
            var getSalonId = $(key);
            console.log(key);
            if (key === 'allsalon') {
                $('.sofa').removeClass('not-selected');
            } else {
                $('.sofa').addClass('not-selected'); // إخفاء جميع العناصر
                // إظهار العناصر التي تحمل قيمة مطابقة لـ data-pstat
                $(getSalonId).find('.sofa').removeClass('not-selected');
            }
        });
         //  حدث عرض الطلبات فى السايد بار عند الضغط على زر الطلبات
         $('.table-btn-orders').on('click', function() {
             console.log('first');
            var newId = $(this).data('id');
            $('.home-side-place').empty();
            $('.home-side-place').append($(newId).clone().css('display', 'block')).addClass('have-bg');
            
        });

        // حدث  الاستعراض لبيانات الطاولة عند الضغط على زر استعراض
        $('.table-btn-info').on('click', function() {
            console.log('second');
            var newId = $(this).data('id');
            $('.home-side-place').empty();
            $('.home-side-place').append($(newId).clone().css('display', 'block')).addClass('have-bg');
            console.log('second');
        });
        
        $('.nav-btns .home-btn').on('click', function(){
            var tabpanid = $(this).data('tab');
            $('.home-table-bar-info').addClass('hidden-tab').removeClass('active-tab')
            $('.' + tabpanid).addClass('active-tab').removeClass('hidden-tab');
            console.log($(tabpanid));
        });
    });
</script>
<script>
    function product(id) {

        // Add active class to "القائمة" link
        $.get('product-order/ajax/' + id, {}).done(function(data) {
            $('#mainPage').html(data); // Show the new content

        }).done(function() {
            $('#casher-section').show(); // Hide the casher section

            $('#reserv-main-section').hide(); // Show the reserv main section

        });


    }
</script>
<script>
    // Function to update the countdown timer display
    // function updateCountdown() {
    //     // Get all the countdown-timer elements
    //     const countdownTimers = document.querySelectorAll('.countdown-timer');

    //     countdownTimers.forEach(countdownTimer => {
    //         const countdownTimerText = countdownTimer.querySelector('.countdown-timer-text');

    //         // Get the data-start and data-package-time values from the data attributes
    //         const startTimeString = countdownTimer.getAttribute('data-start');
    //         const packageTime = parseInt(countdownTimer.getAttribute('data-package-time'));

    //         // Convert the startTimeString to a Date object
    //         const startTime = new Date(startTimeString);

    //         // Calculate the target end time by adding the packageTime in minutes to the start time
    //         const endTime = new Date(startTime.getTime() + packageTime * 60000);

    //         const currentTime = new Date().getTime();
    //         const timeRemaining = endTime - currentTime;

    //         if (timeRemaining <= 0) {
    //             // Timer has ended
    //             countdownTimerText.textContent = 'انتهى';
    //         } else {
    //             // Calculate hours, minutes, and seconds
    //             const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    //             const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
    //             const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

    //             // Format the time and update the countdown display
    //             const formattedTime =
    //                 `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    //             countdownTimerText.textContent = formattedTime;
    //         }
    //     });
    // }

    // // Update the countdown every second
    // setInterval(updateCountdown, 1000);

    // // Initialize the countdown on page load
    // updateCountdown();
</script>
<script>
    Function to update the countdown timer display

    function updateCountdown() {
        // Get all the countdown-timer elements
        const countdownTimers = document.querySelectorAll('.countdown-timer');

        countdownTimers.forEach(countdownTimer => {
            const countdownTimerText = countdownTimer.querySelector('.countdown-timer-text');

            // Get the data-start and data-package-time values from the data attributes
            const startTimeString = countdownTimer.getAttribute('data-start');
            const packageTime = parseInt(countdownTimer.getAttribute('data-package-time'));

            // Convert the startTimeString to a Date object
            const startTime = new Date(startTimeString);

            // Calculate the target end time by adding the packageTime in minutes to the start time
            const endTime = new Date(startTime.getTime() + packageTime * 60000);

            const currentTime = new Date().getTime();
            const timeRemaining = endTime - currentTime;

            if (timeRemaining <= 0) {
                // Timer has ended
                countdownTimerText.textContent = 'انتهى';
            } else {
                // Calculate hours, minutes, and seconds
                const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

                // Format the time and update the countdown display
                const formattedTime =
                    `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                countdownTimerText.textContent = formattedTime;
            }
        });
    }

    // Update the countdown every second
    setInterval(updateCountdown, 1000);

    // Initialize the countdown on page load
    updateCountdown();
</script>


<script>
    //     var tableclick = document.getElementById("tableclick").value;
    //     console.log(tableclick);
    //     var x = document.getElementById("casher-section");
    //     if (tableclick === "available") {
    //         x.style.display = "block";
    //     }
    //
</script>
