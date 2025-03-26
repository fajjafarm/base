<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Backwash extends Model
{
    protected $fillable = [
        'pool_id', 
        'filter1_before_pressure', 
        'filter1_after_pressure',
        'filter1_backwashed', 
        'basket1_cleaned',
        'filter2_before_pressure', 
        'filter2_after_pressure',
        'filter2_backwashed',
        'basket2_cleaned',
        'filter3_before_pressure', 
        'filter3_after_pressure',
        'filter3_backwashed',
        'basket3_cleaned',
        'reason_for_backwash',
        'pump1_status',
        'pump2_status',
        'pump3_status',
        'issues',
        'performed_by'
    ];
}