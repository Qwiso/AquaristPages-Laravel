@extends('templates.main')

@section('content')
<div class="col">
    <div class="row">
        <div class="col">
            @include('market_items.create')
        </div>
    </div>
    <div class="row">
        @foreach($items as $item)
            <div class="col-md-4">
                @include('market_items.show', $item)
            </div>
        @endforeach
    </div>
</div>
@endsection