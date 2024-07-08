<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Exutoire;
use App\Models\Collecte;

class Dechet extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_dechet',
        'trigrame_dechet',
        'photo_dechet',
        'code_dechet',
    ];
    public function exutoire()
    {
        return $this->hasOne(Exutoire::class);
    }
    public function collecte()
    {
        return $this->belongsToMany(Collecte::class);
    }
}
