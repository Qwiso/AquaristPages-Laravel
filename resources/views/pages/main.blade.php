@extends('templates.main')

@section('content')
@if(isset($set_zipcode))
    <h3>Hello, {{auth()->user()->name}}</h3>
    Set your Zipcode to continue:
    <form action="{{url('user/setzip')}}" method="post">
        <input hidden type="text" name="_token" value="{{csrf_token()}}">
        <input id="q" name="zipcode">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    @section('post-script')
    <script>
        $("#q").autocomplete({
            source: "{{url('zipcodes/autocomplete')}}",
            create: function(){
                $(this).data('ui-autocomplete')._renderItem = function(ul, item) {
                    return $("<li>")
                            .append("<a>" + item.text + "</a>")
                            .appendTo(ul);
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
    @include('market_items.list', $items)
@endif
@endsection