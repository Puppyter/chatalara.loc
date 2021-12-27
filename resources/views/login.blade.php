@extends('layouts.layout')
@section('upper')
    <div class="container-lg form-floating">
    <div class="row">
        <div class="col">
            <a href="/" class="h4 text-black-50 form-control">ChataLara</a>
        </div>
        <div class="col-md-auto">
            <h4 class="form-control">Login</h4>
        </div>
        <div class="col col-lg-2">
            <a href="{{route('users.create')}}">Register</a>
        </div>
    </div>
    </div>
@endsection
@section('content')
    @if(session('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @endif
    <Login></Login>
@endsection
