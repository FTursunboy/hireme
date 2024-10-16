<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Profile;

class PerformerController extends Controller
{
    public function index()
    {
        $categories = Profile::query()->get();

        return view('performers.index', compact('categories'));
    }

}
