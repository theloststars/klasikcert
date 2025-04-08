<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="/search-email" method="post">
        @csrf
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="email">
        <br>
        <span id="captcha">{!! captcha_img('math') !!}</span>
        <input type="text" name="captcha" id="captcha" placeholder="captcha">
        <button type="button" class="btn btn-danger" class="reload" id="reload">
            &#x21bb;
        </button>
        <button>Search</button>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $('#reload').click(() => {
            $.ajax({
                type: 'GET',
                url: 'reload-captcha',
                success: (data) => {
                    $('#captcha').html(data.captcha)
                }
            })
        })
    </script>
</body>

</html>
