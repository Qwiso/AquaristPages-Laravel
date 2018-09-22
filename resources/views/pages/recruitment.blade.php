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
                <div class="btn btn-facebook mx-3" data-for="facebook" data-toggle="popover" data-html="true" data-trigger="click" data-placement="bottom" data-content="<a href='https://www.facebook.com/zjones5487'>https://www.facebook.com/zjones5487</a>"><i class="fab fa-facebook"></i> Facebook</div>
                <div class="btn btn-secondary mx-3" data-for="email" data-toggle="popover" data-html="true" data-trigger="click" data-placement="bottom" data-content="qwisodev@gmail.com"><i class="fa fa-envelope"></i> @gmail.com</div>
            </div>
        </div>
    </div>
@endsection

@section('post-script')
<script>
    $('div[data-for]').on('click', function(){

        $(this).popover('show');

        $('div[data-for]').not(this).popover('hide');
//        let dataFor = this.dataset.for;
//
//        $(this).popover({
//            html: true,
//            content: function(){
//                return document.getElementById("popover-content-" + dataFor);
//            }
//        }).popover('show');
    });
</script>
@append