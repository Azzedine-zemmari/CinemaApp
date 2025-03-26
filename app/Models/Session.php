<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    protected $fillable = [
        'filmId',
        'start_date',
        'end_date',
        'type',
        'salleId'
    ];

    public function salle(){
        return $this->belongsTo(salle::class);
    }
}
