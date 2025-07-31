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
        
        $poems = $query->select('id', 'subcategory_id', 'title', 'author', 'registered_by', 'is_structured', 'status', 'created_at')
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

    public function edit(Poem $poem)
    {
        return Inertia::render('Admin/PoemEdit', [
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
            'registered_by' => 'nullable|string|max:255',
            'body' => 'required|string',
            'subcategory_id' => 'required|exists:subcategories,id',
            'verses' => 'nullable|array',
            'is_structured' => 'boolean'
        ]);

        $updateData = $request->only('title', 'author', 'registered_by', 'body', 'subcategory_id');
        
        if ($request->is_structured && $request->verses) {
            $updateData['structure'] = $request->verses;
            $updateData['is_structured'] = true;
        }
        
        $poem->update($updateData);
        return redirect()->route('admin.poems')->with('success', 'Poem updated successfully!');
    }

    public function approve(Poem $poem)
    {
        $poem->update(['status' => 'approved']);
        return back()->with('success', 'Poem approved successfully!');
    }
}