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


    // public function create()
    // {
       
    // }


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

    public function edit(string $id)
    {
   
    }

  
    public function update(Request $request)
    {
        $modifier_id = $request->id;
        $name = $request->modifier;
        Modifier::findOrFail($modifier_id)->update([
            'name' => $name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Modifier Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.modifier')->with($notification);
    }


    public function destroy(string $id)
    {
        //
    }
}
