@extends('templates.main')

@section('content')
<div class="col">
    <img class="img-fluid" src="{{$item->media_url}}" style="cursor: pointer;" onclick="openImageWindow(this)">
</div>
<div class="col text-center pb-2">
    <p class="m-0"><b>{{$item->title}}</b></p>
    <small>from <a href="{{url('profile')}}/{{$item->user->id}}">{{$item->user->name}}</a> in {{$item->zipcode->city}}, {{$item->zipcode->state_abbr}}</small>
</div>
@endsection

@section('post-script')
<script>
    function openImageWindow(element) {
        let img = document.createElement("img");
        img.src = element.src;
        let newTab = window.open();
        newTab.document.body.appendChild(img);
    }
</script>
@endsection