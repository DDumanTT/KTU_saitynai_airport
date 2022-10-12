<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'gate',
        'price',
        'duration',
        'departure_time',
        'arrival_time',
        'departure_id',
        'arrival_id',
        'airline_id'
    ];

    public function airline()
    {
        return $this->belongsTo(Airline::class);
    }

    public function departure()
    {
        return $this->belongsTo(Airport::class);
    }

    public function arrival()
    {
        return $this->belongsTo(Airport::class);
    }
}
