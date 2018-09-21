<?php

namespace App\Http\Controllers;

class CommentController extends Controller
{
    public function create() {
        $incoming = json_decode(request('comment'));
        $user = auth()->user();

        $newComment = new \App\Comment();
        $newComment->text = $incoming->text;
        $newComment->user_id = $user->id;

        $item = \App\MarketItem::where('uuid', $incoming->item_id)->firstOrFail();
        $item->comments()->create($newComment->toArray());

        return response()->json([
            'success' => true
        ]);
    }
}
