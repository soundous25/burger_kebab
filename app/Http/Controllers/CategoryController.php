<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
public function index(Request $request)
{
    $search = $request->search;

    $categories = Category::when($search, function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        })
        ->orderBy('order')
        ->paginate(5);

    return view('categories.index', compact('categories', 'search'));
}

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories,name',
            'order' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ]);

        Category::create($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Catégorie créée avec succès.');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function toggle(Category $category)
{
    $category->update(['status' => !$category->status]);

    return redirect()->route('categories.index');
} 

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
            'order' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ]);

        $category->update($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Catégorie modifiée avec succès.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Catégorie supprimée avec succès.');
    }
}