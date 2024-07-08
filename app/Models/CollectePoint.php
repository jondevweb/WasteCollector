<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Entreprise;
use App\Models\Client;
use App\Models\Collecte;

class CollectePoint extends Model
{
    use HasFactory;
    protected $fillable = [
        'adresse_collecte_point',
        'entreprise_id',
        'client_id',
        'ascenseur_collecte_point',
        'badge_collecte_point',
        'batiment_collecte_point',
        'code_collecte_point',
        'commentaire_collecte_point',
        'hauteur_collecte_point',
        'parking_collecte_point',
        'telephone_collecte_point',
        'creneau_collecte_point',
        'departement_collecte_point',
    ];
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }
    public function collecte()
    {
        return $this->hasMany(Collecte::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
