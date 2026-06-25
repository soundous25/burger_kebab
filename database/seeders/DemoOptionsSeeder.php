<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Option;
use App\Models\OptionValue;
use App\Models\Supplement;

class DemoOptionsSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Suppléments
        |--------------------------------------------------------------------------
        */

        $bacon = Supplement::firstOrCreate(
            ['name' => 'Bacon'],
            [
                'price' => 2.00,
                'status' => true,
            ]
        );

        $fromage = Supplement::firstOrCreate(
            ['name' => 'Fromage supplémentaire'],
            [
                'price' => 1.50,
                'status' => true,
            ]
        );

        $oeuf = Supplement::firstOrCreate(
            ['name' => 'Œuf'],
            [
                'price' => 1.00,
                'status' => true,
            ]
        );

        $oignons = Supplement::firstOrCreate(
            ['name' => 'Oignons frits'],
            [
                'price' => 1.00,
                'status' => true,
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Option : Choix sauce
        |--------------------------------------------------------------------------
        */

        $sauce = Option::firstOrCreate(
            ['name' => 'Choix sauce'],
            [
                'is_required' => true,
                'min_select' => 1,
                'max_select' => 2,
                'status' => true,
            ]
        );

        foreach ([
            'Ketchup',
            'Mayonnaise',
            'Andalouse',
            'Samouraï',
            'Barbecue'
        ] as $value) {

            OptionValue::firstOrCreate(
                [
                    'option_id' => $sauce->id,
                    'name' => $value,
                ],
                [
                    'status' => true,
                ]
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Option : Choix cuisson
        |--------------------------------------------------------------------------
        */

        $cuisson = Option::firstOrCreate(
            ['name' => 'Choix cuisson'],
            [
                'is_required' => true,
                'min_select' => 1,
                'max_select' => 1,
                'status' => true,
            ]
        );

        foreach ([
            'Saignant',
            'À point',
            'Bien cuit'
        ] as $value) {

            OptionValue::firstOrCreate(
                [
                    'option_id' => $cuisson->id,
                    'name' => $value,
                ],
                [
                    'status' => true,
                ]
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Option : Taille menu
        |--------------------------------------------------------------------------
        */

        $taille = Option::firstOrCreate(
            ['name' => 'Taille menu'],
            [
                'is_required' => true,
                'min_select' => 1,
                'max_select' => 1,
                'status' => true,
            ]
        );

        foreach ([
            'Petit',
            'Moyen',
            'Grand'
        ] as $value) {

            OptionValue::firstOrCreate(
                [
                    'option_id' => $taille->id,
                    'name' => $value,
                ],
                [
                    'status' => true,
                ]
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Option : Suppléments
        |--------------------------------------------------------------------------
        */

        $supplements = Option::firstOrCreate(
            ['name' => 'Suppléments'],
            [
                'is_required' => false,
                'min_select' => 0,
                'max_select' => 4,
                'status' => true,
            ]
        );


        $baconValue = OptionValue::firstOrCreate(
            [
                'option_id' => $supplements->id,
                'name' => 'Bacon',
            ],
            [
                'status' => true,
            ]
        );

        $fromageValue = OptionValue::firstOrCreate(
            [
                'option_id' => $supplements->id,
                'name' => 'Fromage supplémentaire',
            ],
            [
                'status' => true,
            ]
        );

        $oeufValue = OptionValue::firstOrCreate(
            [
                'option_id' => $supplements->id,
                'name' => 'Œuf',
            ],
            [
                'status' => true,
            ]
        );

        $oignonsValue = OptionValue::firstOrCreate(
            [
                'option_id' => $supplements->id,
                'name' => 'Oignons frits',
            ],
            [
                'status' => true,
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Liaison Valeurs ↔ Suppléments
        |--------------------------------------------------------------------------
        */

        $baconValue->supplements()->syncWithoutDetaching([$bacon->id]);
        $fromageValue->supplements()->syncWithoutDetaching([$fromage->id]);
        $oeufValue->supplements()->syncWithoutDetaching([$oeuf->id]);
        $oignonsValue->supplements()->syncWithoutDetaching([$oignons->id]);


        /*
        |--------------------------------------------------------------------------
        | Liaison Produits ↔ Options
        |--------------------------------------------------------------------------
        */

        $products = Product::all();

        foreach ($products as $product) {

            $product->options()->syncWithoutDetaching([
                $sauce->id,
                $cuisson->id,
                $taille->id,
                $supplements->id,
            ]);
        }
    }
}
