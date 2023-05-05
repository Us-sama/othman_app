<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $fillable = ['requester_id', 'status', 'demand_files'];

    public function demandeur()
    {
        return $this->belongsTo(Demandeur::class);
    }
}
