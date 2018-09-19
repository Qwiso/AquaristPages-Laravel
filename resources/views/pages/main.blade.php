@extends('templates.main')

@section('content')
<h3>Hello, {{auth()->user()->name}}</h3>
@include('market_items.list', $items)
@endsection