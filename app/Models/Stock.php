<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = ['produit_id', 'quantite_disponible'];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
