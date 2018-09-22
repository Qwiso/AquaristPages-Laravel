<?php

namespace App\Http\Controllers;

use App\MarketItem;
use App\Zipcode;
use Illuminate\Database\Eloquent\Builder;

class MarketplaceController extends Controller
{
    public function index() {
        $user = auth()->user();
        if(request('zipcode')){
            $zipcode = Zipcode::where('zipcode', request('zipcode'))->firstOrFail();
        } else {
            $zipcode = $user->zipcode;
        }

        switch(request('radius')){
            case 10:
                $nearbyZipcodes = $user->getZipcodeIdsByRadiusFrom(10, $zipcode);
                break;
            case 25:
                $nearbyZipcodes = $user->getZipcodeIdsByRadiusFrom(25, $zipcode);
                break;
            case 50:
                $nearbyZipcodes = $user->getZipcodeIdsByRadiusFrom(50, $zipcode);
                break;
            case 50:
                $nearbyZipcodes = $user->getZipcodeIdsByRadiusFrom(100, $zipcode);
                break;
            case "state":
                $nearbyZipcodes = $user->getZipcodeIdsByState($user->zipcode->state);
                break;
            default:
                $nearbyZipcodes = $user->getZipcodeIdsByRadiusFrom(25, $zipcode);
                break;
        }

        switch(request('category')){
            case "flora":
                $cat = "flora";
                break;
            case "fauna":
                $cat = "fauna";
                break;
            case "hardware":
                $cat = "hardware";
                break;
            default:
                $cat = null;
                break;
        }

        if (!$cat)
            $localItems = MarketItem::whereNotNull('amount')->whereIn('zipcode_id', $nearbyZipcodes)->orderBY('created_at', 'desc')->with('zipcode')->get();
        else
            $localItems = MarketItem::whereNotNull('amount')->whereIn('zipcode_id', $nearbyZipcodes)->where('category', $cat)->orderBY('created_at', 'desc')->with('zipcode')->get();

        return view('pages.marketplace', compact('user', 'zipcode', 'localItems'));
    }


    public function getItem($uuid) {

        $item = MarketItem::where('uuid', $uuid)->with(['user','zipcode',
            'comments' => function($q){
                $q->with('user')->take(5);
            }])->firstOrFail();

        if (!\Cache::get($item->uuid.'_map_preview'))
        {
            $radius_map = base64_encode(file_get_contents('https://maps.googleapis.com/maps/api/staticmap?center='.$item->zipcode->lat.','.$item->zipcode->lon.'&zoom=12&scale=1&size=400x200&maptype=roadmap&format=png&visual_refresh=true&key=AIzaSyCYHkj8sSYIxtHm_guGKtkxqJTRTPF4luE'));
            $radius_map = "data:image/png;base64,$radius_map";
            \Cache::put('_map_preview', $radius_map, $expires = now()->addDays(3));
        }

        return view('market_items.modal', compact('item', 'radius_map'))->render();
    }


    public function getEdit($id) {
        $item = MarketItem::find($id);
        return view('market_items.edit', compact('item'))->render();
    }


    public function show($uuid) {
        $radius_map = base64_encode(file_get_contents('https://maps.googleapis.com/maps/api/staticmap?center=33.8206,-84.3549&zoom=12&scale=1&size=400x200&maptype=roadmap&format=png&visual_refresh=true&key=AIzaSyCYHkj8sSYIxtHm_guGKtkxqJTRTPF4luE'));
        $radius_map = "data:image/png;base64,$radius_map";

        $item = MarketItem::where('uuid', $uuid)->with(['zipcode',
            'comments' => function($q){
                $q->with('user')->take(5);
            }])->firstOrFail();

        return view('market_items.show', compact('item', 'radius_map'));
    }


    public function create() {
        $item = new MarketItem(json_decode(request('item'), true));
        if (!$zipcode = Zipcode::find(request('zipcode_id'))) return response()->json(['failed'=>true,'message'=>'not a valid zipcode_id']);
        $item->zipcode_id = request('zipcode_id');
        $item->uuid = md5($item->toJson());

        $data = request('media_url');
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        \File::put(public_path('market_images/' . $item->uuid . '.png'), $data);

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

        \File::delete(public_path('market_images/' . $item->uuid . '.png'));

        $item->delete();
        return response('success');
    }


    public function update() {
        $updatedItem = json_decode(request('item'), true);
        $oldItem = MarketItem::where('uuid', $updatedItem['uuid'])->firstOrFail();
        if (auth()->id() != $oldItem->user_id) return response('stop that', 403);

        $image = request('media_url');
        if ($image) {
            list($type, $image) = explode(';', $image);
            list(, $image)      = explode(',', $image);
            $image = base64_decode($image);
            \File::put(public_path('market_images/' . $oldItem->uuid . '.png'), $image);
        }

        $oldItem->update($updatedItem);

        return response()->json([
            'success' => true
        ]);
    }
}
