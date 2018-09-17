@extends('templates.main')

@section('content')
    <div class="col"></div>
    <div class="col text-center">
        <h3>Welcome to Aquarist Pages</h3>
        <p>Please log in to continue</p>
        <a class="btn btn-facebook btn-block text-white" href="{{url('facebook/login')}}">Continue with <i class="fab fa-facebook"></i></a>
    </div>
    <div class="col"></div>
@endsection