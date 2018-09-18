<div class="col d-flex">
@foreach($items as $item)
    @include('market_items.show', $item)
@endforeach
</div>

@section('post-script')
<script>
    let images = document.querySelectorAll("img[data-media]");

//    images.forEach(function(a, b){
//        let media_url = a.dataset.media;
//        let endpoint;
//
//        if (media_url.includes("a/"))
//            endpoint = "https://api.imgur.com/3/album/"+media_url.replace('a/', '')+"/images?client_id=005fd711b7df2fe";
//        else
//            endpoint = "https://api.imgur.com/3/image/"+media_url+"/images?client_id=005fd711b7df2fe";
//
//
//        const req = new XMLHttpRequest();
//        req.onreadystatechange = function(e){
//            if (this.readyState != 4 || this.status != 200) return;
//            let res =  JSON.parse(this.responseText);
//            a.src = res.data.link;
//        };
//        req.open("GET", endpoint, false);
//        req.send();
//    });
</script>
@append