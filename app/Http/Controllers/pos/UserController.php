<?php

namespace App\Http\Controllers\pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'position' => 'required|string|max:255',  
        ]);
    
        $role = $request->position;
        $password = Hash::make('password123');
    
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'name' => $request->position,
            'password' => $password,
        ]);
    
        switch($role)
        {
            case 'admin':
                $user->assignRole('admin');
                break;
            case 'manager':
                $user->assignRole('manager');
                break;
            case 'cashier':
                $user->assignRole('cashier');
                break;
            case 'waiter':
                $user->assignRole('waiter');
                break;
            case 'kitchen_staff':
                $user->assignRole('kitchen');
                break;
        }
    
        $notification = array(
            'message' => 'Employees Inserted Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->route('all.user')->with($notification);
    }
    
    
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }
    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->id,
            'position_name' => 'required|string|max:255',
        ]);
    
        $user = User::findOrFail($request->id);

        $user->update([
            'name' => $request->position_name, 
            'first_name' => $request->first_name,  
            'last_name' => $request->last_name, 
            'email' => $request->email, 
            'updated_at' => Carbon::now(), 
        ]);
    
        $user->roles()->detach();
    
        switch($request->position_name)
        {
            case 'admin':
                $user->assignRole('admin');
                break;
            case 'manager':
                $user->assignRole('manager');
                break;
            case 'cashier':
                $user->assignRole('cashier');
                break;
            case 'waiter':
                $user->assignRole('waiter');
                break;
            case 'kitchen_staff':
                $user->assignRole('kitchen');
                break;
        }
    
        $notification = array(
            'message' => 'Employee Updated Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->route('all.user')->with($notification);
    }
    

    public function destroy(string $id)
    {
        User::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Employee Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    
}
