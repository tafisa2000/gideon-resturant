<?php

namespace App\Http\Controllers\pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Mail\SendPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Notifications\SendPasswordNotification;


class UserController extends Controller
{
    public function index()
    {
        $user = User::latest()->get();
        return view('backend.user.all_user', compact('user'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'position' => 'required|string|max:255',
            // Uncomment if image upload is needed
            // 'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $role = $request->position;
        $randomPassword = Str::random(10);
    
        $user = new User();
        $user->name = $request->position;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($randomPassword);
        $user->position = $request->position;
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $user->image_url = 'images/' . $imageName;
        }
    
        $user->assignRole($role);  // Direct role assignment
    
        $user->save();
    
        
        // Mail::to($user->email)->send(new SendPasswordMail($randomPassword));
        $user->notify(new SendPasswordNotification($randomPassword));
    
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
