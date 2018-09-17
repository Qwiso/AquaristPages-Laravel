<div class="row">
    <div class="col d-flex justify-content-between">
        @if ($item->amount != 0)
            <input type="number" class="form-control" value="0" min="0" max="{{$item->amount}}">
            <button class="btn btn-info">Add to Cart</button>
        @else
            <input disabled type="text" class="form-control" value="sold out">
            <button class="btn btn-info" disabled>Add to Cart</button>
        @endif
    </div>
</div>