@extends('templates.main')

@section('content')
    <div class="row">
        <div class="col-md-2">
            <form class="form-group" id="form_setMarketplaceSearchRadius">
                <select onchange="this.form.submit()" name="search_radius" class="form-control">
                    <option {{request('search_radius') == 50 ? "selected" : ""}} value="50">50 mi</option>
                    <option {{request('search_radius') == 100 ? "selected" : ""}} value="100">100 mi</option>
                    <option {{request('search_radius') == 500 ? "selected" : ""}} value="500">500 mi</option>
                    <option {{request('search_radius') == "state" ? "selected" : ""}} value="state">State</option>
                    <option {{request('search_radius') == "country" ? "selected" : ""}} value="country">Country</option>
                </select>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            @include('market_items.list', ['items'=>$localItems])
        </div>
    </div>
@endsection