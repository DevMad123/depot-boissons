<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typeclient extends Model
{
    use HasFactory;
    protected $fillable = [];
    // Autres relations et méthodes du modèle...

    public function taritypeproduitclient()
    {
        return $this->hasMany(Tariftypeproduitclient::class);  
    }
    public function client()
    {
        return $this->hasMany(Client::class);  
    }
}
