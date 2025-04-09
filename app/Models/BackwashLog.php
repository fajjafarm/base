// app/Models/BackwashLog.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BackwashLog extends Model
{
    protected $table = 'backwash_logs'; // Ensure this is set

    protected $fillable = [
        'plantroom_id', 'component_id', 'reason', 'pressure_before', 'pressure_after', 
        'strainer_action', 'injector_action', 'pump_status', 'notes', 'user_id', 'performed_at'
    ];

    protected $casts = [
        'performed_at' => 'datetime',
        'pressure_before' => 'decimal:2',
        'pressure_after' => 'decimal:2',
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