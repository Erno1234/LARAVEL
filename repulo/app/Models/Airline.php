<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    use HasFactory;
    protected $primaryKey = 'airline_id';

    protected $fillable = [
        'name',
        'country'
    ];

    public function flight(){
        return $this->hasMany(Flight::class, 'airline_id','airline_id');
    }
}
