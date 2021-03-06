<div class="modal-body">
    <div class="row d-flex justify-content-end pr-3">
        <div class="col">
            <h4 class="modal-title">{{$item->title}}</h4>
        </div>
        <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="row justify-content-center pt-3">
        <div class="col">
            <div class="row justify-content-center">
                <div class="col-md-6 pb-3">
                    <img class="img-fluid d-block mx-auto" src="{{asset('market_images/'.$item->uuid.'.png')}}">
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <div class="col">
                            <p>
                                <small>{{ucwords($item->category)}}</small>
                            </p>
                            <h4 class="m-0">${{$item->price == intval($item->price) ? intval($item->price) : $item->price}}</h4>

                            <p class="m-0 py-3">
                                {{$item->description}}
                            </p>

                            <p class="m-0 pb-3">
                                <small>from <a href="{{url('profile')}}/{{$item->user->uuid}}">{{$item->user->name}}</a> in {{$item->zipcode->city}}, {{$item->zipcode->state_abbr}}</small>
                            </p>

                            <div style="width:300px;height:150px;overflow:hidden;position:relative">
                                <a href="https://www.google.com/maps/@?api=1&map_action=map&center={{$item->zipcode->lat}},{{$item->zipcode->lon}}&zoom=14" target="_blank">
                                    <div class="overlay-circle" style="top:0;left:75px;width:150px;height:150px;position:absolute;box-shadow:0 0 0 500px rgba(0,0,0,0.25);border-radius:500px;z-index:1000"></div>
                                    <div class="overlay-behind" style="width:100%;height:100%;position:absolute;top:0;left:0;">
                                        <img class="img-fluid d-block mx-auto" src="{{$radius_map}}">
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="max-height:40vh;overflow-y:auto;">
                        <div class="col pt-3">
                            @include('comments.create', $item)
                            @include('comments.list', ['comments' => $item->comments])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>