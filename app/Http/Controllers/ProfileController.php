<?php

namespace App\Http\Controllers;

use App\User;

class ProfileController extends Controller
{
    public function index() {
        $user = auth()->user();
        $user->load('zipcode');

        $items = $user->items()->orderBy('created_at', 'desc')->get();

        return view('pages.profile', compact('user', 'items'));
    }


    public function show($uuid){
        $user = User::where('uuid', $uuid)->firstOrFail();
        $items = $user->items()->orderBy('created_at', 'desc')->get();
        return view('pages.profile', compact('user', 'items'));
    }
}
