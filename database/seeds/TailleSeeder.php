<?php

namespace Database\Seeders;

use App\Models\Taille;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PhpParser\Node\Stmt\Foreach_;

class TailleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tailles = [['tailless' => '0,33 l'], ['tailless' => '0,5 l'], ['tailless' => '0,60 l'], ['tailless' => '0,66 l'], ['tailless' => '1 l'], ['tailless' => '1,5 l']];
        foreach ($tailles as $taille) {
            $tail = new Taille();
            $tail->taille = $taille['tailless'];
            $tail->save();
        }
    }
}
