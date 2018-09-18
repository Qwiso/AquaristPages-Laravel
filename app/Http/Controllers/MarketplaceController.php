<?php

namespace App\Http\Controllers;

use App\MarketItem;

class MarketplaceController extends Controller
{
    public function index() {
        return view('pages.marketplace');
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
}
