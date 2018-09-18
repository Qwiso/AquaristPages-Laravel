@extends('templates.main')

@section('content')
    @include('market_items.create')
    @include('market_items.list', $items)
@endsection