<?php

namespace Database\Seeders;

use App\Models\Format;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $formater = [['formaters' => '0,33L'], ['formaters' => '0,5L'], ['formaters' => '0,60L'], ['formaters' => '0,66L'], ['formaters' => '1L'], ['formaters' => '1,5L']];
        foreach ($formater as $format) {
            $formats = new Format();
            $formats->format = $format['formaters'];
            $formats->save();
        }
    }
}
