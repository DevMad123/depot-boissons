<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seuilcritique extends Model
{
    use HasFactory;
    protected $fillable = [];
    // Autres relations et méthodes du modèle...

    public function produit()
    {
        return $this->belongsTo(Produit::class);  // Exemple : un emballage appartient à un produit
    }
}
