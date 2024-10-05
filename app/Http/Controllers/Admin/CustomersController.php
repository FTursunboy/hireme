<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomerRequest;
use App\Http\Requests\Admin\CustomerUpdateRequest;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Models\Category;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CustomersController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()->whereHas('roles', function ($query) {
            return $query->where('name', 'customer');
        });

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }


        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(20);

        if ($request->ajax()) {
            return view('admin.customers.table', compact('users'))->render();
        }

        return view('admin.customers.index', compact('users'));


    }

    public function create()
    {
        $roles = Role::get();
        return view('admin.customers.create', compact('roles'));
    }

    public function edit(User $customer)
    {
        $roles = Role::get();

        return view('admin.customers.edit', compact('customer', 'roles'));
    }

    public function destroy(User $customer)
    {
        $customer->delete();
        return redirect()->route('admin.customers.index')->with('success', 'Заказчик удален');
    }

    public function archive(User $customer)
    {
        $customer->delete();
        return redirect()->back()->with('success', 'Заказчик архивирован');
    }

    public function unblock(User $customer)
    {
        $customer->status = true;
        $customer->save();

        return view('admin.customers.index')->with('success', 'Заказчик разблокирован');
    }

    public function update(User $customer, CustomerUpdateRequest $request)
    {
        $data = $request->validated();

        $customer->update([
            'name' => $data['name'],
            'phone_number' => $data['phone'],
            'status' => $data['status'],
        ]);
        return redirect()->route('admin.customers.index')->with('success', 'Успешно обновлено');
    }

    public function store(CustomerRequest $request)
    {
        $data = $request->validated();

        User::create([
            'name' => $data['name'],
            'phone_number' => $data['phone'],
            'active' => $data['status'],
            'author_id' => Auth::id()
        ])->assignRole('customer');

        return redirect()->route('admin.customers.index')->with('success', 'Успешно создано');
    }

}
