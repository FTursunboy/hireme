<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PerformerRequest;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Models\Category;
use App\Models\Profile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class PerformerController extends Controller
{
    public function index(Request $request)
    {
        $query = Profile::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $performers = $query->paginate(20);
        $categories = Category::query()->whereNotNull('parent_id')->get();

        if ($request->ajax()) {
            return view('admin.performers.table', compact('performers'))->render();
        }

        return view('admin.performers.index', compact('performers', 'categories'));
    }


    public function create()
    {
        $categories = Category::query()->whereNull( 'parent_id')->get();

        return view('admin.performers.create', compact('categories'));
    }

    public function edit(Profile $performer)
    {
        $categories = Category::query()->whereNull( 'parent_id')->get();

        $category = Category::query()->where('id', $performer->category_id)->first();

        $childCategories = Category::query()->where('parent_id', $category->parent_id)->get();


        return view('admin.performers.edit', compact('performer', 'categories', 'childCategories'));
    }

    public function getSubcategories($categoryId)
    {
        $categories = Category::query()->where('parent_id', $categoryId)->get();

        return response()->json([
            'subcategories' => $categories
        ]);
    }

    public function destroy(int $profileId)
    {
        $profile = Profile::query()->findOrFail($profileId);
        $profile->delete();
        return redirect()->route('admin.performers.index')->with('success', 'Пользователь удален');
    }

    public function archive(Profile $profile)
    {
        $profile->archived = true;
        $profile->archived_at = Carbon::now();

        $profile->save();
        return redirect()->route('admin.performers.index')->with('success', 'Успешно архивировано');
    }

    public function update(Profile $performer, PerformerRequest $request)
    {
        $data = $request->validated();

        $performer->update([
            'phone' => $data['phone'],
            'category_id' => $data['category_id'],
            'min_service_cost' => $data['min_service_cost'],
            'status' => $data['status'],
            'name' => $data['name'],
            'service_description' => $data['service_description']
        ]);
        $user = User::query()->where('id', $performer->user_id)->first();
        $user->update([
            'name' => $data['name'],
            'phone_number' => $data['phone'],
        ]);

        return redirect()->route('admin.performers.index')->with('success', 'Успешно обновлено');
    }

    public function store(PerformerRequest $request)
    {
        $data = $request->validated();

        $user  = User::create([
            'name' => $data['name'],
            'phone_number' => $data['phone'],
        ]);

        Profile::create([
            'user_id' => $user->id,
            'phone' => $data['phone'],
            'category_id' => $data['category_id'],
            'min_service_cost' => $data['min_service_cost'],
            'status' => $data['status'],
            'name' => $data['name'],
            'service_description' => $data['service_description']
        ]);


        return redirect()->route('admin.performers.index')->with('success', 'Успешно создано');
    }



}
