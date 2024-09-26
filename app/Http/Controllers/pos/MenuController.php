<?php

namespace App\Http\Controllers\pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    //
    public function Allmenu()
    {

        // $category = Category::latest()->get(); compact('category')
        return view('backend.menu.all_menu');
    } // End Method
}
