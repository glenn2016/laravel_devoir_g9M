<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projets_termines extends Model
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

    public function Projets_termines()
    {
        return $this->hasMany(Projets_termines::class, 'user_id');
    }
}
