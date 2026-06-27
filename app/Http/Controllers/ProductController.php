<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Product::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->paginate(5)->withQueryString();
        return view('products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        $options = Option::where('status', true)->get();

        return view('products.create', compact('categories', 'options'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0.01',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'options' => 'nullable|array',
            'options.*' => 'exists:options,id',
        ]);

        $data = $request->except([
             'image',
             'options'
        ]);

           /*
            Gestion image
           */
        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('products', 'public');
        }

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'status' => $request->status ?? 1,
            'category_id' => $request->category_id,
            'image' => $image,
        ]);

        // Relation Many-To-Many : on attache les options sélectionnées
        $product->options()->sync($request->input('options', []));

        return redirect()->route('products.index')
            ->with('success', 'Produit créé avec succès');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $options = Option::where('status', true)->get();
        $product->load('options');

        return view('products.edit', compact('product', 'categories', 'options'));
    }

    public function show(Product $product)
   {
       return view('products.show', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0.01',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'options' => 'nullable|array',
            'options.*' => 'exists:options,id',
        ]);

        $image = $product->image;
        if ($request->hasFile('image')) {
            // On supprime l'ancienne image avant de stocker la nouvelle
            if ($image) {
                Storage::disk('public')->delete($image);
            }
            $image = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'status' => $request->status ?? 1,
            'category_id' => $request->category_id,
            'image' => $image,
        ]);

        $product->options()->sync($request->input('options', []));

        return redirect()->route('products.index')
            ->with('success', 'Produit mis à jour avec succès');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete(); // détache automatiquement le pivot product_option (cascade)

        return redirect()->route('products.index')
            ->with('success', 'Produit supprimé avec succès');
    }

    public function toggle(Product $product)
    {
        $product->update(['status' => !$product->status]);

        return redirect()->route('products.index');
    }
}