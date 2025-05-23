<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use \Illuminate\Database\Eloquent\Concerns\HasUlids;
    use Notifiable;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'first_name',     // Replacing 'name'
        'surname',        // Added
        'email',
        'password',
        'start_date',     // Added
        'end_date',       // Added
        'position',       // Added
    ];

    protected $hidden = [
        'password',
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
    public function isSuperAdmin()
    {
        // Adjust this condition based on your super admin identifier
        return $this->id === 1; // Example: User with ID 1 is super admin
        // Or: return $this->email === 'your@email.com';
        // Or add a column: $table->boolean('is_super_admin')->default(false);
    }
     public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_user');
    }
}