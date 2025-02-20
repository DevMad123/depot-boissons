<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traitementclientvente extends Model
{
    use HasFactory;
    protected $guarded= ['*'];

    // Relation avec les factures
    public function traitementclients()
    {
        return $this->belongsTo(Client::class);
    }
}
