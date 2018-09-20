@extends('templates.main')

@section('content')
    <div class="row">
        @include('market_items.list', ['items'=>$localItems]);
    </div>
    <div class="row">
        @include('market_items.list', ['items'=>$stateItems]);
    </div>
@endsection