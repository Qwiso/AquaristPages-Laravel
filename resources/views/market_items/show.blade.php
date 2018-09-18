<div class="market-item shadow mr-3 mb-3" style="min-width: 245px; max-width: 245px; min-height: 305px; max-height: 305px;">
    <div style="overflow: hidden; display: flex; align-items: center; min-width: 245px; max-width: 245px; min-height: 250px; max-height: 250px;">
        <img data-media="{{$item->media_url}}" width="245px">
    </div>
    <div class="col pb-2">
        <small><b>{{$item->title}}</b></small>
        <br/>
        <small class="text-muted">{{$item->created_at->diffForHumans() . ' ‧ ' . $item->zipcode->city . ',' . $item->zipcode->state_abbr}}</small>
    </div>
</div>