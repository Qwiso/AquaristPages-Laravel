<?php

namespace App\Http\Controllers;

use App\MarketItem;

class MarketplaceController extends Controller
{
    public function index() {
        $nearbyZipcodes = auth()->user()->getZipcodeIdsByRadius();
        $statewideZipcodes = auth()->user()->getZipcodeIdsByState();

        $localItems = MarketItem::whereNotNull('amount')->whereIn('zipcode_id', $nearbyZipcodes)->orderBY('created_at', 'desc')->get();
        $stateItems = MarketItem::whereNotNull('amount')->whereIn('zipcode_id', $statewideZipcodes)->orderBY('created_at', 'desc')->get();

        return view('pages.marketplace', compact('localItems', 'stateItems'));
    }


    public function show($uuid) {
        $item = MarketItem::where('uuid', $uuid)->firstOrFail();
        return view('market_items.show', compact('item'));
    }


    public function getEdit($id) {
        $item = MarketItem::find($id);
        return view('market_items.edit', compact('item'))->render();
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
        $item_id = request('item_id');
        $item = MarketItem::find($item_id);
        if (auth()->id() != $item->user_id) return response('stop that', 403);
        $item->delete();
        return response('success');
    }


    public function update() {
        $updatedItem = json_decode(request('item'), true);
        $oldItem = MarketItem::where('uuid', $updatedItem['uuid'])->firstOrFail();
        if (auth()->id() != $oldItem->user_id) return response('stop that', 403);
        $oldItem->update($updatedItem);
        return response()->json([
            'success' => true
        ]);
    }
}
