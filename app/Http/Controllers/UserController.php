<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function store(Request $request, AuthManager $authManager)
    {
        return $authManager->create($request);
    }
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', $request->input('name') . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }

        if ($request->filled('status')) {
            $status = $request->input('status') == 'active' ? true : false;
            $query->where('isActive', $status);
        }

        $users = $query->get();

        return view('users.list', compact('users'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function status(User $user)
    {
        if ($user->isActive)
            $user->isActive = false;
        else
            $user->isActive = true;

        $user->save();

        $capitalizedName = Str::title($user->name);

        return back()->with('success', "$capitalizedName status changed successfully.")->withInput();
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'isActive' => ['required'],
        ]);

        $user->isActive = $data['isActive'] == '1';
        $user->save();

        $user->update($data);
        $capitalizedName = Str::title($user->name);


        return redirect()->route('users.index')->with('success', "$capitalizedName updated successfully.");
    }
}
