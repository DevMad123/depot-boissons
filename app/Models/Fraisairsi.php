<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fraisairsi extends Model
{
    use HasFactory;

    public function facture()
    {
        return $this->hasMany(Facture::class);
    }

    public function listevente()
    {
        return $this->hasMany(Listevente::class);
    }
}
