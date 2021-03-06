@extends('templates.main')

@section('content')
    <div class="row justify-content-center">
        <div class="col-8 bg-white py-3 border">
            <h2>Call For Testers</h2>
            <p>
                Are you interested in helping to test, possibly develop, this aquarist focused website?
                <br>
                I need a few savvy people who will get involved. Expect daily styling and functionality changes
                <br>
                <small><b>All feedback considered</b></small>
            </p>
            <div class="w-100 text-center">
                <small><b>Contact Me</b> - click to reveal</small>
            </div>
            <div class="w-100 d-flex flex-wrap justify-content-center pt-2">
                <div class="my-2">
                    <div class="btn btn-facebook mx-3" data-for="facebook" data-toggle="popover" data-html="true" data-trigger="click" data-placement="bottom" data-content="<a href='https://www.facebook.com/zjones5487'>https://www.facebook.com/zjones5487</a>"><i class="fab fa-facebook"></i> Facebook</div>
                </div>
                <div class="my-2">
                    <div class="btn btn-secondary mx-3" data-for="email" data-toggle="popover" data-html="true" data-trigger="click" data-placement="bottom" data-content="qwisodev@gmail.com"><i class="fa fa-envelope"></i> @gmail.com</div>
                </div>
            </div>
            <div style="padding-top: 0.5rem; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                <img class="img img-fluid" src="{{asset('preview.png')}}">
            </div>
        </div>
    </div>
@endsection

@section('post-script')
<script>
    let popovers = $('div[data-for]');
    popovers.on('click', function(){
        $(this).popover('show');
        popovers.not(this).popover('hide');
    });
</script>
@append