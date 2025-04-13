<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaterMeter extends Model
{
    protected $table = 'water_meters';

    protected $fillable = [
        'plantroom_id',
        'location',
        'description',
    ];

    public function plantroom()
    {
        return $this->belongsTo(PlantroomList::class, 'plantroom_id', 'plantroom_id');
    }

    public function readings()
    {
        return $this->hasMany(WaterMeterReading::class, 'water_meter_id', 'id');
    }
}