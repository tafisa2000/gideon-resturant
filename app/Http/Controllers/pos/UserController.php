<?php

namespace App\Http\Controllers\pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function index()
    {
        $user = User::latest()->get();
        return view('backend.user.all_user', compact('user'));
    }
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
                $request->validate([
                    'email' => 'required|string|max:255',
                    'position' => 'required|string|max:255',
                    
                ]);
                User::insert([
                    'email' => $request->email,
                    'name' => $request->position,
                ]);
                $notification = array(
                    'message' => 'User Inserted Successfully',
                    'alert-type' => 'success'
                );
                return redirect()->route('all.user')->with($notification);
    }
    
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
