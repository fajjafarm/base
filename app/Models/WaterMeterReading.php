<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class WaterMeterReading extends Model
{
    protected $table = 'water_meter_readings';
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::ulid();
        });
    }

    protected $fillable = [
        'reading_id', 
        'meter_reading', 
        'difference',
        'plantroom_id', 
        'logged_by'
    ];

    public function getKeyName()
    {
        return 'reading_id';
    }
}