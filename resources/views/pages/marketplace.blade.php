@extends('templates.main')

@section('content')
<div class="col">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#filters">
        <i class="fa fa-list"></i> Filters
    </button>
</div>

<div class="modal fade" id="filters" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body py-2">
                <div class="row d-flex justify-content-end pb-2 pr-3">
                    <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="row">
                    <div class="col">
                        <form id="form_marketplaceFilter">
                                <div class="row p-2">
                                    <select name="category" class="form-control">
                                        <option value="">All</option>
                                        @foreach(DB::table('categories')->get() as $category)
                                            <option {{request('category') == $category->name ? "selected" : ""}} value="{{$category->name}}">{{ucwords($category->name)}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row p-2">
                                    <select name="radius" class="form-control">
                                        <option {{request('radius') == 10 ? "selected" : ""}} value="10">10 mi</option>
                                        <option {{request('radius') == 25 ? "selected" : ""}} value="25">25 mi</option>
                                        <option {{request('radius') == 50 ? "selected" : ""}} value="50">50 mi</option>
                                        <option {{request('radius') == 100 ? "selected" : ""}} value="100">100 mi</option>
                                        <option {{request('radius') == "state" ? "selected" : ""}} value="state">State</option>
                                    </select>
                                </div>

                                <div class="row p-2">
                                    <div class="input-group" id="zipcode_input">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map-marker" aria-hidden="true"></i></span>
                                        </div>
                                        <input id="location" class="form-control" name="autocomplete_zipcode" data-zipid="{{$zipcode->id}}" data-value="{{$zipcode->zipcode}}" placeholder="{{$zipcode->city.', '.$zipcode->state_abbr}}">
                                    </div>
                                </div>

                                <div class="row justify-content-end p-2">
                                    <button type="submit" class="btn btn-primary">Apply</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('market_items.list', ['items' => $localItems])
@endsection

@section('post-script')
    <script>
        $("#location").autocomplete({
            source: "{{url('zipcodes/autocomplete')}}",
            appendTo: '#zipcode_input',
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