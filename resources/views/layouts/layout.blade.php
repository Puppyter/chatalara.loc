<!doctype HTML>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>RPlara</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
@section("upper")
    <div class="row justify-content-md-center" style="background: #474B4F">
        <div class="col col-lg-2">
            <div class="btn-group">
                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Small button
                </button>
                <ul class="dropdown-menu">
                    <li>asdaad</li>
                    <li>fdsagsdf</li>
                </ul>
            </div>

        </div>
        <div class="col col-lg-2">col</div>
        @if(!Auth::check())
            <div class="col col-lg-2"><a href="{{route('users.index')}}" style="color: antiquewhite"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                    </svg></a></div>
        @else
            <div class="col col-lg-2"><a href="{{route('users.show',["user"=>Auth::id()])}}" style="color: antiquewhite"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                    </svg></a></div>
        @endif
    </div>
@show
<div class="container-fluid" id="app" style="margin-top: 1em; height: 100%; width: 100%">
    @yield("content")
</div>
<script src="{{ mix("js/app.js") }}" defer></script>
</body>
</html>

