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

    // Check if the latest check is overdue based on check_interval
    public function needsCheck()
    {
        $latestCheck = $this->lastCheck();
        if (!$latestCheck) {
            return true; // No checks yet, so it needs checking
        }
        return $latestCheck->checked_at->diffInMinutes(now()) > $this->check_interval;
    }

    // Check if the latest check is recent and okay
    public function isRecentAndOk()
    {
        $latestCheck = $this->lastCheck();
        if (!$latestCheck) {
            return false;
        }
        $isWithinInterval = $latestCheck->checked_at->diffInMinutes(now()) <= $this->check_interval;
        $isOkay = in_array($latestCheck->status, ['occupied_okay', 'empty_okay']);
        return $isWithinInterval && $isOkay;
    }
}