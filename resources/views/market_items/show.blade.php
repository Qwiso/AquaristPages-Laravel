{{--@extends('templates.main')--}}

{{--@section('content')--}}
<div class="row justify-content-center p-3">
    <div class="col">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <img class="img-fluid d-block mx-auto" src="{{asset('market_images/'.$item->uuid.'.png')}}">
            </div>

            <div class="col-sm-6">
                <div class="row">
                    <div class="col">
                        <p class="m-0 pt-3">
                            <b>{{$item->title}}</b>
                            <br/>
                            Amount: {{$item->amount}}
                            <br/>
                            Price: ${{$item->price}}
                            <br/>
                            <small>from <a href="{{url('profile')}}/{{$item->user->uuid}}">{{$item->user->name}}</a> in {{$item->zipcode->city}}, {{$item->zipcode->state_abbr}}</small>
                        </p>

                        <p class="m-0 pt-2 pb-3">
                            {{$item->description}}
                        </p>

                        <div style="width:300px;height:150px;overflow:hidden;position:relative">
                            <div class="overlay-circle" style="top:0;left:75px;width:150px;height:150px;position:absolute;box-shadow:0 0 0 500px rgba(0,0,0,0.25);border-radius:500px;z-index:1000"></div>
                            <div class="overlay-behind" style="width:100%;height:100%;position:absolute;top:0;left:0;">
                                <img class="img-fluid d-block mx-auto" src="{{$radius_map}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3" style="overflow-y: scroll;max-height: 300px;">
                    <div class="col pt-3">
                        @include('comments.create', $item)
                        @include('comments.list', ['comments' => $item->comments])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--@endsection--}}