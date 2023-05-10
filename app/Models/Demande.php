<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $fillable = ['demandeur_id', 'status', 'demand_files','created_by'];

    public function demandeur()
    {
        return $this->belongsTo(Demandeur::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
