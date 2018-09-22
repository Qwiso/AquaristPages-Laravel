@extends('templates.main')

@section('content')
<div class="row">
    <div class="col">
        <form id="form_marketplaceFilter">
            <div class="row">
                <div class="col pr-1">
                    <select name="category" class="form-control">
                        <option value="">All</option>
                        @foreach(DB::table('categories')->get() as $category)
                            <option {{request('category') == $category->name ? "selected" : ""}} value="{{$category->name}}">{{ucwords($category->name)}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col pr-1">
                    <select name="radius" class="form-control">
                        <option {{request('radius') == 50 ? "selected" : ""}} value="50">50 mi</option>
                        <option {{request('radius') == 100 ? "selected" : ""}} value="100">100 mi</option>
                        <option {{request('radius') == 500 ? "selected" : ""}} value="500">500 mi</option>
                        <option {{request('radius') == "state" ? "selected" : ""}} value="state">State</option>
                        <option {{request('radius') == "country" ? "selected" : ""}} value="country">Country</option>
                    </select>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary">Apply</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row pt-3">
    <div class="col">
        @include('market_items.list', ['items'=>$localItems])
    </div>
</div>
@endsection