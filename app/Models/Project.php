<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'description',
        'datedebut',
        'datefin',
    ];

    public function projets()
    {
        return $this->hasMany(Projet::class);
    }

}
