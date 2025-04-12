<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PlantroomList extends Model
{
    protected $table = 'plantroom_list';
    protected $primaryKey = 'plantroom_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'plantroom_id',
        'client_id',
        'plantroom_name',
        'description',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->plantroom_id)) {
                $model->plantroom_id = Str::ulid();
            }
        });
    }

    // Define the client relationship
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'client_id');
    }

    public function components()
    {
        return $this->hasMany(PlantroomComponent::class, 'plantroom_id', 'plantroom_id');
    }
}