<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class film extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre',
        'description',
        'image',
        'duree',
        'ageMin',
        'triller',
        'genre'
    ];
}
