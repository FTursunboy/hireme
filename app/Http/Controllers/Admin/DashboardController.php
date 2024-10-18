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

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $performersCount = User::query()->whereHas('roles', function ($query) {
            $query->where('name', 'performer');
        })->count();

        $customersCount = User::query()->whereHas('roles', function ($query) {
            $query->where('name', 'customer');
        })->count();

        return view('admin.index', compact('performersCount', 'customersCount'));
    }

}
