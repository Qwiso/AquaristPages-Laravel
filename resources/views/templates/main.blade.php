<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta http-equiv="content-type" content="text/html" charset="utf-8">

    <!-- COMMON TAGS -->
    <meta charset="utf-8">
    <title>Aquarist Pages - {{$page->path or request()->path() == "/" ? "Home" : ucwords(request()->path())}}</title>

    <!-- Search Engine -->
    <meta name="description" content="{{$page->desc or "A social tool for your breeder, hobbyist, or club related needs"}}">
    <meta name="image" content="{{secure_asset('favicon.png')}}">

    <!-- Schema.org for Google -->
    <meta itemprop="name" content="Aquarist Pages - {{$page->path or ucwords(request()->path())}}">
    <meta itemprop="description" content="{{$page->desc or "A social tool for your breeder, hobbyist, or club related needs"}}">
    <meta itemprop="image" content="{{secure_asset('favicon.png')}}">

    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta name="og:title" content="Aquarist Pages - {{$page->path or ucwords(request()->path())}}">
    <meta name="og:description" content="{{$page->desc or "A social tool for your breeder, hobbyist, or club related needs"}}">
    <meta name="og:image" content="{{secure_asset('favicon.png')}}">
    <meta name="og:url" content="{{url('/')}}">
    <meta name="og:site_name" content="Aquarist Pages">
    <meta name="og:type" content="website">

    @yield('html-head')
    <!-- original svg located at https://openclipart.org/detail/84031/fish -->
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}"/>
    <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet=" href="//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .list-group-item {
            border: 0 !important;
            padding: .25rem .5rem !important;
        }

        textarea {
            resize: none !important;
        }

        @media (min-width: 576px){
            .modal-dialog {
                max-width: 800px !important;
            }
        }

        .btn-mine {
            color: #fff;
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
        .circle-overly {
            overflow: hidden;
            position: absolute;
            border: solid 1px #555;
            box-shadow: 0 0 0 200px rgba(0,0,0,0.8);
            border-radius:100px;
            width: 200px;
            height: 200px;
        }
    </style>
</head>
<body class="bg-light">

@include('templates.menubar')
@include('templates.toolbar')

<div class="container-fluid pb-3">
    @yield('content')
</div>

<script defer src="//use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="//stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<script>
    let albumid, isAlbum, marketItemImage, marketItemImageOrientation;

    $(function(){
        document.addEventListener('submit', function(e){
            e.preventDefault();
            e.stopPropagation();

            let form = e.target;
            let id = form.id;

            switch (id) {
                case "form_createMarketItem":
                    createMarketItemSubmit(form);
                    break;
                case "form_editMarketItem":
                    editMarketItemSubmit(form);
                    break;
                case "form_createComment":
                    createCommentSubmit(form);
                    break;
                case "form_marketplaceFilter":
                    marketplaceFilter(form);
                    break;
            }
        });
    });

    function marketplaceFilter(form) {
        let category = form.querySelector("select[name='category']").value;
        let radius = form.querySelector("select[name='radius']").value;
        let zipcode = form.querySelector("input[name='autocomplete_zipcode']").dataset.value;
        let url = "{{url('marketplace')}}?";

        if (category)
            url += "&category=" + category;

        if (radius)
            url += "&radius=" + radius;

        if(zipcode)
            url += "&zipcode=" + zipcode;

        window.location.href = url;
    }

    function deleteComment(commentId){
        if(!confirm('Delete your comment?!')) return;

        let data = {};
        data.comment_id = commentId;
        data._token = "{{csrf_token()}}";

        $.ajax({
            url: '{{url("comments")}}',
            type: 'DELETE',
            data: data,
            success: function() {
                window.location.reload();
            }
        });
    }

    function editItem(itemId){
        $.get("{{url('marketplace/item/edit')}}/" + itemId, function(res){
            $("#edit-item").remove();
            $("body").append(res);
            $("#edit-item").modal('show');
        });
    }

    function deleteItem(itemId){
        if(!confirm('Delete your listing?!')) return;

        let data = {};
        data.item_id = itemId;
        data._token = "{{csrf_token()}}";

        $.ajax({
            url: '{{url("marketplace")}}',
            type: 'DELETE',
            data: data,
            success: function() {
                window.location.reload();
            }
        });
    }

    function fileLoaded() {
        // Read in file
        var file = event.target.files[0];

        // Ensure it's an image
        if (file.type.match(/image.*/)) {

            // Get image orientation
            getImageOrientation(file, function(orientation) {
                marketItemImageOrientation = orientation;
            });

            // Resize and reorient the image
            var reader = new FileReader();
            reader.onload = function (readerEvent) {
                var image = new Image();
                image.onload = function (imageEvent) {

                    // Resize the image
                    var canvas = document.createElement('canvas'),
                            max_size = 720,
                            width = image.width,
                            height = image.height;
                    if (width > height) {
                        if (width > max_size) {
                            height *= max_size / width;
                            width = max_size;
                        }
                    } else {
                        if (height > max_size) {
                            width *= max_size / height;
                            height = max_size;
                        }
                    }
                    canvas.width = width;
                    canvas.height = height;
                    canvas.getContext('2d').drawImage(image, 0, 0, width, height);

                    var dataUrl = canvas.toDataURL('image/png');
                    resetOrientation(dataUrl, marketItemImageOrientation, function(correctedImage){
                        marketItemImage = correctedImage;
                        // REFACTOR
                        $("#form_createMarketItem .img-fluid")[0].src = marketItemImage;
                        $("#form_editMarketItem .img-fluid")[0].src = marketItemImage;
                    });
                };
                image.src = readerEvent.target.result;
            };

            reader.readAsDataURL(file);
        } else {
            // not an image file
        }
    }

    function getImageOrientation(file, callback) {
        var reader = new FileReader();

        reader.onload = function(event) {
            var view = new DataView(event.target.result);

            if (view.getUint16(0, false) != 0xFFD8) return callback(-2);

            var length = view.byteLength,
                    offset = 2;

            while (offset < length) {
                var marker = view.getUint16(offset, false);
                offset += 2;

                if (marker == 0xFFE1) {
                    if (view.getUint32(offset += 2, false) != 0x45786966) {
                        return callback(-1);
                    }
                    var little = view.getUint16(offset += 6, false) == 0x4949;
                    offset += view.getUint32(offset + 4, little);
                    var tags = view.getUint16(offset, little);
                    offset += 2;

                    for (var i = 0; i < tags; i++)
                        if (view.getUint16(offset + (i * 12), little) == 0x0112)
                            return callback(view.getUint16(offset + (i * 12) + 8, little));
                }
                else if ((marker & 0xFF00) != 0xFF00) break;
                else offset += view.getUint16(offset, false);
            }
            return callback(-1);
        };

        reader.readAsArrayBuffer(file.slice(0, 64 * 1024));
    }

    function resetOrientation(srcBase64, srcOrientation, callback) {
        var img = new Image();

        img.onload = function() {
            var width = img.width,
                    height = img.height,
                    canvas = document.createElement('canvas'),
                    ctx = canvas.getContext("2d");

            // set proper canvas dimensions before transform & export
            if (4 < srcOrientation && srcOrientation < 9) {
                canvas.width = height;
                canvas.height = width;
            } else {
                canvas.width = width;
                canvas.height = height;
            }

            // transform context before drawing image
            switch (srcOrientation) {
                case 2: ctx.transform(-1, 0, 0, 1, width, 0); break;
                case 3: ctx.transform(-1, 0, 0, -1, width, height ); break;
                case 4: ctx.transform(1, 0, 0, -1, 0, height ); break;
                case 5: ctx.transform(0, 1, 1, 0, 0, 0); break;
                case 6: ctx.transform(0, 1, -1, 0, height , 0); break;
                case 7: ctx.transform(0, -1, -1, 0, height , width); break;
                case 8: ctx.transform(0, -1, 1, 0, 0, width); break;
                default: break;
            }

            // draw image
            ctx.drawImage(img, 0, 0, width, height);

            // export base64
            callback(canvas.toDataURL('image/png'));
        };

        img.src = srcBase64;
    }

    function createMarketItemSubmit(form) {
        let marketItem = {};
        marketItem.title = form.querySelector('input[name="title"]').value;
        marketItem.category = form.querySelector('select[name="category"]').value;
        marketItem.description = form.querySelector('textarea[name="description"]').value;
//        let amount = form.querySelector('input[name="amount"]').value;
//        marketItem.amount = amount == '' ? 0 : amount;
        marketItem.price = form.querySelector('input[name="price"]').value;
        let data = {};
        data._token = "{{csrf_token()}}";
        data.item = JSON.stringify(marketItem);
        data.media_url = marketItemImage;
        data.zipcode_id = form.querySelector('input[name="autocomplete_zipcode"]').dataset.zipid;

        $.post("{{url('marketplace')}}", data, function(res){
            if (res.success)
                window.location.reload();
            else
                console.log(res);
        });
    }

    function editMarketItemSubmit(form){
        let marketItem = {};
        marketItem.uuid = form.querySelector('input[name="uuid"]').value;
        marketItem.title = form.querySelector('input[name="title"]').value;
        marketItem.category = form.querySelector('select[name="category"]').value;
        marketItem.description = form.querySelector('textarea[name="description"]').value;
//        let amount = form.querySelector('input[name="amount"]').value;
//        marketItem.amount = amount == '' ? 0 : amount;
        marketItem.price = form.querySelector('input[name="price"]').value;

        let data = {};
        data._token = "{{csrf_token()}}";
        data.item = JSON.stringify(marketItem);
        data.media_url = marketItemImage;

        $.ajax({
            url: '{{url("marketplace")}}',
            type: 'PUT',
            data: data,
            success: function() {
                window.location.reload();
            }
        });
    }

    function createCommentSubmit(form){
        let box = form.querySelector('textarea');

        let comment = {};
        comment.text = box.value;
        comment.item_id = box.dataset.itemId;

        if (comment.text.length == 0 || comment.text == "") {
            box.title = "Comments cannot be blank";
            $(box).tooltip('show');
            setTimeout(function(){
                $(box).tooltip('hide');
            }, 3000);
            return;
        }

        if (comment.text.length > 420) {
            box.title = 420 - comment.text.length + " too many characters";
            $(box).tooltip('show');
            setTimeout(function(){
                $(box).tooltip('hide');
            }, 3000);
            return;
        }

        let data = {};
        data._token = "{{csrf_token()}}";
        data.comment = JSON.stringify(comment);

        $.post("{{url('comments')}}", data, function(res){
            if (res.success)
                window.location.reload();
            else
                console.log(res);
        });
    }
</script>
@yield('post-script')
</body>
</html>
