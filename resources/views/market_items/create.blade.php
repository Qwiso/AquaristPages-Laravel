<div class="col">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create-item">
        <i class="fa fa-plus"></i> Create a New Item
    </button>
</div>

<div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body py-2">
                <div class="row d-flex justify-content-end pr-3">
                    <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form id="form_createMarketItem">
                    <div class="row bg-white">
                        <div class="col pt-3">

                            <div class="row pb-3">
                                <div class="col">
                                    <select class="form-control" name="category" required>
                                        <option value="" selected disabled>Choose a Category</option>
                                        @foreach(DB::table('categories')->get() as $cat)
                                            <option value="{{$cat->name}}">{{strtoupper($cat->name)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row pb-3">
                                <div class="col">
                                    <input type="text" class="form-control" name="title" placeholder="What is the item?" required>
                                </div>
                            </div>

                            <div class="row pb-3">
                                <div class="col">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-dollar-sign" aria-hidden="true"></i></span>
                                        </div>
                                        <input type="number" class="form-control" min="0.00" step="0.25" name="price" placeholder="0.00" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row pb-3">
                                <div class="col">
                                    <textarea rows="3" class="form-control" name="description" placeholder="Describe your item... (optional)"></textarea>
                                </div>
                            </div>

                            <div class="row pb-3">
                                <div class="col">
                                    @include('market_items.setzip')
                                </div>
                            </div>

                            <div class="row pb-3">
                                <div class="col">
                                    <div class="input-group d-flex flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-file-image" aria-hidden="true"></i></span>
                                        </div>
                                        <input data-viewtype="create" type="file" accept="image/*" name="media_url" onchange="fileLoaded(this)" required>
                                    </div>
                                    <img class="img-fluid d-block mx-auto pt-3">
                                </div>
                            </div>

                            <div class="row">
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
</div>