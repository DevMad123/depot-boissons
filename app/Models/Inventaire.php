<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaire extends Model
{
    use HasFactory;
    protected $fillable = [
        'journee_id',
        'produit_id',
        'quantite_ouverture',
        'quantite_fermeture',
        'commentaire',
        'statut',
    ];

    public function journee()
    {
        return $this->belongsTo(Journee::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
