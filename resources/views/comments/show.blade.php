<div class="row">
    <div class="col">
        @if(auth()->id() == $comment->user->id)
            <div class="d-block bg-white border p-3 mt-3 justify-content-around">
                <button class="btn btn-danger btn-sm" onclick="deleteComment('{{$comment->id}}')"><i class="fa fa-trash"></i></button>
                <a href="{{url('profile')}}/{{$comment->user->uuid}}">{{$comment->user->name}}</a> says: {{$comment->text}}
            </div>
        @else
            <div class="d-block bg-white border p-3 mt-3 justify-content-around">
                <a href="{{url('profile')}}/{{$comment->user->uuid}}">{{$comment->user->name}}</a> says: {{$comment->text}}
            </div>
        @endif
    </div>
</div>