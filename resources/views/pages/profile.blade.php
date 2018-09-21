@extends('templates.main')

@section('content')
    @if($user->id == auth()->id())
    @include('market_items.create')
    @endif
    @include('market_items.list', $items)
@endsection