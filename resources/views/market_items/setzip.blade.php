<form id="setzip">
    <div class="input-group" id="zipcode_set_input">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-map-marker" aria-hidden="true"></i></span>
        </div>
        <input id="q_set" class="form-control" name="autocomplete_zipcode" data-zipid="{{$zipcode->id}}" data-value="{{$zipcode->zipcode}}" placeholder="{{$zipcode->city.', '.$zipcode->state_abbr}}">
    </div>
</form>
@section('post-script')
<script>
    $("#q_set").autocomplete({
        source: "{{url('zipcodes/autocomplete')}}",
        appendTo: '#zipcode_set_input',
        create: function(){
            $(this).data('ui-autocomplete')._renderItem = function(ul, item) {
                return $("<li>").append("<a>" + item.text + "</a>").appendTo(ul);
            }
        },
        minLength: 3,
        select: function(event, ui){
            event.target.dataset.zipid = ui.item.id;
            event.target.dataset.value = ui.item.value;
            event.target.placeholder = ui.item.text;
        }
    });
</script>
@append