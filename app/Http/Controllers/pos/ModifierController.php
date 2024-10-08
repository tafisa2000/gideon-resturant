<?php

namespace App\Http\Controllers\pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Modifier;
use Carbon\Carbon;


class ModifierController extends Controller
{
    public function index()
    {
        $modifiers = Modifier::latest()->get();
        return view('backend.modifier.all_modifier', compact('modifiers'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'modifier' => 'required|string|max:255',
        ]);
        Modifier::insert([
            'name' => $request->modifier,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Modifier Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.modifier')->with($notification);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id) {}


    public function update(Request $request)
    {
        $modifier_id = $request->id;

        Modifier::findOrFail($modifier_id)->update([
            'name' => $request->modifier,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Modifier Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.modifier')->with($notification);
    }



    public function DeleteModifier($id)
    {

        Modifier::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Modifier Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
