<?php

namespace App\Http\Controllers;

class ProfileController extends Controller
{
    public function index() {
        $user = auth()->user();
        $items = $user->items()->orderBy('created_at', 'desc')->get();

        return view('pages.profile', compact('items'));
    }
}
