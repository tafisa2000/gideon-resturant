<?php

namespace App\Http\Controllers\pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\Category;
use Carbon\Carbon;

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
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'category' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $menu = new MenuItem();


        $menu->name = $request->name;
        $menu->price = $request->price;
        $menu->description = $request->description;
        $menu->category_id = $request->category;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $menu->image_url = 'images/' . $imageName;
        }
        $menu->save();
        $notification = array(
            'message' => 'Menu Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.menu')->with($notification);
    }


    public function DeleteMenu($id)
    {

        MenuItem::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Menu Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function EditMenu(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|integer|exists:menu_items,id',
        ]);

        $menu_id = $request->menu_id;
        $menu = MenuItem::find($menu_id);

        if (!$menu) {
            return response()->json(['error' => 'Menu item not found.'], 404);
        }
        $data = [
            'id' => $menu->id,
            'name' => $menu->name,
            'price' => $menu->price,
            'description' => $menu->description,
            'category_id' => $menu->category_id,
            'image_url' => asset('images/' . $menu->image),
        ];
        return response()->json($data);
    }

    public function UpdateMenu(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'category' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $menu_id = $request->id;
        $menu = MenuItem::findOrFail($menu_id);
        if ($request->hasFile('image')) {
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');

            $menu->update([
                'image' => $imagePath,
            ]);
        }
        $menu->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Menu Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.menu')->with($notification);
    }
}