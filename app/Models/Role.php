<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Administrateur;
use App\Models\Client;
use App\Models\Transporteur;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_role',
    ];
    public function administrateur()
    {
        return $this->hasMany(Administrateur::class);
    }  
    public function client()
    {
        return $this->hasMany(Client::class);
    }
    public function transporteur()
    {
        return $this->hasMany(Transporteur::class);
    }
}
