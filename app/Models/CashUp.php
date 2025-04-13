
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CashUp extends Model
{
    protected $keyType = 'string'; // ULID is a string
    public $incrementing = false; // Disable auto-incrementing

    protected $fillable = [
        'id',
        'date',
        'department',
        'denominations',
        'cash_total',
        'pdq_total',
        'amex_total',
        'x_reading',
        'z_reading',
        'expected_takings',
    ];

    protected $casts = [
        'denominations' => 'array',
        'expected_takings' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        // Automatically generate ULID when creating a new record
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::ulid();
            }
        });
    }
}