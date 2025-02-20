<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approvisionnement extends Model
{
    use HasFactory;
    // protected $table = 'approvisionnements';

    // public function taritypeproduitfournisseur()
    // {
    //     return $this->belongsTo(Tariftypeproduitfournisseur::class, 'approvisionnement_id');
    // }


    // public function produit()
    // {
    //     return $this->belongsTo(Produit::class);
    // }
    

    // public function fournisseur()
    // {
    //     return $this->belongsTo(Fournisseur::class);
    // }

    // public function tarif()
    // {
    //     return $this->belongsTo(Tariffournisseur::class);
    // }
/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'approvisionnements';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'tariftypeproduitfournisseur_id',
    //     'quantite',
    //     'date_approvisionnement',
    // ];

    protected $guarded= ['*'];

    /**
     * Get the related TarifTypeProduitFournisseur.
     */
    public function taritypeproduitfournisseur()
    {
        return $this->belongsTo(Tariftypeproduitfournisseur::class, 'tariftypeproduitfournisseur_id');
    }
   
}
