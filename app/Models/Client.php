<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Client extends Model
{
    protected $table = 'clients';
    protected $primaryKey = 'client_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'client_id',
        'company_name', 'company_address', 'company_post_code', 'client_contact', 
        'client_phone', 'client_email', 'company_website', 'vat_number', 
        'company_registration_number', 'company_description'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->client_id)) {
                $model->client_id = Str::ulid();
            }
        });
    }

    public function plantrooms()
    {
        return $this->hasMany(PlantroomList::class, 'client_id', 'client_id');
    }
}