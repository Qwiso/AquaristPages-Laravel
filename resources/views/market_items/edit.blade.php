<div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form_createMarketItem">
                <div class="row bg-white shadow-sm">
                    <div class="col pt-3">
                        <div class="row pb-3">
                            <div class="col">
                                <input type="text" class="form-control" name="title" value="{{$item->title}}" placeholder="set the item name..." required>
                            </div>
                        </div>

                        <div class="row pb-3">
                            <div class="col">
                                <select class="form-control" name="category" required>
                                    @foreach(DB::table('categories')->get() as $cat)
                                        @if ($cat == $item->category)
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
                                <textarea rows="3" class="form-control" name="description" placeholder="describe your item..." required>{{$item->description}}</textarea>
                            </div>
                        </div>

                        <div class="row pb-3">
                            <div class="col d-flex justify-content-around">
                                <div class="col">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hashtag" aria-hidden="true"></i></span>
                                        </div>
                                        <input type="number" class="form-control" min="0" step="1" name="amount" value="{{$item->amount}}" placeholder="0">
                                    </div>
                                    <small>how many</small>
                                </div>

                                <div class="col">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-dollar-sign" aria-hidden="true"></i></span>
                                        </div>
                                        <input type="number" class="form-control" min="0.00" step="0.25" name="price" value={{$item->price}} placeholder="0.00" required>
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
                                    <img id="image-preview" width="245px" src="{{$item->media_url}}">
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
        let albumid, isAlbum, marketItemImage, marketItemImageOrientation;

        $(function(){
            let itemForm = document.getElementById('form_createMarketItem');
            itemForm.addEventListener('submit', createMarketItemSubmit);
        });

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

                        var dataUrl = canvas.toDataURL('image/jpeg');
                        resetOrientation(dataUrl, marketItemImageOrientation, function(correctedImage){
                            marketItemImage = correctedImage;
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
                callback(canvas.toDataURL('image/jpeg'));
            };

            img.src = srcBase64;
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
            marketItem.media_url = marketItemImage;

            let data = {};
            data._token = "{{csrf_token()}}";
            data.item = JSON.stringify(marketItem);

            $.ajax({
                type: "PUT",
                contentType: "application/json; charset=utf-8",
                url: "{{url('marketplace/update')}}",
                data: data,
                success: function (result) {
                    document.getElementById('form_createMarketItem').reset();
                }
            });
        }
    </script>
@append