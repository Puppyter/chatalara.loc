@extends('layouts.layout')
@section('upper')
    <div class="row shadow p-3 mb-3 bg-body rounded border justify-content-md-center">
        <div class="col">
            <a class="fs-5 btn btn-dark" href="/">CHATALARA</a>

        </div>
        <div class="col-2">
            <a class="btn btn-primary" href="{{route('users.index')}}">Login</a>
            <a href="{{route('users.create')}}">Register</a>
        </div>
    </div>
@endsection
@section('content')
    <registration route="{{route('usersStore')}}" routeLogin="{{route('users.index')}}"></registration>
@endsection
<script>
    var Laravel = {
        'csrfToken' : '{{csrf_token()}}'
    };
</script>
