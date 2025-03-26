<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class seat extends Model
{
    use HasFactory;
    protected $fillable = [
        'num',
        'status',
        'salleId'
    ];
    public function salle(){
        return $this->belongsTo(salle::class);
    }
}
