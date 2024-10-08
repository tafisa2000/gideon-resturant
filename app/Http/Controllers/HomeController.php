<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;

class HomeController extends Controller
{
    public function index()
    {
        $menus = MenuItem::latest()->get();
        return view('index', compact('menus'));
    }
}
