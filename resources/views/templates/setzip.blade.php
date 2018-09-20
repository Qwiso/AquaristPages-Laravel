<form id="setzip" action="{{url('user/setzip')}}" method="POST">
    <label for="q">Set your Zipcode:</label>
    <input id="q" value="{{auth()->user()->zipcode ? auth()->user()->zipcode->zipcode : ''}}" name="zipcode">
    <input hidden type="text" name="_token" value="{{csrf_token()}}">
    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
</form>
@section('post-script')
    <script>
        $(function(){
            let zipForm = document.getElementById('setzip');
            zipForm.addEventListener('submit', function(e){
                e.preventDefault();
                e.stopPropagation();

                let data = {};
                data._token = "{{csrf_token()}}";
                data.zipcode = $("#q").val();

                $.post("{{url('user/setzip')}}", data, function(res){
                    if (res.invalid) {
                        alert("That was not a known Zipcode")
                    }

                    if ( res.success) {
                        window.location.reload();
                    }
                });
            });
        });

        $("#q").autocomplete({
            source: "{{url('zipcodes/autocomplete')}}",
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