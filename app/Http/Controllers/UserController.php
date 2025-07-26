<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Helpers\StorageHelper;

class UserController extends Controller
{
    public function __construct()
    {
        view()->composer('crm.layouts.link', function ($view) {
            $view->with(['active_name' => 'users']);
        });
    }

    public function index()
    {
        $users = User::all();
        return view('crm.users', compact('users'));
    }

    public function create()
    {
        return view('crm.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'file' => 'nullable|image|max:2048',
        ]);

        $avatar = 'default.jpg';
        if ($request->hasFile('file')) {
            $storage = new StorageHelper('avatar', $request->file('file'), new User());
            $avatar = $storage->saveImage();
        }

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'avatar' => $avatar,
        ]);

        return redirect('/crm');
    }

    public function edit(User $user)
    {
        return view('crm.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,$id",
            'password' => 'nullable|string|min:6',
            'file' => 'nullable|image|max:2048',
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        if ($request->hasFile('file')) {
            $storage = new StorageHelper('avatar', $request->file('file'), new User());
            $data['avatar'] = $storage->saveImage();
        }
        User::where('id', $id)->update($data);

        return redirect('/user');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->avatar && $user->avatar !== 'default.jpg') {
            $storage = new StorageHelper('avatar', null, $user);
            $storage->destroyImage();
        }

        $user->delete();

        return redirect('/user');
    }
}