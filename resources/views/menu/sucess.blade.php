<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>
    <div class="rounded-circle border border-4">
        <p id="counter">5</p>

        <h1 style="font-family: tahoma;">تم الدفع بنجاح</h1>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
            class="bi bi-check-circle-fill" viewBox="0 0 16 16">
            <path
                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </svg>
    </div>
</body>
<style>
    div {
        position: absolute;
        width: 320px;
        height: 320px;
        text-align: center;
        top: 0;
        opacity: 1;
        padding: 39px;
        left: calc(50% - 160px)
    }

    svg {
        color: #62af54;
        font-size: 50px;
        width: 50px;
        height: 50px;
        animation-duration: .5s;
        animation-name: changewidth;
        animation-iteration-count: 11;
        animation-direction: alternate;
    }

    @keyframes changewidth {
        from {

            width: 50px;
            height: 50px;
        }

        to {
            width: 40px;
            height: 40px;
        }
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    jQuery(function($) {
        top_ = ($(window).height() / 2) - 160;
        $('div').animate({
            top: "0",
            top: top_ + 'px'
        }, 300);
        $('div').animate({
            'font-size': "10",
            'font-size': "30"
        }, 400);
        $('div').animate({
            'font-size': "30",
            'font-size': "45"
        }, 400);
    });


    var countDown = 5;

    var x = setInterval(function() {

        countDown = countDown - 1;

        // Display the result in the element with id="demo"
        document.getElementById("counter").innerHTML = countDown;

        // If the count down is finished, write some text
        if (countDown == 0) {
            console.log(countDown);
            clearInterval(x);
            // window.setTimeout(function() {
            //     location.href =
            //         "{{ route('table.tracking', ['vendor_uuid' => $vendor_uuid, 'table_id' => $table]) }}";
            // }, 1000);

        }

    }, 1000);
</script>

</html>
