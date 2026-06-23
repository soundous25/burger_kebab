<?php

namespace App\Http\Controllers;

use App\Models\Supplement;
use Illuminate\Http\Request;

class SupplementController extends Controller
{
    public function index()
    {
        $supplements = Supplement::all();
        return view('supplements.index', compact('supplements'));
    }

    public function create()
    {
        return view('supplements.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric|min:0', // 0 autorisé : un supplément peut être gratuit
        ]);

        Supplement::create($data);

        return redirect()->route('supplements.index')->with('success', 'Supplément créé avec succès');
    }

    public function edit(Supplement $supplement)
    {
        return view('supplements.edit', compact('supplement'));
    }

    public function update(Request $request, Supplement $supplement)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $supplement->update($data);

        return redirect()->route('supplements.index')->with('success', 'Supplément mis à jour avec succès');
    }

    public function destroy(Supplement $supplement)
    {
        if ($supplement->optionValues()->exists()) {
            return redirect()->route('supplements.index')
                ->with('error', 'Impossible de supprimer : ce supplément est déjà associé à des valeurs d\'options. Désactivez-le plutôt.');
        }

        $supplement->delete();

        return redirect()->route('supplements.index')->with('success', 'Supplément supprimé avec succès');
    }

    public function toggle(Supplement $supplement)
    {
        $supplement->update(['status' => !$supplement->status]);

        return redirect()->route('supplements.index');
    }
}
