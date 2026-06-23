<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function index()
    {
        $options = Option::with('values')->get();
        return view('options.index', compact('options'));
    }

    public function create()
    {
        return view('options.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'is_required'  => 'nullable|boolean',
            'min_select'   => 'required|integer|min:0',
            'max_select'   => 'required|integer|min:1|gte:min_select',
        ]);

        $data['is_required'] = $request->boolean('is_required');

        Option::create($data);

        return redirect()->route('options.index')->with('success', 'Option créée avec succès');
    }

    public function edit(Option $option)
    {
        return view('options.edit', compact('option'));
    }

    public function update(Request $request, Option $option)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'is_required'  => 'nullable|boolean',
            'min_select'   => 'required|integer|min:0',
            'max_select'   => 'required|integer|min:1|gte:min_select',
        ]);

        $data['is_required'] = $request->boolean('is_required');

        $option->update($data);

        return redirect()->route('options.index')->with('success', 'Option mise à jour avec succès');
    }

    public function destroy(Option $option)
    {
        // Sécurité : on empêche la suppression si l'option est déjà utilisée par des produits
        if ($option->products()->exists()) {
            return redirect()->route('options.index')
                ->with('error', 'Impossible de supprimer : cette option est utilisée par au moins un produit. Désactivez-la plutôt.');
        }

        $option->delete();

        return redirect()->route('options.index')->with('success', 'Option supprimée avec succès');
    }

    public function toggle(Option $option)
    {
        $option->update(['status' => !$option->status]);

        return redirect()->route('options.index');
    }
}
