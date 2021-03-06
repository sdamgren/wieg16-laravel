<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <!-- Styles -->
    <style>
html, body {
    background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }


        .flex-center {
    align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
    position: relative;
}

        .top-right {
    position: absolute;
    right: 10px;
            top: 18px;
        }

        .content {
    text-align: center;
        }

        .title {
    font-size: 84px;
        }

        .links > a {
    color: #636b6f;
    padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
    margin-bottom: 30px;
        }
    </style>
</head>

<body>
<div class="flex-center position-ref full-height">
@if (Route::has('login'))
    <div class="top-right links">
        @auth
            <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
                @endauth
    </div>
@endif

    <div clas="content">
        <div class="title m-b-md" style=" ">
            Tweets
        </div>

    <form action="{{ action('TweetController@countAndSort') }}" method="get">
        {{ csrf_field() }}
        Search:
        <input type="text" name="search tweet" value="" placeholder="Search tweet"><br>
        <input type="count tweets">
    </form>
    <table>
        <thead>
        <tr>
            <td>Word</td>
            <td>Count</td>
        </tr>
        </thead>
        <tbody>

        @foreach($words as $word => $number)
            <tr>
                <td>{{ $word }}</td>
                <td>{{ $number }}</td>
            </tr>

        @endforeach
        </tbody>
    </table>

    </div>
</div>
</body>
</html>