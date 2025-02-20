<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    // protected $fillable = [];
    protected $guarded= ['*'];
    // Autres relations et méthodes du modèle...

    public function emballage()
    {
        return $this->belongsTo(Emballage::class);  // Exemple : un emballage appartient à un produit
    }

    public function typeproduit()
    {
        return $this->belongsTo(Typeproduit::class); // Exemple de relation
    }

    public function format()
    {
        return $this->belongsTo(Format::class); // Exemple de relation
    }


    public function ventes()
    {
        return $this->hasMany(vente::class);
    }
    public function traitementvente()
    {
        return $this->hasMany(TraitementVente::class);
    }
    public function inventaires()
    {
        return $this->hasMany(Inventaire::class);
    }
    public function stock()
    {
        return $this->hasMany(Stock::class);
    }
    public function approvisionnements()
    {
        return $this->hasMany(Approvisionnement::class);
    }
    public function seuilcritique()
    {
        return $this->hasMany(Seuilcritique::class);
    }
    
    
}
