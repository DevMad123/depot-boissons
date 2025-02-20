<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Devise;
use Illuminate\Database\Seeder;

class DeviseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paramdevisess = [
            ['libelle' => 'Franc CFA (UEMOA)', 'code_devise' => 'XOF', 'status' => 1],
            ['libelle' => 'Franc CFA (CEMAC)', 'code_devise' => 'XAF', 'status' => 0],
            ['libelle' => 'Naira Nigérian', 'code_devise' => 'NGN', 'status' => 0],
            ['libelle' => 'Livre Égyptienne', 'code_devise' => 'EGP', 'status' => 0],
            ['libelle' => 'Rand Sud-Africain', 'code_devise' => 'ZAR', 'status' => 0],
            ['libelle' => 'Shilling Kenyan', 'code_devise' => 'KES', 'status' => 0],
            ['libelle' => 'Shilling Tanzanien', 'code_devise' => 'TZS', 'status' => 0],
            ['libelle' => 'Shilling Ougandais', 'code_devise' => 'UGX', 'status' => 0],
            ['libelle' => 'Dirham Marocain', 'code_devise' => 'MAD', 'status' => 0],
            ['libelle' => 'Dalasi Gambien', 'code_devise' => 'GMD', 'status' => 0],
            ['libelle' => 'Pula Botswanais', 'code_devise' => 'BWP', 'status' => 0],
            ['libelle' => 'Kwacha Malawien', 'code_devise' => 'MWK', 'status' => 0],
            ['libelle' => 'Kwacha Zambien', 'code_devise' => 'ZMW', 'status' => 0],
            ['libelle' => 'Cedi Ghanéen', 'code_devise' => 'GHS', 'status' => 0],
            ['libelle' => 'Ariary Malgache', 'code_devise' => 'MGA', 'status' => 0],
            ['libelle' => 'Metical Mozambicain', 'code_devise' => 'MZN', 'status' => 0],
            ['libelle' => 'Dinar Tunisien', 'code_devise' => 'TND', 'status' => 0],
            ['libelle' => 'Dinar Algérien', 'code_devise' => 'DZD', 'status' => 0],
            ['libelle' => 'Escudo Cap-Verdien', 'code_devise' => 'CVE', 'status' => 0],
            ['libelle' => 'Birr Éthiopien', 'code_devise' => 'ETB', 'status' => 0],
        ];
        foreach ($paramdevisess as $paramdevises) {
            $paramdevise = new Devise();
            $paramdevise->libelle = $paramdevises['libelle'];
            $paramdevise->code_devise = $paramdevises['code_devise'];
            $paramdevise->status = $paramdevises['status'];
            $paramdevise->save();
        }
    }
}
