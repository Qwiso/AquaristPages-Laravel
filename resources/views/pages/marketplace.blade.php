@extends('templates.main')

@section('content')
    @include('market_items.list', $items)
@endsection