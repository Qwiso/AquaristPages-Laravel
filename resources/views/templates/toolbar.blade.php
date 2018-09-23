<div class="container-fluid d-md-none pb-2">
    <div class="row bg-secondary justify-content-center py-2">
        <a href="{{url('/')}}" class="btn btn-default btn-sm border mr-2"><i class="text-white fa fa-fw fa-home"></i></a>
        @if(auth()->check())
            <div>
                <div onclick="showMessages()" class="btn btn-default btn-sm border mr-2"><i class="fa fa-envelope"></i></div>
                <a href="{{url('profile')}}/{{auth()->user()->uuid}}" class="btn btn-default btn-sm border mr-2"><i class="text-white fa fa-fw fa-user"></i></a>
                <a href="{{url('marketplace')}}" class="btn btn-default btn-sm border mr-2"><i class="text-white fa fa-fw fa-dollar-sign"></i></a>
            </div>
        @endif
    </div>
</div>