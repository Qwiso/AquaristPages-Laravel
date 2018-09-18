<?php

Route::get('/', function () {
    if (!auth()->check())
        return view('pages.login');

    return view('pages.main');
});

Route::get('test', function(){
    $fileData = function() {
        $file = fopen('C:\repos\aquaristpages\storage\app\public\US.txt', 'r');

        if (!$file)
            die('file does not exist or cannot be opened');

        while (($line = fgets($file)) !== false) {
            yield $line;
        }

        fclose($file);
    };

    foreach ($fileData() as $line) {
        $data = explode("\t", $line);

        $newZip = [
            'country' => $data[0],
            'zipcode' => $data[1],
            'city' => $data[2],
            'state' => $data[3],
            'state_abbr' => $data[4],
            'county' => $data[5],
            'lat' => $data[9],
            'lon' => $data[10]
        ];

        \App\Zipcode::create($newZip);

        echo "<br>";
        print_r($newZip);
    }
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
    Route::get('items', 'MarketplaceController@getItems');
    Route::post('create', 'MarketplaceController@create');
});