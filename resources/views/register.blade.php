@extends('layouts.layout')
@section('upper')
    <div class="container-lg">
        <div class="row">
            <div class="col">
                <a href="/" class="h4 text-black-50 form-control">ChataLara</a>
            </div>
            <div class="col-md-auto">
                <a href="{{route('users.index')}}" class="">Login</a>
            </div>
            <div class="col col-lg-2">
                <a href="{{route('users.create')}}">Register</a>
            </div>
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
