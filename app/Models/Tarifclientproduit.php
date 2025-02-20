<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarifclientproduit extends Model
{
    use HasFactory;
    //protected $fillable = [];
    protected $guarded= ['*'];
    // Autres relations et méthodes du modèle...

    public function taritypeproduitclient()
    {
        return $this->hasMany(Tariftypeproduitclient::class);  // Exemple : un emballage appartient à un produit
    }
}
