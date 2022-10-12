<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'hq_address',
        'logo'
    ];

    public function flights()
    {
        return $this->hasMany(Flight::class);
    }

    public function planes()
    {
        return $this->hasMany(Plane::class);
    }
}
