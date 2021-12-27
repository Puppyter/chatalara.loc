@extends('layouts.layout')
@section('content')
        <Chat :messages={{json_encode($messages)}}></Chat>
@endsection
