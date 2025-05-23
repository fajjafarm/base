<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TeamMember extends Model
{
    protected $keyType = 'string'; // UUID is a string
    public $incrementing = false; // Disable auto-incrementing

    protected $dates = ['start_date', 'end_date'];

    protected $fillable = [
        'first_name',
        'surname',
        'start_date',
        'end_date',
        'rank'
    ];

    protected static function boot()
    {
        parent::boot();

        // Automatically generate UUID when creating a new team member
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Str::uuid()->toString();
            }
        });
    }

    public function trainingLogs()
    {
        return $this->hasMany(TrainingLog::class);
    }

    public function cprTrainings()
    {
        return $this->hasMany(CprTraining::class);
    }

    public function getLastYearTrainingHoursAttribute()
    {
        return $this->trainingLogs()
            ->where('date', '>=', now()->subYear())
            ->sum('duration') / 60; // Convert minutes to hours
    }

    public function getAverageCprScoreAttribute()
    {
        return $this->cprTrainings()->avg('score');
    }
}