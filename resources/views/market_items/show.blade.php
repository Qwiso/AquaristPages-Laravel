@extends('templates.main')

@section('content')
<div class="col d-flex justify-content-center">
    <img class="img-fluid" data-source="{{$item->media_url}}">
</div>
<div class="col text-center pb-2">
    <p class="m-0"><b>{{$item->title}}</b></p>
    <small>from <a href="{{url('profile')}}/{{$item->user->id}}">{{$item->user->name}}</a> in {{$item->zipcode->city}}, {{$item->zipcode->state_abbr}}</small>
</div>
@endsection

@section('post-script')
<script>
    $(function(){
        let images = $("img[data-source]");
        $(images).each(function(){
            this.src = this.dataset.source;
        });
    });
</script>
@endsection