<?php

namespace App\Http\Controllers;

use App\Comment;

class CommentController extends Controller
{
    public function create() {
        $incoming = json_decode(request('comment'));
        $user = auth()->user();

        $newComment = new Comment();
        $newComment->text = $incoming->text;
        $newComment->user_id = $user->id;

        $item = \App\MarketItem::where('uuid', $incoming->item_id)->firstOrFail();
        $item->comments()->create($newComment->toArray());

        return response()->json([
            'success' => true
        ]);
    }

    public function delete() {
        $comment_id = request('comment_id');
        $comment = Comment::find($comment_id);
        if (auth()->id() != $comment->user_id) return response('stop that', 403);
        $comment->delete();
        return response('success');
    }
}
