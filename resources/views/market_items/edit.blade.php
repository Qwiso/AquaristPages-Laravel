<div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row d-flex justify-content-end pr-3">
                    <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form id="form_editMarketItem">
                    <div class="row bg-white">
                        <div class="col pt-3">

                            <div class="row pb-3">
                                <div class="col">
                                    <select class="form-control" name="category" required>
                                        @foreach(DB::table('categories')->get() as $cat)
                                            @if ($cat->name == $item->category)
                                                <option selected value="{{$cat->name}}">{{strtoupper($cat->name)}}</option>
                                            @else
                                                <option value="{{$cat->name}}">{{strtoupper($cat->name)}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row pb-3">
                                <div class="col">
                                    <input type="text" class="form-control" name="title" value="{{$item->title}}" placeholder="set the item name..." required>
                                </div>
                            </div>

                            <div class="row pb-3">
                                <div class="col">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-dollar-sign" aria-hidden="true"></i></span>
                                        </div>
                                        <input type="number" class="form-control" min="0.00" step="0.25" name="price" value={{$item->price}} placeholder="0.00" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row pb-3">
                                <div class="col">
                                    <textarea rows="3" class="form-control" name="description" placeholder="describe your item...">{{$item->description}}</textarea>
                                </div>
                            </div>

                            <div class="row pb-3">
                                <div class="col">
                                    <div class="input-group d-flex flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-file-image" aria-hidden="true"></i></span>
                                        </div>
                                        <input data-viewtype="edit" type="file" accept="image/*" name="media_url" onchange="fileLoaded(this)">
                                    </div>
                                    <img src="{{asset('market_images/'.$item->uuid.'.png')}}" class="img-fluid d-block mx-auto pt-3">
                                </div>
                            </div>

                            <div class="row pb-3">
                                <div class="col d-flex justify-content-between">
                                    <input hidden type="text" name="uuid" value="{{$item->uuid}}">
                                    <button type="button" class="btn btn-danger" onclick="deleteItem({{$item->id}})">Delete</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>