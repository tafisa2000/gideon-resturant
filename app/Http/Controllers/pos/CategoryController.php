<?php

namespace App\Http\Controllers\pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\Carbon;

class CategoryController extends Controller
{
    public function AllCategory()
    {

        $category = Category::latest()->get();
        return view('backend.category.all_category', compact('category'));
    } // End Method



    public function StoreCategory(Request $request)
    {
        // Validate the request data
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        // Insert the category into the database
        Category::insert([
            'name' => $request->category_name,
            'created_at' => Carbon::now(),
        ]);

        // Create a notification message
        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );

        // Redirect to the all categories page with a notification
        return redirect()->route('all.category')->with($notification);
    }

    public function EditCategory($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category); // Return JSON for AJAX request
    } // End Method


    public function UpdateCategory(Request $request)
    {

        $category_id = $request->id;

        Category::findOrFail($category_id)->update([
            'name' => $request->category_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);
    } // End Method


    public function DeleteCategory($id)
    {

        Category::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method


    public function edit($id)
       {
          $category = Category::findOrFail($id);
          return response()->json($category); // Return JSON for AJAX request
       }



}
