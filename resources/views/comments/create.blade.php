<div class="border bg-white p-2">
    {{--<style scoped>--}}
        {{--/*div.editbox[contenteditable] { display: inline-block; }*/--}}
        {{--/*div.editbox[contenteditable] br { display: none; }*/--}}
        {{--/*div.editbox[contenteditable]:empty::before {*/--}}
            {{--/*content: attr(data-placeholder);*/--}}
            {{--/*display: inline-block;*/--}}
        {{--/*}*/--}}
    {{--</style>--}}
    <form id="form_createComment">
        {{--<div onkeyup="doshit(this)" data-toggle="tooltip" data-trigger="manual" data-placement="bottom" data-item-id="{{$item->id}}" class="editbox w-100 p-2 border" contenteditable="true" data-placeholder="Leave a comment..."></div>--}}
        <textarea required rows="3" maxlength="420" class="form-control" placeholder="Leave a comment..." data-item-id="{{$item->uuid}}"></textarea>
        <div class="w-100 d-flex justify-content-end pt-3 pb-1">
            {{--<button class="btn btn-primary float-right" type="button"><i class="fa fa-paperclip"></i></button>--}}
            <button class="btn btn-primary btn-sm" type="submit">Post</button>
        </div>
    </form>
</div>