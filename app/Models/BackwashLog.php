<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BackwashLog extends Model
{
    protected $table = 'backwash_logs';

    protected $fillable = [
        'plantroom_id', 'component_id', 'action', 'performed_at', 'user_id', 'notes'
    ];

    protected $casts = [
        'performed_at' => 'datetime',
    ];

    public function plantroom()
    {
        return $this->belongsTo(PlantroomList::class, 'plantroom_id', 'plantroom_id');
    }

    public function component()
    {
        return $this->belongsTo(PlantroomComponent::class, 'component_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}