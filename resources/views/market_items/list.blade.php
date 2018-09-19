<div class="col">
@foreach($items as $item)
    @include('market_items.preview', $item)
@endforeach
</div>