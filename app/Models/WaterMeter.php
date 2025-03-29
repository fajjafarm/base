<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class WaterMeter extends Model
{
    protected $table = 'water_meters';

    protected $primaryKey = 'water_meter_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'water_meter_id', 'plantroom_id', 'location', 'description'
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
}