<?php

namespace App\Http\Controllers;

use App\QueryFilters\UserFilters;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request, UserFilters $filters)
    {
        $users = $filters->apply(
            User::query()->orderBy('name')
        )->paginate($request->integer('per_page', 30))->withQueryString();

        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function profile(User $user)
    {
        // show authenticated user's profile when visiting /profile
        $user = auth()->user();
        return view('users.profile', compact('user'));
    }

    /**
     * Update authenticated user's profile (name, email, phone, address).
     */
    public function updateProfile(Request $request)
    {
        $user = $request->user();
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:1024',
            'avatar' => 'nullable|image|max:2048',
        ]);
            if ($request->hasFile('avatar')) {
                $path = $request->file('avatar')->store('avatars', 'public');
                $data['avatar'] = 'storage/' . $path;
            }
            $user->update($data);
        return back()->with('status', 'Profile updated');
    }

    /**
     * Update authenticated user's password.
     */
    public function updatePassword(Request $request)
    {
        $user = $request->user();
        $data = $request->validate([
            'old_password' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if (!\Hash::check($data['old_password'], $user->password)) {
            return back()->withErrors(['old_password' => 'Old password is incorrect']);
        }
        $user->password = bcrypt($data['password']);
        $user->save();
        return back()->with('status', 'Password updated');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email',
            'phone'=>'nullable|string|max:50',
            'password'=>'required|string|min:6|confirmed',
            'is_active'=>'boolean'
        ]);
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        return redirect()->route('users.show', $user);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email,'.$user->id,
            'phone'=>'nullable|string|max:50',
            'password'=>'nullable|string|min:6|confirmed',
            'is_active'=>'boolean'
        ]);
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        $user->update($data);
        return back();
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }
}
