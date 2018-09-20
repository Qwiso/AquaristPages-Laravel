<?php

namespace App\Http\Controllers;

use App\MarketItem;
use Storage;

class MarketplaceController extends Controller
{
    public function index() {
        $user = auth()->user();
        if (!$localItems = \Cache::get($user->id .'localItems')) {
            $nearbyZipcodes = $user->getZipcodeIdsByRadius();
            $localItems = MarketItem::whereNotNull('amount')->whereIn('zipcode_id', $nearbyZipcodes)->orderBY('created_at', 'desc')->get();
            \Cache::put($user->id.'localItems', $localItems, 1);
        }

        return view('pages.marketplace', compact('localItems'));
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

        $data = request('media_url');
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        \File::put(public_path('market_images\\' . $item->uuid . '.jpeg'), $data);

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

        \File::delete(public_path('market_images\\' . $item->uuid . '.jpeg'));

        $item->delete();
        return response('success');
    }


    public function update() {
        $updatedItem = json_decode(request('item'), true);
        $oldItem = MarketItem::where('uuid', $updatedItem['uuid'])->firstOrFail();
        if (auth()->id() != $oldItem->user_id) return response('stop that', 403);

        $data = request('media_url');
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        \File::put(public_path('market_images\\' . $oldItem->uuid . '.jpeg'), $data);

        $oldItem->update($updatedItem);
        return response()->json([
            'success' => true
        ]);
    }
}
