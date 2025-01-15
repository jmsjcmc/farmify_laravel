<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmFacility extends Model
{
    use HasFactory;

    protected $fillable = [
        'farm_owner_id',
        'facility_name',
        'description',
        'facility_type',
        'capacity',
        'facility_image',
        'is_operational'
    ];

    protected $casts = [
        'is_operational' => 'boolean',
        'capacity' => 'integer'
    ];

    public function farmOwner()
    {
        return $this->belongsTo(FarmOwner::class);
    }
}
