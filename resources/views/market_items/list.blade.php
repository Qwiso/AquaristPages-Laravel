<div class="row pt-3">
    <div class="col d-flex flex-wrap justify-content-center justify-content-md-start">
@foreach($items as $item)
    @include('market_items.preview', $item)
@endforeach
    </div>
</div>

<div class="modal fade" id="market-item" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">s
        <div class="modal-content" id="market-item-content"></div>
    </div>
</div>

@section('post-script')
<script>
    function loadMarketItem(uuid){
        $("#market-item-content").html("");
        $("#market-item").modal('show');
        $.get("{{url('marketplace/item/modal')}}/"+uuid, function(res){
            $("#market-item-content").html(res);
        });
    }
</script>
@append