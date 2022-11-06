<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
        'code',
        'city_id'
    ];

    public function departures()
    {
        return $this->hasMany(Flight::class, 'departure_id');
    }

    public function arrivals()
    {
        return $this->hasMany(Flight::class, 'arrival_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
