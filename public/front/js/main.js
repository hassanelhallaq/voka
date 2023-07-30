
$(document).ready(function () {
        
      $('.event-test').on('click', function(){
         var contentId = $(this).data('id');
          var sideTab = $('.show-content[data-id="' + contentId + '"]');
          sideTab.attr('data-v', 1);
          $('.show-content').removeClass('active-list');
          sideTab.addClass('active-list');
          $('.reservation-tabs').hide();
          $(contentId).show();
      });
      
       $('.save-all').on('click', function() {
        //   var jsonData = {
        //     package: $('.package-name').text(),
        //     table: $('.table-name').text(),
        //     guest: $('.guest-name').text(),
        //     date: $('.reserv-date').text(),
        //     time: $('.reserv-time').text(),
        //     status: $('.nav-statues').text()
        //   };
            // console.log(jsonData); // يطبع الكائن JSON في وحدة التحكم (console)


            var data = {
            date: $('.reserv-date').text(),
            time: $('.reserv-time').text(),
            status: $('.nav-statues').text()
             }; // كائن JSON لتخزين القيم

          // جمع قيم العناصر ووضعها في الكائن JSON
          data.guest = $('#guest-input #client_id').val();
          data.package = $('#package-input #package_id').val();
          data.table = $('#table-input #table_id').val();

          // طباعة الكائن JSON في وحدة التحكم
          console.log(data);


          var contentId = $(this).data('id');
          var sideTab = $('.show-content[data-id="' + contentId + '"]');
          $('.reservation-tabs').hide();
          $(contentId).show();
        });

 
    $('.reversed').addClass('casher-box');
    $('.table-list').removeClass('casher-box');
    
    $('.new-menu-li').on('click', function(){
        console.log('clickeeeeeeed');
        $('#mainPage').removeClass('col-md-8').addClass('col-md-11');
        $('.cash').hide();
    });
    
    $('.home').on('click', function(){
        $('.cash').show();
        $('#mainPage').removeClass('col-md-11').addClass('col-md-8');
    });

    
    
// كود صفحة الحجوزات
var currentDate = new Date();
var daysOfWeek = ['السبت', 'الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة'];

// عرض تاريخ الأسبوع الحالي
function displayCurrentWeek() {
  $('.days').each(function(i) {
    var currentDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate() + i);
    var options = { weekday: 'long', month: 'long', day: 'numeric' };
    var formattedDate = currentDay.toLocaleDateString('ar-EG', options);

    $(this).text(formattedDate);
  });
}

// زر الأسبوع السابق
$('.prev-btn').on('click', function() {
  currentDate.setDate(currentDate.getDate() - 7);
  displayCurrentWeek();
});

// زر الأسبوع التالى
$('.next-btn').on('click', function() {
  currentDate.setDate(currentDate.getDate() + 7);
  displayCurrentWeek();
});

// عرض الأسبوع الحالي عند تحميل الصفحة
displayCurrentWeek();

// كود وضع وازالة كلاس الاكتف على يوم الاسبوع ونقل التاريخ الى محتوى التاريخ  فى اعلى الصفحة
$('.days').on('click', function(){
  $('.days').removeClass
  $(this).addClass('active-day');
  console.log($(this).text());
  $('.the-day').text($(this).text());
});


var currentDate = new Date();
var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
var formattedDate = currentDate.toLocaleDateString('ar-EG', options);

$('.reservations-container .the-day').text(formattedDate);
console.log(formattedDate);

// كود عند الضغط على الحجز داخل الجدول
$('.statue').on('click', function(){
  $('.statue').css('opacity', '0.5');
  $(this).css('opacity', '1');
   var dataTable = $(this).data('table');
   var dataname = $(this).data('name');
   var dataguests = $(this).data('guests');
   var dataphone = $(this).data('phone');
   var datapackage = $(this).data('package');
   var datastute = $(this).data('stute');
   var datapoints = $(this).data('guests');
$('.reservations-table-nmber').text(dataTable);
$('.guest-name').text(dataname);
$('.guest-number').text(dataguests);
$('.reservations-phone').text(dataphone);
$('.reservations-package').text(datapackage);
$('.reservations-statue').text(datastute);
$('.reservations-points').text(datapoints);


});

// نهاية صفحة الحجوزات

  $('.search .search-btn').on('click', function(e) {
    e.preventDefault();
    var searchInput = $('.search-input').val();

    if (!searchInput || searchInput === '0') {
      $('.card-col').attr('style', 'display: flex !important'); // عرض جميع العناصر
    } else {
      $('.card-col').attr('style', 'display: none !important'); // إخفاء جميع العناصر
      // إظهار العناصر التي تحمل قيمة مطابقة لـ data-pstat
      $('.card-col[data-tableNumber="' + searchInput + '"]').attr('style', 'display: flex !important');
    }
  });

$(".halls-tab .tab-pane").first().addClass("active");


  $('.home-card .card').on('click', function(){
    $('.home-card .card').removeClass('active-card');
    $(this).addClass('active-card');

    $('.table-side-bar').hide();
    var newId = '#'+$(this).data('id');

    if($(this).data('stat') == 'available') {
      $('#tab-place').show();
      $(newId).hide();
    } else {
      $('#tab-place').hide();
      $(newId).show();
      $('.side-place').append($(newId));
    }

    var newTitle = $(this).find('.card-title').text();
    var oldTitle = $(newId).find('h2').text(newTitle);
    $('.home-tab > li > a').removeClass('active');
    $('.home-tab > li:nth-child(3) > a').addClass('active');


  });

  function countdownTimer(element) {
    // الحصول على قيمة بداية العداد من السبان
    var startValue = parseInt($(element).data('start'));

    // تحويل القيمة إلى ثواني
    var totalSeconds = startValue * 60;

    // تحديث قيمة العداد كل ثانية
    var timerInterval = setInterval(function() {
      // تحويل الثواني إلى دقائق وثواني
      var minutes = Math.floor(totalSeconds / 60);
      var seconds = totalSeconds % 60;

      // تحديث نص العداد في السبان
      $(element).find('.start').text('انتهى').text(minutes + ':' + (seconds < 10 ? '0' : '') + seconds);

      // إيقاف العداد عند الانتهاء من الوقت
      if (totalSeconds === 0) {
        clearInterval(timerInterval);
        $(element).find('.start').text('انتهى');
      }

      // تحديث الثواني
      totalSeconds--;
    }, 1000);
  }

  // استدعاء الوظيفة لكل عنصر سبان بواسطة الفئة .sta
  $('.card-col').each(function() {
    countdownTimer(this);
  });

  // فلتر الحالات للصفحة الرئيسية
  $('.s-filter').on('click', function(){
    var key = $(this).data('st');
    if (key === 'all') {
          $('.card-col').attr('style', 'display: flex !important'); // إظهار جميع العناصر
        } else {
          $('.card-col').attr('style', 'display: none !important');      // إخفاء جميع العناصر
          // إظهار العناصر التي تحمل قيمة مطابقة لـ data-pstat
          $('.card-col[data-pstat="' + key + '"]').attr('style', 'display: flex !important');
        }
  });
  // فلتر الصالات للصفحة الرئيسية
  $('.h-filter').on('click', function(){
    var key = $(this).data('ha');
        if (key === 'all') {
          $('.card-col').attr('style', 'display: flex !important'); // إظهار جميع العناصر
        } else {
          $('.card-col').attr('style', 'display: none !important');      // إخفاء جميع العناصر
          // إظهار العناصر التي تحمل قيمة مطابقة لـ data-pstat
          $('.card-col[data-h="' + key + '"]').attr('style', 'display: flex !important');
        }
  });
  // فلتر للعداد التنازلى للطاولات
  setInterval(function() {
    $('.card-col').each(function() {
      var updatedTime = $(this).data('updatedtime');
      if (updatedTime !== undefined) {
        updatedTime = parseInt(updatedTime);
        updatedTime -= 5;
        $(this).data('updatedtime', updatedTime);
      }
    });
  }, 5 * 60 * 1000);

  $('.apply-time').on('click', function(e) {
    e.preventDefault();
    var inputVal = parseInt($('.time-input').val());

    if (!isNaN(inputVal) && inputVal > 0) {
      $('.card-col').each(function() {
        var updatedTime = $(this).data('updatedtime');
        if (updatedTime !== undefined && inputVal > updatedTime) {
          $(this).attr('style', 'display: flex !important');
          console.log($(this));
        } else {
          $(this).attr('style', 'display: none !important');
        }
      });
    } else {
      $('.card-col').attr('style', 'display: flex !important');
    }
  });

  $('.home-tab .nav-link').on('click', function(e) {
    e.preventDefault();
    $('.home-tab .nav-link').removeClass('active');
    $(this).addClass('active');

    var activeTab = '#' + $(this).data('tab');

    // إظهار العنصر المحدد وإخفاء الباقي
    $('.tab-content .c-tab-pane').hide().removeClass('active');
    $('.tab-content ' + activeTab).addClass('active');

  });



    // الكود الخاص باظهار واخفاء قائمة الطعام حسب كل تصنيف
    $('.all-items').hide(); // إخفاء جميع العناصر all-items في البداية

    var activeDataClass = $('.cat-tap.active-card').data('class');
    $('.' + activeDataClass).show(); // إظهار العنصر النشط الذي يحمل الـ data-class

    $('.cat-tap').on('click', function() {
      var dataClass = $(this).data('class');
      console.log('hhhhhhhhhhhhhhh');

       // إضافة كلاس 'active' للعنصر الحالي وإزالته من باقي العناصر
       $('.cat-tap').removeClass('active-card');
       $(this).addClass('active-card');
       $('.all-items').hide();
       $('.' + dataClass).show();


    });


    // كود خاص بزيدة ونقصان اعداد عناصر القائمة
    var mins = $('.fa-minus');
    var pluss = $('.fa-plus');
    var number = $('.number');

  pluss.on('click', function() {
  var currentValue = parseInt($(this).siblings('.number').text().replace(/,/g, '')); // Remove commas from the text
  $(this).siblings('.number').text((currentValue + 1).toLocaleString()); // Increment and format the number with thousand separators
});

mins.on('click', function() {
  var currentValue = parseInt($(this).siblings('.number').text().replace(/,/g, '')); // Remove commas from the text
  if (currentValue > 0 && currentValue >= 0) {
    $(this).siblings('.number').text((currentValue - 1).toLocaleString()); // Decrement and format the number with thousand separators
  }
});

    // كود قائمة كل طاولة فى صفحة القائمة
    $('.addBtn').on('click', function() {
      var parentElement = $(this).parent(); // الوصول إلى العنصر الأب لزر الإضافة
      var cardTitle = parentElement.find('.card-title').text(); // استخراج المحتوى السابق لعنصر العنوان
      var price = parentElement.find('.price').text(); // استخراج المحتوى السابق لعنصر السعر
      var number = parentElement.find('.number').text(); // استخراج المحتوى السابق لعنصر العدد

      if (number > 0) {
        $(".table-list").find(".menu-info-list").remove();
        // إنشاء العناصر الجديدة وتعيين القيم
        var listItem = $('<li>').addClass('list-group-item drag d-flex justify-content-between align-items-start');
        var divWrapper = $('<div>').addClass('me-2 ms-auto');
        var titleSpan = $('<span>').addClass('title').text(cardTitle);
        var countWrapSpan = $('<span>').addClass('count-wrap mr-2');
        var countIcon = $('<i>').addClass('fa-solid fa-x');
        var countSpan = $('<span>').addClass('count').text(number);
        var priceSpan = $('<span>').addClass('list-price').text(parseInt(price) + ' ريال');

        var deleteButton = $('<button>').addClass('order-remove btn btn-danger').attr('type', 'button');
        var deleteIcon = $('<i>').addClass('fa-solid fa-trash-can');
        deleteButton.append(deleteIcon);

        // إضافة إجراء الحذف عند النقر على زر الحذف
        deleteButton.on('click', function() {
          listItem.animate({
            transform: 'scale(1.4)',
            opacity: 0
          }, 500, function() {
            listItem.remove();
            updateSubTotal();
            calculateTotal();
          });
        });

        // تجميع العناصر وإضافة الزر إلى العنصر الرئيسي
        countWrapSpan.append(countIcon, countSpan);
        divWrapper.append($('<div>').addClass('fw-bold').append(titleSpan, countWrapSpan));
        listItem.append(divWrapper, priceSpan, deleteButton);
      }

      listItem.attr('draggable', 'true');

      $('.table-list').prepend(listItem); // إضافة العنصر إلى القائمة
      updateSubTotal();
      calculateTotal();
    });

    $(document).on('click', '.drag', function() {
      var $this = $(this);
    var $orderRemove = $this.find('.order-remove');
    if ($this.hasClass('dragged')) {
      // إعادة العنصر إلى موقعه الأصلي
      // $this.animate({
      //   left: '0px'
      // }, 500, 'swing');
      // $orderRemove.animate({
      //   right: '0px'
      // }, 500, 'swing');
    } else {
      // نقل العنصر نحو اليسار
      $this.animate({
        left: '-53px'
      }, 500, 'swing');
      $orderRemove.animate({
        right: '-53px'
      }, 500, 'swing');
    }
    $this.toggleClass('dragged');
    });

    // دالة لجمع المجموع قبل الضرائب
    function updateSubTotal() {
      var total = 0;

      $('.table-list .list-group-item').each(function() {
        var listItem = $(this);
        var count = parseInt(listItem.find('.count').text());
        var price = parseInt(listItem.find('.list-price').text());
        total += count * price;
      });
      $('.sub-total-number').text(total);
    }
    updateSubTotal();

    // دالة الضربية
    function calculateTotal() {
      var subTotal = parseInt($('.sub-total-number').text());
      var taxPercentage = parseFloat($('.taxes').html()) / 100;
      var taxAmount = subTotal * taxPercentage;
      var total = subTotal + taxAmount;

      $('.table-total').text(total);
    }

    calculateTotal();

    $('.payment-icon').on('click', function(){
      $('.payment-icon').removeClass('active');
      $(this).addClass('active');
    });

    // صفحة الحجوزات

    $('#datepicker').datepicker();
      $('.calendar-icon').on('click', function() {
      $('#datepicker').datepicker('show');
  });

  $('#datepicker').on('change', function() {
    var selectedDate = $(this).val();
    $('.theDate').text(selectedDate);
  });

    // جلب تاريخ اليوم
    var currentDate = new Date(); // الحصول على تاريخ اليوم
    updateDate(currentDate); // تحديث قيمة التاريخ للمرة الأولى
    $('.prev').on('click', function() {
        currentDate.setDate(currentDate.getDate() - 1); // تقليل اليوم بمقدار 1
        updateDate(currentDate);
    });
    $('.next').on('click', function() {
        currentDate.setDate(currentDate.getDate() + 1); // زيادة اليوم بمقدار 1
        updateDate(currentDate);
    });
    function updateDate(date) {
        var day = date.getDate(); // اليوم (اليوم من 1 إلى 31)
        var month = date.getMonth() + 1; // الشهر (الشهر من 0 إلى 11، لذلك نضيف 1)
        var year = date.getFullYear(); // السنة (بالأربعة أرقام)

        // تجميع العناصر في تنسيق التاريخ المطلوب (يمكنك تعديل التنسيق حسب احتياجاتك)
        var formattedDate = day + '/' + month + '/' + year;

        $('.theDate').text(formattedDate); // طباعة التاريخ داخل العنصر <span class="theDate"></span>
    }

    // تشغيل السكرول بعجلة الماوس فى حجوزات اليوم
    $(".horizontal-scroll").on("wheel", function(event) {
      event.preventDefault();
      var delta = event.originalEvent.deltaX || event.originalEvent.wheelDeltaX || -event.originalEvent.deltaY || -event.originalEvent.wheelDelta;

      // تمرير بانيميشن
      $(this).stop().animate({
        scrollLeft: $(this).scrollLeft() + (delta * 10)
      }, 400, "linear");
    });

    // اضافة التاريخ
    var currentDate = new Date();
    var monthNames = [
      "يناير", "فبراير", "مارس", "أبريل", "مايو", "يونيو",
      "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"
    ];
    var monthIndex = currentDate.getMonth();
    var month = monthNames[monthIndex];
    var day = currentDate.getDate();
    var year = currentDate.getFullYear();
    var formattedDate = day + ' ' +  month + ', ' + year;
    $('.reserv-date').text(formattedDate).attr('data-v', 1);

    // اضافة الوقت
    var currentDate = new Date();
    var hours = currentDate.getHours();
    var minutes = currentDate.getMinutes();
    var ampm = hours >= 12 ? 'PM' : 'AM';

    // تحويل الوقت إلى تنسيق 12 ساعة
    hours = hours % 12;
    hours = hours ? hours : 12; // يعيد 0 إلى 12
    var formattedTime = hours + ':' + minutes + ' ' + ampm;

    $('.reserv-time').text(formattedTime).attr('data-v', 1);

    // كود اخفاء واظهار محتوى التبويبات فى صفحة حجز جديد


//  $('.show-content').on('click', function(){
//         $('.show-content').removeClass('active-list');
//         $(this).addClass('active-list');
//         $('.reservation-tabs').hide();
//         var contentId = $(this).data('id');
//         $(contentId).show();
//     });


       $('.change-content').on('click', function() {
          var contentId = $(this).data('id');
          var sideTab = $('.show-content[data-id="' + contentId + '"]');
          sideTab.attr('data-v', 1);
          $('.show-content').removeClass('active-list');
          sideTab.addClass('active-list');
          $('.reservation-tabs').hide();
          $(contentId).show();
        });
        
      

       





    // تحديد العنصر الهدف
    var targetElement = $('.guests.reserv-date.text-center');

    // إنشاء MutationObserver لمراقبة التغييرات في العناصر الأولى
    var observer = new MutationObserver(function(mutationsList) {
      mutationsList.forEach(function(mutation) {
        // التأكد من أن النوع Mutation هو "childList" وتمت إضافة عناصر جديدة
        if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
          // استخراج نص المحتوى من العناصر الأولى
          var day = $('.head-day').text();
          var monthYear = $('.head-month').text();

          // تحديث محتوى العنصر الهدف
          var formattedDate = day + ' ' + monthYear;
          targetElement.text(formattedDate);
        }
      });
    });

    // تحديد العناصر الأولى للمراقبة
    var observedElements = $('.head-day, .head-month');

    // تكوين المراقب للعناصر الأولى
    observer.observe(observedElements[0], { childList: true });
    observer.observe(observedElements[1], { childList: true });


    $('.clockpicker').clockpicker()
      .find('input').change(function(){
        // TODO: time changed
      });
    $('#demo-input').clockpicker({
      autoclose: true,
    });

    $('.clock').on('change', function() {
      var inputValue = $(this).val();
      var formattedTime = formatTime(inputValue);
      $('.reserv-time').text(formattedTime);
    });

    function formatTime(inputValue) {
      var timeParts = inputValue.split(':');
      var hours = parseInt(timeParts[0]);
      var minutes = parseInt(timeParts[1]);

      // تحويل الوقت إلى تنسيق 12 ساعة
      var ampm = hours >= 12 ? 'PM' : 'AM';
      hours = hours % 12;
      hours = hours ? hours : 12; // يعيد 0 إلى 12

      var formattedTime = hours + ':' + minutes + ' ' + ampm;
      return formattedTime;
    }

    $('.hour-push').on('click', function() {
      var minutesElement = $('.minuts');
      var hoursElement = $('.hour');
      var minutes = parseInt(minutesElement.text());
      var hours = parseInt(hoursElement.text());

      minutes += 15;
      if (minutes >= 60) {
        minutes = 0;
        hours += 1;
        if (hours >= 12) {
          hours = 0;
        }
      }

      minutesElement.text(minutes);
      hoursElement.text(hours);
    });

    $('.hour-mins').on('click', function() {
      var minutesElement = $('.minuts');
      var hoursElement = $('.hour');

      var minutes = parseInt(minutesElement.text());
      var hours = parseInt(hoursElement.text());

      if (!(minutes === 15 && hours === 0)) {
        minutes -= 15;
        if (minutes < 0) {
          minutes = 60;
          hours -= 1;
          if (hours < 0) {
            hours = 11;
          }
        }
      }

      minutesElement.text(minutes);
      hoursElement.text(hours);
    });

    $('.allstatus .btn-check').on('change', function() {
      var $label = $('label[for="' + $(this).attr('id') + '"]');

      if ($(this).is(':checked')) {
        $('.allstatus .btn').removeClass('btn-primary').addClass('btn-secondary');
        $label.removeClass('btn-secondary').addClass('btn-primary');

        var inputValue = $(this).next('label').text();
        $('.nav-statues').text(inputValue).attr('data-v', 1);
      }
    });

    $('.note-save').on('click', function(e) {
      e.preventDefault();
      var noteInputValue = $('.note-input').val();
      var listItem = $('<li class="list-group-item note-list d-flex justify-content-between align-items-start">');
      var noteContent = $('<div class="me-2 ms-auto">').append($('<div class="note-input fw-bold">').text(noteInputValue));
      var closeButton = $('<button type="button" class="note-remove btn btn-dark text-light">حذف</button>');

      $('.no-notes').remove();
      listItem.append(noteContent, closeButton);
      $('.note-lists').append(listItem);
      $('.note-input').val('') ;

      closeButton.on('click', function() {
        listItem.animate({
          left: '-100%',
          opacity: 0
        }, 500, function() {
          listItem.remove();
        });
      });
    });

    //  getting package id
    $('.choos-btn').on('click', function(){
      var parentElement = $(this).parent(); // الوصول إلى العنصر الأب لزر الإضافة
      var forDataV = parentElement.find('.card-title');
      var cardTitle = parentElement.find('.card-title').text();
      $('.package-name').text(cardTitle);

      var itemId = $(this).closest('.card').data('choosen');
      $('.package-name').attr('data-choos', itemId);

       });


       //  getting table id
       $('.new-reservation-tables .card').on('click', function(){
        $('.new-reservation-tables .card').removeClass('active-card');
        $(this).addClass('active-card');
        var cardTitle = $(this).find('.card-title').text();
        $('.table-name').text(cardTitle)

        var itemId = $(this).data('choosen');
        $('.table-name').attr('data-choos', itemId);
      });

    //  getting guest  id
    $('.gust-cards .card').on('click', function(event) {
      event.stopPropagation();

      var personeName = $(this).find('.card-title');
      $('.guest-name').text(personeName.text());
      console.log($(this));

      var itemId = $(this).data('choosen');
      $('.guest-name').attr('data-choos', itemId);
    });

    var newReservationData = {
      packageId: $('.package-name').data('data-choos'),
      tableId: $('.table-name').data('data-choos'),
      guestId: $('.guest-name').data('data-choos')
    };



    var registerButton = document.querySelector('.modal .add-gust');
    registerButton.addEventListener('click', function(e) {
    var name = document.getElementById("name").value;
    var phone = document.getElementById("phone").value;

    var newGuestCard = document.createElement("div");
    newGuestCard.className = "col-12 col-md-4";
    newGuestCard.innerHTML = `
      <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
          <div class="col-md-3">
            <img src="images/avatar.png" class="img-fluid rounded-start" alt="...">
          </div>
          <div class="col-md-9">
            <div class="card-body text-right">
              <h5 class="card-title">${name}</h5>
              <h4 class="card-text">
                <a class="tel" href="tel:${phone}">${phone}+</a>
              </h4>
              <div class="card-text">

              </div>
            </div>
          </div>
          <div class="row pb-4">
            <div class="col-4">
              <div class="upcoming d-flex flex-column text-center ">
                <span class="number">3</span>
                <span class="key">حجوزات</span>
              </div>
            </div>
            <div class="col-4">
              <div class="upcoming d-flex flex-column text-center ">
                <span class="number">15</span>
                <span class="key">زيارة</span>
              </div>
            </div>
            <div class="col-4">
              <div class="upcoming d-flex flex-column text-center ">
                <span class="number">عمليات دفع</span>
                <span class="key">1,300 $</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    `;

    var gustCardsContainer = document.getElementById("gust-cards");
    gustCardsContainer.appendChild(newGuestCard);
  });




  $('.voka-slider').slick({
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 3
    });



  });
