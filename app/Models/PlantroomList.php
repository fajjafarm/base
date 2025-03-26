<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlantroomList extends Model
{
    use HasFactory;

    protected $table = 'plantroom_list';
    protected $primaryKey = 'plantroom_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'client_id', 'plantroom_id', 'plantroom_name','plantroom_type', 'pool_filters', 'pool_strainers', 'other_strainers', 'cl_injector', 'ph_injector', 
        'pac_injector', 'info'
    ];
}