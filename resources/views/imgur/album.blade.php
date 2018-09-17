<div id="carousel_{{$item->id}}" data-media="{{$item->media_url}}" class="carousel slide d-flex justify-content-center">
    <ol id="carousel_{{$item->id}}_indicators" class="carousel-indicators"></ol>
    <div id="carousel_{{$item->id}}_inner" class="carousel-inner"></div>
    <a class="carousel-control-prev" href="#carousel_{{$item->id}}" role="button" data-slide="prev" style="background-color: #696969">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel_{{$item->id}}" role="button" data-slide="next" style="background-color: #696969">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>