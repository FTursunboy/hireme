<?php

namespace App\Http\Controllers;

use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::query()->where('parent_id', null)->take(12)->get();

        return view('index', compact('categories'));
    }
}
