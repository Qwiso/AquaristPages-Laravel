@extends('templates.main')

@section('content')
<h3>Hello, {{auth()->user()->name}}</h3>
<div class="row">
    @include('market_items.list', $items)
</div>
@endsection