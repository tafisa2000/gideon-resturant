<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;

class PublicController extends Controller
{
    public function home()
    {
        $menus = MenuItem::latest()->get();
        return view('welcome', compact('menus'));
    }

    public function menu()
    {
        return view('menu_list');
    }

}
