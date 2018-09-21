@foreach($items as $item)
    @include('market_items.preview', $item)
@endforeach
<div class="modal fade" id="market-item" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="market-item-content"></div>
    </div>
</div>

<script>
    function loadMarketItem(uuid){
        $.get("{{url('marketplace/item/modal')}}/"+uuid, function(res){
            $("#market-item-content").html(res);
            $("#market-item").modal('show');
        });
    }
</script>