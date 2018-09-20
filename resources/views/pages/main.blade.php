@extends('templates.main')

@section('content')
<h3>Hello, {{auth()->user()->name}}</h3>
@if(isset($set_zipcode))
    Set your Zipcode to continue:
    <form id="setzip" action="{{url('user/setzip')}}" method="POST">
        <input hidden type="text" name="_token" value="{{csrf_token()}}">
        <input id="q" name="zipcode">
        <button type="submit" class="btn btn-primary">Submit</button>
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
@else
    <!-- make some main page material -->
@endif
@endsection