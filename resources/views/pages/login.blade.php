@extends('templates.main')

@section('content')
    <div class="col"></div>
    <div class="col text-center">
        <h3>Welcome to Aquarist Pages</h3>
        <p>Please log in to continue</p>
        <div class="row justify-content-center">
            <a class="col-4 btn btn-facebook btn-block text-white" href="{{url('facebook/login')}}">Continue with <i class="fab fa-facebook"></i></a>
        </div>
    </div>
    <div class="col"></div>
@endsection