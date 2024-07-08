<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;

class DocumentType extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_document_type',
    ];
    public function client()
    {
        return $this->belongsToMany(Client::class);
    }
}
