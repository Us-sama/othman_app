<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demandeur extends Model
{
    use HasFactory;
    protected $fillable = ['Nom', 'Prenom', 'CIN', 'birthdate'];

    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }
}
