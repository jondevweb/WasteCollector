<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Entreprise;
use App\Models\User;
use App\Models\Role;

class Administrateur extends User
{
    use HasFactory;
    protected $fillable = [
        'signature_admin',
        'user_id',
        'role_id',
        'entreprise_id',
        'email_admin',
        'telephone_admin',
    ];
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }  
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
