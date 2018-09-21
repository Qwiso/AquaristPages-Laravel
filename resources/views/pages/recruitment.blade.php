@extends('templates.main')

@section('content')
    <h2>Call For Testers</h2>
    <div class="row pt-2">
        <div class="col">
            <p>
                Are you interested in helping to test, possibly develop, this aquarist focused website?
                <br>
                I need a few savvy people who will get involved. Expect daily styling and functionality changes
            </p>
            <small><b>All feedback considered.</b></small>
        </div>
    </div>

    <div class="row">
        <div class="w-100 text-center">
            <small><b>Contact Me</b></small>
        </div>
        <div class="col d-flex justify-content-center pt-2">
            <div class="btn btn-facebook mx-3" onclick="window.location.href='https://www.facebook.com/zjones5487'"><i class="fab fa-facebook"></i> Facebook</div>
            <div class="btn btn-facebook mx-3" onclick="toggleEmailPopover()" data-trigger="manual" data-placement="bottom" data-content="qwisodev@gmail.com"><i class="fa fa-envelope"></i> @gmail.com</div>
        </div>
    </div>
    <script>
        function toggleEmailPopover(){
            $(document.querySelector("div[data-content]")).popover("toggle");
        }
    </script>
@endsection