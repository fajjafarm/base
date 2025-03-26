<?php
namespace App\Models;

use Illuminate\Support\Str;

class TrainingSession extends Model
{
    use \Illuminate\Database\Eloquent\Concerns\HasUlids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'type',
        'custom_type',
        'date',
        'duration',
        'description',
        'location',            // Added
        'pool_depth',         // Added
        'equipment_used',     // Added
        'custom_equipment',   // Added
        'trainer'             // Added
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

    public function employees()
    {
        return $this->belongsToMany(Employee::class)
            ->withPivot('comments');
    }
}