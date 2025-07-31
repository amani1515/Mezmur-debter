<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Poem;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PublicController extends Controller
{
    public function welcome()
    {
        return Inertia::render('Welcome', [
            'categories' => Category::with('subcategories')->get(),
        ]);
    }

    public function submitPoem(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'registered_by' => 'nullable|string|max:255',
            'body' => 'required|string',
            'subcategory_id' => 'required|exists:subcategories,id'
        ]);

        // Check for duplicate title
        $existingPoem = Poem::where('title', $request->title)->first();
        if ($existingPoem) {
            return back()->withErrors([
                'title' => 'A poem with this title already exists. Please choose a different title.'
            ])->withInput();
        }

        Poem::create([
            'title' => $request->title,
            'author' => $request->author ?: 'Anonymous',
            'registered_by' => $request->registered_by ?: 'Anonymous',
            'body' => $request->body,
            'subcategory_id' => $request->subcategory_id
        ]);

        return back()->with('success', 'Poem submitted successfully! Thank you for your contribution.');
    }

    public function checkTitle(Request $request)
    {
        $exists = Poem::where('title', $request->title)->exists();
        $relatedPoems = Poem::where('title', 'like', '%' . $request->title . '%')
            ->select('title', 'author')
            ->limit(5)
            ->get();
        
        return Inertia::render('Welcome', [
            'categories' => Category::with('subcategories')->get(),
            'exists' => $exists,
            'relatedPoems' => $relatedPoems
        ]);
    }

    public function submitStructuredPoem(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'author' => 'nullable|string|max:255',
                'registered_by' => 'nullable|string|max:255',
                'subcategory_id' => 'required|exists:subcategories,id',
                'verses' => 'required|array|min:1',
                'verses.*.main' => 'required|string',
                'verses.*.subs' => 'nullable|array',
                'verses.*.subs.*' => 'string'
            ]);

            $existingPoem = Poem::where('title', $request->title)->first();
            if ($existingPoem) {
                return response()->json(['error' => 'A poem with this title already exists.'], 422);
            }

            $body = '';
            foreach ($request->verses as $verse) {
                $body .= $verse['main'] . "\n";
                if (!empty($verse['subs'])) {
                    foreach ($verse['subs'] as $sub) {
                        $body .= "    " . $sub . "\n";
                    }
                }
                $body .= "\n";
            }

            $poem = Poem::create([
                'title' => $request->title,
                'author' => $request->author ?: 'Anonymous',
                'registered_by' => $request->registered_by ?: 'Anonymous',
                'body' => trim($body),
                'subcategory_id' => $request->subcategory_id,
                'structure' => $request->verses,
                'is_structured' => true
            ]);

            return response()->json(['success' => true, 'poem' => $poem]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
        }
    }

    public function getCategories()
    {
        return response()->json(Category::with('subcategories')->get());
    }
}