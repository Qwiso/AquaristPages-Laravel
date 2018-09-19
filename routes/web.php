<?php

Route::get('/', function () {
    if (!auth()->check())
        return view('pages.login');

    $nearbyZipcodes = auth()->user()->getZipcodeIdsByRadius();
    $items = \App\MarketItem::whereNotNull('amount')->where('amount', '>', 0)->whereIn('zipcode_id', $nearbyZipcodes)->orderBY('created_at', 'desc')->get();

    return view('pages.main', compact('items'));
});

Route::get('logout', function(){
    auth()->logout();
    return redirect('/');
});

Route::get('login', function(){
    $key = request('super_secret_key');

    switch ($key) {
        case "erboh":
            auth()->loginUsingId(2);
            break;
        case "erboh2":
            auth()->loginUsingId(3);
            break;
        case "erboh3":
            auth()->loginUsingId(4);
            break;
        case "erboh4":
            auth()->loginUsingId(5);
            break;
        case "erboh5":
            auth()->loginUsingId(6);
            break;
    }

    return redirect('/');
});


Route::group(['prefix' => 'facebook'], function(){
    Route::get('login', 'FacebookController@redirectToProvider');
    Route::get('callback', 'FacebookController@handleProviderCallback');
});


Route::group(['prefix' => 'profile'], function(){
    Route::get('/', 'ProfileController@index');
    Route::get('user/{id}', 'ProfileController@index');
});


Route::group(['prefix' => 'marketplace'], function(){
    Route::get('/', 'MarketplaceController@index');
    Route::get('item/edit/{id}', 'MarketplaceController@getEdit');
    Route::get('item/{id}', 'MarketplaceController@show');
    Route::post('create', 'MarketplaceController@create');
    Route::put('update', 'MarketplaceController@update');
    Route::delete('delete', 'MarketplaceController@delete');
});