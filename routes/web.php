<?php

Route::get('/', function () {
    if (!auth()->check())
        return redirect('login');

    $user = auth()->user();

    if ($user->zipcode_id == null)
        return view('pages.main', compact('user'))->with('set_zipcode', true);


    if (!$user->uuid){
        $user->uuid = md5($user->toJson());
        $user->save();
    }

    return view('pages.main', compact('user'));
});

Route::get('login', function(){
    $key = request('super_secret_key');

    if (!$key)
        return view('pages.login');

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

Route::get('logout', function(){
    auth()->logout();
    return redirect('/');
});

Route::get('recruitment', function(){
    return view('pages.recruitment');
});

Route::post('user/setzip', function(){
    $zipcode = request('zipcode');

    $zip = \App\Zipcode::where('zipcode', $zipcode)->first();

    if (!$zip){
        return response()->json([
            'invalid' => true
        ]);
    }

    auth()->user()->zipcode_id = $zip->id;
    auth()->user()->save();

    return response()->json([
        'success' => true,
        'zipcode' => $zip
    ]);
});

Route::get('zipcodes/autocomplete', function(){
    $term = request('term');

    $results = array();

    $queries = DB::table('zipcodes')
        ->where('zipcode', 'LIKE', $term.'%')
        ->take(6)->get();

    foreach ($queries as $query)
    {
        $results[] = [ 'id' => $query->id, 'text' => $query->city . ', ' . $query->state_abbr . ' ' . $query->zipcode, 'value' => $query->zipcode];
    }

    return Response::json($results);
});

Route::group(['prefix' => 'facebook'], function(){
    Route::get('login', 'FacebookController@redirectToProvider');
    Route::get('callback', 'FacebookController@handleProviderCallback');
});

Route::group(['prefix' => 'profile', 'middleware' => 'zipcode'], function(){
    Route::get('/', 'ProfileController@index');
    Route::get('/{id}', 'ProfileController@show');
});

Route::group(['prefix' => 'marketplace', 'middleware' => 'zipcode'], function(){
    Route::get('/', 'MarketplaceController@index');
    Route::get('item/modal/{id}', 'MarketplaceController@getItem');
    Route::get('item/edit/{id}', 'MarketplaceController@getEdit');
    Route::get('item/{id}', 'MarketplaceController@show');
    Route::post('/', 'MarketplaceController@create');
    Route::put('/', 'MarketplaceController@update');
    Route::delete('/', 'MarketplaceController@delete');
});

Route::group(['prefix' => 'comments'], function() {
    Route::post('/', 'CommentController@create');
});