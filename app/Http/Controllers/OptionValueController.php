<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\OptionValue;
use App\Models\Supplement;
use Illuminate\Http\Request;

class OptionValueController extends Controller
{
    public function create(Option $option)
    {
        $supplements = Supplement::where('status', true)->get();
        return view('option_values.create', compact('option', 'supplements'));
    }

    public function store(Request $request, Option $option)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $value = $option->values()->create($data);

        // Associer des suppléments (Many-To-Many) si sélectionnés
        if ($request->has('supplements')) {
            $value->supplements()->sync($request->input('supplements'));
        }

        return redirect()->route('options.index')->with('success', 'Valeur ajoutée avec succès');
    }

    public function edit(OptionValue $optionValue)
    {
        $supplements = Supplement::where('status', true)->get();
        return view('option_values.edit', [
            'option' => $optionValue->option,
            'value' => $optionValue,
            'supplements' => $supplements,
        ]);
    }

    public function update(Request $request, OptionValue $optionValue)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $optionValue->update($data);
        $optionValue->supplements()->sync($request->input('supplements', []));

        return redirect()->route('options.index')->with('success', 'Valeur mise à jour avec succès');
    }

    public function destroy(OptionValue $optionValue)
    {
        $optionValue->delete(); // les associations pivot sont supprimées via onDelete('cascade')

        return redirect()->route('options.index')->with('success', 'Valeur supprimée avec succès');
    }

    public function toggle(OptionValue $optionValue)
    {
        $optionValue->update(['status' => !$optionValue->status]);

        return redirect()->route('options.index');
    }
}
