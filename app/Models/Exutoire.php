<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Entreprise;
use App\Models\Dechet;

class Exutoire extends Model
{
    use HasFactory;
    protected $fillable = [
        'poid_exutoire',
        'dechet_id',
        'entreprise_id',
    ];
    public function dechet()
    {
        return $this->belongsTo(Dechet::class);
    }
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }
}
