<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class PerformerController extends Controller
{
    public function index()
    {
        $categories = Category::query()->where('parent_id', null)->with('subCategories')->get();

        $profiles = Profile::query()->paginate(15);
        return view('performers.index', compact('categories', 'profiles'));
    }

    public function show(Profile $profile)
    {
        return view('performers.show', compact('profile'));
    }

}
