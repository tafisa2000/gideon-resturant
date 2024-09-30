<?php

namespace App\Http\Controllers\pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\Category;

class MenuController extends Controller
{
    //
    public function allMenu()
    {
        // Fetch the latest menu items and all categories
        $menuItems = MenuItem::latest()->get();
        $categories = Category::all();
    
        // Return the view with the retrieved data
        return view('backend.menu.all_menu', [
            'menu' => $menuItems,
            'category' => $categories,
        ]);
    }
    


    public function StoreMenu(Request $request)
    {

    }
}
