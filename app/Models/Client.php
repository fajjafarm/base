<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';
    protected $primaryKey = 'client_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'company_name', 'company_address', 'company_post_code', 'client_contact', 
        'client_phone', 'client_email', 'company_website', 'vat_number', 
        'company_registration_number', 'company_description'
    ];
}