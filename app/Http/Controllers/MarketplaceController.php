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
        $newItem = auth()->user()->items()->create($item->toArray());
        return response()->json([
            'success' => true,
            'item' => $newItem
        ]);
    }
}
