<?php

namespace App\Http\Controllers;

use App\MarketItem;

class MarketplaceController extends Controller
{
    public function index() {
        return view('pages.marketplace');
    }


    public function show($uuid) {
        $item = MarketItem::where('uuid', $uuid)->firstOrFail();
        return view('market_items.show', compact('item'));
    }


    public function create() {
        $item = new MarketItem(json_decode(request('item'), true));
        $item->uuid = md5($item->toJson());
        $item->zipcode_id = auth()->user()->zipcode->id;
        $newItem = auth()->user()->items()->create($item->toArray());
        return response()->json([
            'success' => true,
            'item' => $newItem
        ]);
    }


    public function delete() {
        $uuid = request('uuid');
        $item = MarketItem::where('uuid', $uuid)->firstOrFail();
        if (auth()->id() != $item->user_id) return response('stop that', 403);
        $item->delete();
        return response($uuid, 200);
    }


    public function update() {
        $updatedItem = json_decode(request('item'));
        $oldItem = MarketItem::where('uuid', $updatedItem->uuid)->firstOrFail();
        if (auth()->id() != $oldItem->user_id) return response('stop that', 403);
        $updatedItem = $oldItem->update($updatedItem->toArray());
        return response()->json([
            'success' => true,
            'item' => $updatedItem
        ]);
    }
}
