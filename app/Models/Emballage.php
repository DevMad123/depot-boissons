<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emballage extends Model
{
    use HasFactory;
    //protected $fillable = ['libelle'];
    protected $guarded= ['*'];
   // Relation inverse avec Produit
   public function produit()
   {
       return $this->hasMany(Produit::class);
   }
}
