<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class WaterMeter extends Model
{
    protected $table = 'water_meters';
    protected $primaryKey = 'water_meter_id'; // Set correct primary key
    public $incrementing = false; // ULID is not auto-incrementing
    protected $keyType = 'string'; // ULID is a string

    protected $fillable = [
        'water_meter_id',
        'plantroom_id',
        'location',
        'description',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->water_meter_id)) {
                $model->water_meter_id = Str::ulid();
            }
        });
    }

    public function plantroom()
    {
        return $this->belongsTo(PlantroomList::class, 'plantroom_id', 'plantroom_id');
    }

    public function readings()
    {
        return $this->hasMany(WaterMeterReading::class, 'water_meter_id', 'water_meter_id');
    }
}