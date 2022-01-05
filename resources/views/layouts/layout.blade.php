<!doctype HTML>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>RPlara</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body style="overflow: hidden">
@section("upper")
    <div class="row shadow p-3 mb-3 bg-body rounded border justify-content-md-center">
        <div class="col">
            <a class="fs-5 btn btn-dark" href="/">CHATALARA</a>

        </div>
        <div class="col-2">
            <a class="btn btn-primary" href="{{route('logout')}}">Logout</a>
        </div>
    </div>
@show
<div class="container-fluid" id="app" style="margin-top: 1em; height: 100%; width: 100%">
    @yield("content")
</div>
<script src="{{ mix("js/app.js") }}" defer></script>
</body>
</html>

