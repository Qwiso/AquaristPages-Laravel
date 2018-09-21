@foreach($comments as $comment)
    @include('comments.show', $comment)
@endforeach