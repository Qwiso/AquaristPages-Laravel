<div class="row pb-3">
    <div class="col">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-plus"></i> Create a New Item
        </button>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form_createMarketItem">
                <div class="row bg-white shadow-sm">
                    <div class="col pt-3">
                        <div class="row pb-3">
                            <div class="col">
                                <input type="text" class="form-control" name="title" placeholder="set the item name..." required>
                            </div>
                        </div>

                        <div class="row pb-3">
                            <div class="col">
                                <select class="form-control" name="category" required>
                                    <option value="" selected disabled>set item category</option>
                                    @foreach(DB::table('categories')->get() as $cat)
                                        <option value="{{$cat->name}}">{{strtoupper($cat->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row pb-3">
                            <div class="col">
                                <textarea rows="3" class="form-control" name="description" placeholder="describe your item..." required></textarea>
                            </div>
                        </div>

                        <div class="row pb-3">
                            <div class="col d-flex justify-content-around">
                                <div class="col">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hashtag" aria-hidden="true"></i></span>
                                        </div>
                                        <input type="number" class="form-control" min="0" step="1" name="amount" value="0">
                                    </div>
                                    <small>how many</small>
                                </div>

                                <div class="col">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-dollar-sign" aria-hidden="true"></i></span>
                                        </div>
                                        <input type="number" class="form-control" min="0.00" step="0.25" name="price" placeholder="0.00" required>
                                    </div>
                                    <small>price per unit</small>
                                </div>
                            </div>
                        </div>

                        <div class="row pb-3">
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-file-image" aria-hidden="true"></i></span>
                                    </div>
                                    {{--<input type="url" class="form-control" name="media_url" placeholder="imgur url...">--}}
                                    <input type="url" class="form-control" name="media_url" placeholder="imgur url..." onchange="imgurLinkChanged(this)">
                                </div>
                                <small>it is highly recommended to include images</small>
                            </div>
                        </div>

                        <div class="row pb-3">
                            <div class="col d-flex justify-content-end">
                                <button type="submit" class="btn btn-mine">Create</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@section('post-script')
<script>
    let albumid, isAlbum;

    $(function(){
        let itemForm = document.getElementById('form_createMarketItem');
        itemForm.addEventListener('submit', createMarketItemSubmit);
    });


    function imgurLinkChanged(input) {
        let link = input.value;
        let re = /\w+(?=[^/]*$)/;
        let hm = link.match(re);
        albumid = hm[0];
        if (link.includes('/a/') || link.includes('gallery')) {
            isAlbum = 1;
        } else {
            isAlbum = 0;
        }
        console.log(isAlbum);
    }


    function createMarketItemSubmit(e) {
        e.preventDefault();
        e.stopPropagation();

        let marketItem = {};
        marketItem.title = document.querySelector('input[name="title"]').value;
        marketItem.category = document.querySelector('select[name="category"]').value;
        marketItem.description = document.querySelector('textarea[name="description"]').value;
        marketItem.amount = document.querySelector('input[name="amount"]').value;
        marketItem.price = document.querySelector('input[name="price"]').value;

        if (isAlbum)
            marketItem.media_url = 'a/' + albumid;
        else
            marketItem.media_url = albumid;

        let data = {};
        data._token = "{{csrf_token()}}";
        data.item = JSON.stringify(marketItem);

        $.post("{{url('marketplace/create')}}", data, function(res){
            document.getElementById('form_createMarketItem').reset();
        });
    }
</script>
@endsection