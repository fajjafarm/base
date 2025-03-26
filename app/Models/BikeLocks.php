<?php 
namespace App\Models;
use App\Models\BikeRental;

use Illuminate\Database\Eloquent\Model;

class BikeLocks extends Model
{
    protected $fillable = ['status'];

    public function bikelocks()
    {
        return $this->hasMany(BikeRental::class);
    }
    public static function readyToHire()
    {
        return static::where('status', 'ready for hire')->pluck('id')->toArray();
    }
}

