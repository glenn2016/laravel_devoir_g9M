<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projetencours extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'description',
        'datedebut',
        'datefin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function projetencours()
    {
        return $this->hasMany(Projetencours::class, 'user_id');
    }
}
