<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JourneeOperations extends Model
{
    protected $fillable = [
        'user_id',
        'journee_id',
        'produit_id',
        'type_operation',
        'quantite',
        'montant',
    ];

    /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'journeeoperations';

    public function journee()
    {
        return $this->belongsTo(Journee::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
