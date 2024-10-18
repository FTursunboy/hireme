<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()->where('parent_id', null)->get();

        return view('categories.index', compact('categories'));
    }

    public function getSubcategories($id)
    {
        $categories = Category::query()->where('parent_id', $id)->get();

        return response()->json([
            'categories' => $categories
        ]);
    }
}
