<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlantroomComponent extends Model
{
    protected $table = 'plantroom_components';

    protected $fillable = [
        'plantroom_id',
        'component_type',
        'component_number',
        'description',
    ];

    public function plantroom()
    {
        return $this->belongsTo(PlantroomList::class, 'plantroom_id', 'plantroom_id');
    }
}