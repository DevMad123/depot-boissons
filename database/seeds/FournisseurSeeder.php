<?php

namespace Database\Seeders;

use App\Models\Fournisseur;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FournisseurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fournisseurs = [
            ['matrifournisseur' => 'FRN001', 'nom' => 'Solibra', 'email' => 'Solibra@gmail.com', 'telephone' => '+225 0705020301', 'adresse' => 'Jacque Ville', 'solde' => '1000000', 'typefournisseur_id' => 1, 'image' => 'Image 1'],
            ['matrifournisseur' => 'FRN002', 'nom' => 'AGROCI', 'email' => 'AGROCI@gmail.com', 'telephone' => '+225 0705020302', 'adresse' => '3 Anges', 'solde' => '1000001', 'typefournisseur_id' => 2, 'image' => 'Image 2'],
            ['matrifournisseur' => 'FRN003', 'nom' => 'Starfresh', 'email' => 'Starfresh@gmail.com', 'telephone' => '+225 0705020303', 'adresse' => 'Roch du sud', 'solde' => '1000002', 'typefournisseur_id' => 2, 'image' => 'Image 3'],
            ['matrifournisseur' => 'FRN004', 'nom' => 'Doze Industrie', 'email' => 'DozeIndustrie@gmail.com', 'telephone' => '+225 0705020304', 'adresse' => 'Riviera 3', 'solde' => '1000003', 'typefournisseur_id' => 1, 'image' => 'Image 4'],
            ['matrifournisseur' => 'FRN005', 'nom' => 'Poulma Distribution', 'email' => 'PoulmaDistribution@gmail.com', 'telephone' => '+225 0705020305', 'adresse' => 'Abobo 6', 'solde' => '1000004', 'typefournisseur_id' => 2, 'image' => 'Image 5'],
            ['matrifournisseur' => 'FRN006', 'nom' => 'KN Distribution', 'email' => 'rach@gmail.com', 'telephone' => '+225 0705020306', 'adresse' => 'Adjamé', 'solde' => '1000005', 'typefournisseur_id' => 1, 'image' => 'Image 6'],
            ['matrifournisseur' => 'FRN007', 'nom' => 'Castel Afrique', 'email' => 'CastelAfrique@gmail.com', 'telephone' => '+225 0705020307', 'adresse' => 'Plateau', 'solde' => '1000006', 'typefournisseur_id' => 1, 'image' => 'Image 7'],
        ];
        foreach ($fournisseurs as $fournisseurs) {
            $fournisseur = new Fournisseur();
            $fournisseur->matrifournisseur = $fournisseurs['matrifournisseur'];
            $fournisseur->nom = $fournisseurs['nom'];
            $fournisseur->email = $fournisseurs['email'];
            $fournisseur->telephone = $fournisseurs['telephone'];
            $fournisseur->adresse = $fournisseurs['adresse'];
            $fournisseur->solde = $fournisseurs['solde'];
            // $fournisseur->typefournisseur_id = $fournisseurs['typefournisseur_id'];
            $fournisseur->logo = $fournisseurs['image'];
            $fournisseur->save();
        }
    }
}
