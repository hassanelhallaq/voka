<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css style -->
    <link rel="stylesheet" href="{{ asset('invation/css/style.css') }}">
    <!-- media -->
    <link rel="stylesheet" href="{{ asset('invation/css/media.css') }}">
    <title>Wedding Invitation</title>
</head>
@if ($attendance->lang == 'ar')

    <body>
        <!-- start main -->
        <main class="main">
            <div class="cover">
                <img class="coverImg" src="{{ asset('invation/img/cover.jpg') }}" alt="">
                <div class="absoluteCover">
                    <div class="coverContent">
                        <h1 class="coverTitle">دعوة زفاف</h1>
                        <p class="titleWelcome">بكل الحب والود يشرفنا حضوركم لحفل زفافنا</p>
                        <h1 class="titleNames">رائد وَ لينا</h1>
                        <!-- <p class="to">إلى السيد</p> -->
                        <p class="toName">{{ $attendance->name }}</p>
                        <p class="visitorsNum">عدد المدعوين: {{ 200 }} مدعو</p>
                        <div class="Details">
                            <div>
                                <div class="coverDesc">
                                    <i class="fa-sharp fa-solid fa-location-dot icon"></i>
                                    <span>W HOTEL | عمان, الأردن</span>
                                </div>
                                <div class="coverDesc descTime">
                                    <i class="fa-sharp fa-solid fa-clock icon"></i>
                                    <span>20 يوليو 2032 | 8:00 مساءاَ</span>
                                </div>
                            </div>
                        </div>

                        @if ($attendance->status == \App\Models\Attendance::PENDING)
                            <div class="btnsGroup">
                                <form method="post" action="{{ route('invitation.reply') }}" id="acceptInvitation">
                                    @csrf
                                    <input type="hidden" name="invitation_id" value="{{ $attendance->id }}">
                                </form>
                                <button
                                    onclick="event.preventDefault();document.getElementById('acceptInvitation').submit();"
                                    class="btnAccept btn">قبول</button>
                                <form method="post" action="{{ route('invitation.reply.refused') }}"
                                    id="refusedInvitation">
                                    @csrf
                                    <input type="hidden" name="invitation_id" value="{{ $attendance->id }}">
                                </form>
                                <button
                                    onclick="event.preventDefault();document.getElementById('refusedInvitation').submit();"
                                    class="btnReject btn">إعتذار</button>
                            </div>
                        @elseif($attendance->status == 3)
                            <div class="">
                                <button class="btnReject btn apologised">تم الإعتذار عن الدعوة</button>
                                <button class="btnView btn">الدعوة مغلقة</button>
                            </div>
                        @else
                            <div class="btnsGroup">
                                <button class="btnAccept btn">تم قبول الدعوة</button>
                                <a href="#" class="btnView btn">عرض الدعوة</a>
                            </div>
                        @endif
                        <div class="contacts">
                            <div>
                                <p>التواصل مع أهل العريس:</p>
                                <p> 0591238765</p>
                            </div>
                            <div>
                                <p>التواصل مع أهل العروس:</p>
                                <p>0591238765</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('invation/js/main.js') }}"></script>
    </body>
@else

    <body>
        <!-- start main -->
        <main class="main">
            <div class="cover">
                <img class="coverImg" src="{{ asset('invation/img/cover.jpg') }}" alt="">
                <div class="absoluteCover">
                    <div class="coverContent">
                        <h1 class="coverTitle">Wedding Invitation</h1>
                        <p class="titleWelcome">With all love and affection, we are honored by your presence at our
                            wedding</p>
                        <h1 class="titleNames">RAED & LINA</h1>
                        <!-- <p class="to">إلى السيد</p> -->
                        <p class="toName">{{ $attendance->name }}</p>
                        <p class="visitorsNum">Number of invitees: 200 invitees</p>
                        <div class="Details">
                            <div>
                                <div class="coverDesc">
                                    <i class="fa-sharp fa-solid fa-location-dot icon"></i>
                                    <span>W HOTEL | Amman, Jordan</span>
                                </div>
                                <div class="coverDesc descTime">
                                    <i class="fa-sharp fa-solid fa-clock icon"></i>
                                    <span>July 20th, 2023 | 8:00 PM</span>
                                </div>
                            </div>
                        </div>
                        @if ($attendance->status == \App\Models\Attendance::PENDING)
                            <div class="btnsGroup">
                                <form method="post" action="{{ route('invitation.reply') }}" id="acceptInvitation">
                                    @csrf
                                    <input type="hidden" name="invitation_id" value="{{ $attendance->id }}">
                                </form>
                                <button
                                    onclick="event.preventDefault();document.getElementById('acceptInvitation').submit();"
                                    class="btnAccept btn">Accept</button>
                                <form method="post" action="{{ route('invitation.reply.refused') }}"
                                    id="refusedInvitation">
                                    @csrf
                                    <input type="hidden" name="invitation_id" value="{{ $attendance->id }}">
                                </form>
                                <button
                                    onclick="event.preventDefault();document.getElementById('refusedInvitation').submit();"
                                    class="btnReject btn">Apology</button>
                            </div>
                        @elseif($attendance->status == 3)
                            <div class="">
                                <button class="btnReject btn apologised">The invitation has been apologised</button>
                                <button class="btnView btn">The invitation is closed</button>
                            </div>
                        @else
                            <div class=" btnsGroup">
                                <button class="btnAccept btn">Invitation Accepted</button>
                                <a href="#" class="btnView btn">View Invitation</a>
                            </div>
                        @endif
                        <div class="contacts">
                            <div>
                                <p>Communication with the groom's family:</p>
                                <p> 0591238765</p>
                            </div>
                            <div>
                                <p>Communication with the bride's family:</p>
                                <p>0591238765</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="js/main.js"></script>
    </body>
@endif

</html>
