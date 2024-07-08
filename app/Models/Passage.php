<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Collecte;
use App\Models\Transporteur;


class Passage extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_debut_passage',
        'collecte_id',
        'transporteur_id',
        'date_fin_passage',
        'validation_transporteur_passage',
        'commentaire_transporteur_passage',
        'photo_transporteur_passage',
    ];
    public function collecte()
    {
        return $this->belongsTo(Collecte::class);
    }
    public function transporter()
    {
        return $this->belongsTo(Transporteur::class);
    }
}
