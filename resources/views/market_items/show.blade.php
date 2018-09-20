@extends('templates.main')

@section('content')
<div class="col">
    <img class="img-fluid d-block mx-auto" src="{{asset('market_images/'.$item->uuid.'.png')}}">
</div>
<div class="col pb-2">
    <p class="m-0">
        <b>{{$item->title}}</b>
        <br/>
        Amount: {{$item->amount}}
        <br/>
        Price: ${{$item->price}}
        <br/>
        <small>from <a href="{{url('profile')}}/{{$item->user->id}}">{{$item->user->name}}</a> in {{$item->zipcode->city}}, {{$item->zipcode->state_abbr}}</small>
    </p>

    <p class="m-0 pt-3">
        {{$item->description}}
    </p>
</div>
@endsection