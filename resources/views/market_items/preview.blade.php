<div class="market-item d-xs-flex d-sm-inline-block shadow mr-3 mb-3" style="min-width: 245px; max-width: 245px; min-height: 305px; max-height: 305px;">
    @if(auth()->id() == $item->user_id)
        <div class="row justify-content-end pr-3">
            <div class="position-absolute btn btn-xs" onclick="console.log(this)"><i class="fa fa-edit"></i></div>
        </div>
    @endif
    <div style="overflow: hidden; display: flex; align-items: center; min-width: 245px; max-width: 245px; min-height: 250px; max-height: 250px;">
        <a href="{{url('marketplace/item')}}/{{$item->uuid}}"><img src="{{$item->media_url}}" width="245px"></a>
    </div>
    <div class="col text-center pb-2">
        <small><b>{{$item->title}}</b></small>
        <br/>
        <small class="text-muted">{{$item->created_at->diffForHumans() . ' ‧ ' . $item->zipcode->city . ', ' . $item->zipcode->state_abbr}}</small>
    </div>
</div>