<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Support\Str;

class PoolTest extends Model
{
    use HasFactory;
    use HasFactory, HasUlids;

/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pool_tests';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';


   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pool_id',
        'user_id',
        'dpd1',
        'dpd3',
        'ccl',
        'ph',
        'status',
        'sample_location',
        'action_taken',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'pool_id' => 'string', // ULID is stored as a 26-character string
        'user_id' => 'integer',
        'dpd1' => 'float',
        'dpd3' => 'float',
        'ccl' => 'float',
        'ph' => 'float',
        'status' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the pool that this test belongs to.
     */
    public function pool()
    {
        return $this->belongsTo(PoolList::class, 'pool_id', 'pool_id');
    }

    /**
     * Get the user who performed this test.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Calculate Combined Chlorine Level (CCL) if not already set.
     *
     * @return float
     */
    public function calculateCCL()
    {
        if ($this->ccl === null) {
            return $this->dpd3 - $this->dpd1;
        }
        return $this->ccl;
    }

    /**
     * Check if CCL is within acceptable range (<= 1).
     *
     * @return bool
     */
    public function isCCLacceptable()
    {
        return $this->calculateCCL() <= 1;
    }

    /**
     * Scope a query to only include tests with high CCL.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHighCCL($query)
    {
        return $query->whereRaw('dpd3 - dpd1 > 1');
    }

    /**
     * Scope a query to filter by sample location.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $location
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBySampleLocation($query, $location)
    {
        return $query->where('sample_location', $location);
    }

    /**
     * Get available sample location options.
     *
     * @return array
     */
    public static function getSampleLocations()
    {
        return ['Pool', 'Control Panel'];
    }

    /**
     * Get available action taken options.
     *
     * @return array
     */
    public static function getActionOptions()
    {
        return [
            'None',
            'Changed Chlorine',
            'Changed Acid',
            'Changed PAC',
            'Recalibrated Controller',
            'Backwashed',
            'Supervisor Notified',
            'Code Brown',
            'Code Yellow',
            'Shocked'
        ];
    }
}