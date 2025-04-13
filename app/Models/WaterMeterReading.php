<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaterMeterReading extends Model
{
    protected $table = 'water_meter_readings';

    protected $fillable = [
        'water_meter_id',
        'reading_value',
        'reading_date',
        'notes',
    ];

    protected $casts = [
        'reading_date' => 'datetime',
        'reading_value' => 'decimal:2',
    ];

    public function waterMeter()
    {
        return $this->belongsTo(WaterMeter::class, 'water_meter_id', 'id');
    }
}