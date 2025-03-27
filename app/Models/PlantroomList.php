// app/Models/PlantroomList.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class PlantroomList extends Model
{
    use HasFactory;

    protected $table = 'plantroom_list';
    protected $primaryKey = 'plantroom_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'client_id', 'plantroom_id', 'plantroom_name', 'plantroom_type', 'pool_filters', 
        'pool_strainers', 'other_strainers', 'cl_injector', 'ph_injector', 
        'pac_injector', 'info'
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
}