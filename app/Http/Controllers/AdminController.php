<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Poem;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function dashboard()
    {
        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'categories' => Category::count(),
                'subcategories' => Subcategory::count(),
                'poems' => Poem::count(),
            ]
        ]);
    }
}