<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    
    protected $guarded= ['*'];

    // Relation avec les factures
    public function facture()
    {
        return $this->hasMany(Facture::class);
    }
    // Relation avec les factures
    public function traitementclientventes()
    {
        return $this->hasMany(Traitementclientvente::class);
    }
    public function typeclient()
    {
        return $this->belongsTo(Typeclient::class);
    }
    // Relation avec les factures
    public function listevente()
    {
        return $this->hasMany(Listevente::class);
    }
}
