<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Poem;
use Inertia\Inertia;
use Illuminate\Http\Request;

class PoemController extends Controller
{
    public function index(Request $request)
    {
        $query = Poem::with(['subcategory.category']);
        
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('author', 'like', '%' . $request->search . '%');
        }
        
        if ($request->category_id) {
            $query->whereHas('subcategory', function($q) use ($request) {
                $q->where('category_id', $request->category_id);
            });
        }
        
        if ($request->subcategory_id) {
            $query->where('subcategory_id', $request->subcategory_id);
        }
        
        $poems = $query->select('id', 'subcategory_id', 'title', 'author', 'created_at')
                      ->paginate(10)
                      ->withQueryString();
        
        return Inertia::render('Admin/WorkingPoems', [
            'poems' => $poems,
            'categories' => Category::select('id', 'name')->get(),
            'subcategories' => Subcategory::with('category')->select('id', 'category_id', 'name')->get(),
            'filters' => $request->only(['search', 'category_id', 'subcategory_id'])
        ]);
    }

    public function show(Poem $poem)
    {
        return Inertia::render('Admin/PoemDetail', [
            'poem' => $poem->load('subcategory.category'),
            'categories' => Category::select('id', 'name')->get(),
            'subcategories' => Subcategory::select('id', 'category_id', 'name')->get()
        ]);
    }

    public function update(Request $request, Poem $poem)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'body' => 'required|string',
            'subcategory_id' => 'required|exists:subcategories,id'
        ]);
        $poem->update($request->only('title', 'author', 'body', 'subcategory_id'));
        return back()->with('success', 'Poem updated successfully!');
    }
}