<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemperatureCheck extends Model
{
    protected $fillable = [
        'location_id', 
        'temperature', 
        'checked_by'
    ];

    // If you want to define a relationship with Location model
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
}