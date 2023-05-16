<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $fillable = ['name','description'];

    public static $maxDemandes = 30;

    public function demandeCount()
    {
        if($this->demandes()){
            return $this->demandes()->count();
        }
    }

    public function validateMaxDemandes()
    {
        return $this->demandeCount() < self::$maxDemandes;
    }

    public function save(array $options = [])
    {
        if ($this->validateMaxDemandes()) {
            return parent::save($options);
        } else {
            throw new \Exception("This formation has reached the maximum number of demandes.");
        }
    }
    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }
}
