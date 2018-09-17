<div class="row bg-white shadow-sm mb-3 pt-3 pb-3">
    <div class="col">
        <div class="row">
            <div class="col">
                <img src="http://placehold.it/60" class="img rounded-circle float-left">
                <a class="pl-3" href="{{url('users').'/'.$post->user->id}}">{{$post->user->name}}</a><br>
                <small class="pl-3">{{$post->created_at->format('F j \a\t h:i')}}</small>
            </div>
        </div>
        <p class="pt-3">{{$post->text}}</p>
        @if(isset($post->media_url))
            <img src="{{$post->media_url}}" class="img img-thumbnail">
        @endif
        <hr>
        @include('posts.reactions', $post)
        {{--<hr>--}}
        {{--@include('comments.list', $post)--}}
        {{--@include('comments.create', $post)--}}
    </div>
</div>