@extends('templates.main')

@section('content')
    <div class="modal fade" id="create-message" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body py-2">
                    <div class="row d-flex justify-content-end pr-3">
                        <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <form id="form_createMessage" class="pt-3">
                        <textarea required rows="3" maxlength="2000" class="form-control" placeholder="What will you say?"></textarea>
                        <div class="w-100 d-flex justify-content-end pt-3 pb-1">
                            {{--<button class="btn btn-primary float-right" type="button"><i class="fa fa-paperclip"></i></button>--}}
                            <button class="btn btn-primary btn-sm" type="submit">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('market_items.create')
    @include('market_items.list', $items)
@endsection