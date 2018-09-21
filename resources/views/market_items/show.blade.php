@extends('templates.main')

@section('content')
<div class="col-8">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-6 col-sm-6">
            <img class="img-fluid d-block mx-auto" src="{{asset('market_images/'.$item->uuid.'.png')}}">
        </div>

        <div class="col-lg-7 col-md-6 col-sm-6">
            <div class="row">
                <div class="col">
                    <p class="m-0">
                        <b>{{$item->title}}</b>
                        <br/>
                        Amount: {{$item->amount}}
                        <br/>
                        Price: ${{$item->price}}
                        <br/>
                        <small>from <a href="{{url('profile')}}/{{$item->user->uuid}}">{{$item->user->name}}</a> in {{$item->zipcode->city}}, {{$item->zipcode->state_abbr}}</small>
                    </p>

                    <p class="m-0 pt-3">
                        {{$item->description}}
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    @include('comments.create', $item)
                    @include('comments.list', $item)
                </div>
            </div>
        </div>
    </div>
</div>
@endsection