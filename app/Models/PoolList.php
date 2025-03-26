<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PoolList extends Model
{
    use HasFactory;

    protected $table = 'pool_list';
    protected $primaryKey = 'pool_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'client_id', 'pool_name', 'pool_type', 'length', 'width', 'depth', 'volume', 
        'ideal_dpd1', 'ideal_ph', 'ideal_alk', 'ideal_calc', 'ideal_water_temp', 'ideal_air_temp'
    ];
}