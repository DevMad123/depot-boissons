<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Journee extends Model
{
    protected $fillable = [
        'user_id',
        'closed_by_user_id',
        'date_ouverture',
        'date_fermeture',
        'statut',
        'total_entrees',
        'total_sorties',
        'solde_financier',
        'observation',
    ];
    /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'journee';
    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function userFermeture()
    {
        return $this->belongsTo(User::class, 'closed_by_user_id');
    }

    // Relation avec les ventes
    public function ventes()
    {
        return $this->hasMany(Vente::class);
    }

    // Relation avec les approvisionnements
    public function approvisionnements()
    {
        return $this->hasMany(Approvisionnement::class);
    }

    // Relation avec les inventaires
    public function inventaires()
    {
        return $this->hasMany(Inventaire::class);
    }

    public function journeeOperations()
    {
        return $this->hasMany(journeeOperations::class);
    }
}
