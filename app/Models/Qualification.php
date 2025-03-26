<?php
namespace App\Models;

use Illuminate\Support\Str;

class Qualification extends Model
{
    use \Illuminate\Database\Eloquent\Concerns\HasUlids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id', 'name', 'acquired_date', 'expiry_date' // Changed to user_id
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

    public function user() // Changed to user()
    {
        return $this->belongsTo(User::class);
    }
}