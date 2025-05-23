<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingLog extends Model
{
    protected $dates = ['date', 'expiry_date'];

    protected $fillable = [
        'team_member_id',
        'date',
        'duration',
        'type',
        'expiry_date'
    ];

    public function teamMember()
    {
        return $this->belongsTo(TeamMember::class, 'team_member_id', 'id');
    }
}