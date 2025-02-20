<?php

use Database\Seeders\ApprovisionnementSeeder;
use Database\Seeders\ClientSeeder;
use Database\Seeders\DeviseSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\EmballageSeeder;
use Database\Seeders\FormatSeeder;
use Database\Seeders\FournisseurSeeder;
use Database\Seeders\FraisairsiSeeder;
use Database\Seeders\Param_modepaiementSeeder;
use Database\Seeders\ProduitSeeder;
use Database\Seeders\SeuilcritiqueSeeder;
use Database\Seeders\StockSeeder;
use Database\Seeders\TariftypeproduitclientSeeder;
use Database\Seeders\TariftypeproduitembclientSeeder;
use Database\Seeders\TariftypeproduitfournisseurSeeder;
use Database\Seeders\TvaSeeder;
use Database\Seeders\TypeclientSeeder;
use Database\Seeders\TypefournisseurSeeder;
use Database\Seeders\TypeproduitSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(FormatSeeder::class);
        $this->call(RolePermissionSeeder::class);
        $this->call(Param_modepaiementSeeder::class);
        $this->call(TvaSeeder::class);
        $this->call(FournisseurSeeder::class);
        $this->call(FraisairsiSeeder::class);
        $this->call(TypeproduitSeeder::class);
        $this->call(DeviseSeeder::class);
        $this->call(EmballageSeeder::class);
        $this->call(TypeclientSeeder::class);
        $this->call(TypefournisseurSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(ProduitSeeder::class);
        $this->call(TariftypeproduitclientSeeder::class);
        $this->call(TariftypeproduitfournisseurSeeder::class);
        $this->call(SeuilcritiqueSeeder::class);
        $this->call(StockSeeder::class);
        $this->call(ApprovisionnementSeeder::class);
        $this->call(TariftypeproduitembclientSeeder::class);
    }
}
