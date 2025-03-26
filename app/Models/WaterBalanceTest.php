<?php

namespace App\Models;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class WaterBalanceTest extends Model
{
    protected $table = 'water_balance_tests';
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
        'alkalinity',
        'calcium_hardness',
        'ph',
        'pool_id',
        'water_balance',
        'logged_by'
    ];

    // If you want to define the relationship with the Pool model
    public function pool()
    {
        return $this->belongsTo(Pool::class);
    }
}