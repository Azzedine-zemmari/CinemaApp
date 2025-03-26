<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salle extends Model
{
    use HasFactory;
    protected $fillable=[
        'nom',
        'type'
    ];
    public function seats(){
        return $this->hasMany(Seat::class);
    }
    public function session(){
        return $this->hasMany(Session::class);
    }
}
