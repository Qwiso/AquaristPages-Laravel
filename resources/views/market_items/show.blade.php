<div class="row bg-white shadow-sm mb-3 pb-3">
    <div class="col pt-3">
        <h4>{{$item->title}}</h4>
        <div class="row pb-3">
            <div class="col">
                <small>{{$item->description}}</small>
            </div>
        </div>
        <div class="row pb-3">
            <div class="col">
                <small>{{$item->amount}} available for ${{$item->price}} each</small>
            </div>
        </div>
        @if(isset($item->media_url))
            <div class="row pb-3">
                <div class="col">
                    @include('imgur.album', $item)
                </div>
            </div>
        @else

        @endif
        @include('market_items.buy', $item)
    </div>
</div>