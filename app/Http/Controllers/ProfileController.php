<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
 use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'booking_notifications' => 'boolean',
        ]);

        $user = Auth::user();

     
        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'booking_notifications' => $request->booking_notifications ? 1 : 0
            ]);

        return back()->with('success', 'Updated successfully.');
    }



public function updatePassword(Request $request)
{
    $request->validate([
        'old_password' => 'required',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = Auth::user();

 
    if (!Hash::check($request->old_password, $user->password)) {
        return back()->withErrors(['old_password' => 'The old password is incorrect.']);
    }

  
    DB::table('users')
        ->where('id', $user->id)
        ->update([
            'password' => Hash::make($request->password)
        ]);

    return back()->with('success','Password Updated Successfully');
}
}
