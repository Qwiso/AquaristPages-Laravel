@foreach($item->comments->take(5) as $comment)
    @include('comments.show', $comment)
@endforeach