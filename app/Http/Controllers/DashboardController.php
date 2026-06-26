<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Option;
use App\Models\Supplement;

class DashboardController extends Controller
{
    public function index()
    {
        $activities = collect();

        foreach (Category::latest('updated_at')->take(5)->get() as $item) {
            $activities->push([
                'name' => $item->name,
                'module' => 'Catégorie',
                'date' => $item->updated_at,
                'color' => 'success',
                'icon' => 'fa-folder',
            ]);
        }

        foreach (Product::latest('updated_at')->take(5)->get() as $item) {
            $activities->push([
                'name' => $item->name,
                'module' => 'Produit',
                'date' => $item->updated_at,
                'color' => 'danger',
                'icon' => 'fa-burger',
            ]);
        }

        foreach (Option::latest('updated_at')->take(5)->get() as $item) {
            $activities->push([
                'name' => $item->name,
                'module' => 'Option',
                'date' => $item->updated_at,
                'color' => 'primary',
                'icon' => 'fa-gear',
            ]);
        }

        foreach (Supplement::latest('updated_at')->take(5)->get() as $item) {
            $activities->push([
                'name' => $item->name,
                'module' => 'Supplément',
                'date' => $item->updated_at,
                'color' => 'warning',
                'icon' => 'fa-circle-plus',
            ]);
        }

        $activities = $activities
            ->sortByDesc('date')
            ->take(5);

        return view('dashboard', compact('activities'));
    }
}