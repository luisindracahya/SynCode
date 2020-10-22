<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syncode</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/bootstrap-4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/fontawesome/css/all.min.css">
</head>
<body>

    <div class="bg">
        <nav class="navbar justify-content-between">
            <div class="logo">
                <a href="#">
                    <img src = "/assets/logo.png" height="100px">
                </a>
            </div>
            <div class="menu">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">HOME</a>
                    @else
                        <a href="{{ route('login') }}">LOGIN</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">REGISTER</a>
                        @endif
                    @endauth
                </div>
            @endif
                <button class="btn btn-primary btn-lg icon" onclick="sidebarOpen()">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
        </nav>

    <br>

    <div class="container-fluid">
        <div class="d-sm-flex justify-content-around content">
            <div class="content-left">
                <br><br><br><br>
                <h2 class="text-blur"><b>BE PART OF OUR</b></h2>
                <h1>COMMUNITY</h1>
                <div class="description">
                    <p>
                        Indonesia #1 question and answer site for professional and enthusiast programmers
                    </p>
                </div>
                <br>
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">JOIN US</a>
            </div>

            <div class="image1">
                <img src="/assets/content-removed.png" alt="" height="450px">
            </div>
        </div>
    </div>


    </div>    

</body>
<script src="/bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
</html>