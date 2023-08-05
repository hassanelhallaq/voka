<div class="card-header card-header-danger">
    <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
    <div class="nav-tabs-navigation">
        <div class="nav-tabs-wrapper">
            <ul class="nav nav-tabs" data-tabs="tabs">
                @foreach ($halles as $key => $item)
                    <li class="nav-item">
                        <a class="nav-link {{ $key === 0 ? ' active' : '' }}" href="#hall{{ $item->id }}"
                            data-toggle="tab">{{ $item->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<div class="card-body ">
    <div class="tab-content text-center">
        @foreach ($halles as $key => $item)
            <div class="tab-pane {{ $key === 0 ? ' active show' : '' }}" id="hall{{ $item->id }}">
                <div class="row new-reservation-tables">
                    <h2 class="text-center text-light">{{ $item->name }}</h2>
                    <div class="col-12">
                        <div class="row">
                            @foreach ($item->tables as $table)
                                <div class="col-md-3 card-col table-pick  d-flex justify-content-center align-items-center change-content" data-id="#allguests">
                                    <div class="card catch-id  bg-success active-card"
                                         data-choosen="{{ $table->id }}">
                                        <input hidden value="{{ $table->id }}">
                                        <div class="card-header primary-bg-color">
                                            <div class="top d-flex justify-content-between ">
                                                <h5 class="card-title"> طاولة رقم
                                                    {{ $table->name }}</h5>
                                                <span class="no-revers">
                                                    @if ($table->status == 'in_service')
                                                        فى الخدمة
                                                    @elseif($table->status == 'available')
                                                        متاحة
                                                    @elseif ($table->status == 'reserved')
                                                        محجوزة
                                                    @endif
                                                </span>
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
                                                <p class="hall-name"> باقة 3 ساعات</p>
                                                <span class="sta"> 2 اشخاص</span>
                                            </div>
                                            <div class="body-time d-flex justify-content-between">
                                                <p class="hall-name"> لا يوجد تاريخ</p>
                                                <span class="sta"> لا يوجد توقيت </span>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <p class="hall-name">لا يوجد رصيد</p>
                                            <span class="sta"> لا يوجد رصيد متبقى </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
  <div class="row" style="justify-content: space-between;">
                        <div class="col-md-2">
                            <div class="change-content btn btn-primary" data-id="#all-packages">السابق</div>
                        </div>
                        <!--<div class="col-md-2">-->
                        <!--        <div class="change-content btn btn-primary" data-id="#allguests">التالى</div>-->
                        <!--</div> -->
                     </div>
<script src="{{ asset('front/js/main.js') }}"></script>
<script>

    document.querySelectorAll('.table-pick').forEach(function(element) {
        element.addEventListener('click', function() {
            // إزالة الفئة active-card من جميع عناصر .card داخل .new-reservation-tables
            var cardElements = document.querySelectorAll('.new-reservation-tables .card');
            cardElements.forEach(function(card) {
                card.classList.remove('active-card');
            });

            // إضافة الفئة active-card إلى العنصر الذي تم النقر عليه
            this.classList.add('active-card');

            // الحصول على نص عنوان البطاقة
            var cardTitle = this.querySelector('.card-title').textContent;

            // تحديث نص العنصر .table-name بالعنوان الجديد
            var tableNames = document.querySelectorAll('.table-name');
            tableNames.forEach(function(tableName) {
                tableName.textContent = cardTitle;
            });

            // الحصول على القيمة المخزنة في الخاصية data-choosen وتعيينها في الخاصية data-choos للعنصر .table-name
            var itemId = this.getAttribute('data-choosen');
            tableNames.forEach(function(tableName) {
                tableName.setAttribute('data-choos', itemId);
            });
        });
    });
</script>
