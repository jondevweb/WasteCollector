<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CollectePoint;
use App\Models\Dechet;
use App\Models\Passage;

class Collecte extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_collecte',
        'collectePoint_id',
    ];
    public function collectepoint()
    {
        return $this->belongsTo(CollectePoint::class);
    }
    public function dechet()
    {
        return $this->belongsToMany(Dechet::class);
    }
    public function passage()
    {
        return $this->hasOne(Passage::class);
    }
}
