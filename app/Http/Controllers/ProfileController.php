<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function showUser(){

      $users = User::latest()->paginate(5);
      return view('user.account.show' , compact('users'));

     }

     public function create()
     {
         $roles = [
             'admin',
             'user',
             'employee',
             'sales'
         ];

         return view('user.account.create' , compact('roles'));
     }


     public function storeUser(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'image' => ['nullable', 'image', 'max:2048'],
            'role' => ['required']
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = "user";
        $user->role = $request->role;


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);
            $user->image = $filename;
        } else {
            $user->image = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTTOkHm3_mPQ5PPRvGtU6Si7FJg8DVDtZ47rw&usqp=CAU';
        }

        $user->save();
        if($user){
             return redirect()->back()->with('status', 'User  Created Successfully');
        } else {
            return back()->with('fail', 'Something went wrong, try again later');
        }
    }


    public function edit(Request $request): View
    {
        return view('user.profile.editProfile', [
            'user' => $request->user(),
        ]);
    }


    public function deactivate(Request $request): View
    {
        return view('user.profile.deactivate', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user(); // Retrieve the authenticated user

        $userData = $request->validated();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $userData['image'] = $imagePath;

            // Delete the old image if it exists
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
        }

        $user->fill($userData);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save(); // Save the changes made to the user model

        return Redirect::route('profile.edit')->with('profile_updated', 'profile-updated');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
