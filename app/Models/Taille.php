<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taille extends Model
{
    use HasFactory;
    
    // Relation inverse avec Produit
    public function produit()
    {
        return $this->hasMany(Produit::class);
    }
}
