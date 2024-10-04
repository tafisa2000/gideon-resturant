<?php

namespace App\Http\Controllers\pos;

use App\Models\table;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TableController extends Controller
{
    //
    public function index()
    {
        $tables = table::latest()->get();
        return view('backend.table.all_table', compact('tables'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        table::insert([
            'name' => $request->name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Table Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.table')->with($notification);
    }


    public function update(Request $request)
    {
        $table_id = $request->id;

        // Find the table by ID and update the 'name' field
        Table::findOrFail($table_id)->update([
            'name' => $request->name,  // 'name' matches the form input field name
            'updated_at' => Carbon::now(),  // Automatically set the updated_at timestamp
        ]);

        // Return success notification
        $notification = array(
            'message' => 'Modifier Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.table')->with($notification);
    }


    public function DeleteTable($id)
    {

        table::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Modifier Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
