<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdministratorController extends Controller
{
    public function index(Request $request)
    {
        $query = User::whereHas('roles', function ($query) {
            return $query->where('name', 'admin')->orWhere('name', 'moderator');
        });

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(20);

        if ($request->ajax()) {
            return view('admin.administrator.table', compact('users'))->render();
        }


        return view('admin.administrator.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::where('name', 'admin')->orWhere('name', 'moderator')->get();
        return view('admin.administrator.create', compact('roles'));
    }

    public function edit(User $user)
    {
        $roles = Role::where('name', 'admin')->orWhere('name', 'moderator')->get();

        return view('admin.administrator.edit', compact('user', 'roles'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.administrator.index')->with('success', 'Пользователь удален');
    }

    public function block(User $user)
    {
        $user->status = false;
        $user->save();
        return redirect()->back()->with('success', 'Пользователь заблокирован');
    }

    public function unblock(User $user)
    {
        $user->status = true;
        $user->save();

        return view('admin.administrator.index')->with('success', 'Пользователь разблокирован');
    }

    public function update(User $user, UserUpdateRequest $request)
    {
        $data = $request->validated();

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'status' => $data['status'],
        ]);
        $user->roles()->detach();
        $role = Role::findById($data['role_id']);
        $user->assignRole($role->name);

        return redirect()->route('admin.administrator.index')->with('success', 'Успешно обновлено');
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $role = Role::findById($data['role_id']);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'author_id'  => Auth::id(),
        ])->assignRole($role->name);

        return redirect()->route('admin.administrator.index')->with('success', 'Успешно создано');
    }

}
