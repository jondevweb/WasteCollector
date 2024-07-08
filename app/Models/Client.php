<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Role;
use App\Models\Document;
use App\Models\CollectePoint;

class Client extends User
{
    use HasFactory;
    protected $fillable = [
        'contract_date_client',
        'user_id',
        'role_id',
        'email_client',
        'telephone_client',
    ];
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function document()
    {
        return $this->belongsToMany(Document::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }  
    public function collectePoint()
    {
        return $this->hasMany(CollectePoint::class);
    }
}
