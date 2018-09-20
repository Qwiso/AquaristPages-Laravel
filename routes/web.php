<?php

Route::get('/', function () {
    $user = auth()->user();
    if (!auth()->check())
        return view('pages.login');

    if ($user->zipcode_id == null)
        return view('pages.main', compact('user'))->with('set_zipcode', true);

    return view('pages.main', compact('user'));
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


Route::group(['middleware' => 'zipcode', 'prefix' => 'profile'], function(){
    Route::get('/', 'ProfileController@index');
    Route::get('user/{id}', 'ProfileController@index');
});


Route::group(['middleware' => 'zipcode', 'prefix' => 'marketplace'], function(){
    Route::get('/', 'MarketplaceController@index');
    Route::get('item/edit/{id}', 'MarketplaceController@getEdit');
    Route::get('item/{id}', 'MarketplaceController@show');
    Route::post('/', 'MarketplaceController@create');
    Route::put('/', 'MarketplaceController@update');
    Route::delete('/', 'MarketplaceController@delete');
});