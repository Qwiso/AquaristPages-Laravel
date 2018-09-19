<div class="col pb-3">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create-item">
        <i class="fa fa-plus"></i> Create a New Item
    </button>
</div>

<div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <input type="number" class="form-control" min="0" step="1" name="amount" placeholder="0">
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
                                    {{--<input type="url" class="form-control" name="media_url" placeholder="imgur url..." onchange="imgurLinkChanged(this)">--}}
                                    <input type="file" accept="image/*" name="media_url" onchange="fileLoaded()" required>
                                    <img class="img-fluid">
                                </div>
                            </div>
                        </div>

                        <div class="row pb-3">
                            <div class="col d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Create</button>
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
    $(function(){
        let itemForm = document.getElementById('form_createMarketItem');
        itemForm.addEventListener('submit', createMarketItemSubmit);
    });
</script>
@append