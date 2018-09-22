<div class="container-fluid d-none d-md-block pb-2">
    <div class="row bg-secondary justify-content-around">
        <a href="{{url('/')}}" class="btn btn-secondary px-5">Aquarist Pages</a>
        @if(auth()->check())
            <div>
                <a href="{{url('profile')}}/{{auth()->user()->uuid}}" class="btn btn-secondary">Profile</a>
                <a href="{{url('marketplace')}}" class="btn btn-secondary">Marketplace</a>
            </div>
        @endif
    </div>
</div>