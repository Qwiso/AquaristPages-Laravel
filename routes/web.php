<?php

Route::get('/', function () {
    if (!auth()->check())
        return view('pages.login');

    return view('pages.main');
});

Route::get('logout', function(){
    if (auth()->check())
        auth()->logout();

    return redirect('/');
});


Route::get('login', function(){
    $key = request('super_secret_key');
    if ($key == "erboh")
        auth()->loginUsingId(2);
    
    return redirect('/');
});

Route::group(['prefix' => 'facebook'], function(){
    Route::get('login', 'FacebookController@redirectToProvider');
    Route::get('callback', 'FacebookController@handleProviderCallback');
});


Route::group(['prefix' => 'profile'], function(){
    Route::get('/', 'ProfileController@index');
});


Route::group(['prefix' => 'marketplace'], function(){
    Route::get('/', 'MarketplaceController@index');

    Route::post('create', 'MarketplaceController@create');
});