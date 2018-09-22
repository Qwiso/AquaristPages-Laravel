@extends('templates.main')

@section('content')
    <div class="d-flex text-center justify-content-center">
        <div class="col">
            <h3>Welcome to Aquarist Pages</h3>
            <div class="d-flex justify-content-center pt-3">
                <a class="col-sm-4 btn btn-facebook btn-block text-white" href="{{url('facebook/login')}}">Continue with <i class="fab fa-facebook"></i> if you dare</a>
            </div>
            <div class="d-flex justify-content-center pt-3">
                <a class="col-sm-4 btn btn-success btn-block text-white" href="{{url('recruitment')}}">Help me test or develop <i class="fa fa-user"></i> <i class="fa fa-code"></i></a>
            </div>
        </div>
    </div>
@endsection