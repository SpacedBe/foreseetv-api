<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Foresee.tv</title>

    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.tooltipster/4.1.4/css/tooltipster.core.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.tooltipster/4.1.4/css/tooltipster.bundle.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
            crossorigin="anonymous"></script>
</head>
<body>

<nav>
    <div class="nav-wrapper">
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            @if (!Auth::guest())
                <li><a href="{{ url('/') }}">collections</a></li>
                <li><a href="{{ url('/logout') }}">logout</a></li>
            @endif
        </ul>
    </div>
</nav>

@yield('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.tooltipster/4.1.4/js/tooltipster.bundle.min.js"></script>

<script src="/js/app.js" type="text/javascript"></script>
</body>
</html>
