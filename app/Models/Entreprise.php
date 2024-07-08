<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Exutoire;
use App\Models\CollectePoint;
use App\Models\Administrateur;

class Entreprise extends Model
{
    use HasFactory;
    protected $fillable = [
        'raison_sociale_entreprise',
        'siret_entreprise',
        'adresse_administrative_entreprise',
        'number_employee_entreprise',
    ];
    public function administrateur()
    {
        return $this->hasMany(Administrateur::class);
    }  
    public function collectePoint()
    {
        return $this->hasOne(CollectePoint::class);
    }  
    public function exutoire()
    {
        return $this->hasOne(Exutoire::class);
    }  
    
}
