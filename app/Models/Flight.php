<?php

namespace App\Models;

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
        'arrival_id'
    ];

    public function plane()
    {
        return $this->hasOne(Plane::class);
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
