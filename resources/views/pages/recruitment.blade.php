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
                <small><b>Contact Me</b> - click to reveal url or email</small>
            </div>
            <div class="w-100 d-flex justify-content-center pt-2">
                <div class="btn btn-facebook mx-3" onclick="togglePopover(this)" data-for="facebook" data-placement="bottom" data-content="https://www.facebook.com/zjones5487"><i class="fab fa-facebook"></i> Facebook</div>
                <div class="btn btn-secondary mx-3" onclick="togglePopover(this)" data-for="email" data-trigger="manual" data-placement="bottom" data-content="qwisodev@gmail.com"><i class="fa fa-envelope"></i> @gmail.com</div>
            </div>
        </div>
    </div>
@endsection

@section('post-script')
<script>
    $('div[data-content]').on('click', function(){
        $('div[data-content]').not(this).popover('hide');
    });
    function togglePopover(target){
        $(target).popover('toggle');
    }
</script>
@append