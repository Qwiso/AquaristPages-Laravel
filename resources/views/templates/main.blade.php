<!DOCTYPE html>
<html>
<head>
    <title>{{env('APP_NAME')}}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta http-equiv="content-type" content="text/html" charset="utf-8">
    @yield('html-head')
    <link rel="shortcut icon" href="/favicon.ico"/>
    <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet=" href="//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        input {
            /*border-radius: 20px !important;*/
        }
        hr {
            margin-top: 0.5rem !important;
            margin-bottom: 0.5rem !important;
        }
        .btn-mine:hover {
            color: #fff;
            background-color: #d5d5d5;
            border-color: rgba(0,0,0,0.2);
        }
        .btn-facebook {
            color: #fff;
            background-color: #3b5998;
            border-color: rgba(0,0,0,0.2);
        }
        .btn-twitch {
            color: #fff;
            background-color: #6441A4;
            border-color: rgba(0,0,0,0.2);
        }
        .btn-amazon {
            color: #fff;
            background-color: #ff9900;
            border-color: rgba(0,0,0,0.2);
        }
        .btn-patreon {
            color: #fff;
            background-color: #F96854;
            border-color: rgba(0,0,0,0.2);
        }

        .active img {
            margin: 0 auto;
        }

        .sidebar-item:hover {
            transition: 300ms cubic-bezier(.08,.52,.52,1) background-color, 400ms cubic-bezier(.08,.52,.52,1) border-color, 400ms cubic-bezier(.08,.52,.52,1) opacity;
            cursor: pointer;
            background-color: #f9f2bd;
        }

        .list-group-item {
            border: 0 !important;
            padding: .25rem .5rem !important;
        }
    </style>
</head>
<body class="bg-light" style="height: auto; min-height: 100%;">
<div class="container-fluid">
    <div class="row bg-secondary">
        <div class="col">
            <a href="{{url('/')}}" class="btn btn-secondary">Aquarist Pages</a>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row justify-content-around pt-3">
        @if(auth()->check())
            <div class="col-md-2">
                @include('templates.sidebar')
            </div>
        @endif
        <div class="col-md-8">
            @yield('content')
        </div>
    </div>
</div>
<script defer src="//use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="//stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<script src="{{asset('js/bootstrap-wysiwyg.js')}}"></script>
<script>
    $(function(){
        var carousels = $(".carousel");
        $.each(carousels, function(index, carousel){
            createImgurAlbumElement(carousel);
        });
    });

    function createImgurAlbumElement(carousel) {
        let carousel_id = carousel.id;
        let media_url = carousel.dataset.media;
        let endpoint;

        if (media_url.includes("a/"))
            endpoint = "https://api.imgur.com/3/album/"+media_url.replace('a/', '')+"/images?client_id=005fd711b7df2fe";
        else
            endpoint = "https://api.imgur.com/3/image/"+media_url+"/images?client_id=005fd711b7df2fe";

        $.get(endpoint, function(res){
            let first = true;
            let count = 0;
            let car = $(carousel);
            let inner = $("#"+carousel_id+"_inner");

            if (res.data.length) {
                $.each(res.data, function(a, b){
                    if (first) {
                        first = false;
                        inner.append("<div class='active carousel-item'><img height='280px' src='"+b.link+"'></div>");
                        $("#"+carousel_id+"_indicators").append("<li data-target='#"+carousel_id+"' data-slide-to='" + count++ +"' class='active'></li>");
                    } else {
                        inner.append("<div class='carousel-item'><img height='280px'></div>");
                        $("#"+carousel_id+"_indicators").append("<li data-target='#"+carousel_id+"' data-slide-to='" + count++ +"'></li>");
                    }
                });
                car.carousel({
                    'interval': false
                });
                car.on('slide.bs.carousel', function(event){
                    $(event.relatedTarget).find('img')[0].src = res.data[event.to].link;
                });
            } else {
                car.html("<img style='max-height: 280px;' height='280px' src='"+res.data.link+"' class='img img-fluid'>");
            }
        });
    }
</script>
@yield('post-script')
</body>
</html>
