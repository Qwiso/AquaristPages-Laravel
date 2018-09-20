@extends('templates.main')

@section('content')
<h3>Hello, {{auth()->user()->name}}</h3>
@if(isset($set_zipcode))
    @include('templates.setzip')
@else
    <!-- make some main page material -->
@endif
@endsection