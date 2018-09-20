<div class="market-item d-xs-flex d-sm-inline-block shadow mr-3 mb-3" style="min-width: 245px; max-width: 245px; min-height: 305px; max-height: 305px;">
    @if(auth()->id() == $item->user_id)
    <div class="row justify-content-end pr-3">
        <div class="position-absolute btn btn-secondary pt-0 pb-1 px-1" onclick="editItem({{$item->id}})"><i class="fa fa-xs fa-edit"></i></div>
    </div>
    @endif
    <div class="row justify-content-start pl-3">
        <div class="position-absolute badge badge-secondary p-2 align-middle">${{$item->price}}</div>
    </div>
    <div style="overflow: hidden; display: flex; align-items: center; min-width: 245px; max-width: 245px; min-height: 250px; max-height: 250px;">
        <a href="{{url('marketplace/item')}}/{{$item->uuid}}"><img src="{{Storage::disk('local')->get('market_images/'.$item->uuid.'.jpeg')}}" width="245px"></a>
    </div>
    <div class="row pb-2">
        <div class="col mx-2 text-truncate">
            <small title="{{$item->title}}"><b>{{$item->title}}</b></small>
            <br/>
            <small class="text-muted">{{$item->created_at->diffForHumans() . ' ‧ ' . $item->zipcode->city . ', ' . $item->zipcode->state_abbr}}</small>
        </div>
    </div>
</div>