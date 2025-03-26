<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ThermalSuite extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'client_id',
        'thermal_name',
        'thermal_type',
        'sauna_temp',
        'steamroom_temp',
        'lounger_temp',
        'check_interval',
        'notes'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Str::ulid();
            }
        });
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function checks()
{
    return $this->hasMany(ThermalSuiteCheck::class, 'thermal_suite_id');
}

public function lastCheck()
{
    return $this->checks()->latest('checked_at')->first();
}
}