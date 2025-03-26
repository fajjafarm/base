<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Employee extends Authenticatable
{
    use \Illuminate\Database\Eloquent\Concerns\HasUlids;
    use Notifiable; // Required for password resets and notifications

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'first_name',
        'surname',
        'email',
        'password',
        'start_date',
        'end_date',
        'position'
    ];

    protected $hidden = [
        'password', // Hide password in serialization
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
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

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->surname}";
    }

    public function qualifications()
    {
        return $this->hasMany(Qualification::class);
    }

    public function trainingSessions()
    {
        return $this->belongsToMany(TrainingSession::class)
            ->withPivot('comments');
    }
}