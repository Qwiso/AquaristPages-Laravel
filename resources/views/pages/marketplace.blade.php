@extends('templates.main')

@section('content')
<div class="row">
    <div class="col">
        <div class="d-flex justify-content-around">
            @foreach(DB::table('categories')->get() as $category)
                <div class="btn btn-mine" data-category="{{$category->name}}" onclick="loadCategory(this)">{{strtoupper($category->name)}}</div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('post-script')
<script>
    function loadCategory(element) {
        var cat = element.dataset.category;
        var data = {
            'cat': cat,
            _token: '{{csrf_token()}}'
        };

        $.post('{{url('marketplace/items')}}', data, function(res){
            if (res.success) {
                console.log(res);
            }
        });
    }
</script>
@endsection