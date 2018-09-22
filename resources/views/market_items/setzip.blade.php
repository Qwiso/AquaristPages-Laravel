<form id="setzip">
    <div class="input-group" id="zipcode_input">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-map-marker" aria-hidden="true"></i></span>
        </div>
        <input id="q" class="form-control" name="zip" value="{{$user->zipcode_id ? $user->zipcode->zipcode : ''}}">
    </div>
</form>
@section('post-script')
<script>
    $("#q").autocomplete({
        source: "{{url('zipcodes/autocomplete')}}",
        appendTo: '#zipcode_input',
        create: function(){
            $(this).data('ui-autocomplete')._renderItem = function(ul, item) {
                return $("<li>").append("<a>" + item.text + "</a>").appendTo(ul);
            }
        },
        minLength: 3,
        select: function(event, ui){
            $("#q").val(ui.item.value);
        }
    });
</script>
@append