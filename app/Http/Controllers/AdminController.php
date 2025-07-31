<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Poem;
use Inertia\Inertia;
use Illuminate\Http\Request;

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

    public function users()
    {
        return Inertia::render('Admin/Users', [
            'users' => \App\Models\User::select('id', 'name', 'email', 'role', 'created_at')->get()
        ]);
    }

    public function categories()
    {
        return Inertia::render('Admin/Categories', [
            'categories' => Category::select('id', 'name', 'created_at')->get()
        ]);
    }

    public function storeCategory(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Category::create(['name' => $request->name]);
        return back()->with('success', 'Category registered successfully!');
    }

    public function updateCategory(Request $request, Category $category)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $category->update(['name' => $request->name]);
        return back()->with('success', 'Category updated successfully!');
    }

    public function subcategories()
    {
        return Inertia::render('Admin/Subcategories', [
            'subcategories' => Subcategory::with('category')->select('id', 'category_id', 'name', 'created_at')->get(),
            'categories' => Category::select('id', 'name')->get()
        ]);
    }

    public function storeSubcategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id'
        ]);
        Subcategory::create($request->only('name', 'category_id'));
        return back()->with('success', 'Subcategory added successfully!');
    }

    public function updateSubcategory(Request $request, Subcategory $subcategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id'
        ]);
        $subcategory->update($request->only('name', 'category_id'));
        return back()->with('success', 'Subcategory updated successfully!');
    }
}