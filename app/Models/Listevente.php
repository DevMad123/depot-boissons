<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listevente extends Model
{
    use HasFactory;
    protected $fillable = [];
     // Relation avec le client
    
     public function client()
     {
         return $this->belongsTo(Client::class);
     }
     public function tva()
     {
         return $this->belongsTo(Tva::class);
     }
     public function fraisairsi()
     {
         return $this->belongsTo(Fraisairsi::class);
     }
}
