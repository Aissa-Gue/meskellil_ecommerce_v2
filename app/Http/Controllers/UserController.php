<?php

namespace App\Http\Controllers;

use App\QueryFilters\UserFilters;
use App\Models\User;
use Illuminate\Http\Request;

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
        return view('users.profile', compact('user'));
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
