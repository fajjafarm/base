<?php 
// app/Models/Rental.php
namespace App\Models;
use Illuminate\Support\Str;
use App\Models\Bike;

use Illuminate\Database\Eloquent\Model;

class BikeRentalOrder extends Model
{
    use \Illuminate\Database\Eloquent\Concerns\HasUlids; // This trait adds ULID support

    protected $table = 'bike_rental_orders';
    protected $fillable = [
        'order_number', 'duration', 'date', 'bike_numbers', 'helmet_numbers', 'lock_numbers', 'status'
    ];

    protected $casts = [
        'bike_numbers' => 'array',
        'helmet_numbers' => 'array',
        'lock_numbers' => 'array',
        'date' => 'date',
    ];
}