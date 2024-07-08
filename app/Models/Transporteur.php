<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use App\Models\Passage;

class Transporteur extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_transporteur',
        'role_id',
        'description_transporteur',
        'immatriculation_transporteur',
        'password_transporteur',
    ];
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function passage()
    {
        return $this->hasMany(Passage::class);
    }
}
